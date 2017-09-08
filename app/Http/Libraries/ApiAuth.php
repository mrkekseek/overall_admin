<?php

namespace App\Http\Libraries;

use App;

class ApiAuth
{
    public static function Accounts($data)
    {
        $response = self::send_curl($data, 'api/Accounts/', 'GET');
        return $response;
    }
    
    public static function AccountsGetAll($data)
    {
        $response = self::send_curl($data, 'api/Accounts/GetAll', 'GET');
        return $response;
    }
    
    public static function AccountsId($data)
    {
        $response = self::send_curl($data, 'api/Accounts/', 'GET');
        return $response;
    }
    
    public static function AccountsGetByUsername($data)
    {
        $response = self::send_curl($data, 'api/Accounts/GetByUsername', 'GET');
        return $response;
    }
    
    public static function AccountsGetByPhoneNumber($data)
    {
        $response = self::send_curl($data, 'api/Accounts/GetByPhoneNumber', 'GET');
        return $response;
    }
    
    public static function AccountsGetByEmail($data)
    {
        $response = self::send_curl($data, 'api/Accounts/GetByEmail', 'GET');
        return $response;
    }
    
    public static function AccountsCheckIfExists($data)
    {
        $response = self::send_curl($data, 'api/Accounts/CheckIfExists', 'GET');
        return $response;
    }
    
    public static function AccountsResetPassword($data)
    {
        $response = self::send_curl($data, 'api/Accounts/ResetPassword', 'GET');
        return $response;
    }
    
    public static function AccountsGetAccountWithActivities($data)
    {
        $response = self::send_curl($data, 'api/Accounts/GetAccountWithActivities', 'GET');
        return $response;
    }
    
    public static function EnumsGetActivities($data)
    {
        $response = self::send_curl($data, 'api/Enums/GetActivities', 'GET');
        return $response;
    }
    
    
    private static function generateApiKey($data)
    {
        if (is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        $hash = base64_encode(hash_hmac('sha256', $data, env('SSO_API_APIKEY',false), TRUE));

        return $hash;
    }
    
    private static function send_curl($data, $api_url, $method = 'GET')
    {
        if ($method == 'GET') {
            $api_url .= (string)$data;
        }
        $ApiKey = self::generateApiKey($data);

        $curl = curl_init(env('SSO_API',false) . $api_url);

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
        return $curl_results;
    }
}