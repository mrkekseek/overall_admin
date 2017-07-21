<?php

namespace App\Http\Libraries;



class ApiClub
{
    static $subdomain_key;
    
    static $error = '';

    public static function create_owner($owner, $subdomain)
    {
        self::$subdomain_key = 'apiKey-@f4g8-FH2-8809x-dj22aSwrL=cP24Zd234-TuJh87EqChVBGfs=SG564SD-fgAG47-747AhAP=U456=O97=Y=O6A=OC7b5645MNB-V4OO7Z-qw-OARSOc-SD456OFoCE-=64RW67=QOVq=';
        $subdomain = self::handle_url($subdomain);
        $response = self::send_curl($owner, $subdomain.'apic/register_owner', 'POST');
        $message = '';
        if ( ! isset($response->code))
        {
            return [
                'success' => FALSE,
                'message' => 'Somerthing whent wront',
            ];
        }
        if (is_array($response->message))
        {
            foreach ($response->message as $item)
            {
                $message = $message.$item;
            }
        }
        else
        {
            $message = $response->message;
        }
        if ($response->code == 1) 
        {
            $result['success'] = true;
            $result['message'] = $message;
        } 
        else 
        {
            $result['success'] = false;
            $result['message'] = $message;
        }
        return $result;
    }
    
    
    public static function create_club($club, $subdomain)
    {
        self::$subdomain_key = 'apiKey-@f4g8-FH2-8809x-dj22aSwrL=cP24Zd234-TuJh87EqChVBGfs=SG564SD-fgAG47-747AhAP=U456=O97=Y=O6A=OC7b5645MNB-V4OO7Z-qw-OARSOc-SD456OFoCE-=64RW67=QOVq=';
        $subdomain = self::handle_url($subdomain);
        $response = self::send_curl($club, $subdomain.'apic/assign_subdomain_settings', 'POST');
        $message = '';
        if (is_array($response->message))
        {
            foreach ($response->message as $item)
            {
                $message = $message.$item;
            }
        }
        else
        {
            $message = $response->message;
        }
        if ($response->code == 1) 
        {
            $result['success'] = true;
            $result['message'] = $message;
        } 
        else 
        {
            $result['success'] = false;
            $result['message'] = $message;
        }
        return $result;
    }
    
    public static function get_all_locations_and_resources($data, $subdomain)
    {
        self::$subdomain_key = 'apiKey-@f4g8-FH2-8809x-dj22aSwrL=cP24Zd234-TuJh87EqChVBGfs=SG564SD-fgAG47-747AhAP=U456=O97=Y=O6A=OC7b5645MNB-V4OO7Z-qw-OARSOc-SD456OFoCE-=64RW67=QOVq=';
        $subdomain = self::handle_url($subdomain);
        $response = self::send_curl($data, $subdomain.'apic/get_all_locations_and_resources', 'POST');
        if (is_array($response->message))
        {
            foreach ($response->message as $item)
            {
                $message = $message.$item;
            }
        }
        else
        {
            $message = $response->message;
        }
        if ($response->code == 1) 
        {
            $result['success'] = true;
            $result['locations'] = $response->locations;
            $result['message'] = $message;
        } 
        else 
        {
            $result['success'] = false;
            $result['message'] = $message;
        }
        return $result;
    }

    private static function generateApiKey($data)
    {
        if (is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_SLASHES);
        }
        $hash = base64_encode(hash_hmac('sha256', $data, self::$subdomain_key, TRUE));
        return $hash;
    }


    private static function send_curl($data, $api_url, $method = 'GET')
    {
        if ($method == 'GET') {
            $api_url .= (string)$data;
        }
        $ApiKey = self::generateApiKey($data);
        $curl = curl_init($api_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = [
            'Content-Type: application/json',
            'ApiKey:' . $ApiKey,
        ];
        if (in_array($method, ['POST', 'PUT']) && is_array($data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $headers[] = 'Accept: application/json';
        } else {
            $headers[] = 'Accept: text/plain';
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_results = curl_exec($curl);
        $result = json_decode($curl_results);
        return $result;
    }
    
    private static function handle_url($subdomain)
    {
        if ($subdomain[strlen($subdomain)-1] !== '/')
        {
            $subdomain .= '/';
        }
        return $subdomain;
    }
}
