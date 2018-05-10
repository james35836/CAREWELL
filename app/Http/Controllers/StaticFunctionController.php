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
use App\Http\Model\TblCalPaymentModel;


use App\Http\Model\TblCompanyTrunklineModel;

use App\Http\Model\TblNewMemberModel;
use App\Http\Model\TblNewCalMemberModel;


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

use Carbon\Carbon;
use Excel;
use Session;

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
        $provider                   = TblProviderModel::where('provider_id',$request->provider_id)->first();
        $data['_provider_doctor']   = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$request->provider_id)
                                    ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_doctor_provider.doctor_id')
                                    ->get();
        $data['_provider_doctors'] = '<option>-SELECT DOCTOR-';
        foreach($data['_provider_doctor'] as $provider_doctor)
        {
            $data['_provider_doctors']     .= '<option value='.$provider_doctor->doctor_id.'>'.$provider_doctor->doctor_full_name;
        }

        return  response()->json(array('first' => $data['_provider_doctors'],'second'=>$provider->provider_rvs,'third'=>$provider->provider_name));
    }
  }
  
  public function getDoctorSpecialty(Request $request)
  {
    if($request->ajax())
    {
        $data['_specialization']      = TblDoctorSpecializationModel::where('tbl_doctor_specialization.doctor_id',$request->value)
                                      ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                      ->get();
        $data['_specializationList']  = '';
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
        $coverage           = TblMemberCompanyModel::where('archived',0)->where('member_id',$request->member_id)->value('coverage_plan_id');
        $data['procedure']  = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage)
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
  public static function  transformText($string)
  {
    $result =  ucwords(strtolower($string));
    return $result;
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
    $date  = $birthdate;
    $bdate = date('m-y', strtotime($birthdate));
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
    $age    = date_create($birthdate)->diff(date_create('today'))->y;
    return  $age;
  }
  public static function archived_data($archived_id,$archived_name)
  {
    $message              = "";
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
      case 'PROVIDER':
        $check = TblProviderModel::where('provider_id',$restore_id)->update($restore);
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
  
  public static function getNewMember($cal_id,$status)
  {
    
    $data['new_member'] = TblNewMemberModel::where('cal_id',$cal_id)->get();
    $companyData        = TblCompanyModel::join('tbl_cal','tbl_cal.company_id','=','tbl_company.company_id')
                        ->where('tbl_cal.cal_id',$cal_id)
                        ->first();

    foreach($data['new_member'] as $new_member)
    {
      $member['member_first_name']        =   $new_member->member_first_name;
      $member['member_middle_name']       =   $new_member->member_middle_name;
      $member['member_last_name']         =   $new_member->member_last_name;
      $member['member_birthdate']         =   date('d-m-Y', strtotime($new_member->member_birthdate));  
      $member['member_gender']            =   "N/A";
      $member['member_marital_status']    =   "N/A";
      $member['member_mother_maiden_name']=   "N/A";
      $member['member_permanet_address']  =   "N/A";
      $member['member_present_address']   =   "N/A";
      $member['member_contact_number']    =   "N/A";
      $member['member_email_address']     =   "N/A";
      $member['member_created']           =   Carbon::now();
      $member['member_universal_id']      =   StaticFunctionController::generateUniversalId($member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'],$member['member_birthdate']);
      $member_id                          =   TblMemberModel::insertGetId($member);

      $dependent['dependent_full_name']   =   "N/A";
      $dependent['dependent_birthdate']   =   "N/A";
      $dependent['dependent_relationship']=   "N/A";
      $dependent['member_id']             =   $member_id;
      TblMemberDependentModel::insert($dependent);

      $government['government_card_philhealth'] =   "N/A";
      $government['government_card_sss']        =   "N/A";
      $government['government_card_tin']        =   "N/A";
      $government['government_card_hdmf']       =   "N/A";
      $government['member_id']                  =   $member_id;
      TblMemberGovernmentCardModel::insert($government);
      
      $company['member_carewell_id']        =   StaticFunctionController::generateCarewellId($companyData->company_code);
      $company['member_employee_number']    =   "000000";
      $company['member_company_status']     =   "N/A";
      $company['member_transaction_date']   =   Carbon::now();
      $company['coverage_plan_id']          =   $new_member->coverage_plan_id;
      $company['deployment_id']             =   $new_member->deployment_id;
      $company['member_id']                 =   $member_id;
      $company['company_id']                =   $companyData->company_id;
      $company['member_payment_mode']       =   'SEMI-MONTHLY';
      TblMemberCompanyModel::insert($company);

      $cal_member['cal_payment_amount']     =   $new_member->cal_payment_amount;
      $cal_member['cal_payment_date']       =   Carbon::now();
      $cal_member['cal_payment_count']      =   $new_member->cal_payment_count;
      $cal_member['member_id']              =   $member_id;
      $cal_member['cal_id']                 =   $cal_id;
      $cal_member_id = TblCalMemberModel::insertGetId($cal_member);
      
      $data['new_cal_member'] = TblNewCalMemberModel::where('new_member_id',$new_member->new_member_id)->get();
        
        foreach($data['new_cal_member'] as $new_cal_member)
        {
          $member_cut['cal_payment_start']  = $new_cal_member->cal_payment_start;
          $member_cut['cal_payment_end']    = $new_cal_member->cal_payment_end;
          $member_cut['cal_payment_type']   = 'ORIGINAL';
          $member_cut['cal_member_id']      = $cal_member_id;
          $member_cut['member_id']          = $member_id;
          $member_cut['archived']           = $status;

          TblCalPaymentModel::insert($member_cut);
        }

        TblNewMemberModel::where('new_member_id',$new_member->new_member_id)->delete();
        TblNewCalMemberModel::where('new_member_id',$new_member->new_member_id)->delete();

    }
    
  }
  public static function getModeOfPayment($member_id,$cal_member_id,$premium,$payment_count,$cal_id)
  {
    $cal              = TblCalModel::where('cal_id',$cal_id)->first();
    $payment          = TblCalPaymentModel::where('member_id',$member_id)->orderBy('cal_payment_end','DESC')->first();
    for($i = 1; $i<=$payment_count;  $i++)
    {
      if($i==1)
      {
        if($payment!=null)
        {                           
          if(strtotime($payment->cal_last_payment) >= strtotime($cal->cal_payment_start))
          {
            Self::insertMemberPayment($cal_member_id,$member_id);
          }
          else
          {
            $member_cut['cal_payment_start']  = $cal->cal_start;
            $member_cut['cal_payment_end']    = $cal->cal_end;
            $member_cut['cal_payment_type']   = 'ORIGINAL';
            $member_cut['cal_member_id']      = $cal_member_id;
            $member_cut['member_id']          = $member_id;
            TblCalPaymentModel::insert($member_cut);
          }
        }
        else
        {
          $member_cut['cal_payment_start']  = $cal->cal_payment_start;
          $member_cut['cal_payment_end']    = $cal->cal_payment_end;
          $member_cut['cal_payment_type']   = 'ORIGINAL';
          $member_cut['cal_member_id']      = $cal_member_id;
          $member_cut['member_id']          = $member_id;
          TblCalPaymentModel::insert($member_cut);
        }
      }
      else
      {
        Self::insertMemberPayment($cal_member_id,$member_id);
      }
    }
    return 0;
  }
  public static function insertMemberPayment($cal_member_id,$member_id)
  {
    $member_cut['cal_payment_start']  = 'start';
    $member_cut['cal_payment_end']    = 'end';
    $member_cut['cal_payment_type']   = 'ORIGINAL';
    $member_cut['cal_member_id']      = $cal_member_id;
    $member_cut['member_id']          = $member_id;
    TblCalPaymentModel::insert($member_cut);
  }
  public static function newMemberModeOfPayment($member_id,$payment_count,$cal_id)
  {
    $cal              = TblCalModel::where('cal_id',$cal_id)->first();
    for($i = 1; $i<=$payment_count;  $i++)
    {
      if($i==1)
      {
        
        $member_cut['cal_payment_start']  = $cal->cal_payment_start;
        $member_cut['cal_payment_end']    = $cal->cal_payment_end;
        $member_cut['new_member_id']      = $member_id;
        TblNewCalMemberModel::insert($member_cut);
        
      }
      else
      {
        $member_cut['cal_payment_start']  = 'start';
        $member_cut['cal_payment_end']    = 'end';
        $member_cut['new_member_id']      = $member_id;
        TblNewCalMemberModel::insert($member_cut);
      }
    }
    return 0;
  }
  public static function checkPaymentUpdate($date_start,$date_end,$member_id,$ref)
  {
    $start         = strtotime($date_start);
    $end           = strtotime($date_end);
    $count         = 0;
    if($ref=="old")
    {
      $_payment  = TblCalPaymentModel::where('member_id',$member_id)
                ->where(function($query)
                  {
                    $query->where('archived',1)->orWhere('archived',2);
                  })
                ->get();
      foreach($_payment as $key=>$payment)
      {
        if($payment->cal_payment_start!=="start"&&$payment->cal_payment_start!="end")
        {
          $payment_start = strtotime($payment->cal_payment_start);
          $payment_end   = strtotime($payment->cal_payment_end);
          if((($start > $payment_start) && ($start < $payment_end))||(($end > $payment_start) && ($end < $payment_end)))
          {
            $count++;
          }
        }
      }
    }
    else
    {

    }
    return $count;
  }
  public static function checkIfMemberCanAvailed($payment_mode,$last_payment)
  {

    $date       = date('Y-m-d');
    $last_date  = date('d',strtotime($last_payment));
    if($last_payment=="end")
    {
      $new_date = "not_updated";
    }
    else if($payment_mode=="SEMI-MONTHLY")
    {
      if( $last_date <= 15)
      {
        $new_date = date('Y-m-t', strtotime($last_payment) );
      }
      else
      {
        $new_date = date('Y-m-15', strtotime($last_payment . "+1 months"));
      }
    }
    else if($payment_mode=="MONTHLY")
    {
      $new_date = date('Y-m-'.$last_date.'', strtotime($last_payment . "+1 months"));
    }
    else if($payment_mode=="QUARTERLY")
    {
      $new_date = date('Y-m-'.$last_date.'', strtotime($last_payment . "+3 months"));
    }
    else if($payment_mode=="SEMESTRAL")
    {
      $new_date = date('Y-m-'.$last_date.'', strtotime($last_payment . "+6 months"));
    }
    else if($payment_mode=="ANNUAL")
    {
      $new_date = date('Y-m-'.$last_date.'', strtotime($last_payment . "+1 years"));
    }

    return $new_date;

  }
  public static function getExportWarning()
  {
    if(Session::has('exportWarning'))
    {
      $excels['_member'] = Session::get('exportWarning');
      $excels['data']  =   ['LAST NAME','FIRST NAME','MIDDLE NAME','TYPE'];
      Excel::create('CAREWELL WARNING DATA', function($excel) use ($excels) 
      {
        $excel->sheet('template', function($sheet) use ($excels) 
        {
          $data = $excels['data'];
          $sheet->fromArray($data, null, 'A1', false, false);
          $sheet->freezeFirstRow();
          $_member = $excels['_member'];
          foreach($excels['_member'] as  $key => $member)
          {
            $key = $key+=2;
            $sheet->setCellValue('A'.$key, $member['last']);
            $sheet->setCellValue('B'.$key, $member['first']);
            $sheet->setCellValue('C'.$key, $member['middle']);
            $sheet->setCellValue('D'.$key, $member['type']);
          }
        });
      })->download('xlsx');
    }
    
  }
  
}
