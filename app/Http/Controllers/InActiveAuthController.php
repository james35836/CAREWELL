<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Session;


class InActiveAuthController extends Controller
{
	function __construct()
	{
		if(session('active') || session('user_id'))
	    {
	    	return Redirect::to("/dashboard");
	    }
	}

	

}