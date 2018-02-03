<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Session;


class ActiveAuthController extends Controller
{
	function __construct()
	{
		if(!session('active') || !session('user_id'))
	    {
	    	Session::flash('error', 'Session Expired');
			return Redirect::to("/")->send();
	    }
	}

	

}