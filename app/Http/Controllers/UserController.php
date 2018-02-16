<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Model\TblUserModel;
use Redirect;
use Session;
use Crypt;

use App\Http\Controllers\StaticFunctionController;

class UserController extends Controller
{
  public function user_view_profile()
  {
  	$data['user'] = StaticFunctionController::global();
    return view('carewell.modal_pages.user_profile',$data);
  }
  
  
}
