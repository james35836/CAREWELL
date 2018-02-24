<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Model\TblUserModel;
use App\Http\Model\TblUserInfoModel;

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
  public function user_save_profile(Request $request)
  {

  	  $userData['user_email']               = $request->user_email;
      $userData['user_position']            = $request->user_position;
      TblUserModel::where('user_id',$request->user_id)->update($userData);
      
      if($request->file('new_profile')!=null)
      {
  		$unique_name   = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,5);
	    $file = $request->file('new_profile');
	    $fileRef = $unique_name.'-'.$file->getClientOriginalName();
	    $file->move('profile',$fileRef);
	    $user_profile = '/profile/'.$fileRef.'';
      }
      else
      {
      	$user_profile  = $request->old_profile;
      }
      $userInfoData['user_profile']         = $user_profile;
      $userInfoData['user_first_name']      = $request->user_first_name;
      $userInfoData['user_middle_name']     = $request->user_middle_name;
      $userInfoData['user_last_name']       = $request->user_last_name;
      $userInfoData['user_gender']          = $request->user_gender;
      $userInfoData['user_birthdate']       = $request->user_birthdate;
      $userInfoData['user_contact_number']  = $request->user_contact_number;
      $userInfoData['user_address']         = $request->user_address;
      TblUserInfoModel::where('user_id',$request->user_id)->update($userInfoData);

      return "<div class='alert alert-success' style='text-align: center;'>Profile Updated Successfully!</div>";
      
      
  }
  
}
