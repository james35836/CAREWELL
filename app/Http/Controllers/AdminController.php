<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticFunctionController;
use App\Http\Controllers\ActiveAuthController;
use App\Http\Model\TblUserModel;
use App\Http\Model\TblUserInfoModel;
use App\Http\Model\TblAvailmentModel;
use App\Http\Model\TblAvailmentChargesModel;
use App\Http\Model\TblCoveragePlanModel;
use App\Http\Model\TblCoveragePlanTagModel;
use App\Http\Model\TblCompanyModel;
use App\Http\Model\TblCompanyContractModel;
use App\Http\Model\TblCompanyNumberModel;
use App\Http\Model\TblCompanyContractImageModel;
use App\Http\Model\TblCompanyContractBenefitsModel;
use App\Http\Model\TblCompanyCoveragePlanModel;
use App\Http\Model\TblCompanyDeploymentModel;
use App\Http\Model\TblCalModel;
use App\Http\Model\TblCalMemberModel;
use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberDependentModel;
use App\Http\Model\TblMemberGovernmentCardModel;
use App\Http\Model\TblPaymentModeModel;
use App\Http\Model\TblProviderModel;
use App\Http\Model\TblProviderPayeeModel;
use App\Http\Model\TblDoctorModel;
use App\Http\Model\TblDoctorProcedureModel;
use App\Http\Model\TblDoctorProviderModel;
use App\Http\Model\TblDoctorSpecializationModel;
use App\Http\Model\TblPayableModel;
use App\Http\Model\TblPayableApprovalModel;
use App\Http\Model\TblSpecializationModel;
use App\Http\Model\TblApprovalModel;
use App\http\Model\TblApprovalAvailedModel;
use App\Http\Model\TblApprovalDoctorModel;
use App\Http\Model\TblLaboratoryModel;
use App\Http\Model\TblDiagnosisModel;
use App\Http\Model\TblProcedureModel;
use App\Http\Model\TblScheduleOfBenefitsModel;

use App\Http\Model\TblPositionModel;
use App\Http\Model\TblPositionTagModel;
use App\Http\Model\TblPositionAccessModel;


