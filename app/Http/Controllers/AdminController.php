<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ActiveAuthController;

use App\Http\Model\TblUserModel;
use App\Http\Model\TblUserInfoModel;

use Redirect;
use Session;
use Crypt;
use Mail;
use Carbon\Carbon;

use App\Http\Controllers\StaticFunctionController;

class AdminController extends ActiveAuthController
{
  public function admin_center()
  {
  	$data['page'] = 'Admin Panel'; 
    $data['user'] = StaticFunctionController::global();
    $data['_user_data']= TblUserModel::join('tbl_user_info','tbl_user_info.user_id','=','tbl_user.user_id')->paginate(10);
  	return view('carewell.pages.admin_center',$data);
  }
  public function admin_create_user()
  {
    $data['page'] = 'Admin Panel'; 
    $data['user'] = StaticFunctionController::global();

    return view('carewell.modal_pages.admin_create_user',$data);
  }
  public function admin_create_user_submit(Request $request)
  {
    $checkData = TblUserModel::where('user_email',$request->user_email)->first();
    if(count($checkData) == 1)
    {
      return "Email exist";
    }
    else
    {
      $password   = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz1234567890"), 0,8);
      
      $userData = new TblUserModel;
      $userData->user_email               = $request->user_email;
      $userData->user_password            = Crypt::encrypt($password);
      $userData->user_position            = $request->user_position;
      $userData->save();

      $userInfoData = new TblUserInfoModel;
      $userInfoData->user_profile         = '/profile/default_profile.jpg';
      $userInfoData->user_first_name      = $request->user_first_name;
      $userInfoData->user_middle_name     = $request->user_middle_name;
      $userInfoData->user_last_name       = $request->user_last_name;
      $userInfoData->user_gender          = $request->user_gender;
      $userInfoData->user_birthdate       = $request->user_birthdate;
      $userInfoData->user_contact_number  = $request->user_contact_number;
      $userInfoData->user_id_number       = $request->user_id_number;
      $userInfoData->user_address         = $request->user_address;
      $userInfoData->user_created         = Carbon::now();
      $userInfoData->user_id              = $userData->user_id;
      $userInfoData->save();

      $name       = $request->user_first_name." ".$request->user_last_name;
      $email      = $userData->user_email;
      $password   = Crypt::decrypt($userData->user_password);
      $link       = 'http://carewell.digimahouse.com/';
      $data       = array('name'=>$name,'email'=>$email,'password'=>$password,'link'=>$link);
      $check_mail = Mail::send('carewell.additional_pages.email_file', $data, function($message) use($data) 
                  {
                    $message->to($data['email'], 'Carewell Password')->subject('Carewell Login');
                    $message->from('carewelladmin@admin.com','Carewell Assistance');
                  });
      if($userInfoData->save()&&$userInfoData->save())
      {
        return "<div class='alert alert-success' style='text-align: center;'>User Added Successfully!</div>";
      }
      else 
      {
        return "<div class='alert alert-danger' style='text-align: center;'>Something went wrong!</div>";
      }
    }
  }
  public function admin_view_user_deatils($user_id)
  {
    $data['user_details'] = TblUserModel::where('tbl_user.user_id',$user_id)
                          ->join('tbl_user_info','tbl_user_info.user_id','=','tbl_user.user_id')
                          ->first();
    return view('carewell.modal_pages.admin_user_details',$data);
  }
  
}
