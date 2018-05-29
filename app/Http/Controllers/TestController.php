<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\TblUserModel;
use Illuminate\Support\Facades\Input;
use Carbon;
use Excel;
use App\Http\Model\TblApprovalModel;

use DB;
use PDF2;




class TestController extends Controller
{
  public function global()
  {
    $user="James Omosora";
    return $user;
  }

 public function export_pdf()
 {
      $data["page"] = "Monthly Government Forms";
      $year = 2017;
      $shop_id = 7;
      $contri_info = TblApprovalModel::get();
      $data['company_id1'] = 1;
      $data["contri_info"] = 2; 
      $data["month"] = 33;
      $data["month_name"] = 44;
      $data["year"] = $year;
      $data['_company'] = TblApprovalModel::get();

      $format["title"] = $data['page'];
      $format["format"] = "A4";
      $format["default_font"] = "sans-serif";
      $pdf = PDF2::loadView('carewell.additional_pages.approval_export_pdf', $data, [], $format);
      return $pdf->stream('document.pdf');
 }
}
