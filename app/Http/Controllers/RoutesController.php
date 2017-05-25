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
    			if (method_exists($controller, $method))
    			{
	    			$data = request()->all();
				    
				    $vars = $controller->callAction($method, ['id' => $id, 'data' => $data]);
	        	}
    		}

    		$view = implode('.', [$unit, $method]);
    		if (view()->exists($view))
    		{
			    return view(implode('.', [$unit, $method]), $vars);
			}
    		else
    		{
    			return view('layouts.404');
    		}
    	}

    	return redirect('login');
    }
}