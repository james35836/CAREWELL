<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Session;
use View;


class ActiveAuthController extends Controller
{
	function __construct()
	{
		View::share('james','1');
		if(!session('active') || !session('user_id'))
	    {
	    	
	    	Session::flash('error', 'Session Expired');
			return Redirect::to("/")->send();
	    }
        
	    View::share('edit','james');

	}

	

}