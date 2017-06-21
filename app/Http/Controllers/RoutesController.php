<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
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
        
        if ($this->validate_api_key($data, $api_key) && method_exists($controller, $func))
        {
            //$request_method = request()->method();
            $vars = $controller->callAction($method, ['id' => $id, 'data' => $data, 'api_key'=>$api_key]);
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
    
    private function validate_api_key($data, $api_key)
    {
        $local_api_key = env('API_KEY');
        if (empty($local_api_key))
        {
            return [
                'code' => 2,
                'message' => ['Api not available.'],
            ];
        }
        
        if ( ! empty($api_key))
        {
            $validate_data = $this->generate_api_key($data);
            if ($api_key !== $validate_data['hash'])
            {
                self::$code = 2;
                self::$message[] = 'Incorect Api key for '.$validate_data['data_encoded'].'.';
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return [
                'code' => 2,
                'message' => ['Api key reqired.'],
            ];
        }
        return FALSE;
    }
    
    private function generate_api_key($data)
    {
        $method = $data['request_method'];
        unset($data['request_method']);
        $data = ($method == 'GET') ? http_build_query($data) : json_encode($data,JSON_UNESCAPED_SLASHES);
        $result['hash'] = base64_encode(hash_hmac('sha256', $data, self::APIKEY, TRUE));
        //dd($result['hash']);
        $result['data_encoded'] = $data;
        return $result;
    }
}