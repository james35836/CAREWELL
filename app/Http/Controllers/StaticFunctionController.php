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

use App\http\Model\TblProviderModel;


class StaticFunctionController extends Controller
{
  public function getCompanyCoveragePlan(Request $request)
  {
    if($request->ajax())
    {
        $data['_coveragePlan']  = TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$request->company_id)
                        ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_company_coverage_plan.availment_plan_id')
                        ->get();
        $data['_coveragePlanList'] = '<option>COVERAGE PLAN';
        foreach($data['_coveragePlan'] as $coveragePlan)
        {
            $data['_coveragePlanList']     .= '<option value='.$coveragePlan->availment_plan_id.'>'.$coveragePlan->availment_plan_name;
        }
        return $data['_coveragePlanList'];
    }
  }
  public function getCompanyJobsite(Request $request)
  {
    if($request->ajax())
    {
        $data['_jobsite']  = TblCompanyJobsiteModel::where('company_id',$request->company_id)->get();
        $data['jobsiteList'] = '<option>DEPLOYMENT';
        foreach($data['_jobsite'] as $jobsite)
        {
            $data['jobsiteList']     .= '<option value='.$jobsite->jobsite_id.'>'.$jobsite->jobsite_name;
        }
        return $data['jobsiteList'];
    }
  }

  public static function James($number)
  {
  	$data = $number + 1;
  	return $data;
  }
  public static function nullableToString($data = null, $output = 'string')
  {

      if($data == null && $output == 'string')
      {
           $data = 'N/A';
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
          $id = 1;
        }
        break;

      case 'availment':
        $id = TblAvailmentPlanModel::where('availment_plan_name', $str_name)->value('availment_plan_id');
        if($id == null)
        {
          $id = 1;
        }
        break;

      case 'company':
        $id = TblCompanyModel::where('company_code', $str_name)->value('company_id');
        if($id == null)
        {
          $id = 1;
        }
        break;

      case 'provider':
        $id = TblProviderModel::where('provider_name', $str_name)->value('provider_id');
        if($id == null)
        {
          $id = 1;
        }
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
