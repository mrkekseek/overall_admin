<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Federation_account;

class ApiController extends Controller
{
    const VERSION = '0.7.3.0';

    private static $message = [];
    private static $code;
    
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function get_federation_url(Request $request)
    {
        $data = $request->only('account_key');
        $rules = [
            'account_key' => 'required|size:29',
        ];
        if (! $this->validate_request($data, $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $federation = Federation_account::where('account_key', $data['account_key'])
                ->with('subdomains')    
                ->first();
            if (empty($federation->subdomains))
            {
                $response = [
                    'code' => 4,
                    'message' => ["Subdomain url not found"],
                ];
            }
            else
            {
                $response = [
                    'code' => 1,
                    'message' => ["Subdomain url founded"],
                    'url' => $federation->subdomains->subdomain_link
                ];
            }
        }
        return $response;
    }
    
    public function register_club(Request $request)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'phone_no', 'club_name', 'country', 'base_activity', 'middle_name', 'date_of_birth', 'gender');
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'string',
            'email' => 'required|email',
            'phone_no' => 'required|string|min:8',
            'date_of_birth'=>'required|date',
            'gender'=>'required|in:m,f',
            'club_name' => 'required|string',
            'country' => 'required|size:2|exists:countries,iso_3166_2',
            'base_activity' => 'required|integer|exists:sports,id',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $country = \App\Countries::where('iso_3166_2', $data['country'])->first();
            $owner = \App\Club_owner::firstOrNew(['email_address'=>$data['email']]);
            if ( ! $owner->exists)
            {
                $owner->first_name = $data['first_name'];
                $owner->last_name = $data['last_name'];
                $owner->middle_name = $data['middle_name'];
                $owner->date_of_birth = date('Y-m-d', strtotime($data['date_of_birth']));
                $owner->gender = $data['gender'];
                $owner->phone_number = $data['phone_no'];
                $owner->country = $country->iso_3166_2;
                $owner->save();
            }
            $club = \App\Club_account::firstOrNew([
                'name' => $data['club_name'],
                'owner_id' => $owner->id,
            ]);
            if ($club->exists)
            {
                self::$message[] = 'Club with name "'. $data['club_name']. '" and owner '.$data['email']. ' exists'; 
                $response = [
                    'code' => 4,
                    'message' => self::$message,
                ];
                return $response;
            }
            else
            {
                $club->country = $country->iso_3166_2;
                $club->account_key = $club->generate_account_key();
                $club->main_sport_id = $data['base_activity'];
                self::$message[] = $club->save() ? 'Club '.$data['club_name'].' created.' : '';
                $response = [
                    'code' => 1,
                    'message' => self::$message,
                ];
            }
            
        }
        return $response;
    }
    
    public function mark_registration (Request $request)
    {
        $data = $request->only('account_key', 'activity');
        $rules = [
            'account_key' => 'required|size:29',
            'activity' => 'required|integer|exists:sports,id',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $club = \App\Club_account::where('account_key', $data['account_key'])->first();
            if ( ! empty($club))
            {
                if ($club->main_sport_id != $data['activity'])
                {
                    $response = [
                        'code' => 4,
                        'message' => 'Current club activity not '.$data['activity'].'.',
                    ];
                }
                else
                {
                    $club->status = 2;
                    if ($club->save())
                    {
                        $response = [
                            'code' => 1,
                            'message' => 'Club registration marked as finished',
                        ];
                    }
                }
            }
            else 
            {
                $response = [
                    'code' => 4,
                    'message' => 'Club with key '.$data['account_key'].' not fount.',
                ];
            }
        }
        return $response;
    }
    
    public function update_default_activity(Request $request)
    {
        $data = $request->only('account_key', 'activity');
        $rules = [
            'account_key' => 'required|size:29',
            'activity' => 'required|integer|exists:sports,id',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $club = \App\Club_account::where('account_key', $data['account_key'])->first();
            if ( ! empty($club))
            {
                $club->main_sport_id = $data['activity'];
                if ($club->save())
                {
                    $response = [
                        'code' => 1,
                        'message' => 'Club activity set to '.$data['activity'].'.',
                    ];
                }
            }
            else 
            {
                $response = [
                    'code' => 4,
                    'message' => 'Club with key '.$data['account_key'].' not found.',
                ];
            }
        }
        return $response;
    }
    
    public function status()
    {
        return [
            'code' => 1,
            'message' => 'Version '.self::VERSION
        ];
    }
    
    public function validate_account_key(Request $request)
    {
        $data = $request->only('account_key');
        $rules = [
            'account_key' => 'required|size:29',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $club = \App\Club_account::where('account_key', $data['account_key'])->with('owners', 'subdomains')->first();
            $federation = \App\Federation_account::where('account_key', $data['account_key'])->with('owners', 'subdomains')->first();
            if ( ! empty($club))
            {
                $owner = [
                    'first_name' => $club->owners->first_name,
                    'last_name' => $club->owners->last_name,
                    'middle_name' => $club->owners->middle_name,
                    'email_address' => $club->owners->email_address,
                    'phone_number' => $club->owners->phone_number,
                ];
                $account = [
                    'name' => $club->name,
                    'subdomain' => empty($club->subdomains) ? FALSE : $club->subdomains->subdomain_link,
                ];
                $message = "Club founded.";
                $account_details = [
                    'owner' => $owner,
                    'account' => $account,
                ];
                $response = [
                    'code' => 1,
                    'account_details' => $account_details,   
                    'message' => $message,
                ];
            }
            elseif( ! empty($federation))
            {
                $owner = [
                    'first_name' => $federation->owners->first_name,
                    'last_name' => $federation->owners->last_name,
                    'middle_name' => $federation->owners->middle_name,
                    'email_address' => $federation->owners->email_address,
                    'phone_number' => $federation->owners->phone_number,
                ];
                $account = [
                    'name' => $federation->name,
                    'subdomain' => empty($federation->subdomains) ? FALSE : $federation->subdomains->subdomain_link,
                ];
                $message = "Federation founded.";
                $account_details = [
                    'owner' => $owner,
                    'account' => $account,
                ];
                $response = [
                    'code' => 1,
                    'account_details' => $account_details,   
                    'message' => $message,
                ];
            }
            else 
            {
                $response = [
                        'code' => 4,
                        'message' => 'Club or federation with key '.$data['account_key'].' not found.',
                    ];
            }
        }
        return $response;
    }
    
    public function get_available_countries(Request $request)
    {
        $data = $request->only('selection');
        $rules = [
            'selection' => 'required|in:active,all',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $countries = [];
            switch ($data['selection'])
            {
                case 'all':
                    $countries = \App\Countries::select('name','iso_3166_2')->orderBy('name','ASC')->get();
                    break;
                case 'active':
                    $countries = \App\Countries::select('name','iso_3166_2')->orderBy('name','ASC')->get();
                    break;
            }
            $response = [
                    'code' => 1,
                    'countries' => $countries,   
                    'message' => '',
            ];
        }
        return $response;
    }
    
    public function get_available_activities(Request $request)
    {
        $data = $request->only('selection');
        $rules = [
            'selection' => 'required|in:active,all',
        ];
        if ( ! $this->validate_request($data , $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        else
        {
            $sports = [];
            switch ($data['selection'])
            {
                case 'all':
                    $sports = \App\Sport::select('id','name')->orderBy('id', 'ASC')->get();
                    break;
                case 'active':
                    $sports = \App\Sport::select('id','name')->orderBy('id', 'ASC')->get();
                    break;
            }
            $response = [
                    'code' => 1,
                    'activities' => $sports,   
                    'message' => '',
            ];
        }
        return $response;
    }
    
    private function validate_request($data, $rules)
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            foreach ($validator->errors()->all() as $error)
            {
                self::$message[] = $error;
            }
            self::$code = 3;
            return FALSE;
        }
        return TRUE;
    }
}
