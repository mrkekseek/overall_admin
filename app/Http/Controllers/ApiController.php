<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Federation_account;

class ApiController extends Controller
{
    //use DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
     * 
     */
    
    private static $message = [];
    private static $code;
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function get_federation_url($id = FALSE, $data = [], $request_method = FALSE)
    {
        $data = array_only($data, ['country', 'activity']);
        $data['request_method'] = $request_method;
        $rules = [
            'country' => 'required|size:2|exists:countries,iso_3166_2',
            'activity' => 'required|integer|exists:sports,id',
            'request_method' => 'in:GET',
        ];
        if (! $this->validate_request($data, $rules) )
        {
            $response = [
                'code' => self::$code,
                'message' => self::$message,
            ];
        }
        //find subdomain link 
        else
        {
            $query = Federation_account::query();
            $query->where('sport_id', $data['activity']);
            $query->with([
                'countries'=>function ($query) use ($data){
                    $query->where('iso_3166_2', $data['country']);
            },
                'subdomains']);
            $federation = $query->first();
            if (empty($federation))
            {
                $response = [
                    'code' => 4,
                    'message' => ["Subdomain not found"],
                ];
            }
            else
            {
                $response = [
                    'code' => 1,
                    'message' => ["Subdomain founded"],
                    'url' => $federation->subdomains->subdomain_link
                ];
            }
        }
        return $response;
    }
    
    public function register_club($id = FALSE, $data = [], $request_method = FALSE)
    {
        $data = array_only($data, ['first_name', 'last_name', 'email', 'phone_no', 'club_name', 'country', 'base_activity']);
        $data['request_method'] = $request_method;
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string|min:8|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'club_name' => 'required|string',
            'country' => 'required|size:2|exists:countries,iso_3166_2',
            'base_activity' => 'required|integer|exists:sports,id',
            'request_method' => 'in:POST',
        ];
        if (! $this->validate_request($data , $rules) )
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
            $owner->save();
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
                $club->country = $country->id;
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
    
    public function update_default_activity($id = FALSE, $data = [], $request_method = FALSE)
    {
        $data = array_only($data, ['club_url', 'activity']);
        $data['request_method'] = $request_method;
        $rules = [
            'club_url' => 'required|url',
            'activity' => 'required|integer|exists:sports,id',
            'request_method' => 'in:POST',
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
            $club = \App\Club_account::whereHas('subdomains', function($query) use ($data){
                $query->where('subdomain_link', $data['club_url']);
            })->with('subdomains')->first();
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
                        'message' => 'Club with url '.$data['club_url'].' not fount.',
                    ];
            }
        }
        return $response;
    }
    
    private function validate_request($data, $rules, $messages = [])
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
        else
        {
            return TRUE;
        }
    }
}