use Excel;
use Input;
use Session;
use DB;
use Carbon\Carbon;
use Paginate;
use Crypt;
use Mail;
class AdminController extends ActiveAuthController
{
    public function access_center()
    {
        $data['page'] = 'Access Panel';
        $data['user'] = StaticFunctionController::global();
        $data['_position'] = TblPositionModel::where('archived',0)->paginate(10);
        return view('carewell.pages.access_center',$data);
    }
    public function access_center_create_position()
    {
        $data['_access'] = TblPositionAccessModel::where('access_parent_id',0)->get();
        foreach($data['_access'] as $key=> $access)
        {
            $data['_access'][$key]['sub_acces']  = TblPositionAccessModel::where('access_parent_id',$access->access_id)->get();
        }
        return view('carewell.modal_pages.access_create_position',$data);
    }
    public function access_center_create_position_submit(Request $request)
    {
        $accessData                     = new TblPositionModel;
        $accessData->position_name      =  $request->position_name;
        $accessData->position_created   =  Carbon::now();
        $accessData->save();

        foreach($request->access_id as $access_id)
        {
            $accessLevel                = new TblPositionTagModel;
            $accessLevel->access_id     = $access_id;
            $accessLevel->position_id   = $accessData->position_id;
            $accessLevel->save();
        }
        return StaticFunctionController::customMessage('success','NEW POSITION ADDED!');
        
    }
    public function admin_center()
    {
        $data['page'] = 'Admin Panel';
        $data['user'] = StaticFunctionController::global();
        $data['_user_active']= TblUserModel::where('tbl_user.archived',0)->UserInfo()->paginate(10);
        $data['_user_archived']= TblUserModel::where('tbl_user.archived',1)->UserInfo()->paginate(10);
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
            $userInfoData->user_number          = $request->user_id_number;
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
    public function admin_view_user_details($user_id)
    {
        $data['user_details'] = TblUserModel::where('tbl_user.user_id',$user_id)
        ->join('tbl_user_info','tbl_user_info.user_id','=','tbl_user.user_id')
        ->first();
        return view('carewell.modal_pages.admin_user_details',$data);
    }
    public function settings_maintenance()
    {
        $data['page'] = 'Maintenance';
        $data['user'] = StaticFunctionController::global();
        $data['_diagnosis']         = TblDiagnosisModel::where('archived',0)->paginate(10);
        $data['_doctor_procedure']  = TblDoctorProcedureModel::where('archived',0)->paginate(10);
        $data['_procedure']         = TblProcedureModel::where('archived',0)->paginate(10);
        return view('carewell.pages.settings_developer',$data);
    }
    public function settings_maintenance_modal()
    {
    return view('carewell.modal_pages.developer_modal');
    }

    public function settings_maintenance_modal_submit(Request $request)
    {
        $file   = $request->file('importDeveloperFile')->getRealPath();
        $_data  = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
        $first  = $_data[0];
        if(isset($first['provider_payee_name'])&&isset($first['provider_name'])&&$request->file_name=="provider")
        {
            $count = 0;
            $countPayee = 0;
            foreach($_data as $data)
            {
                $refNumber = StaticFunctionController::getIdNorName($data['provider_name'],'provider');
                if($refNumber==$data->provider_name)
                {
                    $providerData = new TblProviderModel;
                    $providerData->provider_name            = $data['provider_name'];
                    $providerData->provider_rvs             = $data['provider_rvs'];
                    $providerData->provider_contact_person  = "N/A";
                    $providerData->provider_telephone_number= "N/A";
                    $providerData->provider_mobile_number   = "N/A";
                    $providerData->provider_contact_email   = "N/A";
                    $providerData->provider_address         = "N/A";
                    $providerData->provider_created         = Carbon::now();
                    $providerData->save();

                    $providerPayeeData = new TblProviderPayeeModel;
                    $providerPayeeData->provider_payee_name = $data['provider_payee_name'];
                    $providerPayeeData->provider_id = $providerData->provider_id;
                    $providerPayeeData->save();
                    $count++;
                }
                else
                {
                    $providerPayeeData = new TblProviderPayeeModel;
                    $providerPayeeData->provider_payee_name = $data['provider_payee_name'];
                    $providerPayeeData->provider_id = $refNumber;
                    $providerPayeeData->save();
                    $countPayee++;
                }
            }
            if($count == 0)
            {
                $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
            }
            else
            {
                $message = '<center><b><span class="color-green">'.$count.' Provider/s has been inserted and '.$countPayee.' payee.</span></b></center>';
            }
            return $message;
        }
        if(isset($first['diagnosis_name'])&&isset($first['diagnosis_covered'])&&$request->file_name=="diagnosis")
        {
            $count = 0;
            $countExist = 0;
            foreach($_data as $data)
            {

                $check = TblDiagnosisModel::where('diagnosis_name',$data['diagnosis_name'])->where('diagnosis_covered',$data['diagnosis_covered'])->first();
                if($check==null&&$data['diagnosis_name']!="")
                {
                    $diagnosisData = new TblDiagnosisModel;
                    $diagnosisData->diagnosis_name           = $data['diagnosis_name'];
                    $diagnosisData->diagnosis_covered        = $data['diagnosis_covered'];
                    $diagnosisData->save();

                    $count++;
                }
                else
                {
                    $countExist++;
                }
            }
            if($count == 0)
            {
                $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
            }
            else
            {
                $message = '<center><b><span class="color-green">'.$count.' Diagnosis/s has been inserted and '.$countExist.' diagnosis are already exist.</span></b></center>';
            }
            return $message;
        }
        if(isset($first['procedure_name'])&&isset($first['procedure_amount'])&&$request->file_name=="procedure")
        {
            $count = 0;
            $countExist = 0;
            foreach($_data as $data)
            {

            $check = TblProcedureModel::where('procedure_name',$data['procedure_name'])->first();
            if($check==null&&$data['procedure_name']!="")
            {
                $procedureData = new TblProcedureModel;
                $procedureData->procedure_name           = StaticFunctionController::transformText($data['procedure_name']);
                $procedureData->procedure_amount        = "0";
                $procedureData->type                    = $data['type'];

                $procedureData->save();

                $count++;
            }
            else
            {
                $countExist++;
            }
            }
            if($count == 0)
            {
                $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
            }
            else
            {
                $message = '<center><b><span class="color-green">'.$count.' Description/s has been inserted and '.$countExist.' descriptions are already exist.</span></b></center>';
            }
            return $message;
        }
        else
        {
            return '<center><b><span class="color-gray">WRONG FILE</span></b></center>';
        }
    }
    public function terminated_member()
    {
        $data['page']               = 'Terminated Member';
        $data['user']               = StaticFunctionController::global();
        $data['_company']           = TblCompanyModel::where('archived',0)->get();
        $data['_member_terminated'] = TblMemberModel::where('tbl_member.archived',1)->where('tbl_member_company.archived',0)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10, ['*'], 'inactive');
        return view('carewell.pages.terminated_member',$data);
    }

