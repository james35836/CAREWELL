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
use App\Http\Model\TblCoveragePlanTagModel;

use App\Http\Model\TblCoveragePlanProcedureModel;

use App\Http\Model\TblAvailmentTagModel;

use App\Http\Model\TblPaymentModeModel;

use App\Http\Model\TblProviderModel;
use App\Http\Model\TblProviderBillingModel;
use App\Http\Model\TblProviderPayeeModel;


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

  public function getCompanyInfo(Request $request)
  {
    
    if($request->ajax())
    {
        $data['_coverage']  = TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$request->value)
                              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                              ->get();
        $data['_coverage_list'] = '<option value="0">-SELECT COVERAGE PLAN-';
        foreach($data['_coverage'] as $coverage)
        {
            $data['_coverage_list']     .= '<option value='.$coverage->coverage_plan_id.'>'.$coverage->coverage_plan_name;
        }

        $data['_deployment'] = TblCompanyDeploymentModel::where('company_id',$request->value)->get();
        $data['_deployment_list'] = '<option value="0">-SELECT DEPLOYMENT-';
        foreach($data['_deployment'] as $deployment)
        {
            $data['_deployment_list']     .= '<option value='.$deployment->deployment_id.'>'.$deployment->deployment_name;
        }

        return  response()->json(array('first' => $data['_deployment_list'],'second' => $data['_coverage_list']));
    }
  }
  
  public function getProviderInfo(Request $request)
  {
    if($request->ajax())
    {
        $provider_rvs  = TblProviderModel::where('provider_id',$request->provider_id)->value('provider_rvs');
        $data['_provider_doctor']  = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$request->provider_id)
                              ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_doctor_provider.doctor_id')
                              ->get();
        $data['_provider_doctors'] = '<option>-SELECT DOCTOR-';
        foreach($data['_provider_doctor'] as $provider_doctor)
        {
            $data['_provider_doctors']     .= '<option value='.$provider_doctor->doctor_id.'>'.$provider_doctor->doctor_first_name." ".$provider_doctor->doctor_last_name;
        }

        $data['_payee'] = TblProviderPayeeModel::where('provider_id',$request->provider_id)->get();
        
        $data['_payee_list'] = '<option>-SELECT PAYEE-';
        foreach($data['_payee'] as $payee)
        {
            $data['_payee_list']     .= '<option value='.$payee->provider_payee_id.'>'.$payee->provider_payee_name;
        }


        return  response()->json(array('first' => $data['_provider_doctors'],'second' => $data['_payee_list'],'third'=>$provider_rvs));
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
  public function getAvailmentInfo(Request $request)
  {
    if($request->ajax())
    {
        $coverage  = TblMemberCompanyModel::where('archived',0)->where('member_id',$request->member_id)->value('coverage_plan_id');
        
        $coverage_plan_tag = TblCoveragePlanTagModel::where('coverage_plan_id',$coverage)->where('availment_id',$request->availment_id)->first();
        $data['procedure'] = TblCoveragePlanProcedureModel::where('coverage_plan_tag_id',$coverage_plan_tag->coverage_plan_tag_id)
                        ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_coverage_plan_procedure.procedure_id')
                        ->get();
        
        $data['_procedureList'] = '<option>-SELECT DESCRIPTION-';
        foreach($data['procedure'] as $procedure)
        {
            $data['_procedureList']     .= '<option value='.$procedure->procedure_id.'>'.$procedure->procedure_name;
        }
        return $data['_procedureList'];
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
      case 'user':
        $count_user = TblUserInfoModel::count();
        if($count_user==null||$count_user==0)
        {
          $refrenceNumber = 'CW-'.sprintf("%05d",1);
        }
        else
        {
          $user = TblUserInfoModel::orderBy('user_info_id','DESC')->first();
          $refrenceNumber = 'CW-'.sprintf("%05d",$user->user_info_id+1);
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
    $refer = "";
    switch ($str_param) 
    {
      case 'provider':
        $ref = TblProviderModel::where('provider_name', $name)->value('provider_id');
        break;
    }

    if($ref == null||$ref=="")
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
  public static function archived_data($archived_id,$archived_name)
  {
    $message = "";
    $archived['archived'] = '1';
    switch ($archived_name) 
    {
      case 'USER':
        $check = TblUserModel::where('user_id', $archived_id)->update($archived);
        break;
      case 'COMPANY':
        $check = TblCompanyModel::where('company_id',$archived_id)->update($archived);
        break;
      case 'MEMBER':
        $check = TblMemberModel::where('member_id',$archived_id)->update($archived);
        break;
      case 'PROVIDER':
        $check = TblProviderModel::where('provider_id',$archived_id)->update($archived);
        break;
      case 'DOCTOR':
        $check = TblDoctorModel::where('doctor_id',$archived_id)->update($archived);
        break;
    }

    if($check==true)
    {    
      $message = "SUCCESSFULLY";
    }
    else
    {
      $message = "FAILED";
    }
    return $message; 
  }
  public static function restore_data($restore_id,$restore_name)
  {
    $message = "";
    $restore['archived'] = '0';
    switch ($restore_name) 
    {
      case 'USER':
        $check = TblUserModel::where('user_id', $restore_id)->update($restore);
        break;
      case 'COMPANY':
        $check = TblCompanyModel::where('company_id',$restore_id)->update($restore);
        break;
      case 'MEMBER':
        $check = TblMemberModel::where('member_id',$restore_id)->update($restore);
        break;
      case 'DOCTOR':
        $check = TblDoctorModel::where('doctor_id',$restore_id)->update($restore);
        break;
    }

    if($check==true)
    {    
      $message = "SUCCESSFULLY";
    }
    else
    {
      $message = "FAILED";
    }
    return $message; 
  }
  public static function getModeOfPayment($last_payment,$mode_of_payment,$coverage_plan_id,$payment_amount)
  {

    $premium          = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->value('coverage_plan_premium');
    $premium_gross    = number_format($payment_amount / number_format($premium));
    $period           = self::modeOfPaymentReference($mode_of_payment,$last_payment,$premium_gross);
    $date['start']    = $period['start'];
    $date['end']      = $period['end'];
    $date['count']    = $premium_gross;
    return $date;
  }

  public static function modeOfPaymentReference($mode_of_payment,$last_payment,$premium_gross)
  {
    $reference = number_format($premium_gross)%2;
    $period_paid = date('d',strtotime($last_payment));
    $ref = round($premium_gross/2);

    if($mode_of_payment=="SEMI-MONTHLY")
    {
      $i = 0;
  
      for($i=0; $i<=$premium_gross;  $i++)
      {
        
          $date = date('Y-m-18', strtotime($last_payment));
          $new_date = strtotime($date. '+'.$i.' months');

          $first_cut_start[$i]  = date('Y-m-01', $new_date);
          $first_cut_end[$i]    = date('Y-m-15', $new_date);

          $second_cut_start[$i] = date('Y-m-16', $new_date);
          $second_cut_end[$i]   = date('Y-m-t',   $new_date );
      }
      
      
      
      if($period_paid<=15)
      {
        $data['start']  = date('Y-m-16', strtotime($date));
        if($reference==0)
        {
          $data['end']  = $second_cut_end[$ref];
        }
        else
        {
          $data['end']  = $first_cut_end[$ref];
        }
      }
      else
      {
        $data['start']  = date('Y-m-01', strtotime($date. '+1 months'));
        if($reference==true)
        {
          $data['end']  = $first_cut_end[$ref];
        }
        else
        {
          $data['end']  = $second_cut_end[$ref];
        }

      }
      return $data;
    }
  }
  
  
}
