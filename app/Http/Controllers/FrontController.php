<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InActiveAuthController;
use App\Http\Model\TblUserModel;
use Redirect;
use Session;
use Crypt;


class FrontController extends Controller
{
  

  public function login()
  {
  	$data['page'] = 'Login';
  	return view('front.pages.login',$data);
  }
  public function  login_submit(Request $request)
  {
    $email          = $request->email;
    $password       = $request->password;
    $validate_login = TblUserModel::where('user_email',$email)->first();
    if($validate_login)
    {
      if($validate_login->user_email==$email)
      {
        if(Crypt::decrypt($validate_login->user_password)==$password)
        {
          Session::put('active','active_user_login');
          Session::put('user_id',$validate_login->user_id);
          return Redirect::to('/dashboard');
        }
        else
        {
          Session::flash('error', 'Password you entered is incorrect.');
          return Redirect::to('/login');
        }
      }
      else
      {
        Session::flash('error', 'Email you entered does not exist to any account.');
        return Redirect::to('/login');
      }
    }
    else
    {
      Session::flash('error', 'Email you entered does not exist to any account.');
        return Redirect::to('/login');
    }
  }
  public function register()
  {
    $data['page'] = 'Register';
    return view('front.pages.register',$data);
  }
  public function logout()
  {
    Session::forget('active');
    Session::flash('error', 'Session Expired');
    return Redirect::to('/login');
  }
}