    public function terminated_member_import()
    {
        $data['link'] = "/settings/terminated/import/template";
        return view('carewell.modal_pages.terminated_member_import',$data);
    }
    public function terminated_member_import_template()
    {
        $excels['data']  =   ['LAST NAME','FIRST NAME','MIDDLE NAME'];
        Excel::create('CAREWELL TERMINATED MEMBER TEMPLATE', function($excel) use ($excels) 
        {
            $excel->sheet('template', function($sheet) use ($excels) 
            {
                $data = $excels['data'];
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->freezeFirstRow();
            });
            
        })->download('xlsx');
    }
    public function terminated_member_import_submit(Request $request)
    {
        Session::forget('exportWarning');

        $file                           = $request->file('importTerminatedMemberFile')->getRealPath();
        $_data                          = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
        $first                          = $_data[0]; 
        $countSuccess                   = 0;
        $countError                     = 0;
        $exportArray                    = array();
        $member_archived['archived']    = 1;
        if(isset($first['last_name'])&&isset($first['first_name'])&&isset($first['middle_name']))
        {
            foreach($_data as $data)
            {
                if($data['last_name']!=null&&$data['first_name']!=null&&$data['middle_name']!=null)
                {
                    $TblMemberModel = TblMemberModel::MemberExist($data['first_name'],$data['middle_name'],$data['last_name']);
                    if($TblMemberModel->count()>0)
                    {
                        $TblMemberModel->update($member_archived);
                        $countSuccess++;
                    }
                    else
                    {
                        $name['first']  = $data['first_name'];
                        $name['middle'] = $data['middle_name'];
                        $name['last']   = $data['last_name'];
                        $name['type']   = 'MEMBER ARE NOT ON THE MEMBER LIST PLEASE CHECK SPELLING';
                        array_push($exportArray,$name);
                        $countError++;
                    }
                } 
                else
                {
                    $name['first']  = $data['first_name'];
                    $name['middle'] = $data['middle_name'];
                    $name['last']   = $data['last_name'];
                    $name['type']   = 'SOME FIELDS HAS NULL VALUES';
                    array_push($exportArray,$name);
                    $countError++;
                }           
            }  

        }
        StaticFunctionController::session_putter($exportArray);
            
        if($countSuccess == 0)
        {
            $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
        }
        else
        {
            $message = '<center><b><span class="color-green">'.$countSuccess.' member/s has been terminated and '.$countError.' error.</span></b></center>';
        }
        return $message;
    }


}