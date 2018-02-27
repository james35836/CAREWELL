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

use Excel;
use Input;
// use Request;
use DB;
use Carbon\Carbon;
use Paginate;
use Crypt;

class CarewellController extends ActiveAuthController
{
  /*DASHBOARD*/
  public function dashboard()
  {
    $monthYear            = date("Y");
  	$data['page']         = 'Dashboard';
    $data['user']         = StaticFunctionController::global();

    $data['January']    =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-01').'%')->count();
    $data['February']   =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-02').'%')->count();
    $data['March']      =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-03').'%')->count();
    $data['April']      =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-04').'%')->count();
    $data['May']        =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-05').'%')->count();
    $data['June']       =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-06').'%')->count();
    $data['July']       =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-07').'%')->count();
    $data['August']     =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-08').'%')->count();
    $data['September']  =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-09').'%')->count();
    $data['October']    =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-10').'%')->count();
    $data['November']   =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-11').'%')->count();
    $data['December']   =  TblApprovalModel::where('approval_created','LIKE','%'.date('Y-12').'%')->count();
   
    $data['company_active']    = TblCompanyModel::where('archived',0)->count();
    $data['member_active']     = TblMemberModel::where('archived',0)->count();

    $data['company_inactive']    = TblCompanyModel::where('archived',0)->count();
    $data['member_inactive']     = TblMemberModel::where('archived',1)->count();

    $data['provider_active']   = TblProviderModel::where('archived',0)->count();
    
    $data['_approval']  = TblApprovalModel::where('tbl_approval.archived',0)->ApprovalInfo()->orderBy('approval_created','DESC')->get();
    $data['total_approval'] =  count($data['_approval']);
    return view('carewell.pages.dashboard',$data);
  }
  /*COMPANY*/
  public function company()
  {
  	$data['page']          = 'Company';
    $data['user']          = StaticFunctionController::global();
    $data['_company_active']      = TblCompanyModel::where('tbl_company.archived',0)->Company()->paginate(10);
    $data['_company_inactive']      = TblCompanyModel::where('tbl_company.archived',1)->Company()->paginate(10);
    foreach ($data['_company_active'] as $key => $company) 
    {
      $data['_company_active'][$key]['coverage_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)
                                                ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                                                ->get();
    }
    foreach ($data['_company_inactive'] as $key => $company) 
    {
      $data['_company_inactive'][$key]['coverage_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)
                                                ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                                                ->get();
    }
  	return view('carewell.pages.company_center',$data);
  }
  public function company_details($company_id)
  {
    $data['_coverage_plan']       = TblCoveragePlanModel::get();
    $data['_payment_mode']        = TblPaymentModeModel::get();
    $data['company_details']      = TblCompanyModel::where('company_id',$company_id)->first();
    $data['_company_deployment']  = TblCompanyDeploymentModel::where('company_id',$company_id)->get();
    $data['_company_number']      = TblCompanyNumberModel::where('company_id',$company_id)->get();
    $data['_coverage_plan']       = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                                  ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                                  ->get();
    $data['_company_member']      = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)
                                  ->where('tbl_member_company.archived',0)
                                  ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
                                  ->join('tbl_company_deployment','tbl_company_deployment.deployment_id','=','tbl_member_company.deployment_id')
                                  ->get();
    $data['company_contract']     = TblCompanyContractModel::where('company_id',$company_id)
                                  ->join('tbl_payment_mode','tbl_payment_mode.payment_mode_id','=','tbl_company_contract.payment_mode_id')
                                  ->first();
    $data['_contract_images']     = TblCompanyContractImageModel::where('archived',0)->where('contract_id',$data['company_contract']->contract_id)->get();
    $data['_benefits_images']     = TblCompanyContractBenefitsModel::where('archived',0)->where('contract_id',$data['company_contract']->contract_id)->get();
    return view('carewell.modal_pages.company_details',$data);

  }
  public function company_create_company()
  {

    $data['_coverage_plan']   = TblCoveragePlanModel::where('archived',0)->get();
    $data['_payment_mode']    = TblPaymentModeModel::get();
    return view('carewell.modal_pages.company_create',$data);
  }
  public function company_create_company_submit(Request $request)
  {
    
        
        $unique_name   = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,5);
        
        $companyData = new TblCompanyModel;
        $companyData->company_code            = StaticFunctionController::updateReferenceNumber('company');
        $companyData->company_name            = $request->company_name;
        $companyData->company_contact_person  = $request->company_contact_person;
        $companyData->company_email_address   = $request->company_email_address;
        $companyData->company_address         = $request->company_address;
        $companyData->company_status          = 'active';
        $companyData->company_contract_signed = Carbon::now();
        $companyData->company_created         = Carbon::now();
        $companyData->company_parent_id       = 0;
        $companyData->save();

        $contractCompanyData = new TblCompanyContractModel;
        $contractCompanyData->contract_number  = $companyData->company_code;
        $contractCompanyData->payment_mode_id  = 1;
        $contractCompanyData->contract_created = Carbon::now();
        $contractCompanyData->company_id       = $companyData->company_id;
        $contractCompanyData->save();

        foreach($request->contactData as $company_number)
        {
          $numberData = new TblCompanyNumberModel;
          $numberData->company_number = $company_number;
          $numberData->company_id = $companyData->company_id;
          $numberData->save();
        }
        
        foreach($request->file("contractData") as $contract_image_name)
        {
          $fileContractRef = $unique_name.'-'.$contract_image_name->getClientOriginalName();
          $contract_image_name->move('contract',$fileContractRef );

          $contractImageData = new TblCompanyContractImageModel;
          $contractImageData->contract_image_name = '/contract/'.$fileContractRef.'';
          $contractImageData->contract_id = $contractCompanyData->contract_id;
          $contractImageData->save();
        }
        // foreach($request->file("benefitsData") as $contract_benefits_name)
        // {
          // $fileContractBRef = $unique_name.'-'.$contract_benefits_name->getClientOriginalName();
          // $contract_benefits_name->move('schedule_of_benefits',$fileContractBRef );

          // $benefitsImageData = new TblCompanyContractBenefitsModel;
          // $benefitsImageData->contract_benefits_name = '/schedule_of_benefits/'.$fileContractBRef.'';
          // $benefitsImageData->contract_id = $contractCompanyData->contract_id;
          // $benefitsImageData->save();
        // }
          $benefitsImageData = new TblCompanyContractBenefitsModel;
          $benefitsImageData->contract_benefits_name = 'none';
          $benefitsImageData->contract_id = $contractCompanyData->contract_id;
          $benefitsImageData->save();

        foreach($request->coveragePlanData as $coverage_plan_id)
        {
          $coverageData = new TblCompanyCoveragePlanModel;
          $coverageData->coverage_plan_id = $coverage_plan_id;
          $coverageData->company_id = $companyData->company_id;
          $coverageData->save();
        }
        foreach($request->deploymentData as $deployment_name)
        {
          $deploymentCompanyData = new TblCompanyDeploymentModel;
          $deploymentCompanyData->deployment_name = $deployment_name;
          $deploymentCompanyData->company_id = $companyData->company_id;
          $deploymentCompanyData->save();
        }
   return StaticFunctionController::returnMessage('success','COMPANY');
  }
 
