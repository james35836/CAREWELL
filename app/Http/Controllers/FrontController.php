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
use Mail;


class FrontController extends Controller
{
  public static function allow_logged_out_users_only()
  {
    if(session("active"))
    {
      return Redirect::to("/dashboard")->send();
    }
  }
  public function login()
  {
    Self::allow_logged_out_users_only();
  	$data['page'] = 'Login Page';
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
          if($validate_login->archived==0)
          {
            Session::put('active','active_user_login');
            Session::put('user_id',$validate_login->user_id);
            
            return Redirect::to('/dashboard');
          }
          else
          {
            Session::flash('error', 'Your account has been deactivated.');
            return Redirect::to('/login');
          }
          
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
      return Redirect::back()->withErrors(['User Login is Incorectaa!', 'User Login is Incorect!']);

     // Session::flash('error', 'Email you entered does not exist to any account.');
     //  return Redirect::to('/login');
    }
  }
  public function register()
  {
    Self::allow_logged_out_users_only();
    $data['page'] = 'Register';
    return view('front.pages.register',$data);
  }
  public function logout()
  {
    Session::forget('active');
    Session::flash('error', 'Session Expired');
    return Redirect::to('/login');
  }
  public function reset_password()
  {
    Self::allow_logged_out_users_only();
    $data['page'] = 'Reset Password';
    return view('front.pages.reset_password',$data);
  }
  public function reset_password_submit(Request $request)
  {
    $check = TblUserModel::where('user_email',$request->resetEmail)
            ->join('tbl_user_info','tbl_user_info.user_info_id','=','tbl_user.user_id')
            ->first();
    if($check!=null)
    {
      $name       = $check->user_first_name." ".$check->user_last_name;
      $email      = $check->user_email;
      $password   = Crypt::decrypt($check->user_password);
      $link       = 'http://carewell.digimahouse.com/';
      $data       = array('name'=>$name,'email'=>$email,'password'=>$password,'link'=>$link);
      Mail::send('front.pages.reset_password_email', $data, function($message) use($data) 
      {
        $message->to('jamesomosora@gmail.com', 'Carewell Reset Password')->subject('Carewell Reset Password');
        $message->from('carewelladmin@admin.com','Carewell Assistance');
      });
      if(Mail::failures())
      {
        return "<div class='alert alert-danger' style='text-align: center;'>Something went wrong!</div>";
        
      }
      else 
      {
        return "<div class='alert alert-success' style='text-align: center;'>Please check your email!</div>";
      }
    }
    else
    {
      echo "wala";
    }

  }
}
