<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyApiKey
{
    private static $message;

    
    public function handle($request, Closure $next, $guard = null)
    {
        $request_method = strtolower(request()->method());
        $api_key = request()->header('ApiKey');
        $data = request()->all();
        if ($this->validate_api_key($data, $request_method, $api_key))
        {
            return $next($request);
        }
        else
        {
            $result = [
                'code' => 2,
                'message' => [self::$message],
            ];
            $result = json_encode($result, JSON_NUMERIC_CHECK);
            return response($result);

        }
    }
    private function validate_api_key($data, $request_method, $api_key)
    {
        $local_api_key = env('API_KEY');
        if (empty($local_api_key))
        {
            self::$message = 'Api not available.';
            return FALSE;
        }
        if ( ! empty($api_key))
        {
            $validate_data = $this->generate_api_key($data, $request_method);
            if ($api_key !== $validate_data['hash'])
            {
                self::$message = 'Incorect Api key for '.$validate_data['data_encoded'].'.';
                //dd(self::$message);
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            self::$message = 'Api key reqired.';
            return FALSE;
        }
        return FALSE;
    }
    
    private function generate_api_key($data, $request_method)
    {
        $data = ($request_method == 'get') ? http_build_query($data) : json_encode($data,JSON_UNESCAPED_SLASHES);
        $result['hash'] = base64_encode(hash_hmac('sha256', $data, env('API_KEY'), TRUE));
        $result['data_encoded'] = $data;
        //echo $result['hash']."<br>"; dd('stop');
        return $result;
    }
}
