<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Model\TblUserModel;

use App\Http\Model\TblCompanyModel;
use App\Http\Model\TblCompanyContractModel;
use App\Http\Model\TblCompanyCoveragePlanModel;
use App\Http\Model\TblCompanyJobsiteModel;
use App\Http\Model\TblCompanyCalModel;

use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberPaymentModel;

use App\Http\Model\TblAvailmentModel;
use App\Http\Model\TblAvailmentPlanModel;
use App\Http\Model\TblAvailmentTagModel;

use App\Http\Model\TblPaymentModeModel;


class StaticFunctionController extends Controller
{
  

  public static function James($number)
  {
  	$data = $number + 1;
  	return $data;
  }
  public static function nullableToString($data = null, $output = 'string')
  {

      if($data == null && $output == 'string')
      {
           $data = '';
      }
      else if($data == null && $output == 'int')
      {
           $data = 0;
      }

      return $data;
  }
  public static function initials($full_name) 
  {
    $ret = '';
    foreach (explode(' ', $full_name) as $word)
        $ret  .=strtoupper(substr($word,0,1));
    return $ret;
    
  }
  public static function yesNotoInt($stryn = 'Y')
  {
        $int = 0;
        $stryn = strtoupper($stryn);
        if($stryn == 'Y' || $stryn == 'YES' || $stryn == 'TRUE')
        {
             $int = 1;
        }
        return $int;
  }
  public static function getid($str_name = '', $str_param = '')
  {
    $id = 0;
    switch ($str_param) 
    {
      case 'jobsite':
        $id = TblCompanyJobsiteModel::where('jobsite_name', $str_name)->value('jobsite_id');
        if($id == null)
        {
          $id = 420;
        }
        break;

      case 'availment':
        $id = TblAvailmentPlanModel::where('availment_plan_name', $str_name)->value('availment_plan_id');
        if($id == null)
        {
          $id = 420;
        }
        break;

      case 'company':
        $id = TblCompanyModel::where('company_name', $str_name)->value('company_id');
        break;

     

    }

    if($id == null)
    {    
      $id = 0;
    }
  return $id; 
  }
  public static function getAge($birthdate)
  {
    $age = date_create($birthdate)->diff(date_create('today'))->y;
    return $age;
  }
  
}
