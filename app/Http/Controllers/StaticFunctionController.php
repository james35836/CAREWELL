<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;



use App\Http\Model\TblUserModel;
use App\Http\Model\TblUserInfoModel;


use App\Http\Model\TblCompanyModel;
use App\Http\Model\TblCompanyContractModel;
use App\Http\Model\TblCompanyCoveragePlanModel;
use App\Http\Model\TblCompanyDeploymentModel;
use App\Http\Model\TblCalModel;
use App\Http\Model\TblCalMemberModel;
use App\Http\Model\TblCompanyTrunklineModel;



use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberPaymentModel;
use App\Http\Model\TblMemberDependentModel;
use App\Http\Model\TblMemberGovernmentCardModel;



use App\Http\Model\TblAvailmentModel;

use App\Http\Model\TblCoveragePlanModel;
use App\Http\Model\TblAvailmentTagModel;

use App\Http\Model\TblPaymentModeModel;

use App\Http\Model\TblProviderModel;
use App\Http\Model\TblProviderBillingModel;

use App\Http\Model\TblDoctorModel;
use App\Http\Model\TblDoctorSpecializationModel;
use App\Http\Model\TblDoctorProviderModel;
use App\Http\Model\TblSpecializationModel;

use App\Http\Model\TblApprovalModel;

use App\Http\Model\TblProcedureModel;
use App\http\Model\TblProcedureAvailedModel;
use App\Http\Model\TblProcedureDoctorModel;

use App\Http\Model\TblLaboratoryModel;


use App\Http\Model\TblScheduleOfBenefitsModel;


