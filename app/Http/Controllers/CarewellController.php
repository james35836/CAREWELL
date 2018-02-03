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
use App\Http\Model\TblCompanyJobsiteModel;
use App\Http\Model\TblCompanyCalModel;
use App\Http\Model\TblCompanyCalMemberModel;
use App\Http\Model\TblCompanyTrunklineModel;



use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberPaymentModel;
use App\Http\Model\TblMemberDependentModel;
use App\Http\Model\TblMemberGovernmentCardModel;



use App\Http\Model\TblAvailmentModel;
use App\Http\Model\TblAvailmentPlanModel;
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



use App\Http\Model\TblScheduleOfBenefitsModel;


use App\Http\Controllers\StaticFunctionController;
use App\Http\Controllers\ActiveAuthController;





use Excel;
use Input;
// use Request;
use DB;
use Carbon\Carbon;
use Paginate;
use Crypt;



class CarewellController extends ActiveAuthController
{
  
  /*STATIC DATA*/
  public static function global()
  {
    $user_info = TblUserInfoModel::where('tbl_user_info.user_id',session('user_id'))
                ->join('tbl_user','tbl_user.user_id','=','tbl_user_info.user_id')
                ->first();

    return $user_info;

  }

  

  /*DASHBOARD*/
  public function dashboard()
  {
  	$data['page']         = 'Dashboard';
    $data['user']         = $this->global();
    $data['company']      = TblCompanyModel::where('archived',0)->count();
    $data['member']       = TblMemberModel::where('archived',0)->count();
    $data['provider']     = TblProviderModel::where('archived',0)->count();
    $data['_approval']    = TblApprovalModel::where('tbl_approval.archived',0)
                            ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                            ->orderBy('approval_created','DESC')
                            ->get();
    return view('carewell.pages.dashboard',$data);
  }
  /*COMPANY*/
  public function company()
  {
  	$data['page']             = 'Company';
    $data['user']             = $this->global();
    $data['_company']         = TblCompanyModel::Company()->paginate(10);
    $data['_availment_plan']  = TblAvailmentPlanModel::get();
    foreach ($data['_company'] as $key => $company) 
    {
      $data['_company'][$key]['coverage_plan']    = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)
                                                    ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_company_coverage_plan.availment_plan_id')
                                                    ->get();
    }
  	return view('carewell.pages.company_center',$data);
  }
  public function company_details($company_id)
  {
    $data['_availment_plan']          = TblAvailmentPlanModel::get();
    $data['_payment_mode']            = TblPaymentModeModel::get();
    $data['company_details']          = TblCompanyModel::where('company_id',$company_id)->first();
    $data['_company_jobsite']         = TblCompanyJobsiteModel::where('company_id',$company_id)->get();
    $data['_company_trunkline']       = TblCompanyTrunklineModel::where('company_id',$company_id)->get();
    $data['_company_availment_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                                      ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_company_coverage_plan.availment_plan_id')
                                      ->get();
    $data['_company_member']          = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)
                                      ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
                                      ->get();
    $data['company_contract']         = TblCompanyContractModel::where('company_id',$company_id)->first();

    return view('carewell.modal_pages.company_details',$data);

  }
  public function company_create_company()
  {
    $data['_availment_plan'] = TblAvailmentPlanModel::get();
    $data['_payment_mode']    = TblPaymentModeModel::get();
    return view('carewell.modal_pages.company_create_company',$data);
  }
  public function company_create_company_submit(Request $request)
  {

        $count_company = TblCompanyModel::count();
        $unique_name   = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,5);
        if($count_company==null||$count_company==0)
        {
          $companyLastId = sprintf("%05d",1);
        }
        else
        {
          $company = TblCompanyModel::orderBy('company_id','DESC')->first();
          $companyLastId = sprintf("%05d",$company->company_id+1);
        }
        
        $companyData = new TblCompanyModel;
        $companyData->company_code            = $companyLastId;
        $companyData->company_name            = $request->company_name;
        $companyData->company_contact_person  = $request->company_contact_person;
        $companyData->company_email_address   = $request->company_email_address;
        $companyData->company_phone_number    = $request->company_phone_number;
        $companyData->company_zipcode         = $request->company_zipcode;
        $companyData->company_street          = $request->company_street;
        $companyData->company_city            = $request->company_city;
        $companyData->company_country         = $request->company_country;
        $companyData->company_status          = 'active';
        $companyData->company_date_created    = Carbon::now();
        $companyData->company_parent_id      = 0;
        $companyData->save();

        $fileContract = $request->file("contract");
        $fileContractRef = $unique_name.'-'.$fileContract->getClientOriginalName();
        $fileContract->move('contract',$fileContractRef );
        $fileSchedule = $request->file("schedule");
        $fileScheduleRef = $unique_name.'-'.$fileSchedule->getClientOriginalName();
        $fileSchedule->move('schedule_of_benifits',$fileScheduleRef );

        $contractData = new TblCompanyContractModel;
        $contractData->contract_number          = sprintf("%05d",$companyLastId);
        $contractData->contract_mode_of_payment = $request->contract_mode_of_payment;
        $contractData->contract_image           = '/contract/'.$fileContractRef.'';
        $contractData->contract_schedule_of_benifits_image = '/schedule_of_benifits/'.$fileScheduleRef.'';
        $contractData->contract_date_created    = Carbon::now();
        $contractData->company_id               = $companyData->company_id;
        $contractData->save();

        foreach($request->availmentData as $availment_plan)
        {
          $coverageData = new TblCompanyCoveragePlanModel;
          $coverageData->availment_plan_id = $availment_plan;
          $coverageData->company_id = $companyData->company_id;
          $coverageData->save();

        }
        foreach($request->ajaxData as $jobsite)
        {
          $jobsiteData                = new TblCompanyJobsiteModel;
          $jobsiteData->jobsite_name  = $jobsite;
          $jobsiteData->company_id    = $companyData->company_id;
          $jobsiteData->save();
        }
        foreach($request->trunkData as $trunk)
        {
          $trunkData                  = new TblCompanyTrunklineModel;
          $trunkData->trunkline_number= $trunk;
          $trunkData->company_id      = $companyData->company_id;
          $trunkData->save();
        }
        

     return "<div class='alert alert-success' style='text-align: center;'>Company Added Successfully!</div>";
  }
 
  /*MEMBER*/
  public function member()
  {
  	$data['page'] = 'Member';
    $data['user'] = $this->global();
    $data['_member']  =  TblMemberModel::Member()->paginate(10);
  	return view('carewell.pages.member_center',$data);
  }
  public function member_create_member()
  {
    $data['_company'] = TblCompanyModel::where('archived',0)->get();
    return view('carewell.modal_pages.member_create_member',$data);
  }
  public function member_create_member_submit(Request $request)
  {
    $companyData = TblCompanyModel::where('company_id',$request->company_id)->first();

    $memberData = new TblMemberModel;
    $memberData->member_first_name          = $request->member_first_name;
    $memberData->member_middle_name         = $request->member_middle_name;
    $memberData->member_last_name           = $request->member_last_name;
    $memberData->member_birthdate           = $request->member_birthdate;
    $memberData->member_gender              = $request->member_gender;
    $memberData->member_marital_status      = $request->member_marital_status;
    $memberData->member_mother_maiden_name  = $request->member_monther_maiden_name;
    $memberData->member_permanet_address    = $request->member_permanet_address;
    $memberData->member_present_address     = $request->member_present_address;
    $memberData->member_contact_number      = $request->member_contact_number;
    $memberData->member_email_address       = $request->member_email_address;
    $memberData->member_date_created        = Carbon::now();
    $memberData->member_universal_id        = "UNIVERSAL ID";
    $memberData->save();

    $display_name                       =   $request->member_first_name." ".$request->member_middle_name." ".$request->member_last_name;
    $member_id                          =   $memberData->member_id;
    $update['member_universal_id']      =   StaticFunctionController::initials($display_name)."-".str_replace(' ','',preg_replace('/[^a-z0-9\s]/i', '', $request->member_birthdate))."-".sprintf("%05d",$member_id);
                                            TblMemberModel::where('member_id',$member_id)->update($update);
    foreach($request->member_dependent_full_name as $key=>$data)
    {
      $dependentData = new TblMemberDependentModel;
      $dependentData->member_dependent_full_name    = $request->member_dependent_full_name[$key];
      $dependentData->member_dependent_birthdate    = $request->member_dependent_birthdate[$key];
      $dependentData->member_dependent_relationship = $request->member_dependent_relationship[$key];
      $dependentData->member_id                     = $memberData->member_id;
      $dependentData->save();
    }

    $governmentData = new TblMemberGovernmentCardModel;
    $governmentData->member_government_card_philhealth  = $request->member_government_card_philhealth;
    $governmentData->member_government_card_sss         = $request->member_government_card_sss;
    $governmentData->member_government_card_tin         = $request->member_government_card_tin;
    $governmentData->member_government_card_hdmf        = $request->member_government_card_hdmf;
    $governmentData->member_id                          = $memberData->member_id;
    $governmentData->save();
    
    $member_company_count = TblMemberCompanyModel::count();
    if($member_company_count==null||$member_company_count==0)
    {
      $member_company_data = 1;
    }
    else
    {
      $member_company = TblMemberCompanyModel::orderBy('member_company_id','DESC')->first();
      $member_company_data = $member_company->member_company_id + 1;
    }
    
    $companyMemberData = new TblMemberCompanyModel;
    $companyMemberData->member_company_carewell_id      = $companyData->company_code."-".date("my")."-".sprintf("%05d",$member_company_data);
    $companyMemberData->member_company_employee_number  = $request->member_company_employee_number;
    $companyMemberData->member_company_status           = "active";
    $companyMemberData->availment_plan_id               = $request->availment_plan_id;
    $companyMemberData->jobsite_id                      = $request->jobsite_id;
    $companyMemberData->member_id                       = $memberData->member_id;
    $companyMemberData->company_id                      = $request->company_id;
    $companyMemberData->save();
    if($memberData->save())
    {
      return "<div class='alert alert-success' style='text-align: center;'>Member Added Successfully!</div>";
    }
    else
    {
      return "<div class='alert alert-danger' style='text-align: center;'>Something went wrong!</div>";
    }
  }
  public function member_view_details($member_id)
  {
    $data['member_details']    = TblMemberModel::where('member_id',$member_id)->first();
    $data['_member_dependent'] = TblMemberDependentModel::where('member_id',$member_id)->get();
    $data['member_government'] = TblMemberGovernmentCardModel::where('member_id',$member_id)->first();
    $data['_member_company']    = TblMemberCompanyModel::where('member_id',$member_id)
                                ->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id')
                                ->join('tbl_company_jobsite','tbl_company_jobsite.jobsite_id','=','tbl_member_company.jobsite_id')
                                ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_member_company.availment_plan_id')
                                ->get();

    return view('carewell.modal_pages.member_view_details',$data);
  }
  public function member_transaction_details($member_id)
  {
    $data['_payment_history'] = TblCompanyCalMemberModel::where('tbl_company_cal_member.member_id',$member_id)
                                ->join('tbl_member','tbl_member.member_id','=','tbl_company_cal_member.member_id')
                                ->join('tbl_company_cal','tbl_company_cal.cal_id','=','tbl_company_cal_member.cal_id')
                                ->join('tbl_company','tbl_company.company_id','=','tbl_company_cal.cal_company_id')
                                ->paginate(10);
    $data['_approval']        = TblApprovalModel::where('tbl_approval.member_id',$member_id)
                                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                                ->get();

    return view('carewell.modal_pages.member_transaction_details',$data);
  }
  public function member_import_member(Request $request)
  {

    $data['_company']     =   TblCompanyModel::get();
    return view('carewell.modal_pages.member_import',$data);
    
  }
  public function member_download_template($company_id,$number)
  {
        $excels['number_of_rows'] =   $number;
        $excels['company_id']     =   $company_id;
        $company_template         =   TblCompanyModel::where('company_id',$company_id)->first();
        $excels['company_code']   =   $company_template->company_code;
        $excels['data']           =   ['COMPANY CODE','EMPLOYEE NUMBER','MEMBER LAST NAME','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER BIRTHDATE','MEMBER JOBSITE','AVAILMENT PLAN NAME'];
         Excel::create('CAREWELL '.$company_template->company_name.' TEMPLATE', function($excel) use ($excels) 
         {

            $excel->sheet('template', function($sheet) use ($excels) 
            {
              $data = $excels['data'];
              $number_of_rows = $excels['number_of_rows'];
              $sheet->fromArray($data, null, 'A1', false, false);
              $sheet->freezeFirstRow();

              for($row = 1, $rowcell = 2; $row <= $number_of_rows; $row++, $rowcell++)
              {
                  /* COMPANY ROW */
                  $sheet->setCellValue('A'.$rowcell, $excels['company_code']);
              
                  /* DEPLOYMENT*/
                  $deployment_cell = $sheet->getCell('G'.$rowcell)->getDataValidation();
                  $deployment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $deployment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $deployment_cell->setAllowBlank(false);
                  $deployment_cell->setShowInputMessage(true);
                  $deployment_cell->setShowErrorMessage(true);
                  $deployment_cell->setShowDropDown(true);
                  $deployment_cell->setErrorTitle('Input error');
                  $deployment_cell->setError('Value is not in list.');
                  $deployment_cell->setFormula1('deployment');
                  
                  /* AVAILMENT*/
                  $availment_cell = $sheet->getCell('H'.$rowcell)->getDataValidation();
                  $availment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $availment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $availment_cell->setAllowBlank(false);
                  $availment_cell->setShowInputMessage(true);
                  $availment_cell->setShowErrorMessage(true);
                  $availment_cell->setShowDropDown(true);
                  $availment_cell->setErrorTitle('Input error');
                  $availment_cell->setError('Value is not in list.');
                  $availment_cell->setFormula1('availment');
              }
            });

          /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
          $excel->sheet('reference', function($sheet) use($excels) 
          {
              $company_id       = $excels['company_id'];
              $_company         = TblCompanyModel::get();
              $_jobsite         = TblCompanyJobsiteModel::where('company_id',$company_id)->get();
              $_availment       = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                                  ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_company_coverage_plan.availment_plan_id')
                                  ->get();
              /* DEPLOYMENT REFERENCES */
              $sheet->SetCellValue("D1", "Deployment");
              $job_number = 2;
              foreach($_jobsite as $jobsite)
              {
                  $sheet->SetCellValue("D".$job_number, $jobsite->jobsite_name);
                  $job_number++;
              }
              $job_number--;
              /* AVAILMENT REFERENCES */
              $sheet->SetCellValue("F1", "availment");
              $availment_number = 2;
              foreach($_availment as $availment)
              {
                  $sheet->SetCellValue("F".$availment_number, $availment->availment_plan_name);
                  $availment_number++;
              }
              $availment_number--;
              /*DEPLOYMENT*/
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'deployment', $sheet, 'D2:D'.$job_number
                  )
              );
              /*AVAILMENT*/
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'availment', $sheet, 'F2:F'.$availment_number
                  )
              );
          });
      })->download('xlsx');
  }
  

  public function member_import_member_submit(Request $request)
  {
    $file   = $request->file('importMemberFile')->getRealPath();
    $_data  = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    
    $first  = $_data[0]; 
      if(isset($first['company_code'])&&isset($first['member_last_name']))
      {    
        $count = 0;
        foreach($_data as $data)
        {
          $companyID   = StaticFunctionController::getid($data['company_code'], 'company');
          $companyData = TblCompanyModel::where('company_id',$companyID)->first();

          $count_member = TblMemberModel::where('member_first_name',StaticFunctionController::nullableToString($data['member_first_name']))
                          ->where('member_last_name', StaticFunctionController::nullableToString($data['member_last_name']))
                          ->where('member_middle_name',StaticFunctionController::nullableToString($data['member_middle_name']))
                          ->count();
          if($count_member == 0 && $data['member_birthdate']!=null&&StaticFunctionController::getid($data['company_code'], 'company') != null )
          {
            $member['member_first_name']        =   StaticFunctionController::nullableToString($data['member_first_name']);
            $member['member_middle_name']       =   StaticFunctionController::nullableToString($data['member_middle_name']);
            $member['member_last_name']         =   StaticFunctionController::nullableToString($data['member_last_name']);
            $member['member_birthdate']         =   date_format($data['member_birthdate'],"d-m-Y");  
            $member['member_gender']            =   "N/A";
            $member['member_marital_status']    =   "N/A";
            $member['member_mother_maiden_name']=   "N/A";
            $member['member_permanet_address']  =   "N/A";
            $member['member_present_address']   =   "N/A";
            $member['member_contact_number']    =   "N/A";
            $member['member_email_address']     =   "N/A";
            $member['member_date_created']      =   Carbon::now();
            $member['member_universal_id']      =   'UNIVERSAL ID';

            $member_id                          =   TblMemberModel::insertGetId($member);
            $display_name                       =   $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
            $update['member_universal_id']      =   StaticFunctionController::initials($display_name)."-".str_replace(' ','',preg_replace('/[^a-z0-9\s]/i', '', $member['member_birthdate']))."-".sprintf("%05d",$member_id);
                                                    TblMemberModel::where('member_id',$member_id)->update($update);

            $dependent['member_dependent_full_name']    =   "N/A";
            $dependent['member_dependent_birthdate']    =   "N/A";
            $dependent['member_dependent_relationship'] =   "N/A";
            $dependent['member_id']                     =   $member_id;
            TblMemberDependentModel::insert($dependent);

            $government['member_government_card_philhealth'] =   "N/A";
            $government['member_government_card_sss']        =   "N/A";
            $government['member_government_card_tin']        =   "N/A";
            $government['member_government_card_hdmf']       =   "N/A";
            $government['member_id']                         =   $member_id;
              
            TblMemberGovernmentCardModel::insert($government);

            $member_company_count = TblMemberCompanyModel::count();
            if($member_company_count==null||$member_company_count==0)
            {
              $member_company_data = 1;
            }
            else
            {
              $member_company = TblMemberCompanyModel::orderBy('member_company_id','DESC')->first();
              $member_company_data = $member_company->member_company_id + 1;
            }
            $company['member_company_carewell_id']    =  $companyData->company_code."-".date("my")."-".sprintf("%05d",$member_company_data);
            $company['member_company_status']         =   "active";
            $company['member_company_employee_number']=   StaticFunctionController::nullableToString($data['employee_number']);
            $company['availment_plan_id']             =   StaticFunctionController::getid($data['availment_plan_name'], 'availment');
            $company['jobsite_id']                    =   StaticFunctionController::getid($data['member_jobsite'], 'jobsite');
            $company['member_id']                     =   $member_id;
            $company['company_id']                    =   $companyID;
            TblMemberCompanyModel::insert($company);
              
            $count++;
          }
        }    

        if($count == 0)
        {
          $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
        }
        else
        {
          $message = '<center><b><span class="color-green">'.$count.' Employee/s has been inserted.</span></b></center>';
        }
        return $message;
      }
      else
      {
        return '<center><b><span class="color-red">Wrong file Format</span></b></center>';
      }
  }
  

  /*PROVIDER*/
  public function provider()
  {
    $data['page']       = 'Network Provider';
    $data['user']       = $this->global();
    $data['_provider']  = TblProviderModel::paginate(10);
    return view('carewell.pages.provider_center',$data);
  }
  public function provider_create()
  {
    return view('carewell.modal_pages.provider_create_provider');
  }

  public function provider_create_submit(Request $request)
  {
    if($request->agreed_value=="checked")
    {
      $provider_billing_name = $request->provider_name;
    }
    else
    {
      $provider_billing_name = $request->provider_billing_name;
    }
    $providerData = new TblProviderModel;
    $providerData->provider_name            = $request->provider_name;
    $providerData->provider_billing_name    = $provider_billing_name;
    $providerData->provider_contact_person  = $request->provider_contact_person;
    $providerData->provider_contact_number  = $request->provider_contact_number;
    $providerData->provider_mobile_number   = $request->provider_mobile_number;
    $providerData->provider_contact_email   = $request->provider_contact_email;
    $providerData->provider_zip             = $request->provider_zip;
    $providerData->provider_street          = $request->provider_street;
    $providerData->provider_city            = $request->provider_city;
    $providerData->provider_country         = $request->provider_country;
    $providerData->provider_created         = Carbon::now();
    $providerData->save();

    $billingData = new TblProviderBillingModel;
    $billingData->provider_billing_name     = $request->provider_billing_name;
    $billingData->provider_billing_email    = $request->provider_billing_email;
    $billingData->provider_billing_telephone= $request->provider_billing_telephone;
    $billingData->provider_billing_mobile   = $request->provider_billing_mobile;
    $billingData->provider_billing_zipcode  = $request->provider_billing_zipcode;
    $billingData->provider_billing_street   = $request->provider_billing_street;
    $billingData->provider_billing_city     = $request->provider_billing_city;
    $billingData->provider_billing_country  = $request->provider_billing_country;
    $billingData->provider_id               = $providerData->provider_id;
    $billingData->save();


    if($providerData->save())
    {
      return "<div class='alert alert-success' style='text-align: center;'>Provider Added Successfully!</div>";    
    }
    else
    {
      return "error";
    }
    

  }
  public function provider_details(Request $request,$provider_id)
  {
    $data['provider_details'] = TblProviderModel::where('tbl_provider.provider_id',$provider_id)
                              ->join('tbl_provider_billing','tbl_provider_billing.provider_id','=','tbl_provider.provider_id')
                              ->first();
    $data['_provider_doctor']  = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$provider_id)
                              ->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
                              ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_doctor_provider.doctor_id')
                              ->get();
    foreach ($data['_provider_doctor'] as $key => $doctor) 
    {
      $data['_provider_doctor'][$key]['doctor_specialization'] =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)->get();
    }

    return view('carewell.modal_pages.provider_details',$data);
  }

  /*DOCTOR*/
  public function doctor(Request $request)
  {
    $data['page']       = 'Doctor';
    $data['user']       = $this->global();
    $data['_doctor']    = TblDoctorModel::Doctor()->paginate(10);
    foreach ($data['_doctor'] as $key => $doctor) 
    {
      $data['_doctor'][$key]['specialization'] =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)->get();
    }
    return view('carewell.pages.doctor_center',$data);

  }
  public function create_doctor()
  {
    $data['_provider'] = TblProviderModel::where('archived',0)->get();
    $data['_specialization'] = TblSpecializationModel::get();
    return view('carewell.modal_pages.doctor_create',$data);
  }
  public function doctor_view_details(Request $request,$doctor_id)
  {
    $data['_provider']              = TblProviderModel::get();
    $data['doctor_details']         = TblDoctorModel::where('doctor_id',$doctor_id)->first();
    $data['_doctor_specialization'] = TblDoctorSpecializationModel::where('doctor_id',$doctor_id)->get();
    $data['_doctor_provider']       = TblDoctorProviderModel::where('tbl_doctor_provider.doctor_id',$doctor_id)
                                    ->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
                                    ->get();

    return view('carewell.modal_pages.doctor_details',$data);
  }
  public function create_doctor_submit(Request $request)
  {

    $doctorData = new TblDoctorModel;
    $doctorData->doctor_number          = $request->doctor_number;
    $doctorData->doctor_first_name      = $request->doctor_first_name;
    $doctorData->doctor_middle_name     = $request->doctor_middle_name;
    $doctorData->doctor_last_name       = $request->doctor_last_name;
    $doctorData->doctor_gender          = $request->doctor_gender;
    $doctorData->doctor_birthdate       = $request->doctor_birthdate;
    $doctorData->doctor_contact_number  = $request->doctor_contact_number;
    $doctorData->doctor_email_address   = $request->doctor_email_address;
    $doctorData->doctor_address         = $request->doctor_address;
    $doctorData->doctor_created         = Carbon::now();
    $doctorData->save();

    $providerData = new TblDoctorProviderModel;
    $providerData->provider_id          = $request->provider_id;
    $providerData->doctor_id            = $doctorData->doctor_id;
    $providerData->save();

    foreach($request->ajaxData as $specialization)
    {
      $specializationData = new TblDoctorSpecializationModel;
      $specializationData->specialization_name  = $specialization;
      $specializationData->doctor_id            = $doctorData->doctor_id;
      $specializationData->save();
    }
    if($doctorData->save())
    {
      return "<div class='alert alert-success' style='text-align: center;'>Doctor Added Successfully!</div>";    
    }
  }
  public function import_doctor()
  {
    $data['_provider'] = TblProviderModel::get();
    return view('carewell.modal_pages.doctor_import',$data);
  }
  public function doctor_download_template($provider_id,$number)
  {
    $excels['number_of_rows'] =   $number;
    $excels['provider_id']    =   $provider_id;
    $provider_template         =   TblProviderModel::where('provider_id',$provider_id)->first();
    $excels['provider_name']   =   $provider_template->provider_name;
    $excels['data']           =   ['PROVIDER NAME','DOCTOR NUMBER','DOCTOR LAST NAME','DOCTOR FIRST NAME','DOCTOR MIDDLE NAME','DOCTOR GENDER','DOCTOR BIRTHDATE','DOCTOR CONTACT NUMBER','DOCTOR EMAIL ADDRESS','DOCTOR ADDRESS','DOCTOR SPECIALIZATION'];
    Excel::create('CAREWELL '.$provider_template->provider_name.' PROVIDER TEMPLATE', function($excel) use ($excels) 
    {
      $excel->sheet('template', function($sheet) use ($excels) 
      {
        $data = $excels['data'];
        $number_of_rows = $excels['number_of_rows'];
        $sheet->fromArray($data, null, 'A1', false, false);
        $sheet->freezeFirstRow();

        for($row = 1, $rowcell = 2; $row <= $number_of_rows; $row++, $rowcell++)
        {
            /* PROVIDER ROW */
            $sheet->setCellValue('A'.$rowcell, $excels['provider_name']);
        
            /* GENDER*/
            $gender_cell = $sheet->getCell('F'.$rowcell)->getDataValidation();
            $gender_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $gender_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $gender_cell->setAllowBlank(false);
            $gender_cell->setShowInputMessage(true);
            $gender_cell->setShowErrorMessage(true);
            $gender_cell->setShowDropDown(true);
            $gender_cell->setErrorTitle('Input error');
            $gender_cell->setError('Value is not in list.');
            $gender_cell->setFormula1('gender');
        }
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {
        $provider_id       = $excels['provider_id'];
        
        /* GENDER REFERENCES */
        $sheet->SetCellValue("F1", "gender");
        $sheet->SetCellValue("F2", 'MALE');
        $sheet->SetCellValue("F3", 'FEMALE');
        
        /*GENDER*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'gender', $sheet, 'F2:F3'
            )
        );
      });
    })->download('xlsx');
  }
  public function doctor_import_doctor_submit(Request $request)
  {
    $file   = $request->file('importDoctorFile')->getRealPath();
    $_data  = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    
    $first  = $_data[0]; 
      if(isset($first['provider_name'])&&isset($first['doctor_last_name']))
      {    
        $count = 0;
        foreach($_data as $data)
        {
          $providerID   = StaticFunctionController::getid($data['provider_name'], 'provider');
          $providerData = TblProviderModel::where('provider_id',$providerID)->first();

          $count_doctor = TblDoctorModel::where('doctor_first_name',StaticFunctionController::nullableToString($data['doctor_first_name']))
                          ->where('doctor_last_name', StaticFunctionController::nullableToString($data['doctor_last_name']))
                          ->where('doctor_middle_name',StaticFunctionController::nullableToString($data['doctor_middle_name']))
                          ->count();
          if($count_doctor == 0 && $data['doctor_birthdate']!=null&&StaticFunctionController::getid($data['provider_name'], 'provider') != null )
          {
            $doctor['doctor_number']            =   StaticFunctionController::nullableToString($data['doctor_number']);
            $doctor['doctor_first_name']        =   StaticFunctionController::nullableToString($data['doctor_first_name']);
            $doctor['doctor_middle_name']       =   StaticFunctionController::nullableToString($data['doctor_middle_name']);
            $doctor['doctor_last_name']         =   StaticFunctionController::nullableToString($data['doctor_last_name']);
            $doctor['doctor_birthdate']         =   date_format($data['doctor_birthdate'],"d-m-Y");  
            $doctor['doctor_gender']            =   StaticFunctionController::nullableToString($data['doctor_gender']);
            $doctor['doctor_address']           =   StaticFunctionController::nullableToString($data['doctor_address']);
            $doctor['doctor_contact_number']    =   StaticFunctionController::nullableToString($data['doctor_contact_number']);
            $doctor['doctor_email_address']     =   StaticFunctionController::nullableToString($data['doctor_email_address']);
            $doctor['doctor_created']           =   Carbon::now();
           
            $doctor_id                          =   TblDoctorModel::insertGetId($doctor);
            

            $specialization['specialization_name']  =   StaticFunctionController::nullableToString($data['doctor_email_address']);
            $specialization['doctor_id']            =   $doctor_id ;
            TblDoctorSpecializationModel::insert($specialization);

            $doctorProviderData['provider_id']         = $providerID;
            $doctorProviderData['doctor_id']           = $doctor_id;
            TblDoctorProviderModel::insert($doctorProviderData);

            $count++;
          }
        }    

        if($count == 0)
        {
          $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
        }
        else
        {
          $message = '<center><b><span class="color-green">'.$count.' Member/s has been inserted.</span></b></center>';
        }
        return $message;
      }
      else
      {
        return '<center><b><span class="color-red">Wrong file Format</span></b></center>';
      }

  }
  /*BILLING*/
  public function billing()
  {
  	$data['page']         = 'Billing';
    $data['user']         = $this->global();
    $data['_cal_company'] = TblCompanyCalModel::join('tbl_company','tbl_company.company_id','=','tbl_company_cal.cal_company_id')->paginate(10);
    $data['_company']     = TblCompanyModel::get();
  	return view('carewell.pages.billing_and_collection',$data);
  }
  public function billing_create_cal()
  {
    $data['_company']     = TblCompanyModel::get();
    $data['_cal_company'] = TblCompanyCalModel::get();
    return view('carewell.modal_pages.billing_create_cal',$data);
  }
  public function billing_create_cal_submit(Request $request)
  {
    
    $cal_count                                  =  TblCompanyCalModel::count();
    if($cal_count==null||$cal_count==0)
    {
      $calLastId                               =  1;
    }
    else
    {
      $cal                                      =  TblCompanyCalModel::orderBy('cal_id','DESC')->first();
      $calLastId                               =  $cal->cal_id+1;
    }
    $companyCalData                             =   new TblCompanyCalModel;
    $companyCalData->cal_company_id             =   $request->cal_company_id;
    $companyCalData->cal_number                 =   'CAL-'.sprintf("%05d",$calLastId);
    $companyCalData->cal_reveneu_period_month   =   $request->cal_reveneu_period_month;
    $companyCalData->cal_reveneu_period_year    =   $request->cal_reveneu_period_year;
    $companyCalData->cal_reveneu_period         =   $request->cal_reveneu_period;
    $companyCalData->cal_reveneu_period_count   =   $request->cal_reveneu_period_count;
    $companyCalData->cal_company_period_start   =   $request->cal_company_period_start;
    $companyCalData->cal_company_period_end     =   $request->cal_company_period_end;
    $companyCalData->cal_payment_date           =   $request->cal_payment_date;
    $companyCalData->cal_created                =   Carbon::now();
    $companyCalData->save();

    return "<div class='alert alert-success' style='text-align: center;'>Company Cal Added Successfully!</div>";    
  }
  public function billing_member_view($cal_id,$company_id)
  {
    $data['cal_id']   = $cal_id;
    $data['company_id']   = $company_id;
    $data['_cal_member']  = TblCompanyCalMemberModel::where('cal_id',$cal_id)
                            ->join('tbl_member','tbl_member.member_id','=','tbl_company_cal_member.member_id')
                            ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_company_cal_member.member_id')
                            ->paginate(10);
    return view('carewell.modal_pages.billing_cal_members',$data);
  }
  public function billing_import_cal_members($cal_id,$company_id)
  {
    $data['cal_id']       = $cal_id;
    $data['company_id']   = $company_id;
    return view('carewell.modal_pages.billing_import_cal_members',$data);
  }
  public function billing_cal_download_template($cal_id,$company_id)
  {
    $excels['number_of_rows'] =   10;
    $excels['company_id']     =   $company_id;
    $company_template         =   TblCompanyModel::where('company_id',$company_id)->first();
    $cal_template             =   TblCompanyCalModel::where('cal_id',$cal_id)->first();
    $excels['company_name']   =   $company_template->company_name;
    $excels['company_id']     =   $company_template->company_id;
    $excels['cal_number']     =   $cal_template->cal_number;
    $excels['_member']        =   TblMemberCompanyModel::where('tbl_member_company.company_id',$excels['company_id'])
                                  ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
                                  ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_member_company.availment_plan_id')
                                  ->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id')
                                  ->get();
    $excels['data'] = ['COMPANY','CAL NUMBER','CAREWELL ID','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER LAST NAME','PAYMENT AMOUNT','MEMBER STATUS'];
    Excel::create('CAL - '.$company_template->company_name.' - TEMPLATE', function($excel) use ($excels) 
    {
      $excel->sheet('template', function($sheet) use ($excels) 
      {
        $data   = $excels['data'];
        $_member = $excels['_member'];
        $number_of_rows = $excels['number_of_rows'];
        $sheet->fromArray($data, null, 'A1', false, false);
        $sheet->freezeFirstRow();
        $count_member     = count($_member);
        for($row = 1, $rowcell = 2; $row <= $count_member; $row++, $rowcell++)
        {
          $sheet->setCellValue('A'.$rowcell, $excels['company_name']);
          $sheet->setCellValue('B'.$rowcell, $excels['cal_number']);

          $status_cell = $sheet->getCell('H'.$rowcell)->getDataValidation();
          $status_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $status_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $status_cell->setAllowBlank(false);
          $status_cell->setShowInputMessage(true);
          $status_cell->setShowErrorMessage(true);
          $status_cell->setShowDropDown(true);
          $status_cell->setErrorTitle('Input error');
          $status_cell->setError('Value is not in list.');
          $status_cell->setFormula1('status');
        }
        foreach($_member as  $key => $member)
        {
          $key = $key+=2;
          $sheet->setCellValue('C'.$key, $member->member_company_carewell_id);
          $sheet->setCellValue('D'.$key, $member->member_first_name);
          $sheet->setCellValue('E'.$key, $member->member_middle_name);
          $sheet->setCellValue('F'.$key, $member->member_last_name);
          $sheet->setCellValue('G'.$key, $member->availment_plan_price);
          $sheet->setCellValue('H'.$key, $member->member_company_status);
        }
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {

         /* STATUS REFERENCE */
          $sheet->SetCellValue("A1", "status");
          $sheet->SetCellValue("A2", "ACTIVE");
          $sheet->SetCellValue("A3", "INACTIVE");
          $sheet->SetCellValue("A4", "RESIGN");

          $sheet->_parent->addNamedRange
          (
              new \PHPExcel_NamedRange(
              'status', $sheet, 'A2:A4'
              )
          );
      });
      
    })->download('xlsx');
  }
  public function billing_cal_import_template(Request $request)
  {
    $file         = $request->file('importCalMemberFile')->getRealPath();
    $_data        = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    $company_id   = $request->company_id;
    $cal_id       = $request->cal_id;
    $companyData  = TblCompanyModel::where('company_id',$company_id)->first();
    $first        = $_data[0]; 
          if(isset($first['company'])&&isset($first['cal_number'])&&isset($first['carewell_id']))
          {    
               $count = 0;
               foreach($_data as $data)
               {

                    $check_member   = TblMemberCompanyModel::where('member_company_carewell_id',$data['carewell_id'])->first();
                    $check_exist    = TblCompanyCalMemberModel::where('member_id',$check_member->member_id)
                                    ->where('cal_id',$cal_id)
                                    ->first();
                    $count_member = count($check_member);
                    $count_exist  = count($check_exist);
                    if($count_member != 0 &&$count_exist==0)
                    {
                          
                          $cal_member['cal_member_amount']        =   StaticFunctionController::nullableToString($data['payment_amount']);
                          $cal_member['cal_member_date_paid']     =   Carbon::now();
                          $cal_member['member_id']                =   $check_member->member_id;
                          $cal_member['cal_id']                   =   $cal_id; 

                          
                          TblCompanyCalMemberModel::insert($cal_member);
                          
                          $count++;
                    }
               }    
               if($count == 0)
               {
                    $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
                    
               }
               else
               {
                  $message = '<center><b><span class="color-green">'.$count.' Employee/s has been inserted.</span></b></center>';
               }
               


               return $message;
          }
          else
          {
               return '<center><b><span class="color-red">Wrong file Format</span></b></center>';
               
          }
  }
  public function billing_billing_statement()
  {
    return view('carewell.modal_pages.billing_cal_statements');
  }

  /*MEDICAL*/
  public function medical()
  {
  	$data['page'] = 'Medical';
    $data['user'] = $this->global();
    $data['_approval'] = TblApprovalModel::join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                          ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                          ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                          ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                          ->paginate(10);
  	return view('carewell.pages.medical_representative',$data);
  }
  public function medical_create_approval()
  {
    $data['_member']    = TblMemberModel::get();
    $data['_provider']  = TblProviderModel::get();
    $data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
    $data['_procedure'] = TblProcedureModel::get();
    $data['_doctor']    = TblDoctorModel::get();
    return view('carewell.modal_pages.medical_create_approval',$data);
  }
  public function medical_create_approval_member_info($member_id)
  {
    $data['member_info']  = TblMemberModel::where('tbl_member.member_id',$member_id)->Member()->first();
    $data['_member']      = TblMemberModel::get();
    foreach ($data['_member'] as $key => $member) 
    {
      $data['_member'][$key]['display_name'] =  $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
    }
    
    return view('carewell.modal_pages.medical_create_approval_member',$data);
  }
  public function medical_create_approval_availment_info($availment_id)
  {
    $data['_procedure']   = TblProcedureModel::get();
    return view('carewell.modal_pages.medical_create_approval_availment',$data);
  }
  public function medical_create_approval_doctor_info($provider_id)
  {
    $data['_procedure']   = TblProcedureModel::get();
    $data['_doctor']      = TblDoctorModel::get();
    return view('carewell.modal_pages.medical_create_approval_doctor',$data);
  }
  public function medical_create_approval_submit(Request $request)
  {
    $approval_count                                  =  TblApprovalModel::count();
    if($approval_count==null||$approval_count==0)
    {
      $approvalLastId                               =  1;
    }
    else
    {
      $approval                                      =  TblApprovalModel::orderBy('approval_id','DESC')->first();
      $approvalLastId                               =  $approval->approval_id+1;
    }
    
    $data['user'] = $this->global();
    $approvalData = new TblApprovalModel;
    $approvalData->approval_number            = 'APP-'.str_replace(["-", "–"], "",date("m-y")).'-'.sprintf("%05d",$approvalLastId);
    $approvalData->approval_complaint         = $request->approval_complaint;
    $approvalData->approval_initial_diagnosis = $request->approval_initial_diagnosis;
    $approvalData->approval_final_diagnosis   = $request->approval_final_diagnosis;
    $approvalData->approval_created           = Carbon::now();
    $approvalData->availment_id               = $request->availment_id;
    $approvalData->provider_id                = $request->provider_id;
    $approvalData->member_id                  = $request->member_id;
    $approvalData->user_id                    = $data['user']->user_id;
    $approvalData->save();

    foreach($request->procedure_id as $key=>$data)
    {
      $availedData = new TblProcedureAvailedModel;
      $availedData->procedure_availed_amount              = $request->procedure_availed_amount[$key];
      $availedData->procedure_availed_remarks             = $request->procedure_availed_remarks[$key];
      $availedData->procedure_availed_philhealth_charity  = $request->procedure_availed_philhealth_charity[$key];
      $availedData->procedure_availed_charge_to_patient   = $request->procedure_availed_charge_to_patient[$key];
      $availedData->procedure_availed_disapproved         = $request->procedure_availed_disapproved[$key];
      $availedData->procedure_availed_charge_to_carewell  = $request->procedure_availed_charge_to_carewell[$key];
      $availedData->procedure_id                          = $request->procedure_id[$key];
      $availedData->approval_id                           = $approvalData->approval_id;
      $availedData->save();
    }
    
    foreach($request->doctor_id as $key=>$data)
    {
      $doctorData = new TblProcedureDoctorModel;
      $doctorData->procedure_doctor_actual_pf_charges    = $request->procedure_doctor_actual_pf_charges[$key];
      $doctorData->procedure_doctor_rate_r_vs            = $request->procedure_doctor_rate_r_vs[$key];
      $doctorData->procedure_doctor_philhealth_charity   = $request->procedure_doctor_philhealth_charity[$key];
      $doctorData->procedure_doctor_charge_to_patient   = $request->procedure_doctor_charge_to_patient[$key];
      $doctorData->procedure_doctor_disapproved          = $request->procedure_doctor_disapproved[$key];
      $doctorData->procedure_doctor_charge_to_carewell   = $request->procedure_doctor_charge_to_carewell[$key];
      $doctorData->procedure_id                          = $request->doctor_procedure_id[$key];
      $doctorData->doctor_id                             = $request->doctor_id[$key];
      $doctorData->approval_id                           = $approvalData->approval_id;
      $doctorData->save();
    }
    if($approvalData->save()&&$availedData->save()&&$doctorData->save())
    {
      return "<div class='alert alert-success' style='text-align: center;'>Company Added Successfully!</div>";
    }
    else
    {
      return "<div class='alert alert-danger' style='text-align: center;'>Something went wrong!</div>";
    }
    
  }
  public function medical_view_approval_details($approval_id)
  {
    $data['_member']    = TblMemberModel::get();
    $data['_provider']  = TblProviderModel::get();
    $data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
    $data['_procedure'] = TblProcedureModel::get();
    $data['_doctor']    = TblDoctorModel::get();
    $data['approval_details']  = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)
                                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id')
                                ->join('tbl_user_info','tbl_user_info.user_id','tbl_approval.user_id')
                                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                                ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                                ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                                ->first();
    $data['_availed']   = TblProcedureAvailedModel::where('tbl_procedure_availed.approval_id',$approval_id)
                                ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_procedure_availed.procedure_id')
                                ->get();
    $data['_doctor_assigned']   = TblProcedureDoctorModel::where('tbl_procedure_doctor.approval_id',$approval_id)
                                ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_procedure_doctor.procedure_id')
                                ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_procedure_doctor.doctor_id')
                                ->get();
    return view('carewell.modal_pages.medical_approval_details',$data);
  }

  

  /*PAYABLE*/
  public function payable()
  {
  	$data['page'] = 'Payable';
    $data['user'] = $this->global();
  	return view('carewell.pages.payable',$data);
  }

  public function payable_create()
  {

    $data['_provider']  = TblProviderModel::where('archived',0)->get();
    $data['_approval'] = TblApprovalModel::join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                          ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                          ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                          ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                          ->paginate(10);
    return view('carewell.modal_pages.payable_create',$data);
  }
  public function reports()
  {
  	$data['page'] = 'Reports';
    $data['user'] = $this->global();

    return view('carewell.pages.reports',$data);
  }
  /*SETTINGS*/
  public function settings_plan()
  {
  	$data['page'] = 'Plan Settings';
    $data['user'] = $this->global();

    $data['_availment_plan'] = TblAvailmentPlanModel::paginate(10);

  	return view('carewell.pages.settings_plan',$data);
  }
  public function settings_plan_create_plan()
  {
    $data['_availment'] = TblAvailmentModel::all();
    return view('carewell.modal_pages.settings_create_plan',$data);
  }
  public function settings_plan_create_plan_submit(Request $request)
  {
   
    $availmentPlanData = new TblAvailmentPlanModel;
    $availmentPlanData->availment_plan_name   =   $request->availment_plan_name;
    $availmentPlanData->availment_plan_price  =   $request->availment_plan_price;
    $availmentPlanData->availment_plan_created=   Carbon::now();
    $availmentPlanData->save();

    foreach($request->ajaxData as $key=> $availment_id)
    {

      $availmentTagData = new TblAvailmentTagModel;
      $availmentTagData->availment_id                   =   $availment_id;
      $availmentTagData->availment_plan_id              =   $availmentPlanData->availment_plan_id;
      $availmentTagData->availment_type_coverage_amount =   '1400';
      $availmentTagData->save();
    }
    return "<div class='alert alert-success' style='text-align: center;'>Company Added Successfully!</div>";
  }
  public function settings_plan_details($availment_plan_id)
  {
    $data['_availment_plan_details'] = TblAvailmentTagModel::where('availment_plan_id',$availment_plan_id)->AvailmentTag($availment_plan_id)->get();
    // dd($data);
    $data['availment_plan'] = TblAvailmentPlanModel::where('availment_plan_id',$availment_plan_id)->first();
    return view('carewell.modal_pages.settings_plan_details',$data);
  }

  public function settings_provider()
  {
    $data['page'] = 'Provider Settings';
    $data['user'] = $this->global();

    $data['_provider'] = TblProviderModel::paginate(10);

    return view('carewell.pages.settings_provider',$data);
  }

  public function settings_coverage_plan()
  {
    $data['page'] = 'Coverage PLan';
    $data['user'] = $this->global();

    $data['_availment_plan'] = TblAvailmentPlanModel::paginate(10);

    return view('carewell.pages.settings_coverage_plan',$data);
  }
  public function settings_coverage_plan_create()
  {
    $data['_benefits'] = TblScheduleOfBenefitsModel::where('benefits_parent_id',0)->get();
    foreach ($data['_benefits'] as $key => $benefits) 
    {
      $data['_benefits'][$key]['child_benefits'] =  TblScheduleOfBenefitsModel::where('benefits_parent_id',$benefits->benefits_id)->get();
    }
    // dd($data);
    return view('carewell.modal_pages.settings_create_coverage_plan',$data);
  }


}
