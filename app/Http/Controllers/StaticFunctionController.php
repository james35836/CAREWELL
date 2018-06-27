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
use App\Http\Model\TblApprovalProcedureModel;

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
use App\Http\Model\TblDoctorProcedureModel;

use App\Http\Model\TblApprovalModel;

use App\Http\Model\TblProcedureModel;
use App\http\Model\TblProcedureAvailedModel;
use App\Http\Model\TblProcedureDoctorModel;

use App\Http\Model\TblLaboratoryModel;

use App\Http\Model\TblPayableModel;

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
          return "<div class='alert alert-success' style='text-align: center;'>".$str_name." Added/Updated Successfully!</div>";
        }
        else
        {
          return "<div class='alert alert-danger' style='text-align: center;'>".$str_name." transaction Failed!</div>";
        }
    }
    public static function customMessage($class,$message)
    {
        return "<div class='alert alert-".$class."' style='text-align: center;'>".$message."!</div>";
    }

    public function getCheckProcedureAmount(Request $request)
    {

        $member_id          = $request->member_id;
        $carewell_amount    = $request->carewell_amount;
        $procedure_id       = $request->procedure_id;
        $availment_id       = $request->availment_id;
        $member             = TblMemberCompanyModel::where('tbl_member_company.member_id',$member_id)->CompanyMember()->first();
        $TblCoveragePlanProcedureModel = TblCoveragePlanProcedureModel::where('procedure_id',$procedure_id)->where('availment_id',$availment_id)->where('coverage_plan_id',$member->coverage_plan_id);
        $sum                = 0;
    
        
        $procedure_covered  = $TblCoveragePlanProcedureModel->value('plan_covered_amount'); 
        $procedure_limit    = $TblCoveragePlanProcedureModel->value('plan_limit'); 
        

        $_approval          = TblApprovalModel::where('member_id',$member_id)->Procedure()->where('procedure_id',$procedure_id)->where('availment_id',$availment_id)->get();
                            
        foreach($_approval as $approval)
        {
            $sum = $sum + $approval->procedure_charge_carewell;
        }
        $actual     = $sum+$carewell_amount;
        $balance    = $procedure_covered-$actual;

        $current_balance = $procedure_covered-$sum;
        // dd($procedure_limit);
        if($procedure_limit=="OPEN"||count($_approval) < $procedure_limit)
        {
            if($balance < 0)
            {
                $message['ref']             = 'sumobra';
                $message['balance']         = $balance;
                $message['actual']          = $actual;
                $message['current_balance'] = $current_balance;
            }
            else 
            {
                $message['ref']             = 'pwede';
                $message['balance']         = $balance;
                $message['actual']          = $actual;
                $message['current_balance'] = $current_balance;

            }
        }
        else
        {
            $message['ref']             = 'reached_limit';
            $message['balance']         = $balance;
            $message['actual']          = $actual;
            $message['current_balance'] = $current_balance;
        }
        
        return $message;
    }
    public function getCompanyInfo(Request $request)
    {
        if($request->ajax())
        {
            $data['_coverage']  = TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$request->value)->CoveragePlan()->get();
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
            $_specialization                    = TblSpecializationModel::get();
            $_procedure_doctor                  = TblDoctorProcedureModel::where('archived',0)->get();
            $provider                           = TblProviderModel::where('provider_id',$request->provider_id)->first();
            $data['_provider_doctor']           = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$request->provider_id)->where('tbl_doctor_provider.archived',0)->DoctorProvider()->get();
            $data['_procedure_doctors']          = '<option value="1">-SELECT PROCEDURE-';
            $data['_provider_doctors']          = '<option>-SELECT DOCTOR-';
            $data['_specialization_doctors']    = '<option>-SELECT SPECIALIZATION-';
            foreach($_procedure_doctor as $procedure_doctor)
            {
                $data['_procedure_doctors']     .= '<option value='.$procedure_doctor->doctor_procedure_id.'>'.$procedure_doctor->doctor_procedure_descriptive;
            }
            foreach($data['_provider_doctor'] as $provider_doctor)
            {
                $data['_provider_doctors']     .= '<option value='.$provider_doctor->doctor_id.'>'.$provider_doctor->doctor_full_name;
            }
            foreach($_specialization as $specialization)
            {
                $data['_specialization_doctors']     .= '<option>'.$specialization->specialization_name;
            }

            $first              = $data['_provider_doctors'];
            $second             = $provider->provider_rvs;
            $third              = $provider->provider_name;
            $specialization     = $data['_specialization_doctors'];
            $doctorprocedure    = $data['_procedure_doctors'];

            if($request->warning=="show")//FOR UPDATE
            {
                $view               = view('carewell.additional_pages.availment_change_provider')->render();
            }
            else
            {
                $view               = 'none';
            }
            return response()->json(array('first' => $first,'second'=>$second,'third'=>$third,'view'=>$view,'specialization'=>$specialization,'doctorprocedure'=>$doctorprocedure));
        }
    }
    public function getAvailmentInfo(Request $request)
    {
        if($request->ajax())
        {
            $coverage           = TblMemberCompanyModel::where('archived',0)->where('member_id',$request->member_id)->value('coverage_plan_id');
            $procedure          = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage)->Procedure()->get();
            $data['_procedureList'] = '<option>-SELECT DESCRIPTION-';
            foreach($procedure as $procedure)
            {
                $data['_procedureList']     .= '<option value='.$procedure->procedure_id.'>'.$procedure->procedure_name;
            }
            $procedure_list    = $data['_procedureList'];
            if($request->warning=="show")//FOR UPDATE
            {
                $view               = view('carewell.additional_pages.availment_change_availment')->render();
            }
            else
            {
                $view               = 'none';
            }
            return response()->json(array('procedure_list'=>$procedure_list,'view'=>$view));
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
                $approval_count     =  TblApprovalModel::count();
                if($approval_count==null||$approval_count==0)
                {
                    $refrenceNumber = 'APP-'.str_replace(["-", "–"], "",date("m-y")).'-'.sprintf("%05d",1);
                }
                else
                {
                    $approval       =  TblApprovalModel::orderBy('approval_id','DESC')->first();
                    $refrenceNumber = 'APP-'.str_replace(["-", "–"], "",date("m-y")).'-'.sprintf("%05d",$approval->approval_id+1);
                }
            break;
            case 'payable':
                $payable_count      =  TblPayableModel::count();
                if($payable_count==null||$payable_count==0)
                {
                    $refrenceNumber = 'PV-'.sprintf("%05d",1);
                }
                else
                {
                    $payable        =  TblPayableModel::orderBy('payable_id','DESC')->first();
                    $refrenceNumber = 'PV-'.sprintf("%05d",$payable->payable_id+1);
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
    public static function getIdNorName($name="",$str_param)
    {
        $ref = "";
        $refer = "";
        switch ($str_param) 
        {
            case 'provider':
            $ref = TblProviderModel::where('provider_name', $name)->value('provider_id');
            break;
            case 'doctor':
            $ref = TblDoctorModel::where('doctor_full_name', $name)->value('doctor_id');
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
            $check_doctor_provider = TblDoctorProviderModel::where('provider_id',$archived_id)->update($archived);
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
    public static function archivedCurrentCompany($member_id,$ref_id,$ref)
    {
        $member_company = TblMemberCompanyModel::where('member_id',$member_id)->where('archived',0)->first();
        
        switch ($ref) 
        {
          case 'coverage_plan':
            $company['member_carewell_id']        =   $member_company->member_carewell_id;
            $company['member_employee_number']    =   $member_company->member_employee_number;
            $company['member_company_status']     =   $member_company->member_company_status;
            $company['member_transaction_date']   =   Carbon::now();
            $company['member_id']                 =   $member_company->member_id;
            $company['company_id']                =   $member_company->company_id;
            $company['member_payment_mode']       =   $member_company->member_payment_mode;
            $company['deployment_id']             =   $member_company->deployment_id;
            $company['coverage_plan_id']          =   $ref_id;
            $member_company_id = TblMemberCompanyModel::insertGetId($company);
            break;
          case 'deployment':
            $company['member_carewell_id']        =   $member_company->member_carewell_id;
            $company['member_employee_number']    =   $member_company->member_employee_number;
            $company['member_company_status']     =   $member_company->member_company_status;
            $company['member_transaction_date']   =   Carbon::now();
            $company['member_id']                 =   $member_company->member_id;
            $company['company_id']                =   $member_company->company_id;
            $company['member_payment_mode']       =   $member_company->member_payment_mode;
            $company['coverage_plan_id']          =   $member_company->coverage_plan_id;
            $company['deployment_id']             =   $ref_id;
            $member_company_id = TblMemberCompanyModel::insertGetId($company);
            break;
        }
        $update['archived'] = 1;
        TblMemberCompanyModel::where('member_id',$member_id)->where('member_company_id','!=',$member_company_id)->update($update);
    }
    public static function restore_data($restore_id,$restore_name)
    {
        $message             = "";
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
            $check_doctor_provider = TblDoctorProviderModel::where('provider_id',$restore_id)->update($restore);
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
    public static function provider_doctor_insert($provider_name,$provider_id,$doctor_name,$doctor_id)
    {
        $countPayee = 0;
        if ($provider_name != $doctor_name)
        {
            if($doctor_id==null)
            {
                $providerDoctorData = new TblDoctorModel;
                $providerDoctorData->doctor_full_name       = StaticFunctionController::transformText($doctor_name);
                $providerDoctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
                $providerDoctorData->doctor_gender          = "N/A";
                $providerDoctorData->doctor_contact_number  = "N/A";
                $providerDoctorData->doctor_email_address   = "N/A";
                $providerDoctorData->doctor_created         = Carbon::now();
                $providerDoctorData->save();

                $insert['doctor_id']   = $providerDoctorData->doctor_id;
                $insert['provider_id'] = $provider_id;
                TblDoctorProviderModel::insert($insert);
                $countPayee++;
            }
            else
            {
                if(TblDoctorProviderModel::where('doctor_id',$doctor_id)->where('provider_id',$provider_id)->count()==0)
                {
                    $insert['doctor_id']   = $doctor_id;
                    $insert['provider_id'] = $provider_id;
                    TblDoctorProviderModel::insert($insert);

                    $countPayee++;
                }
            }
        }
        return $countPayee;
    }
    public static function provider_add_tag_doctor($doctorProviderData,$provider_id)
    {
        $doctorInsert = 0;
         foreach($doctorProviderData as $doctor_full_name)
        {
            $doctor_id = StaticFunctionController::getIdNorName($doctor_full_name,'doctor');
            if($doctor_id==$doctor_full_name)
            {
                $doctorData = new TblDoctorModel;
                $doctorData->doctor_full_name       = StaticFunctionController::transformText($doctor_full_name);
                $doctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
                $doctorData->doctor_gender          = "N/A";
                $doctorData->doctor_contact_number  = "N/A";
                $doctorData->doctor_email_address   = "N/A";
                $doctorData->doctor_created         = Carbon::now();
                $doctorData->save();

                $providerDoctorData = new TblDoctorProviderModel;
                $providerDoctorData->doctor_id  = $doctorData->doctor_id;
                $providerDoctorData->provider_id    = $provider_id;
                $providerDoctorData->save();

                $doctorInsert++;
            }
            else
            {
                $check = TblDoctorProviderModel::where('provider_id',$provider_id)->where('doctor_id',$doctor_id)->count();
                if($check==0)
                {
                    $providerDoctorData = new TblDoctorProviderModel;
                    $providerDoctorData->doctor_id  = $doctor_id;
                    $providerDoctorData->provider_id    = $provider_id;
                    $providerDoctorData->save();
                    
                    $doctorInsert++;
                }
            }
        }
        return $doctorInsert;
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
                    if(strtotime($payment->cal_last_payment) >= strtotime($cal->cal_start))
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
                Self::insertMemberPayment($cal_member_id,$member_id);
            }
        }
        return 0;
    }
    public static function moth_reference($date)
    {
        $month     = date('m',strtotime($date));
        $new_month = 0;
        for ($i=1; $i <=12; $i++) 
        { 
            if($month == sprintf("%02d",$i))
            {
               $new_month = sprintf("%02d",$i);
               break;
            }
        }
        if($month<=15)
        {
            $colspan = ($new_month*2)-2;
        }
        else
        {
            $colspan = ($new_month*2)-1;
        }
        return $colspan;
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
            
                $member_cut['cal_payment_start']  = $cal->cal_start;
                $member_cut['cal_payment_end']    = $cal->cal_end;
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
    public function getExportWarning()
    {
        $session = Session::get('exportWarning');
        if($session!=null)
        {
            $excels['_member'] = $session;
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
    public function forgetSession(Request $request)
    {
        Session::forget('exportWarning');
        return redirect()->back();   
    }
    public static function paymentDateComputation($member_id,$cal_member_id,$payment_count,$payment_mode)
    {
        $payment          = TblCalPaymentModel::where('member_id',$member_id)->where('archived',0)->orderBy('cal_payment_end','DESC')->first();
        $cal              = TblCalMemberModel::where('cal_member_id',$cal_member_id)->join('tbl_cal','tbl_cal.cal_id','=','tbl_cal_member.cal_id')->first();

        if($payment)
        {
            $date           = $payment->cal_payment_end;
        }
        else
        {
            $date           = $cal->cal_start;
        }
        $count            = 0;
        if($payment_mode  == "SEMI-MONTHLY")
        {
            for($i = 1; $i <= $payment_count; $i++)
            {
                $day = date('d',strtotime($date));
                if($day>=15)
                {
                    $result = date('Y-m-d',strtotime("+1 months",strtotime($date)));
                    $start  = date('Y-m-26',strtotime($date));
                    $end    = date('Y-m-10',strtotime($result));
                    $date   = $end;
                    $count++;
                }
                else
                {
                    $result = date('Y-m-d',strtotime("+1 months",strtotime($date)));
                    $start  = date('Y-m-11',strtotime($result));
                    $end    = date('Y-m-25',strtotime($result));
                    $date   = $end;
                    $count++;
                }
                StaticFunctionController::insertMemberPayment_v2($cal_member_id,$member_id,$start,$end);
            }
        }
        else if($payment_mode == "MONTHLY")
        {
            for($i = 1; $i <= $payment_count; $i++)
            {
                $day      = date('d',strtotime($date));
                $new_day  = $day+1;
                $result   = date('Y-m-d',strtotime("+1 months",strtotime($date)));
                $start    = date('Y-m-'.$new_day,strtotime($date));
                $end      = date('Y-m-'.$day,strtotime($result));
                $date     = $end;
                $count++;
                StaticFunctionController::insertMemberPayment_v2($cal_member_id,$member_id,$start,$end);
            }
        }
        else if($payment_mode == "QUARTERLY")
        {
            for($i = 1; $i <= $payment_count; $i++)
            {
                $day      = date('d',strtotime($date));
                $new_day  = $day+1;
                $result   = date('Y-m-d',strtotime("+3 months",strtotime($date)));
                $start    = date('Y-m-'.$new_day,strtotime($date));
                $end      = date('Y-m-'.$day,strtotime($result));
                $date     = $end;
                $count++;
                StaticFunctionController::insertMemberPayment_v2($cal_member_id,$member_id,$start,$end);
            }
        }
        else if($payment_mode == "SEMESTRAL")
        {
            for($i = 1; $i <= $payment_count; $i++)
            {
                $day      = date('d',strtotime($date));
                $new_day  = $day+1;
                $result   = date('Y-m-d',strtotime("+6 months",strtotime($date)));
                $start    = date('Y-m-'.$new_day,strtotime($date));
                $end      = date('Y-m-'.$day,strtotime($result));
                $date     = $end;
                $count++;
                StaticFunctionController::insertMemberPayment_v2($cal_member_id,$member_id,$start,$end);
            }
        }
        else if($payment_mode == "ANNUAL")
        {
            for($i = 1; $i <= $payment_count; $i++)
            {
                $day      = date('d',strtotime($date));
                $new_day  = $day+1;
                $result   = date('Y-m-d',strtotime("+1 years",strtotime($date)));
                $start    = date('Y-m-'.$new_day,strtotime($date));
                $end      = date('Y-m-'.$day,strtotime($result));
                $date     = $end;
                $count++;
                StaticFunctionController::insertMemberPayment_v2($cal_member_id,$member_id,$start,$end);
            }
        }
    
    }
    public static function insertMemberPayment_v2($cal_member_id,$member_id,$start,$end)
    {
        $member_cut['cal_payment_start']  = $start;
        $member_cut['cal_payment_end']    = $end;
        $member_cut['cal_payment_type']   = 'ORIGINAL';
        $member_cut['cal_member_id']      = $cal_member_id;
        $member_cut['member_id']          = $member_id;
        TblCalPaymentModel::insert($member_cut);
    }
    public static function coverage_plan_mark_new($new_coverage_plan_id,$coverage_plan_id)
    {
        $_coverage_procedure = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage_plan_id)->get();
        foreach($_coverage_procedure as $coverage_procedure)
        {
            $insert['procedure_id']         = $coverage_procedure->procedure_id;
            $insert['availment_id']         = $coverage_procedure->availment_id;
            $insert['plan_charges']         = $coverage_procedure->plan_charges;
            $insert['plan_covered_amount']  = $coverage_procedure->plan_covered_amount;
            $insert['plan_limit']           = $coverage_procedure->plan_limit;
            $insert['coverage_plan_id']     = $new_coverage_plan_id;
            TblCoveragePlanProcedureModel::insert($insert);
        }
    }
}