class StaticFunctionController extends Controller
{
  public static function global()
  {
    $user_info = TblUserInfoModel::where('tbl_user_info.user_id',session('user_id'))
                ->join('tbl_user','tbl_user.user_id','=','tbl_user_info.user_id')
                ->first();
    return $user_info;
  }
  public static function returnMessage($alert_message="",$str_name="")
  {
    if($alert_message=="success")
    {
      return "<div class='alert alert-success' style='text-align: center;'>".$str_name." Added Successfully!</div>";
    }
    else
    {
      return "<div class='alert alert-danger' style='text-align: center;'>".$str_name." transaction Failed!</div>";
    }
  }
  public function getProviderDoctor(Request $request)
  {
    if($request->ajax())
    {
        $data['_provider_doctor']  = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$request->value)
                              ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_doctor_provider.doctor_id')
                              ->get();
        $data['_provider_doctors'] = '<option>-SELECT DOCTOR-';
        foreach($data['_provider_doctor'] as $provider_doctor)
        {
            $data['_provider_doctors']     .= '<option value='.$provider_doctor->doctor_id.'>'.$provider_doctor->doctor_first_name." ".$provider_doctor->doctor_last_name;
        }
        return $data['_provider_doctors'];
    }
  }
  
  public function getDoctorSpecialty(Request $request)
  {
    if($request->ajax())
    {
        $data['_specialization']  = TblDoctorSpecializationModel::where('tbl_doctor_specialization.doctor_id',$request->value)
                                    ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                    ->get();
        $data['_specializationList'] = '';
        foreach($data['_specialization'] as $specializationDoctor)
        {
            $data['_specializationList']     .= '<option value='.$specializationDoctor->specialization_id.'>'.$specializationDoctor->specialization_name;
        }
        return $data['_specializationList'];
    }
  }
  public function getLaboratoryAmount(Request $request)
  {
    if($request->ajax())
    {
        $laboratory  = TblLaboratoryModel::where('tbl_laboratory.laboratory_id',$request->value)->first();
        $amount = $laboratory ->laboratory_amount;
        return $amount;
    }
  }
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
  
  public static function generateUniversalId($display_name,$birthdate)
  {
    
    $member_count = TblMemberModel::count();
    if($member_count==null||$member_count==0)
    {
      $member_data = sprintf("%08d",1);
    }
    else
    {
      $member = TblMemberModel::orderBy('member_id','DESC')->first();
      $member_data = sprintf("%08d",$member->member_id + 1);
    }
    $universal_id = Self::initials($display_name)."-".Self::birthdate($birthdate)."-".$member_data;

    return $universal_id;
  }
  public static function generateCarewellId($company_code)
  {
    $member_company_count = TblMemberCompanyModel::count();
    if($member_company_count==null||$member_company_count==0)
    {
      $member_company_data = sprintf("%05d",1);
    }
    else
    {
      $member_company = TblMemberCompanyModel::orderBy('member_company_id','DESC')->first();
      $member_company_data = sprintf("%05d",$member_company->member_company_id + 1);
    }
    $carewell_id = $company_code."-".date("my")."-".$member_company_data;

    return $carewell_id;
  }
  public static function updateReferenceNumber($str_name = '')
  {
    $refrenceNumber = '00000';
    switch ($str_name) 
    {
      case 'approval':
        $approval_count          =  TblApprovalModel::count();
        if($approval_count==null||$approval_count==0)
        {
          $refrenceNumber = 'APP-'.str_replace(["-", "–"], "",date("m-y")).'-'.sprintf("%05d",1);
        }
        else
        {
          $approval              =  TblApprovalModel::orderBy('approval_id','DESC')->first();
          $refrenceNumber = 'APP-'.str_replace(["-", "–"], "",date("m-y")).'-'.sprintf("%05d",$approval->approval_id+1);
       
        }
        break;
      case 'doctor':
        $count_doctor = TblDoctorModel::count();
        if($count_doctor==null||$count_doctor==0)
        {
          $refrenceNumber = sprintf("%05d",1);
        }
        else
        {
          $doctor = TblDoctorModel::orderBy('doctor_id','DESC')->first();
          $refrenceNumber = sprintf("%05d",$doctor->doctor_id+1);
        }

        break;

      case 'company':
        $count_company = TblCompanyModel::count();
        if($count_company==null||$count_company==0)
        {
          $refrenceNumber = sprintf("%05d",1);
        }
        else
        {
          $company = TblCompanyModel::orderBy('company_id','DESC')->first();
          $refrenceNumber = sprintf("%05d",$company->company_id+1);
        }
        break;

      case 'contract':
        $count_contract = TblCompanyContractModel::count();
        if($count_contract==null||$count_contract==0)
        {
          $refrenceNumber = sprintf("%05d",1);
        }
        else
        {
          $contract = TblCompanyContractModel::orderBy('company_id','DESC')->first();
          $refrenceNumber = sprintf("%05d",$contract->contract_id+1);
        }
        break;
      case 'member_company':
        $member_company_count = TblMemberCompanyModel::count();
        if($member_company_count==null||$member_company_count==0)
        {
          $refrenceNumber = sprintf("%05d",1);
        }
        else
        {
          $member_company = TblMemberCompanyModel::orderBy('member_company_id','DESC')->first();
          $refrenceNumber = sprintf("%05d",$member_company->member_company_id + 1);
        }
        break;
      case 'billing_cal':
        $cal_count        =  TblCalModel::count();
        if($cal_count==null||$cal_count==0)
        {
          $refrenceNumber = 'CAL-'.sprintf("%05d",1);
        }
        else
        {
          $cal            =  TblCalModel::orderBy('cal_id','DESC')->first();
          $refrenceNumber =  'CAL-'.sprintf("%05d",$cal->cal_id+1);
        }
        break;
    }
     
    return $refrenceNumber; 
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
  public static function birthdate($birthdate) 
  {
    $date = $birthdate;
    // $bdate = date_format($date,"m-y");
    $bdate = date('m-y', strtotime($birthdate));
    // dd($bdate);
    $final = str_replace(' ','',preg_replace('/[^a-z0-9\s]/i', '', $bdate));
    return $final;
    
  }
  public static function checkIfExistMember($carewell_id,$universal_id)
  {
    $check_universal = TblMemberModel::where('member_universal_id',$universal_id)->first();
    
    if($check_universal!=null)
    {
      $check_carewell  = TblMemberCompanyModel::where('member_carewell_id',$carewell_id)->first();
      if($check_carewell!=null)
      {
        $result = 0;
      }
      else
      {

      }
      $result = 1;
    }
    else
    {
      $result = 0;
    }
    return $result;
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
  public static function getIdNorName($name="",$str_param)
  {
    $ref = "";
    switch ($str_param) 
    {
 

      case 'provider':
        $ref = TblProviderModel::where('provider_name', $name)->value('provider_id');
        break;
    }

    if($ref == null)
    {    
      $refer = $name;
    }
    else
    {
      $refer = $ref;
    }
  return $refer; 
  }
  public static function getid($str_name = '', $str_param = '')
  {
    $id = 0;
    switch ($str_param) 
    {
      case 'deployment':
        $id = TblCompanyDeploymentModel::where('deployment_name', $str_name)->value('deployment_id');
        if($id == null)
        {
          $id = 1;
        }
        break;

      case 'coverage':
        $id = TblCoveragePlanModel::where('coverage_plan_name', $str_name)->value('coverage_plan_id');
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

      case 'specialization':
        $id = TblSpecializationModel::where('specialization_name', $str_name)->value('specialization_id');
        if($id == null)
        {
          $id = 1;
        }
        break;
      case 'member':
        $id = TblMemberModel::where('member_universal_id', $str_name)->value('member_id');
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
