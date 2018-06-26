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
	function __construct(Request $request)
	{
		View::share('james','1');
		if(!session('active') || !session('user_id'))
	    {
	    	
	    	Session::flash('error', 'Session Expired');
			return Redirect::to("/")->send();
	    }
	    if($request->segment(1)=="dashboard")
	    {
	    	$_user_access = array(1,2,3);
	    	$access = array(2,3,4,5);
	    	foreach($_user_access as $key=>$user_access)
	    	{
	    		if(in_array($user_access, $access))
	    		{
	    			$data['create'] = "hidden";
	    			$data['modify'] = "hidden";
	    			$data['delete'] = "hidden";
	    			$data['move']   = "hidden";
	    		}
	    	}
	    	

	    	View::share($data);
	    }
        
	    View::share('edit','james');
	}

	

}