<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\TblUserModel;
use App\Http\Controllers\ActiveAuthController;
use Redirect;
use Session;
use Crypt;

use App\Http\Controllers\StaticFunctionController;

class AdminController extends ActiveAuthController
{
  public function admin_center()
  {
  	$data['page'] = 'Admin Panel'; 
    $data['user'] = CarewellController::global();
    $data['_user']= TblUserModel::join('tbl_user_info','tbl_user_info.user_id','=','tbl_user.user_id')->paginate(10);
  	return view('carewell.pages.admin_center',$data);
  }
  public function admin_create_user()
  {
    $data['page'] = 'Admin Panel'; 
    $data['user'] = CarewellController::global();

    return view('carewell.modal_pages.admin_create_user',$data);
  }
  
}
