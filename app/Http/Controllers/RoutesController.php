<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
    private static $api_message;
    
    public function index($unit, $method, $id = FALSE)
    {
    	if (Auth::check())
    	{
    		$vars = [];
    		if (class_exists('\App\Http\Controllers\\'.ucfirst($unit).'Controller'))
    		{
    			$controller = app()->make('\App\Http\Controllers\\'.ucfirst($unit).'Controller');
                $m = strtolower(request()->method());
                $func = strtolower($method).($m != 'get' ? ucfirst($m) : '');
    			if (method_exists($controller, $func))
    			{
	    			$data = request()->all();
				    $vars = $controller->callAction($func, ['id' => $id, 'data' => $data]);

                    if ( ! is_array($vars))
                    {
                        return $vars;
                    }
	        	}
    		}

            $file = implode('.', [$unit, $method]);
            $view = view('layouts.404');
            if (view()->exists($file))
            {
                $view = view($file);
            }

            $vars['id'] = $id;
            $view->with($vars);

            return $view;
    	}

    	return redirect('login');
    }

    public function ajax($unit, $method, $id = FALSE)
    {
        $vars = [];
        if (Auth::check())
        {
            if (class_exists('\App\Http\Controllers\\'.ucfirst($unit).'Controller'))
            {
                $controller = app()->make('\App\Http\Controllers\\'.ucfirst($unit).'Controller');
                if (method_exists($controller, $method))
                {
                    $data = request()->all();
                    $vars = $controller->callAction($method, ['id' => $id, 'data' => $data]);
                }
            }
        }

        $vars = json_encode($vars, JSON_NUMERIC_CHECK);
        return $vars;
    }
    
    public function api($method, $id = FALSE)
    {
        $vars = [];
        $controller = app()->make('\App\Http\Controllers\ApiController');
        $request_method = strtolower(request()->method());
        $func = strtolower($method).(ucfirst($request_method));
        $api_key = request()->header('ApiKey');
        $data = request()->all();
        if ( ! $this->validate_api_key($data, $request_method, $api_key) )
        {
            $vars = [
                'code' => 2,
                'message' => [self::$api_message],
            ];
        }
        elseif (method_exists($controller, $func))
        {
            $vars = $controller->callAction($func, ['id' => $id, 'data' => $data]);
        }
        else
        {
            $vars = [
                'code' => 5,
                'message' => ['Method not fount.'],
            ];
            
        }
        $vars = json_encode($vars, JSON_NUMERIC_CHECK);
        return $vars;
    }
    
    private function validate_api_key($data, $request_method, $api_key)
    {
        $local_api_key = env('API_KEY');
        if (empty($local_api_key))
        {
            self::$api_message = 'Api not available.';
            return FALSE;
        }
        if ( ! empty($api_key))
        {
            $validate_data = $this->generate_api_key($data, $request_method);
            if ($api_key !== $validate_data['hash'])
            {
                self::$api_message = 'Incorect Api key for '.$validate_data['data_encoded'].'.';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            self::$api_message = 'Api key reqired.';
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