  /*MEMBER*/
  public function member()
  {
  	$data['page']                 = 'Member';
    $data['user']                 = StaticFunctionController::global();
    $data['_company']             = TblCompanyModel::where('archived',0)->get();
    $data['_member_active']       = TblMemberModel::where('tbl_member.archived',0)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10);
    $data['_member_deactivate']   = TblMemberModel::where('tbl_member.archived',1)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10);
  	return view('carewell.pages.member_center',$data);
  }
  public function member_create_member()
  {
    $data['_company'] = TblCompanyModel::where('archived',0)->get();
    return view('carewell.modal_pages.member_create',$data);
  }
  public function member_create_member_submit(Request $request)
  {
    $companyData = TblCompanyModel::where('company_id',$request->company_id)->first();
    
    $memberData = new TblMemberModel;
    $memberData->member_first_name          = $request->member_first_name;
    $memberData->member_middle_name         = $request->member_middle_name;
    $memberData->member_last_name           = $request->member_last_name;
    $memberData->member_birthdate           = date('d-m-Y', strtotime($request->member_birthdate));
    $memberData->member_gender              = $request->member_gender;
    $memberData->member_marital_status      = $request->member_marital_status;
    $memberData->member_mother_maiden_name  = $request->member_mother_maiden_name;
    $memberData->member_contact_number      = $request->member_contact_number;
    $memberData->member_email_address       = $request->member_email_address;
    $memberData->member_permanet_address    = $request->member_permanet_address;
    $memberData->member_present_address     = $request->member_present_address;
    $memberData->member_created             = Carbon::now();
    
    $display_name                           = $memberData->member_first_name." ".$memberData->member_middle_name." ".$memberData->member_last_name;
    
    $memberData->member_universal_id        = StaticFunctionController::generateUniversalId($display_name,$memberData->member_birthdate);
    $memberData->save();

    foreach($request->dependent_full_name as $key=>$data)
    {
      $dependentData = new TblMemberDependentModel;
      $dependentData->dependent_full_name    = $request->dependent_full_name[$key];
      $dependentData->dependent_birthdate    = $request->dependent_birthdate[$key];
      $dependentData->dependent_relationship = $request->dependent_relationship[$key];
      $dependentData->member_id              = $memberData->member_id;
      $dependentData->save();
    }

    $governmentData = new TblMemberGovernmentCardModel;
    $governmentData->government_card_philhealth  = $request->government_card_philhealth;
    $governmentData->government_card_sss         = $request->government_card_sss;
    $governmentData->government_card_tin         = $request->government_card_tin;
    $governmentData->government_card_hdmf        = $request->government_card_hdmf;
    $governmentData->member_id                   = $memberData->member_id;
    $governmentData->save();
    
    $companyMemberData = new TblMemberCompanyModel;
    $companyMemberData->member_carewell_id      = StaticFunctionController::generateCarewellId($companyData->company_code);
    $companyMemberData->member_employee_number  = $request->member_employee_number;
    $companyMemberData->member_company_status   = "active";
    $companyMemberData->member_transaction_date = Carbon::now();
    $companyMemberData->coverage_plan_id        = $request->coverage_plan_id;
    $companyMemberData->deployment_id           = $request->deployment_id;
    $companyMemberData->member_id               = $memberData->member_id;
    $companyMemberData->company_id              = $request->company_id;
    $companyMemberData->save();
    if($memberData->save())
    {
      return StaticFunctionController::returnMessage('success','MEMBER');
    }
    else
    {
      return StaticFunctionController::returnMessage('danger','MEMBER');
    }
  }
  public function member_details($member_id)
  {
    $data['member_details']     = TblMemberModel::where('member_id',$member_id)->first();
    $data['_member_dependent']  = TblMemberDependentModel::where('member_id',$member_id)->get();
    $data['member_government']  = TblMemberGovernmentCardModel::where('member_id',$member_id)->first();
    $data['_member_company']    = TblMemberCompanyModel::where('tbl_member_company.member_id',$member_id)->MemberCompany()->get();

    return view('carewell.modal_pages.member_details',$data);
  }

  public function member_transaction_details($member_id)
  {
    $coverage = TblMemberCompanyModel::where('archived',0)->where('member_id',$member_id)->first();
    $data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage->coverage_plan_id)->first();
    $data['_coverage_plan_covered'] = TblCoveragePlanTagModel::where('coverage_plan_id',$coverage->coverage_plan_id)
                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_tag.availment_id')
                                    ->get();
    foreach($data['_coverage_plan_covered'] as $key=>$coverage_plan_covered)
    {
      $data['_coverage_plan_covered'][$key]['child_plan_item']    =  TblCoveragePlanTagModel::where('availment_parent_id',$coverage_plan_covered->availment_id)->where('coverage_plan_id',$coverage->coverage_plan_id)->CoveragePlanTag($coverage->coverage_plan_id)->get();
      $data['_coverage_plan_covered'][$key]['child_availment']    =  TblAvailmentModel::where('availment_parent_id',$coverage_plan_covered->availment_id)->get();
      $data['_coverage_plan_covered'][$key]['availment_charges']  =  TblAvailmentChargesModel::where('archived',0)->get();
    }

    $data['_payment_history']   = TblCalMemberModel::where('tbl_cal_member.member_id',$member_id)->PaymentHistory()->paginate(10);
    $data['_availment_history'] = TblApprovalModel::where('tbl_approval.member_id',$member_id)->AvailmentHistory()->get();
                                // dd($data['_availment_history']);

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
        $excels['data']           =   ['COMPANY CODE','CAREWELL ID','EMPLOYEE NUMBER','MEMBER LAST NAME','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER BIRTHDATE','DEPLOYMENT','COVERAGE PLAN'];
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
                  $deployment_cell = $sheet->getCell('H'.$rowcell)->getDataValidation();
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
                  $availment_cell = $sheet->getCell('I'.$rowcell)->getDataValidation();
                  $availment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $availment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $availment_cell->setAllowBlank(false);
                  $availment_cell->setShowInputMessage(true);
                  $availment_cell->setShowErrorMessage(true);
                  $availment_cell->setShowDropDown(true);
                  $availment_cell->setErrorTitle('Input error');
                  $availment_cell->setError('Value is not in list.');
                  $availment_cell->setFormula1('coverage');
              }
            });

          /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
          $excel->sheet('reference', function($sheet) use($excels) 
          {
              $company_id       = $excels['company_id'];
              $_company         = TblCompanyModel::get();
              $_deployment      = TblCompanyDeploymentModel::where('company_id',$company_id)->get();
              $_coverage       = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                                  ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                                  ->get();
              /* DEPLOYMENT REFERENCES */
              $sheet->SetCellValue("H1", "deployment");
              $deployment_number = 2;
              foreach($_deployment as $deployment)
              {
                  $sheet->SetCellValue("H".$deployment_number, $deployment->deployment_name);
                  $deployment_number++;
              }
              $deployment_number--;
              /* AVAILMENT REFERENCES */
              $sheet->SetCellValue("I1", "coverage");
              $coverage_number = 2;
              foreach($_coverage as $coverage)
              {
                  $sheet->SetCellValue("I".$coverage_number, $coverage->coverage_plan_name);
                  $coverage_number++;
              }
              $coverage_number--;
              /*DEPLOYMENT*/
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'deployment', $sheet, 'H2:H'.$deployment_number
                  )
              );
              /*AVAILMENT*/
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'coverage', $sheet, 'I2:I'.$coverage_number
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
      if(isset($first['company_code'])&&isset($first['carewell_id']))
      {    
        $count = 0;
        $countError = 0;
        foreach($_data as $data)
        {
          $companyID   = StaticFunctionController::getid($data['company_code'], 'company');
          $companyData = TblCompanyModel::where('company_id',$companyID)->first();

          $count_member = TblMemberModel::MemberExist($data['member_first_name'],$data['member_middle_name'],$data['member_last_name'])->first();

          if($data['carewell_id']!=null&&$companyData!=null&&$count_member ==null && $data['member_birthdate']!=null&&StaticFunctionController::getid($data['company_code'], 'company') != null )
          {
            $member['member_first_name']        =   StaticFunctionController::nullableToString($data['member_first_name']);
            $member['member_middle_name']       =   StaticFunctionController::nullableToString($data['member_middle_name']);
            $member['member_last_name']         =   StaticFunctionController::nullableToString($data['member_last_name']);
            $member['member_birthdate']         =   date('d-m-Y', strtotime($data['member_birthdate'])); 
            $member['member_gender']            =   "N/A";
            $member['member_marital_status']    =   "N/A";
            $member['member_mother_maiden_name']=   "N/A";
            $member['member_contact_number']    =   "N/A";
            $member['member_email_address']     =   "N/A";
            $member['member_permanet_address']  =   "N/A";
            $member['member_present_address']   =   "N/A";
            $member['member_created']           =   Carbon::now();

            $display_name                       =   $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
            $member['member_universal_id']      =   StaticFunctionController::generateUniversalId($display_name,$member['member_birthdate']);
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

            $company['member_carewell_id']        =   StaticFunctionController::nullableToString($data['carewell_id']);
            $company['member_employee_number']    =   "11";
            $company['member_company_status']     =   "N/A";
            $company['member_transaction_date']   =   Carbon::now();
            $company['coverage_plan_id']          =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
            $company['deployment_id']             =   StaticFunctionController::getid($data['deployment'], 'deployment');
            $company['member_id']                 =   $member_id;
            $company['company_id']                =   $companyData->company_id;
            
            TblMemberCompanyModel::insert($company);
              
            $count++;
          }
          else
          {
            $countError++;
          }
        }    

        if($count == 0&&$countError==0)
        {
          $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
        }
        else
        {
          $message = '<center><b><span class="color-green">'.$count.' Member/s  inserted with '.$countError.' member rejected</span></b></center>';
        }
        return $message;
      }
      else
      {
        return '<center><b><span class="color-red">Wrong file Format</span></b></center>';
      }
  }
  public function member_adjustment($member_id)
  {
    $data['member_id']  = $member_id;
    $data['_company'] = TblCompanyModel::where('archived',0)->get();

    return view('carewell.modal_pages.member_adjustment',$data);
  }
  public function member_adjustment_submit(Request $request)
  {
    $update['archived'] = 1;
    TblMemberCompanyModel::where('member_id',$request->member_id_adjustment)->update($update);
    $companyData = TblCompanyModel::where('company_id',$request->company_id_adjustment)->first();
    // dd($request->company_id_adjustment);
    $companyMemberData = new TblMemberCompanyModel;
    $companyMemberData->member_carewell_id      = StaticFunctionController::generateCarewellId($companyData->company_code);
    $companyMemberData->member_employee_number  = $request->employee_number_adjustment;
    $companyMemberData->member_company_status   = "active";
    $companyMemberData->member_transaction_date = Carbon::now();
    $companyMemberData->coverage_plan_id        = $request->coverage_plan_id_adjustment;
    $companyMemberData->deployment_id           = $request->deployment_id_adjustment;
    $companyMemberData->member_id               = $request->member_id_adjustment;
    $companyMemberData->company_id              = $companyData->company_id;
    $companyMemberData->save();

    if($companyMemberData->save())
    {
      return StaticFunctionController::returnMessage('success','ADJUSTMENT');    
    }
    else
    {
      return StaticFunctionController::returnMessage('danger','ADJUSTMENT'); 
    }
  }

  /*PROVIDER*/
  public function provider()
  {
    $data['page']       = 'Network Provider';
    $data['user']       = StaticFunctionController::global();
    $data['_provider_active']  = TblProviderModel::where('archived',0)->paginate(10);
    foreach ($data['_provider_active'] as $key => $provider) 
    {
      $data['_provider_active'][$key]['provider_payee'] =  TblProviderPayeeModel::where('provider_id',$provider->provider_id)->get();
    }

    $data['_provider_inactive']  = TblProviderModel::where('archived',1)->paginate(10);
    foreach ($data['_provider_inactive'] as $key => $provider) 
    {
      $data['_provider_inactive'][$key]['provider_payee'] =  TblProviderPayeeModel::where('provider_id',$provider->provider_id)->get();
    }

    return view('carewell.pages.provider_center',$data);
  }
  public function provider_create()
  {
    return view('carewell.modal_pages.provider_create');
  }

  public function provider_create_submit(Request $request)
  {
    
    $providerData = new TblProviderModel;
    $providerData->provider_name            = $request->provider_name;
    $providerData->provider_contact_person  = $request->provider_contact_person;
    $providerData->provider_telephone_number= $request->provider_telephone_number;
    $providerData->provider_mobile_number   = $request->provider_mobile_number;
    $providerData->provider_contact_email   = $request->provider_contact_email;
    $providerData->provider_address         = $request->provider_address;
    $providerData->provider_created         = Carbon::now();
    $providerData->save();

    foreach($request->payeeData as $payee_name)
    {
      $providerPayeeData = new TblProviderPayeeModel;
      $providerPayeeData->provider_payee_name = $payee_name;
      $providerPayeeData->provider_id = $providerData->provider_id;
      $providerPayeeData->save();
    }
    if($providerData->save())
    {
      return StaticFunctionController::returnMessage('success','PROVIDER');    
    }
    else
    {
      return StaticFunctionController::returnMessage('danger','PROVIDER'); 
    }
    

  }
  public function provider_details(Request $request,$provider_id)
  {
    $data['_provider_payee'] = TblProviderPayeeModel::where('provider_id',$provider_id)->get();
    $data['provider_details'] = TblProviderModel::where('tbl_provider.provider_id',$provider_id)->first();
    $data['_provider_doctor']  = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$provider_id)->DoctorProvider()->get();
    foreach ($data['_provider_doctor'] as $key => $doctor) 
    {
      $data['_provider_doctor'][$key]['doctor_specialization'] =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)
                                                                ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                                                ->get();
    }

    return view('carewell.modal_pages.provider_details',$data);
  }

  /*DOCTOR*/
  public function doctor(Request $request)
  {
    $data['page']       = 'Doctor';
    $data['user']       = StaticFunctionController::global();
    $data['_provider']  = TblProviderModel::where('archived',0)->get();
    
    $data['_doctor_active']    = TblDoctorModel::where('archived',0)->paginate(10);
    foreach ($data['_doctor_active'] as $key => $doctor) 
    {
      $data['_doctor_active'][$key]['specialization']  =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)
                                                ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                                ->get();
      $data['_doctor_active'][$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
                                                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
                                                ->get();
    }

    $data['_doctor_inactive']    = TblDoctorModel::where('archived',1)->paginate(10);
    foreach ($data['_doctor_inactive'] as $key => $doctor) 
    {
      $data['_doctor_inactive'][$key]['specialization']  =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)
                                                ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                                ->get();
      $data['_doctor_inactive'][$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
                                                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
                                                ->get();
    }
    return view('carewell.pages.doctor_center',$data);

  }
  
  public function doctor_view_details(Request $request,$doctor_id)
  {
    $data['_provider']              = TblProviderModel::where('archived',0)->get();
    $data['_specialization']        = TblSpecializationModel::where('archived',0)->get();
    $data['doctor_details']         = TblDoctorModel::where('doctor_id',$doctor_id)->first();
    $data['_doctor_specialization'] = TblDoctorSpecializationModel::where('doctor_id',$doctor_id)
                                    ->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
                                    ->get();
    $data['_doctor_provider']       = TblDoctorProviderModel::where('tbl_doctor_provider.doctor_id',$doctor_id)
                                    ->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
                                    ->get();

    return view('carewell.modal_pages.doctor_details',$data);
  }
  public function add_doctor()
  {
    $data['_provider']        = TblProviderModel::where('archived',0)->get();
    $data['_specialization']  = TblSpecializationModel::get();
    return view('carewell.modal_pages.doctor_create',$data);
  }
  public function add_doctor_submit(Request $request)
  {

    

    $doctorData = new TblDoctorModel;
    $doctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
    $doctorData->doctor_first_name      = $request->doctor_first_name;
    $doctorData->doctor_middle_name     = $request->doctor_middle_name;
    $doctorData->doctor_last_name       = $request->doctor_last_name;
    $doctorData->doctor_gender          = $request->doctor_gender;
    $doctorData->doctor_contact_number  = $request->doctor_contact_number;
    $doctorData->doctor_email_address   = $request->doctor_email_address;
    $doctorData->doctor_created         = Carbon::now();
    $doctorData->save();

    

    foreach($request->doctorProviderData as $provider)
    {
      $providerData = new TblDoctorProviderModel;
      $providerData->provider_id  = $provider;
      $providerData->doctor_id    = $doctorData->doctor_id;
      $providerData->save();
    }

    foreach($request->specialData as $specialization)
    {
      $specializationData = new TblDoctorSpecializationModel;
      $specializationData->specialization_id = $specialization;
      $specializationData->doctor_id         = $doctorData->doctor_id;
      $specializationData->save();
    }
    if($doctorData->save())
    {
      return StaticFunctionController::returnMessage('success','DOCTOR');    
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
    $excels['data']           =   ['PROVIDER NAME','DOCTOR LAST NAME','DOCTOR FIRST NAME','DOCTOR MIDDLE NAME','DOCTOR GENDER','DOCTOR CONTACT NUMBER','DOCTOR EMAIL ADDRESS','DOCTOR SPECIALIZATION'];
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
            $gender_cell = $sheet->getCell('E'.$rowcell)->getDataValidation();
            $gender_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $gender_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $gender_cell->setAllowBlank(false);
            $gender_cell->setShowInputMessage(true);
            $gender_cell->setShowErrorMessage(true);
            $gender_cell->setShowDropDown(true);
            $gender_cell->setErrorTitle('Input error');
            $gender_cell->setError('Value is not in list.');
            $gender_cell->setFormula1('gender');

            /* SPECIALIZATION*/
            $special_cell = $sheet->getCell('H'.$rowcell)->getDataValidation();
            $special_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $special_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $special_cell->setAllowBlank(false);
            $special_cell->setShowInputMessage(true);
            $special_cell->setShowErrorMessage(true);
            $special_cell->setShowDropDown(true);
            $special_cell->setErrorTitle('Input error');
            $special_cell->setError('Value is not in list.');
            $special_cell->setFormula1('special');
        }
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {
        $provider_id       = $excels['provider_id'];
        $_specialization    = TblSpecializationModel::where('archived',0)->get();
        
        /* GENDER REFERENCES */
        $sheet->SetCellValue("E1", "gender");
        $sheet->SetCellValue("E2", 'MALE');
        $sheet->SetCellValue("E3", 'FEMALE');

        /* DEPLOYMENT REFERENCES */
        $sheet->SetCellValue("H1", "special");
        $special_number = 2;
        foreach($_specialization as $specialization)
        {
            $sheet->SetCellValue("H".$special_number, $specialization->specialization_name);
            $special_number++;
        }
        $special_number--;
        
        /*GENDER*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'gender', $sheet, 'E2:E3'
            )
        );
        /*SPECIALIZATION*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'special', $sheet, 'H2:H'.$special_number
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
      if(isset($first['provider_name'])&&isset($first['doctor_last_name'])&&isset($first['doctor_first_name'])&&isset($first['doctor_middle_name']))
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
          if($count_doctor == 0 &&StaticFunctionController::getid($data['provider_name'], 'provider') != null )
          {
            $doctor['doctor_number']            =   StaticFunctionController::updateReferenceNumber('doctor');
            $doctor['doctor_first_name']        =   StaticFunctionController::nullableToString($data['doctor_first_name']);
            $doctor['doctor_middle_name']       =   StaticFunctionController::nullableToString($data['doctor_middle_name']);
            $doctor['doctor_last_name']         =   StaticFunctionController::nullableToString($data['doctor_last_name']);
            $doctor['doctor_gender']            =   StaticFunctionController::nullableToString($data['doctor_gender']);
            $doctor['doctor_contact_number']    =   StaticFunctionController::nullableToString($data['doctor_contact_number']);
            $doctor['doctor_email_address']     =   StaticFunctionController::nullableToString($data['doctor_email_address']);
            $doctor['doctor_created']           =   Carbon::now();
           
            $doctor_id                          =   TblDoctorModel::insertGetId($doctor);
            

            $specialization['specialization_id']  =   StaticFunctionController::getid($data['doctor_specialization'], 'specialization');
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
    $data['user']         = StaticFunctionController::global();
    $data['_cal_open']    = TblCalModel::where('tbl_cal.archived',0)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
    $data['_cal_close']   = TblCalModel::where('tbl_cal.archived',1)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
    $data['_company']     = TblCompanyModel::where('archived',0)->get();
  	return view('carewell.pages.billing_center',$data);
  }
  public function billing_create_cal()
  {
    $data['_company']     = TblCompanyModel::get();
    $data['_cal_company'] = TblCalModel::get();
    $data['_period']      = TblPaymentModeModel::get();
    return view('carewell.modal_pages.billing_create_cal',$data);
  }
  public function billing_create_cal_submit(Request $request)
  {
    
    $companyCalData                             =   new TblCalModel;
    $companyCalData->cal_number                 =   StaticFunctionController::updateReferenceNumber('billing_cal');;
    $companyCalData->cal_reveneu_period_month   =   $request->cal_reveneu_period_month;
    $companyCalData->cal_reveneu_period_year    =   $request->cal_reveneu_period_year;
    $companyCalData->cal_reveneu_period         =   $request->cal_reveneu_period;
    $companyCalData->cal_reveneu_period_count   =   $request->cal_reveneu_period_count;
    $companyCalData->cal_company_period_start   =   $request->cal_company_period_start;
    $companyCalData->cal_company_period_end     =   $request->cal_company_period_end;
    $companyCalData->cal_payment_date           =   $request->cal_payment_date;
    $companyCalData->cal_created                =   Carbon::now();
    $companyCalData->company_id                 =   $request->cal_company_id;
    $companyCalData->save();

    return StaticFunctionController::returnMessage('success','COMPANY CAL');     
  }
  public function billing_cal_details($cal_id)
  {
    $data['cal_details']  = TblCalModel::where('cal_id',$cal_id)
                          ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                          ->first();
    $data['_cal_member']  = TblCalMemberModel::where('cal_id',$cal_id)->CalMember()->get();
    
    return view('carewell.modal_pages.billing_cal_details',$data);
  }
  public function billing_import_cal_members($cal_id,$company_id)
  {
    $data['cal_id']       = $cal_id;
    $data['company_id']   = $company_id;
    return view('carewell.modal_pages.billing_import',$data);
  }
  public function billing_cal_download_template($cal_id,$company_id)
  {
    $excels['number_of_rows'] =   10;
    $excels['company_id']     =   $company_id;
    $cal_template             =   TblCalModel::where('cal_id',$cal_id)
                              ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                              ->first();
    $excels['company_name']   =   $cal_template->company_name;
    $excels['company_id']     =   $cal_template->company_id;
    $excels['cal_number']     =   $cal_template->cal_number;

    $excels['_deployment']    = TblCompanyDeploymentModel::where('tbl_company_deployment.company_id',$company_id)->get();
    $excels['_coverage']      = TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$company_id)
                              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                              ->get();
    $excels['_member']        = TblMemberCompanyModel::where('tbl_member_company.archived',0)->where('tbl_member_company.company_id',$company_id)->MemberCompany()->get();
    $excels['count_member']   =   count($excels['_member'])+10;
    $excels['data'] = ['COMPANY','CAL NUMBER','UNIVERSAL ID','CAREWELL ID','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER LAST NAME','MEMBER BIRTHDATE','COVERAGE PLAN','DEPLOYMENT','PAYMENT AMOUNT','MEMBER STATUS'];
    Excel::create('CAL - '.$excels['company_name'].' - TEMPLATE', function($excel) use ($excels) 
    {
      $excel->sheet('template', function($sheet) use ($excels) 
      {
        $data   = $excels['data'];
        $_member = $excels['_member'];
        $number_of_rows = $excels['number_of_rows'];
        $sheet->fromArray($data, null, 'A1', false, false);
        $sheet->freezeFirstRow();
        for($row = 1, $rowcell = 2; $row <= $excels['count_member']; $row++, $rowcell++)
        {
          $sheet->setCellValue('A'.$rowcell, $excels['company_name']);
          $sheet->setCellValue('B'.$rowcell, $excels['cal_number']);
          
          $coverage_cell = $sheet->getCell('I'.$rowcell)->getDataValidation();
          $coverage_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $coverage_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $coverage_cell->setAllowBlank(false);
          $coverage_cell->setShowInputMessage(true);
          $coverage_cell->setShowErrorMessage(true);
          $coverage_cell->setShowDropDown(true);
          $coverage_cell->setErrorTitle('Input error');
          $coverage_cell->setError('Value is not in list.');
          $coverage_cell->setFormula1('coverage');

          $deployment_cell = $sheet->getCell('J'.$rowcell)->getDataValidation();
          $deployment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $deployment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $deployment_cell->setAllowBlank(false);
          $deployment_cell->setShowDropDown(true);
          $deployment_cell->setFormula1('deployment');

          $status_cell = $sheet->getCell('L'.$rowcell)->getDataValidation();
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

          $sheet->setCellValue('C'.$key, $member->member_universal_id);
          $sheet->setCellValue('D'.$key, $member->member_carewell_id);
          $sheet->setCellValue('E'.$key, $member->member_first_name);
          $sheet->setCellValue('F'.$key, $member->member_middle_name);
          $sheet->setCellValue('G'.$key, $member->member_last_name);
          $sheet->setCellValue('H'.$key, date('m/d/Y', strtotime($member->member_birthdate)));
          $sheet->setCellValue('I'.$key, $member->coverage_plan_name);
          $sheet->setCellValue('J'.$key, $member->deployment_name);
          $sheet->setCellValue('K'.$key, $member->coverage_plan_monthly_premium);
          $sheet->setCellValue('L'.$key, $member->member_company_status);
        }
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {
        $_coverage    = $excels['_coverage'];
        $_deployment  = $excels['_deployment'];
        /* COVERAGE REFERENCES */
        $sheet->SetCellValue("I1", "coverage");
        $coverage_number = 2;
        foreach($_coverage as $coverage)
        {
            $sheet->SetCellValue("I".$coverage_number, $coverage->coverage_plan_name);
            $coverage_number++;
        }
        $coverage_number--;
        /* DEPLOYMENT REFERENCES */
        $sheet->SetCellValue("J1", "deployment");
        $deployment_number = 2;
        foreach($_deployment as $deployment)
        {
            $sheet->SetCellValue("J".$deployment_number, $deployment->deployment_name);
            $deployment_number++;
        }
        $deployment_number--;
        /* STATUS REFERENCE */
        $sheet->SetCellValue("L1", "status");
        $sheet->SetCellValue("L2", "ACTIVE");
        $sheet->SetCellValue("L3", "INACTIVE");
        

        /*COVERAGE*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'coverage', $sheet, 'I2:I'.$coverage_number
            )
        );
        /*DEPLOYMENT*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'deployment', $sheet, 'J2:J'.$deployment_number
            )
        );
        /*STATUS*/
        $sheet->_parent->addNamedRange
        (
            new \PHPExcel_NamedRange(
            'status', $sheet, 'L2:L3'
            )
        );
      });
      
    })->download('xlsx');
  }
  public function billing_cal_import_template(Request $request)
  {
    $file         = $request->file('importCalMemberFile')->getRealPath();
    $_data        = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    $first        = $_data[0]; 

    if(isset($first['company'])&&isset($first['cal_number']))
    {    
      $count            = 0;
      $countBdate       = 0;
      $countWrongCode   = 0;
      $countExist      = 0;
      $countNew      = 0;
      foreach($_data as $data)
      {
        $companyData  = TblCompanyModel::join('tbl_cal','tbl_cal.company_id','=','tbl_company.company_id')
                    ->where('tbl_company.company_name',$data['company'])
                    ->where('tbl_cal.cal_number',$data['cal_number'])
                    ->first();
        if($companyData!=null&&$data['member_first_name']!=""&&$data['member_last_name']!=""&&$data['member_middle_name']!="")
        {
          if($data['universal_id']==""&&$data['carewell_id']=="")
          {
            $checkingMember = TblMemberModel::MemberExist($data['member_first_name'],$data['member_middle_name'],$data['member_last_name'])->first();
            
            if($checkingMember!=null)
            {
              $checkCal     = TblCalMemberModel::CalMemberExist($checkingMember->member_id,$companyData->cal_id)->first();
              if($checkCal!=null)
              {
                $countExist++;
              }
              else
              {
                $cal_member['cal_payment_amount']     =   StaticFunctionController::nullableToString($data['payment_amount']);
                $cal_member['cal_payment_date']       =   Carbon::now();
                $cal_member['member_id']              =   $checkingMember->member_id;
                $cal_member['cal_id']                 =   $companyData->cal_id;

                TblCalMemberModel::insert($cal_member);

                $count++; 
              }

            }
            else
            {
              $member['member_first_name']        =   StaticFunctionController::nullableToString($data['member_first_name']);
              $member['member_middle_name']       =   StaticFunctionController::nullableToString($data['member_middle_name']);
              $member['member_last_name']         =   StaticFunctionController::nullableToString($data['member_last_name']);
                                                  $date = $data['member_birthdate'];
              $member['member_birthdate']         =   date('d-m-Y', strtotime($date));  
              $member['member_gender']            =   "N/A";
              $member['member_marital_status']    =   "N/A";
              $member['member_mother_maiden_name']=   "N/A";
              $member['member_permanet_address']  =   "N/A";
              $member['member_present_address']   =   "N/A";
              $member['member_contact_number']    =   "N/A";
              $member['member_email_address']     =   "N/A";
              $member['member_created']           =   Carbon::now();

              $display_name                       =   $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];

              $member['member_universal_id']      =   StaticFunctionController::generateUniversalId($display_name,$member['member_birthdate']);

              $member_id                          =   TblMemberModel::insertGetId($member);

              $dependent['dependent_full_name']    =   "N/A";
              $dependent['dependent_birthdate']    =   "N/A";
              $dependent['dependent_relationship'] =   "N/A";
              $dependent['member_id']                     =   $member_id;
              TblMemberDependentModel::insert($dependent);

              $government['government_card_philhealth'] =   "N/A";
              $government['government_card_sss']        =   "N/A";
              $government['government_card_tin']        =   "N/A";
              $government['government_card_hdmf']       =   "N/A";
              $government['member_id']                         =   $member_id;
              TblMemberGovernmentCardModel::insert($government);
              
              $company['member_carewell_id']        =   StaticFunctionController::generateCarewellId($companyData->company_code);
              $company['member_employee_number']    =   "11";
              $company['member_company_status']     =   "N/A";
              $company['member_transaction_date']   =   Carbon::now();
              $company['coverage_plan_id']          =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
              $company['deployment_id']             =   StaticFunctionController::getid($data['deployment'], 'deployment');
              $company['member_id']                 =   $member_id;
              $company['company_id']                =   $companyData->company_id;
              TblMemberCompanyModel::insert($company);

              $cal_member['cal_payment_amount']     =   StaticFunctionController::nullableToString($data['payment_amount']);
              $cal_member['cal_payment_date']       =   Carbon::now();
              $cal_member['member_id']              =   $member_id;
              $cal_member['cal_id']                 =   $companyData->cal_id; 

              TblCalMemberModel::insert($cal_member);
              $countNew++;
            }
          }
          else
          {
            $checkingMember = TblMemberModel::MemberExist($data['member_first_name'],$data['member_middle_name'],$data['member_last_name'])->first();
            
            if($checkingMember!=null)
            {
              $checkCal     = TblCalMemberModel::CalMemberExist($checkingMember->member_id,$companyData->cal_id)->first();
              if($checkCal!=null)
              {
                $countExist++;
              }
              else
              {
                $checkingMemberCompany = TblMemberCompanyModel::where('member_id',$checkingMember->member_id)->where('company_id',$companyData->company_id)->first();
                if($checkingMemberCompany!=null)
                {
                  $cal_member['cal_payment_amount']     =   StaticFunctionController::nullableToString($data['payment_amount']);
                  $cal_member['cal_payment_date']       =   Carbon::now();
                  $cal_member['member_id']              =   $checkingMember->member_id;
                  $cal_member['cal_id']                 =   $companyData->cal_id;

                  TblCalMemberModel::insert($cal_member);

                  $count++; 

                }
                else
                {
                  $archived['archived'] = 1;
                  TblMemberCompanyModel::where('member_id',$checkingMember->member_id)->update($archived);
                
                  $company['member_carewell_id']        =   StaticFunctionController::generateCarewellId($companyData->company_code);
                  $company['member_employee_number']    =   "11";
                  $company['member_company_status']     =   "active";
                  $company['member_transaction_date']   =   Carbon::now();
                  $company['coverage_plan_id']          =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
                  $company['deployment_id']             =   StaticFunctionController::getid($data['deployment'], 'deployment');
                  $company['member_id']                 =   $checkingMember->member_id;
                  $company['company_id']                =   $companyData->company_id;
                  TblMemberCompanyModel::insert($company);

                  $cal_member['cal_payment_amount']     =   StaticFunctionController::nullableToString($data['payment_amount']);
                  $cal_member['cal_payment_date']       =   Carbon::now();
                  $cal_member['member_id']              =   $checkingMember->member_id;
                  $cal_member['cal_id']                 =   $companyData->cal_id;

                  TblCalMemberModel::insert($cal_member);

                  $count++; 
                }
              }
            }
            else
            {
              $member['member_first_name']        =   StaticFunctionController::nullableToString($data['member_first_name']);
              $member['member_middle_name']       =   StaticFunctionController::nullableToString($data['member_middle_name']);
              $member['member_last_name']         =   StaticFunctionController::nullableToString($data['member_last_name']);
                                            $date = $data['member_birthdate'];
              $member['member_birthdate']         =   date('d-m-Y', strtotime($date));  
              $member['member_gender']            =   "N/A";
              $member['member_marital_status']    =   "N/A";
              $member['member_mother_maiden_name']=   "N/A";
              $member['member_permanet_address']  =   "N/A";
              $member['member_present_address']   =   "N/A";
              $member['member_contact_number']    =   "N/A";
              $member['member_email_address']     =   "N/A";
              $member['member_created']           =   Carbon::now();

              $display_name                       =   $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];

              $member['member_universal_id']      =   StaticFunctionController::generateUniversalId($display_name,$member['member_birthdate']);

              $member_id                          =   TblMemberModel::insertGetId($member);

              $dependent['dependent_full_name']    =   "N/A";
              $dependent['dependent_birthdate']    =   "N/A";
              $dependent['dependent_relationship'] =   "N/A";
              $dependent['member_id']                     =   $member_id;
              TblMemberDependentModel::insert($dependent);

              $government['government_card_philhealth'] =   "N/A";
              $government['government_card_sss']        =   "N/A";
              $government['government_card_tin']        =   "N/A";
              $government['government_card_hdmf']       =   "N/A";
              $government['member_id']                         =   $member_id;
              TblMemberGovernmentCardModel::insert($government);
              
              $company['member_carewell_id']        =   StaticFunctionController::generateCarewellId($companyData->company_code);
              $company['member_employee_number']    =   "11";
              $company['member_company_status']     =   "N/A";
              $company['member_transaction_date']   =   Carbon::now();
              $company['coverage_plan_id']          =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
              $company['deployment_id']             =   StaticFunctionController::getid($data['deployment'], 'deployment');
              $company['member_id']                 =   $member_id;
              $company['company_id']                =   $companyData->company_id;
              TblMemberCompanyModel::insert($company);

              $cal_member['cal_payment_amount']     =   StaticFunctionController::nullableToString($data['payment_amount']);
              $cal_member['cal_payment_date']       =   Carbon::now();
              $cal_member['member_id']              =   $member_id;
              $cal_member['cal_id']                 =   $companyData->cal_id; 

              TblCalMemberModel::insert($cal_member);
              $countNew++;
            }
          }
        }
        else
        {
          $countWrongCode++;
        }
      }
      if($count == 0&&$countExist==0&&$countNew==0)
      {
        $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
      }
      else
      {
        $message = '<center><b><span class="color-green">'.$count.' Member/s has been added to cal.'.$countNew.' new member And '.$countWrongCode.' rejected with '.$countExist.' already exist.</span></b></center>';

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
  public function billing_cal_member_remove(Request $request)
  {
    $remove = TblCalMemberModel::where('cal_member_id',$request->cal_member_id)->delete();
    if($remove)
    {
      return '<center><b><span class="color-red">Member successfully removed!</span></b></center>';
    }
    else
    {
      return "james";
    }

  }

  /*MEDICAL*/
  public function availment()
  {
  	$data['page']       = 'Availment';
    $data['_company']   = TblCompanyModel::where('archived',0)->get();
    $data['user']       = StaticFunctionController::global();
    $data['_approval']  = TblApprovalModel::ApprovalInfo()->paginate(10);
  	return view('carewell.pages.availment_center',$data);
  }
  public function availment_create_approval()
  {
    $data['_member']          = TblMemberModel::join('tbl_member_company','tbl_member_company.member_id','=','tbl_member.member_id')
                              ->where('tbl_member_company.archived',0)
                              ->get();
    $data['_provider']        = TblProviderModel::where('archived',0)->get();
    $data['_availment']       = TblAvailmentModel::where('availment_parent_id',0)->get();
    $data['_procedure_doctor']= TblDoctorProcedureModel::where('archived',0)->get();
    $data['_doctor']          = TblDoctorModel::where('archived',0)->get();
    $data['_payee']           = TblProviderPayeeModel::where('archived',0)->get();
    $data['_diagnosis']       = TblDiagnosisModel::where('archived',0)->get();
    $data['_laboratory']      = TblLaboratoryModel::where('archived',0)->get();
    return view('carewell.modal_pages.availment_approval_create',$data);
  }
  public function availment_get_member_info($member_id)
  {
    $data['member_info']  = TblMemberModel::where('tbl_member.member_id',$member_id)->Member()->first();
    $data['_member']      = TblMemberModel::get();
    foreach ($data['_member'] as $key => $member) 
    {
      $data['_member'][$key]['display_name'] =  $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
    }
    
    return view('carewell.additional_pages.availment_get_member_info',$data);
  }
  public function availment_get_member_procedure($availment_id)
  {
    $data['_procedure']   = TblAvailmentModel::where('availment_parent_id',$availment_id)->get();
    return view('carewell.additional_pages.availment_get_member_procedure',$data);
  }
  public function availment_get_provider_doctor($provider_id)
  {
    $data['_procedure_doctor']   = TblDoctorProcedureModel::get();
    $data['_doctor']      = TblDoctorModel::get();
    return view('carewell.additional_pages.availment_procedure_doctor',$data);
  }
  public function availment_create_approval_submit(Request $request)
  {
    StaticFunctionController::updateReferenceNumber('approval');
    $data['user'] = StaticFunctionController::global();

    $approvalData = new TblApprovalModel;
    $approvalData->approval_number            = StaticFunctionController::updateReferenceNumber('approval');
    $approvalData->approval_complaint         = $request->approval_complaint;
    $approvalData->approval_created           = Carbon::now();
    $approvalData->availment_id               = $request->availment_id;
    $approvalData->provider_id                = $request->provider_id;
    $approvalData->member_id                  = $request->member_id;
    $approvalData->user_id                    = $data['user']->user_id;
    $approvalData->save();
    
    foreach($request->availed_id as $key=>$datas)
    {
      $availedData = new TblApprovalAvailedModel;
      $availedData->availed_phil_charity      = $request->availed_phil_charity[$key];
      $availedData->availed_charge_patient    = $request->availed_charge_patient[$key];
      $availedData->availed_charge_carewell   = $request->availed_charge_carewell[$key];
      $availedData->availed_remarks           = $request->availed_remarks[$key];
      $availedData->availment_id              = $datas;
      $availedData->approval_id               = $approvalData->approval_id;
      $availedData->save();
    }
    
    foreach($request->doctor_id as $key=>$data)
    {
      $doctorData = new TblApprovalDoctorModel;
      $doctorData->approval_doctor_actual_pf        = $request->approval_doctor_actual_pf[$key];
      $doctorData->approval_doctor_rate_rvs         = $request->approval_doctor_rate_rvs[$key];
      $doctorData->approval_doctor_phil_charity     = $request->approval_doctor_phil_charity[$key];
      $doctorData->approval_doctor_charge_patient   = $request->approval_doctor_charge_patient[$key];
      $doctorData->approval_doctor_charge_carewell  = $request->approval_doctor_charge_carewell[$key];
      $doctorData->specialization_id                = $request->specialization_id[$key];
      $doctorData->doctor_id                        = $data;
      $doctorData->procedure_id                     = $request->procedure_id[$key];
      $doctorData->approval_id                      = $approvalData->approval_id;
      $doctorData->save();
    }
    if($approvalData->save()&&$availedData->save()&&$doctorData->save())
    {
      return StaticFunctionController::returnMessage('success','APPROVAL');
    }
    else
    {
      return StaticFunctionController::returnMessage('danger','APPROVAL');
    }
    
  }
  public function availment_view_approval_details($approval_id)
  {
    $data['_member']          = TblMemberModel::where('archived',0)->get();
    $data['_provider']        = TblProviderModel::where('archived',0)->get();
    $data['_availment']       = TblAvailmentModel::where('availment_parent_id',0)->get();
    $data['_procedure']       = TblProcedureModel::where('archived',0)->get();
    $data['_doctor']          = TblDoctorModel::where('archived',0)->get();
    $data['approval_details'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->ApprovalDetails()->first();
    $data['_availed']         = TblApprovalAvailedModel::where('tbl_approval_availed.approval_id',$approval_id)
                              ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval_availed.availment_id')
                              ->get();
    $data['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$approval_id)->ApprovalDoctor()->get();
    return view('carewell.modal_pages.availment_approval_details',$data);
  }

  /*PAYABLE*/
  public function payable()
  {
  	$data['page']       = 'Payable';
    $data['user']       = StaticFunctionController::global();
    $data['_provider']  = TblProviderModel::where('archived',0)->get();
    $data['_payable_open']   = TblPayableModel::where('tbl_payable.archived',0)->PayableInfo()->paginate(10);
    foreach ($data['_payable_open'] as $key => $payable) 
    {
      $data['_payable_open'][$key]['approval_number']    =  TblPayableApprovalModel::where('payable_id',$payable->payable_id)
                                                    ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                                                    ->get();
    }

    $data['_payable_close']   = TblPayableModel::where('tbl_payable.archived',1)->PayableInfo()->paginate(10);
    foreach ($data['_payable_close'] as $key => $payable) 
    {
      $data['_payable_close'][$key]['approval_number']    =  TblPayableApprovalModel::where('payable_id',$payable->payable_id)
                                                    ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                                                    ->get();
    }

  	return view('carewell.pages.payable_center',$data);
  }

  public function payable_create()
  {

    $data['_provider']  = TblProviderModel::where('archived',0)->get();
    $data['_approval']  = TblApprovalModel::where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
    return view('carewell.modal_pages.payable_create',$data);
  }

  public function payable_create_get_approval($provider_id)
  {
    $data['_approval']  = TblApprovalModel::where('tbl_provider.provider_id',$provider_id)->where('tbl_approval.archived',0)->ApprovalInfo()->paginate(10);
    return view('carewell.additional_pages.payable_get_approval',$data);
  }
  public function payable_create_submit(Request $request)
  {
    $user         = StaticFunctionController::global();

    // dd($request->all());
    $payableDatas = new TblPayableModel;
    $payableDatas->payable_soa_number  = $request->payable_soa_number;
    $payableDatas->payable_recieved    = $request->payable_recieved; 
    $payableDatas->payable_due         = $request->payable_due;
    $payableDatas->payable_created     = Carbon::now();
    $payableDatas->provider_id         = $request->provider_id;  
    $payableDatas->user_id             = $user->user_id;
    $payableDatas->save();
    foreach($request->approvalData as $approval_id)
    {
      $payApprovalData = new TblPayableApprovalModel;
      $payApprovalData->approval_id = $approval_id; 
      $payApprovalData->payable_id  = $payableDatas->payable_id;
      $payApprovalData->save();
    }
    if($payableDatas->save())
    {
      return StaticFunctionController::returnMessage('success','PAYABLE ');
    }

  }
  public function payable_details($payable_id)
  {
    $data['_provider']          = TblProviderModel::where('archived',0)->get();
    $data['payable_details']    = TblPayableModel::where('tbl_payable.payable_id',$payable_id)->PayableInfo()->first();
    $data['_payable_approval']  =  TblPayableApprovalModel::where('payable_id',$payable_id)->where('tbl_member_company.archived',0)->PayableApproval()->get();

    foreach ($data['_payable_approval'] as $key => $payable_approval) 
    {
      $data['_payable_approval'][$key]['availed']   =  TblApprovalAvailedModel::where('tbl_approval_availed.approval_id',$payable_approval->approval_id)
                                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval_availed.availment_id')
                                                    ->get();
      $data['_payable_approval'][$key]['doctor']    =  TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id)
                                                    ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id')
                                                    ->get();
      $data['_payable_approval'][$key]['doctor_fee']=  TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id)
                                                    ->sum('approval_doctor_charge_carewell');
                                                    
      $data['_payable_approval'][$key]['charge_carewell']= TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id)
                                                    ->sum('approval_doctor_charge_carewell');                                          
                                                          
    }
    // dd($data['_payable_approval'][$key]['doctor_fee']);
    return view('carewell.modal_pages.payable_details',$data);
  }
  /*REPORTS*/
  public function reports()
  {
  	$data['page']     = 'Reports';
    $data['_company'] = TblCompanyModel::where('archived',0)->get();
    $data['user']     = StaticFunctionController::global();

    return view('carewell.pages.reports',$data);
  }
  public function reports_availment()
  {
    $data['page']     = 'Availment Reports';
    $data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);
    $data['user']     = StaticFunctionController::global();

    foreach ($data['_company'] as $key => $company) 
    {
      $data['_company'][$key]['company_availment']  =  TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$company->company_id)
                                                    ->where('tbl_availment.availment_parent_id',0)
                                                    ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                                                    ->join('tbl_coverage_plan_tag','tbl_coverage_plan_tag.coverage_plan_id','=','tbl_coverage_plan.coverage_plan_id')
                                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_tag.availment_id')
                                                    ->get();
    }

    return view('carewell.pages.reports_availment',$data);
  }


  /*SETTINGS*/
  public function settings_coverage_plan()
  {
    $data['page'] = 'Coverage PLan';
    $data['user'] = StaticFunctionController::global();

    $data['_coverage_plan'] = TblCoveragePlanModel::paginate(10);

    return view('carewell.pages.settings_coverage_plan',$data);
  }
  public function settings_coverage_plan_create()
  {
    $data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
    foreach ($data['_availment'] as $key => $availment) 
    {
      $data['_availment'][$key]['child_availment']    =  TblAvailmentModel::where('availment_parent_id',$availment->availment_id)->get();
      $data['_availment'][$key]['availment_charges']  =  TblAvailmentChargesModel::where('archived',0)->get();
    }
    return view('carewell.modal_pages.settings_coverage_plan_create',$data);
  }
  public function settings_coverage_plan_create_submit(Request $request)
  {
    $coverageData = new TblCoveragePlanModel;
    $coverageData->coverage_plan_name                = $request->coverage_name;
    $coverageData->coverage_plan_confinement = $request->coverage_patient_confinement;
    $coverageData->coverage_plan_maximum_benefit     = $request->coverage_maximum_benefit;
    $coverageData->coverage_plan_case_handling       = $request->coverage_case_handling;
    $coverageData->coverage_plan_age_bracket         = $request->coverage_age_bracket;
    $coverageData->coverage_plan_monthly_premium     = $request->coverage_monthly_premium;
    $coverageData->coverage_plan_created             = Carbon::now();
    $coverageData->save();
   
    foreach($request->child_availment as $key=>$data)
    {
      if($data!=0)
      {
        $coverageTagData = new TblCoveragePlanTagModel;
        $coverageTagData->availment_charges_id    = $request->child_availment_charges[$key];
        $coverageTagData->availment_id            = $request->child_availment[$key];
        $coverageTagData->coverage_plan_id        = $coverageData->coverage_plan_id;
        $coverageTagData->save();
      }
      
    }
    foreach($request->parent_availment as $parent_availment)
    {
      $parentTagData = new TblCoveragePlanTagModel;
      $parentTagData->availment_charges_id    = 0;
      $parentTagData->availment_id            = $parent_availment;
      $parentTagData->coverage_plan_id        = $coverageData->coverage_plan_id;
      $parentTagData->save();
    }
    if($coverageData->save())
    {
      return StaticFunctionController::returnMessage('success','COVERAGE PLAN');
    }
  }
  public function settings_coverage_plan_details($coverage_plan_id)
  {
    $data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->first();
    $data['_coverage_plan_covered'] = TblCoveragePlanTagModel::where('coverage_plan_id',$coverage_plan_id)
                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_tag.availment_id')
                                    ->get();
    foreach($data['_coverage_plan_covered'] as $key=>$coverage_plan_covered)
    {
      $data['_coverage_plan_covered'][$key]['child_plan_item']    =  TblCoveragePlanTagModel::where('availment_parent_id',$coverage_plan_covered->availment_id)->where('coverage_plan_id',$coverage_plan_id)->CoveragePlanTag($coverage_plan_id)->get();
      $data['_coverage_plan_covered'][$key]['child_availment']    =  TblAvailmentModel::where('availment_parent_id',$coverage_plan_covered->availment_id)->get();
      $data['_coverage_plan_covered'][$key]['availment_charges']  =  TblAvailmentChargesModel::where('archived',0)->get();
    }
    return view('carewell.modal_pages.settings_coverage_plan_details',$data);

  }

  /*ARCHIVED*/
  public function archived_submit(Request $request)
  {
    
    return StaticFunctionController::archived_data($request->archived_id,$request->archived_name);
  }
  /*RESTORE*/
  public function restore_submit(Request $request)
  {
    
    return StaticFunctionController::restore_data($request->restore_id,$request->restore_name);
  }
}
