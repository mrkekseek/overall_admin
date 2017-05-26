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
}