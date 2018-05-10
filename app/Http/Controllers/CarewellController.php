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
use App\Http\Model\TblCoveragePlanProcedureModel;

use App\Http\Model\TblCompanyModel;
use App\Http\Model\TblCompanyContractModel;
use App\Http\Model\TblCompanyNumberModel;
use App\Http\Model\TblCompanyContractImageModel;
use App\Http\Model\TblCompanyContractBenefitsModel;
use App\Http\Model\TblCompanyCoveragePlanModel;
use App\Http\Model\TblCompanyDeploymentModel;
use App\Http\Model\TblCompanyContactPersonModel;


use App\Http\Model\TblCalModel;
use App\Http\Model\TblCalInfoModel;
use App\Http\Model\TblCalMemberModel;
use App\Http\Model\TblCalPaymentModel;


use App\Http\Model\TblNewMemberModel;
use App\Http\Model\TblNewCalMemberModel;

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
use App\Http\Model\TblApprovalProcedureModel;
use App\Http\Model\TblApprovalDiagnosisModel;
use App\Http\Model\TblApprovalPayeeModel;
use App\Http\Model\TblApprovalTotalModel;

use App\Http\Model\TblLaboratoryModel;
use App\Http\Model\TblDiagnosisModel;
use App\Http\Model\TblProcedureModel;
use App\Http\Model\TblScheduleOfBenefitsModel;

use Excel;
use Input;
use DB;
use Carbon\Carbon;
use Paginate;
use Crypt;
use Session;

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
    $data['member_inactive']     = TblMemberModel::where('archived',1)->count();

    $data['provider_active']   = TblProviderModel::where('archived',0)->count();
    
    $data['_approval']  = TblApprovalModel::where('tbl_approval.archived',0)->ApprovalInfo()->orderBy('approval_created','DESC')->get();
    $data['total_approval'] =  count($data['_approval']);
    return view('carewell.pages.dashboard',$data);
  }
  /*COMPANY*/
  public function company()
  {
  	$data['page']               = 'Company';
    $data['user']               = StaticFunctionController::global();
    $data['_company_active']    = TblCompanyModel::where('tbl_company.archived',0)->Company()->paginate(10);
    $data['_company_inactive']  = TblCompanyModel::where('tbl_company.archived',1)->Company()->paginate(10);
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
    $data['_payment_mode']        = TblPaymentModeModel::get();
    $data['company_details']      = TblCompanyModel::where('tbl_company.company_id',$company_id)
                                  ->join('tbl_company_contact_person','tbl_company_contact_person.company_id','=','tbl_company.company_id')
                                  ->first();
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

  public function company_update_company_submit(Request $request)
  {
    $update['company_name']             = $request->company_name;
    $update['company_email_address']    = $request->company_email_address;
    $update['company_contact_number']   = $request->company_contact_number;
    $update['company_address']          = $request->company_address;
    $update['contact_person_name']      = $request->contact_person_name;
    $update['contact_person_position']  = $request->contact_person_position;
    $update['contact_person_number']    = $request->contact_person_number;
    $update['contact_person_names']     = $request->contact_person_names;
    $update['contact_person_positions'] = $request->contact_person_positions;
    $update['contact_person_numbers']   = $request->contact_person_numbers;

    $check =  TblCompanyModel::where('tbl_company.company_id',$request->company_id)
              ->join('tbl_company_contact_person','tbl_company_contact_person.company_id','=','tbl_company.company_id')
              ->update($update);

    return 'company updated successfully';
  }
  public function company_add_coverage_plan($company_id)
  {
    $data['company_id']       = $company_id;
    $company_coverage         = TblCompanyCoveragePlanModel::where('company_id',$company_id)->get();
    foreach($company_coverage as $coverage)
    {
      $data['_coverage_plan'] = TblCoveragePlanModel::where('coverage_plan_id','!=',$coverage->coverage_plan_id)->get();
    }
    return view('carewell.modal_pages.company_add_plan',$data);
  }
  public function  company_add_coverage_plan_submit(Request $request)
  {
    foreach($request->coveragePlanData as $coverage_plan_id)
    {
      $coverageData                   = new TblCompanyCoveragePlanModel;
      $coverageData->coverage_plan_id = $coverage_plan_id;
      $coverageData->company_id       = $request->company_id;
      $coverageData->save();
    }
    return StaticFunctionController::returnMessage('success','COVERAGE PLAN');
  }
  public function company_add_deployment($company_id)
  {
    $data['company_id']       = $company_id;
    return view('carewell.modal_pages.company_add_deployment',$data);
  }
  public function  company_add_deployment_submit(Request $request)
  {
    foreach($request->deploymentData as $deployment_name)
    {
      $deploymentCompanyData                  = new TblCompanyDeploymentModel;
      $deploymentCompanyData->deployment_name = $deployment_name;
      $deploymentCompanyData->company_id      = $request->company_id;
      $deploymentCompanyData->save();
    }
    return StaticFunctionController::returnMessage('success','DEPLOYMENT');
  }

  public function company_create_company_submit(Request $request)
  {
    $unique_name   = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,5);
        
    $companyData = new TblCompanyModel;
    $companyData->company_code            = StaticFunctionController::updateReferenceNumber('company');
    $companyData->company_name            = $request->company_name;
    $companyData->company_contact_number  = $request->company_contact_number;
    $companyData->company_email_address   = $request->company_email_address;
    $companyData->company_address         = $request->company_address;
    $companyData->company_status          = 'active';
    $companyData->company_created         = Carbon::now();
    $companyData->company_parent_id       = 0;
    $companyData->save();

    $contractCompanyData = new TblCompanyContractModel;
    $contractCompanyData->contract_number  = $companyData->company_code;
    $contractCompanyData->contract_created = Carbon::now();
    $contractCompanyData->company_id       = $companyData->company_id;
    $contractCompanyData->save();

    $contactPerson = new TblCompanyContactPersonModel;
    $contactPerson->contact_person_name     = StaticFunctionController::nullableToString($request->contact_person_name);
    $contactPerson->contact_person_position = StaticFunctionController::nullableToString($request->contact_person_position);
    $contactPerson->contact_person_number   = StaticFunctionController::nullableToString($request->contact_person_number);
    $contactPerson->contact_person_names    = StaticFunctionController::nullableToString($request->contact_person_names);
    $contactPerson->contact_person_positions= StaticFunctionController::nullableToString($request->contact_person_positions);
    $contactPerson->contact_person_numbers  = StaticFunctionController::nullableToString($request->contact_person_numbers);
    $contactPerson->company_id              = $companyData->company_id;
    $contactPerson->save();
        
    foreach($request->file("contractData") as $contract_image_name)
    {
      $fileContractRef = $unique_name.'-'.$contract_image_name->getClientOriginalName();
      $contract_image_name->move('contract',$fileContractRef );

      $contractImageData = new TblCompanyContractImageModel;
      $contractImageData->contract_image_name = '/contract/'.$fileContractRef.'';
      $contractImageData->contract_id = $contractCompanyData->contract_id;
      $contractImageData->save();
    }
    foreach($request->file("benefitsData") as $contract_benefits_name)
    {
      $fileContractBRef = $unique_name.'-'.$contract_benefits_name->getClientOriginalName();
      $contract_benefits_name->move('schedule_of_benefits',$fileContractBRef );

      $benefitsImageData = new TblCompanyContractBenefitsModel;
      $benefitsImageData->contract_benefits_name = '/schedule_of_benefits/'.$fileContractBRef.'';
      $benefitsImageData->contract_id = $contractCompanyData->contract_id;
      $benefitsImageData->save();
    }
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
    $data['_member_active']       = TblMemberModel::where('tbl_member.archived',0)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10, ['*'], 'active');
    $data['_member_inactive']     = TblMemberModel::where('tbl_member.archived',1)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10, ['*'], 'inactive');
  	return view('carewell.pages.member_center',$data);
  }
  public function member_create_member()
  {
    $data['_company']       = TblCompanyModel::where('archived',0)->get();
    $data['_payment_mode']  = TblPaymentModeModel::where('archived',0)->get();
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
    $companyMemberData->member_payment_mode     = 'SEMI-MONTHLY';
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

  //edrich
  public function member_update_member_submit(Request $request)
  {
    $update['member_first_name']          = $request->member_first_name;
    $update['member_middle_name']         = $request->member_middle_name;
    $update['member_last_name']           = $request->member_last_name;
    $update['member_gender']              = $request->member_gender;
    $update['member_marital_status']      = $request->member_marital_status;
    $update['member_mother_maiden_name']  = $request->member_mother_maiden_name;
    $update['member_contact_number']      = $request->member_contact_number;
    $update['member_email_address']       = $request->member_email_address;
    $update['member_permanet_address']    = $request->member_permanet_address;
    $update['member_present_address']     = $request->member_present_address;


    $check    =  TblMemberModel::where('tbl_member.member_id',$request->member_id)
              ->join('tbl_member_government_card','tbl_member_government_card.member_id','=','tbl_member.member_id')
              ->update($update);

    return 'member update successfully';
  }

  //edrich

  public function member_transaction_details($member_id)
  {

    $coverage                       = TblMemberCompanyModel::where('archived',0)->where('member_id',$member_id)->first();
    $data['_availment_history']     = TblApprovalModel::where('tbl_approval.member_id',$member_id)->AvailmentHistory()->get();
    $data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage->coverage_plan_id)->first();     
    $data['_coverage_plan_covered'] = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage->coverage_plan_id)
                                    ->where('tbl_coverage_plan_procedure.archived',0)
                                    ->select(DB::raw('count(*) as totals, tbl_coverage_plan_procedure.availment_id,tbl_availment.availment_name'))
                                    ->groupBy('availment_id')
                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_procedure.availment_id') 
                                    ->get();
    foreach($data['_coverage_plan_covered'] as $key=>$availment)
    {
      $data['_coverage_plan_covered'][$key]['procedure']   = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)
                                    ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_coverage_plan_procedure.procedure_id') 
                                    ->get();
    }
    $data['_payment_history']   = TblCalMemberModel::where('tbl_cal_member.member_id',$member_id)
                                ->where(function($query)
                                          {
                                            $query->where('tbl_cal.archived',1);
                                            $query->orWhere('tbl_cal.archived',2);
                                          }
                                        )
                                ->PaymentHistory()
                                ->get();
    foreach($data['_payment_history'] as $key=>$payment)
    {
      $data['_payment_history'][$key]['amount'] = $payment->cal_payment_amount/$payment->cal_payment_count;
    }
    return view('carewell.modal_pages.member_transaction_details',$data);
  }
  public function member_import_member(Request $request)
  {
    $data['_company']     =   TblCompanyModel::where('archived',0)->get();
    return view('carewell.modal_pages.member_import',$data);
  }
  public function member_download_template($company_id,$number)
  {
    $excels['number_of_rows'] =   $number;
    $excels['company_id']     =   $company_id;
    $company_template         =   TblCompanyModel::where('company_id',$company_id)->first();
    $excels['company_code']   =   $company_template->company_code;
    $excels['data']           =   ['COMPANY CODE','CAREWELL ID','EMPLOYEE NUMBER','MEMBER LAST NAME','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER BIRTHDATE','DEPLOYMENT','COVERAGE PLAN','MODE OF PAYMENT','STATUS'];
    Excel::create('CAREWELL '.$company_template->company_name.' TEMPLATE', function($excel) use ($excels) 
    {
      $excel->sheet('template', function($sheet) use ($excels) 
      {
        $data = $excels['data'];
        $number_of_rows = $excels['number_of_rows'];
        $sheet->fromArray($data, null, 'A1', false, false);
        $sheet->freezeFirstRow();

        for($row = 1, $rowcell = 2; $row <= $number_of_rows+5; $row++, $rowcell++)
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

            /* MODE OF PAYMENT*/
            $payment_cell = $sheet->getCell('J'.$rowcell)->getDataValidation();
            $payment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
            $payment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $payment_cell->setAllowBlank(false);
            $payment_cell->setShowInputMessage(true);
            $payment_cell->setShowErrorMessage(true);
            $payment_cell->setShowDropDown(true);
            $payment_cell->setErrorTitle('Input error');
            $payment_cell->setError('Value is not in list.');
            $payment_cell->setFormula1('payment');

            /* STATUS*/
            $status_cell = $sheet->getCell('K'.$rowcell)->getDataValidation();
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
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {
          $company_id       = $excels['company_id'];
          $_deployment      = TblCompanyDeploymentModel::where('company_id',$company_id)->get();
          $_coverage        = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                              ->get();
          $_payment_mode    = TblPaymentModeModel::where('archived',0)->get();
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

          /* PAYMENT REFERENCES */
          $sheet->SetCellValue("J1", "payment");
          $payment_mode_number = 2;
          foreach($_payment_mode as $payment_mode)
          {
              $sheet->SetCellValue("J".$payment_mode_number, $payment_mode->payment_mode_name);
              $payment_mode_number++;
          }
          $payment_mode_number--;
          /* STATUS REFERENCES */
          $sheet->SetCellValue("K1", "status");
          $sheet->SetCellValue("K2", 'ACTIVE');
          $sheet->SetCellValue("K3", 'INACTIVE');

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

          /*PAYMENT*/
          $sheet->_parent->addNamedRange(
              new \PHPExcel_NamedRange(
              'payment', $sheet, 'J2:J'.$payment_mode_number
              )
          );
          /*STATUS*/
          $sheet->_parent->addNamedRange(
              new \PHPExcel_NamedRange(
              'status', $sheet, 'K2:K3'
              )
          );
      });
    })->download('xlsx');
  }
  public function member_import_member_submit(Request $request)
  {
    $file         = $request->file('importMemberFile')->getRealPath();
    $_data        = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    $first        = $_data[0]; 
    $exportArray  = array();
      if(isset($first['company_code'])&&isset($first['carewell_id']))
      {    
        $count = 0;
        $countError = 0;
        foreach($_data as $data)
        {
          $companyID        = StaticFunctionController::getid($data['company_code'], 'company');
          $companyData      = TblCompanyModel::where('company_id',$companyID)->first();
          $count_member     = TblMemberModel::MemberExist($data['member_first_name'],$data['member_middle_name'],$data['member_last_name'])->first();
          $carewellCheck    = TblMemberCompanyModel::where('member_carewell_id',$data['carewell_id'])->first();
          if($carewellCheck!=null)
          {
            $name['first']  = $data['member_first_name'];
            $name['last']   = $data['member_middle_name'];
            $name['middle'] = $data['member_last_name'];
            $name['type']   = 'CAREWELL ID EXIST';
            array_push($exportArray,$name);
            $countError++;
          }
          else if($data['carewell_id']!=null&&$companyData!=null&&$count_member ==null && $data['member_birthdate']!=null&&StaticFunctionController::getid($data['company_code'], 'company') != null )
          {
            $member['member_first_name']        =   StaticFunctionController::transformText($data['member_first_name']);
            $member['member_middle_name']       =   StaticFunctionController::transformText($data['member_middle_name']);
            $member['member_last_name']         =   StaticFunctionController::transformText($data['member_last_name']);
            $member['member_birthdate']         =   date('d-m-Y', strtotime($data['member_birthdate'])); 
            $member['member_gender']            =   "N/A";
            $member['member_marital_status']    =   "N/A";
            $member['member_mother_maiden_name']=   "N/A";
            $member['member_contact_number']    =   "N/A";
            $member['member_email_address']     =   "N/A";
            $member['member_permanet_address']  =   "N/A";
            $member['member_present_address']   =   "N/A";
            $member['member_created']           =   Carbon::now();
            if($data['status']=="ACTIVE")
            {
              $member['archived']           =   0;
            }
            else
            {
              $member['archived']           =   1;
            }
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
            $company['member_payment_mode']       =   StaticFunctionController::nullableToString($data['mode_of_payment']);
            
            TblMemberCompanyModel::insert($company);
              
            $count++;
          }
          else
          {
            $name['first']  = $data['member_first_name'];
            $name['last']   = $data['member_middle_name'];
            $name['middle'] = $data['member_last_name'];
            $name['type']   = 'CAREWELL EXIST';
            array_push($exportArray,$name);
            $countError++;
          }
          if(count($exportArray)>0)
          {
            Session::put('exportWarning',$exportArray);
          }
        }    

        if($count == 0&&$countError==0)
        {
          $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
        }
        else
        {
          if(count($exportArray)>0)
          {
             $message = '<center><b><i style="color:#ac2925;">WARNING!</i><br>Click <a href="/get/export/warning" style="color:#3c8dbc;cursor:pointer;">EXPORT</a> to Export Warning<br><br><span class="color-green">'.$count.' Member/s  inserted with '.$countError.' member rejected</span></b></center>';
          }
          else
          {
            $message = '<center><b><span class="color-green">'.$count.' Member/s  inserted with '.$countError.' member rejected</span></b></center>';
          }
          
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
    $data['_company']   = TblCompanyModel::where('archived',0)->get();

    return view('carewell.modal_pages.member_adjustment',$data);
  }
  public function member_adjustment_submit(Request $request)
  {
    $update['archived']= 1;
    $memberCompany     = TblMemberCompanyModel::where('member_id',$request->member_id_adjustment)->update($update);
    $companyData       = TblCompanyModel::where('company_id',$request->company_id_adjustment)->first();
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
    $data['page']              = 'Network Provider';
    $data['user']              = StaticFunctionController::global();
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

  public static function chk_doctor_exist_insert_doctor_provider(Request $request,$chk_provider_name)
  {
    foreach($request->doctorProviderData as $doctor_full_name)
      {
        $chk_refProviderId  = TblProviderModel::where('provider_name',$chk_provider_name)->value('provider_id');

        $refDoctorId   = TblDoctorModel::where('doctor_full_name', $doctor_full_name)->value('doctor_id');

        if($refDoctorId == null)
        {
          $doctorData = new TblDoctorModel;
          $doctorData->doctor_full_name       = StaticFunctionController::transformText($doctor_full_name);
          $doctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
          $doctorData->doctor_gender          = "N/A";
          $doctorData->doctor_contact_number  = "N/A";
          $doctorData->doctor_email_address   = "N/A";
          $doctorData->doctor_created         = Carbon::now();
          $doctorData->save();

          $chk_refDoctorId   = TblDoctorModel::where('doctor_full_name',$doctor_full_name)->value('doctor_id');
          
         
          $providerDoctorData = new TblDoctorProviderModel;
          $providerDoctorData->doctor_id = $chk_refDoctorId;
          $providerDoctorData->provider_id =  $chk_refProviderId;
          $providerDoctorData->save();
        }
        else
        {
          $providerDoctorData = new TblDoctorProviderModel;
          $providerDoctorData->doctor_id = $refDoctorId;
          $providerDoctorData->provider_id =  $chk_refProviderId;
          $providerDoctorData->save();
        }
      }
  }

  public function provider_create_submit(Request $request)
  {
    $returnMessage_popup = 0; // use to show popup as a parameter
    
    $refProviderId   = TblProviderModel::where('provider_name', $request->provider_name)->value('provider_id');

    if($refProviderId == null) // if provider name does not exist
    {    
      $providerData = new TblProviderModel;
      $providerData->provider_name            = $request->provider_name;
      $providerData->provider_rvs             = $request->provider_rvs;
      $providerData->provider_contact_person  = $request->provider_contact_person;
      $providerData->provider_telephone_number= $request->provider_telephone_number;
      $providerData->provider_mobile_number   = $request->provider_mobile_number;
      $providerData->provider_contact_email   = $request->provider_contact_email;
      $providerData->provider_address         = $request->provider_address;
      $providerData->provider_created         = Carbon::now();
      $providerData->save();

      Self::chk_doctor_exist_insert_doctor_provider($request,$request->provider_name);

      $returnMessage_popup = 1;

    }
    else
    {
      Self::chk_doctor_exist_insert_doctor_provider($request,$request->provider_name);

      $returnMessage_popup = 1;
    }


    if($returnMessage_popup == 1)
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

    return view('carewell.modal_pages.provider_details',$data);
  }
  public function provider_import()
  {
    return view('carewell.modal_pages.provider_import');
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

  public function provider_import_submit(Request $request)
  {
    $file   = $request->file('importProviderFile')->getRealPath();
    $_data  = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    $first  = $_data[0]; 
    if(isset($first['provider_name'])&&isset($first['provider_payee']))
    {
      $count = 0;
      $countPayee = 0;
      foreach($_data as $data)
      {
        if($data['provider_name']!=null)
        {
          $refProviderId = TblProviderModel::where('provider_name', $data['provider_name'])->value('provider_id');
          $refDoctorId   = TblDoctorModel::where('doctor_full_name', $data['provider_payee'])->value('doctor_id');

          if($refProviderId==null)
          {
            $providerData = new TblProviderModel;
            $providerData->provider_name            = StaticFunctionController::transformText($data['provider_name']);
            $providerData->provider_rvs             = $data['provider_rvs'];
            $providerData->provider_contact_person  = "N/A";
            $providerData->provider_telephone_number= "N/A";
            $providerData->provider_mobile_number   = "N/A";
            $providerData->provider_contact_email   = "N/A";
            $providerData->provider_address         = "N/A";
            $providerData->provider_created         = Carbon::now();
            $providerData->save();

            $count++;

            if ($data['provider_name'] != $data['provider_payee'])
            {
              if($refDoctorId==null)
              {
                $providerDoctorData = new TblDoctorModel;
                $providerDoctorData->doctor_full_name       = StaticFunctionController::transformText($data['provider_payee']);
                $providerDoctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
                $providerDoctorData->doctor_gender          = "N/A";
                $providerDoctorData->doctor_contact_number  = "N/A";
                $providerDoctorData->doctor_email_address   = "N/A";
                $providerDoctorData->doctor_created         = Carbon::now();
                $providerDoctorData->save();


                $insert['doctor_id'] = $providerDoctorData->doctor_id;
                $insert['provider_id'] = $providerData->provider_id;
                TblDoctorProviderModel::insert($insert);

                 $countPayee++;
              }
              else
              {
                $insert['doctor_id'] = $refDoctorId;
                $insert['provider_id'] = $providerData->provider_id;
                TblDoctorProviderModel::insert($insert);
              }
            }

            // $count++;
          }
          else
          {
            if ($data['provider_name'] != $data['provider_payee'])
            {
              if($refDoctorId==null)
              {
                $providerDoctorData = new TblDoctorModel;
                $providerDoctorData->doctor_full_name       = StaticFunctionController::transformText($data['provider_payee']);
                $providerDoctorData->doctor_number          = '1233';
                $providerDoctorData->doctor_gender          = "N/A";
                $providerDoctorData->doctor_contact_number  = "N/A";
                $providerDoctorData->doctor_email_address   = "N/A";
                $providerDoctorData->doctor_created         = Carbon::now();
                $providerDoctorData->save();

                $insert['doctor_id']   = $providerDoctorData->doctor_id;
                $insert['provider_id'] = $refProviderId;
                TblDoctorProviderModel::insert($insert);
                 $countPayee++;
              }
              else
              {
                if(TblDoctorProviderModel::where('doctor_id',$refDoctorId)->where('provider_id',$refProviderId)->count()>=1)
                {
                  //row in tbl_doctor_provider that have $refDoctorId and $repProviderId exist
                }
                else
                {
                  $insert['doctor_id']   = $refDoctorId;
                  $insert['provider_id'] = $refProviderId;
                  TblDoctorProviderModel::insert($insert);
                }
              }
            }
          }
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
  }
  public function provider_export_template(Request $request)
  {
    $excels['data']  =   ['PROVIDER NAME','PROVIDER PAYEE','PROVIDER RVS'];
    Excel::create('CAREWELL PROVIDER TEMPLATE', function($excel) use ($excels) 
    {
      $excel->sheet('template', function($sheet) use ($excels) 
      {
        $data = $excels['data'];
        $sheet->fromArray($data, null, 'A1', false, false);
        $sheet->freezeFirstRow();
      });
    })->download('xlsx');
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

    public function doctor_update_submit(Request $request)
  {
    $update['doctor_full_name'] = $request->doctor_full_name;
    $update['doctor_gender'] = $request->doctor_gender;
    $update['doctor_contact_number'] = $request->doctor_contact_number;
    $update['doctor_contact_number'] = $request->doctor_contact_number;
    $check =  TblDoctorModel::where('doctor_id',$request->doctor_id)->update($update);

    return 'doctor update successfully';
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
    $doctorData->doctor_full_name       = $request->doctor_full_name;
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
    $provider_template        =   TblProviderModel::where('provider_id',$provider_id)->first();
    $excels['provider_name']  =   $provider_template->provider_name;
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
            $doctor['doctor_first_name']        =   StaticFunctionController::nullableToString(ucwords($data['doctor_first_name']));
            $doctor['doctor_middle_name']       =   StaticFunctionController::nullableToString(ucwords($data['doctor_middle_name']));
            $doctor['doctor_last_name']         =   StaticFunctionController::nullableToString(ucwords($data['doctor_last_name']));
            $doctor['doctor_gender']            =   StaticFunctionController::nullableToString(ucwords($data['doctor_gender']));
            $doctor['doctor_contact_number']    =   StaticFunctionController::nullableToString(ucwords($data['doctor_contact_number']));
            $doctor['doctor_email_address']     =   StaticFunctionController::nullableToString(ucwords($data['doctor_email_address']));
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
  	$data['page']             = 'Billing';
    $data['user']             = StaticFunctionController::global();
    $data['_cal_open']        = TblCalModel::where('tbl_cal.archived',0)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
    $data['_cal_close']       = TblCalModel::where('tbl_cal.archived',1)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
    $data['_cal_pending']     = TblCalModel::where('tbl_cal.archived',2)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
    $data['_company']         = TblCompanyModel::where('archived',0)->get();


    foreach ($data['_cal_open'] as $key => $cal_open) 
    {
      $data['_cal_open'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_open->cal_id)->count();
      $data['_cal_open'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_open->cal_id)->count();
    }
    foreach ($data['_cal_close'] as $key => $cal_close) 
    {
      $data['_cal_close'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_close->cal_id)->count();
      $data['_cal_close'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_close->cal_id)->count();
    }
    foreach ($data['_cal_pending'] as $key => $cal_pending) 
    {
      $data['_cal_pending'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_pending->cal_id)->count();
      $data['_cal_pending'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_pending->cal_id)->count();
    }

  	return view('carewell.pages.billing_center',$data);
  }
  public function billing_create_cal()
  {
    $data['_company']         = TblCompanyModel::get();
    $data['_cal_company']     = TblCalModel::get();
    $data['_period']          = TblPaymentModeModel::get();
    return view('carewell.modal_pages.billing_create_cal',$data);
  }
  public function billing_create_cal_submit(Request $request)
  {
    $companyCalData                             =   new TblCalModel;
    $companyCalData->cal_number                 =   StaticFunctionController::updateReferenceNumber('billing_cal');;
    $companyCalData->cal_reveneu_period_year    =   $request->cal_reveneu_period_year;
    $companyCalData->cal_payment_mode           =   $request->cal_payment_mode;
    $companyCalData->cal_start                  =   $request->cal_start;
    $companyCalData->cal_end                    =   $request->cal_end;
    $companyCalData->cal_created                =   Carbon::now();
    $companyCalData->company_id                 =   $request->company_id;
    $companyCalData->save();

    return StaticFunctionController::returnMessage('success','COMPANY CAL');     
  }
  public function billing_cal_details($cal_id)
  {
    $data['cal_check']        = TblCalModel::where('cal_id',$cal_id)->value('archived');
    $data['_cal_member']      = TblCalMemberModel::where('tbl_cal_member.cal_id',$cal_id)->where('tbl_cal_member.archived',0)->CalMember()->get();
    $data['_cal_member_remove']=TblCalMemberModel::where('tbl_cal_member.cal_id',$cal_id)->where('tbl_cal_member.archived',1)->CalMember()->get();
    $data['_cal_new_member']  = TblNewMemberModel::where('cal_id',$cal_id)->get();
    if($data['cal_check']==0||$data['cal_check']==2)
    {
      $data['cal_details']    = TblCalModel::where('cal_id',$cal_id)
                              ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                              ->first();
    }
    else
    {
      $data['cal_details']    = TblCalModel::where('tbl_cal.cal_id',$cal_id)
                              ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                              ->join('tbl_cal_info','tbl_cal_info.cal_id','=','tbl_cal.cal_id')
                              ->first();
    }
    $sum      = 0;
    $sums     = 0;
    foreach($data['_cal_member'] as $amount)
    {
      $sum = $sum + $amount->cal_payment_amount;
    }
    foreach($data['_cal_new_member'] as $amounts)
    {
      $sums = $sums + $amounts->cal_payment_amount;
    }
    $data['total_amount']     = $sum + $sums;
    $data['total_member']     = count($data['_cal_member'])+count($data['_cal_new_member']);
    return view('carewell.modal_pages.billing_cal_details',$data);
  }
  public function billing_payment_breakdown($cal_member_id,$str_ref)
  {
    if($str_ref=='old')
    {
      $TblCalMember               = TblCalMemberModel::where('cal_member_id',$cal_member_id);
      $data['_payment_breakdown'] = TblCalPaymentModel::where('cal_member_id',$cal_member_id)->get();
      $data['member_id']          = $TblCalMember->value('member_id');
      $data['ref']                = 'old';
      $cal_id                     = $TblCalMember->value('cal_id');
      $data['archived']           = TblCalModel::where('cal_id',$cal_id)->value('archived');                   
    }
    else
    {
      $data['_payment_breakdown'] = TblNewCalMemberModel::where('new_member_id',$cal_member_id)->get();
      $data['member_id']          = $cal_member_id;
      $data['ref']                = 'new';
      $cal_id                     = TblNewMemberModel::where('new_member_id',$cal_member_id)->value('cal_id');
      $data['archived']           = TblCalModel::where('cal_id',$cal_id)->value('archived');  
    }
    
    return view('carewell.modal_pages.billing_payment_breakdown',$data);
  }
  public function billing_last_ten_payments($member_id)
  {
    $data['_payment_breakdown'] = TblCalPaymentModel::where('member_id',$member_id)
                                ->where('archived',1)
                                ->orderBy('cal_payment_end','DESC')
                                ->limit(10)
                                ->get();
    $data['member_id']          = 'disabled';
    $data['ref']                = 'old';
    $data['archived']           = 1;  
    return view('carewell.modal_pages.billing_payment_breakdown',$data);
  }
  public function billing_update_payment_date(Request $request)
  {
    
    $update['cal_payment_start'] = date('Y-m-d', strtotime($request->cal_payment_start));
    $update['cal_payment_end']   = date('Y-m-d', strtotime($request->cal_payment_end));
    
    if($request->ref=='old')
    {
      $updateCheck = TblCalPaymentModel::where('cal_payment_id',$request->cal_payment_id)->update($update);
    }
    else
    {
      $updateCheck = TblNewCalMemberModel::where('cal_new_member_id',$request->cal_new_member_id)->update($update);
    }
    if($updateCheck)
    {
      return "check";
    }
    else
    {
      return "times";
    }
    
  }
  public function billing_import_cal_members($cal_id,$company_id)
  {
    $data['cal_id']           = $cal_id;
    $data['company_id']       = $company_id;
    return view('carewell.modal_pages.billing_import',$data);
  }
  public function billing_cal_download_template($cal_id,$company_id)
  {
    $excels['number_of_rows'] = 10;
    $excels['company_id']     = $company_id;
    $cal_template             = TblCalModel::where('cal_id',$cal_id)
                              ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                              ->first();
    $excels['company_name']   = $cal_template->company_name;
    $excels['company_id']     = $cal_template->company_id;
    $excels['cal_number']     = $cal_template->cal_number;

    $excels['_payment']       = TblPaymentModeModel::where('archived',0)->get();
    $excels['_deployment']    = TblCompanyDeploymentModel::where('tbl_company_deployment.company_id',$company_id)->get();
    $excels['_coverage']      = TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$company_id)
                              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
                              ->get();
    $excels['_member']        = TblMemberCompanyModel::where('tbl_member_company.archived',0)
                              ->where('tbl_member_company.company_id',$company_id)
                              ->where('tbl_member_company.member_payment_mode',$cal_template->cal_payment_mode)
                              ->MemberCompany()
                              ->get();
    $excels['count_member']   =   count($excels['_member'])+10;
    $excels['data'] = ['LAST NAME','FIRST NAME','MIDDLE NAME','BIRTHDATE','COVERAGE PLAN','DEPLOYMENT','MODE OF PAYMENT','PAYMENT AMOUNT'];
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

          $coverage_cell = $sheet->getCell('E'.$rowcell)->getDataValidation();
          $coverage_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $coverage_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $coverage_cell->setAllowBlank(false);
          $coverage_cell->setShowInputMessage(true);
          $coverage_cell->setShowErrorMessage(true);
          $coverage_cell->setShowDropDown(true);
          $coverage_cell->setErrorTitle('Input error');
          $coverage_cell->setError('Value is not in list.');
          $coverage_cell->setFormula1('coverage');

          $deployment_cell = $sheet->getCell('F'.$rowcell)->getDataValidation();
          $deployment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $deployment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $deployment_cell->setAllowBlank(false);
          $deployment_cell->setShowDropDown(true);
          $deployment_cell->setFormula1('deployment');

          $payment_cell = $sheet->getCell('G'.$rowcell)->getDataValidation();
          $payment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
          $payment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
          $payment_cell->setAllowBlank(false);
          $payment_cell->setShowDropDown(true);
          $payment_cell->setFormula1('payment');
        }
        foreach($_member as  $key => $member)
        {
          $key = $key+=2;

          $sheet->setCellValue('A'.$key, $member->member_last_name);
          $sheet->setCellValue('B'.$key, $member->member_first_name);
          $sheet->setCellValue('C'.$key, $member->member_middle_name);
          $sheet->setCellValue('D'.$key, date('m/d/Y', strtotime($member->member_birthdate)));
          $sheet->setCellValue('E'.$key, $member->coverage_plan_name);
          $sheet->setCellValue('F'.$key, $member->deployment_name);
          $sheet->setCellValue('G'.$key, $member->member_payment_mode);
          $sheet->setCellValue('H'.$key, $member->coverage_plan_premium);
          
        }
      });
      /* DATA VALIDATION (REFERENCE FOR DROPDOWN LIST) */
      $excel->sheet('reference', function($sheet) use($excels) 
      {

        $_coverage    = $excels['_coverage'];
        $_deployment  = $excels['_deployment'];
        $_payment     = $excels['_payment'];
        /* COVERAGE REFERENCES */
        $sheet->SetCellValue("E1", "coverage");
        $coverage_number = 2;
        foreach($_coverage as $coverage)
        {
            $sheet->SetCellValue("E".$coverage_number, $coverage->coverage_plan_name);
            $coverage_number++;
        }
        $coverage_number--;
        /* DEPLOYMENT REFERENCES */
        $sheet->SetCellValue("F1", "deployment");
        $deployment_number = 2;
        foreach($_deployment as $deployment)
        {
            $sheet->SetCellValue("F".$deployment_number, $deployment->deployment_name);
            $deployment_number++;
        }
        $deployment_number--;

        /* PAYMENT REFERENCES */
        $sheet->SetCellValue("G1", "payment");
        $payment_number = 2;
        foreach($_payment as $payment)
        {
            $sheet->SetCellValue("G".$payment_number, $payment->payment_mode_name);
            $payment_number++;
        }
        $payment_number--;
        
        

        /*COVERAGE*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'coverage', $sheet, 'E2:E'.$coverage_number
            )
        );
        /*DEPLOYMENT*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'deployment', $sheet, 'F2:F'.$deployment_number
            )
        );
        /*PAYMENT*/
        $sheet->_parent->addNamedRange(
            new \PHPExcel_NamedRange(
            'payment', $sheet, 'G2:G'.$payment_number
            )
        );
        
      });
      
    })->download('xlsx');
  }
  
  public function billing_cal_import_template(Request $request)
  {
    Session::forget('exportWarning');
    
    $file               = $request->file('importCalMemberFile')->getRealPath();
    $_data              = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
    $companyData        = TblCompanyModel::join('tbl_cal','tbl_cal.company_id','=','tbl_company.company_id')
                        ->where('tbl_company.company_id',$request->company_id)
                        ->where('tbl_cal.cal_id',$request->cal_id)
                        ->first();

    $first              = $_data[0]; 
    
    if(isset($first['last_name'])&&isset($first['first_name'])&&isset($first['middle_name'])&&isset($first['birthdate']))
    {    
      $count            = 0;
      $countBdate       = 0;
      $countExist       = 0;
      $countNew         = 0;
      $exportArray        = array();
      foreach($_data as $data)
      {
        if($data['first_name']!=""&&$data['last_name']!=""&&$data['middle_name']!=""&&$data['birthdate']!="")
        {
          $checkingMember     = TblMemberModel::MemberExist($data['first_name'],$data['middle_name'],$data['last_name'],$data['birthdate'])->first();
          $checkingNewMember  = TblNewMemberModel::MemberExist($data['first_name'],$data['middle_name'],$data['last_name'],$data['birthdate'])->first();
          if($checkingMember!=null)
          {
            $checkCal       = TblCalMemberModel::CalMemberExist($checkingMember->member_id,$companyData->cal_id)->first();
            $member_data    = TblMemberCompanyModel::where('member_id',$checkingMember->member_id)->where('archived',0)->first();
            if($checkCal!=null)
            {
              $name['first']  = $data['first_name'];
              $name['last']   = $data['middle_name'];
              $name['middle'] = $data['last_name'];
              $name['type']   = 'EXISTING IN CAL';
              array_push($exportArray,$name);
              $countExist++;
            }
            else
            {
              $coverage_plan_id = StaticFunctionController::getid($data['coverage_plan'], 'coverage');
              $payment_amount   = $data['payment_amount'];
              $cal_id           = $companyData->cal_id;
              $member_id        = $checkingMember->member_id;
              $premium          = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->value('coverage_plan_premium');
              $payment_count    = number_format($payment_amount / number_format($premium));
              if($payment_count > 1)
              {
                $name['first']  = $data['first_name'];
                $name['last']   = $data['middle_name'];
                $name['middle'] = $data['last_name'];
                $name['type']   = 'NEED ADJUSTMENT';
                array_push($exportArray,$name);
              }
              $cal_member['cal_payment_amount']   =   $payment_amount;
              $cal_member['cal_payment_date']     =   Carbon::now();
              $cal_member['cal_payment_count']    =   $payment_count;
              $cal_member['member_id']            =   $checkingMember->member_id;
              $cal_member['cal_id']               =   $companyData->cal_id;
              $cal_member_id                      =   TblCalMemberModel::insertGetId($cal_member);
              $payment_ref                        =   StaticFunctionController::getModeOfPayment($member_id,$cal_member_id,$premium,$payment_count,$cal_id);
              $count++; 
            }
          }
          elseif($checkingNewMember==null)
          {
            $coverage_plan_id                     =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
            $payment_amount                       =   $data['payment_amount'];
            $cal_id                               =   $companyData->cal_id;
            $premium                              =   TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->value('coverage_plan_premium');
            $payment_count                        =   number_format($payment_amount / number_format($premium));

            $new_member['member_first_name']      =   StaticFunctionController::nullableToString(ucwords($data['first_name']));
            $new_member['member_middle_name']     =   StaticFunctionController::nullableToString(ucwords($data['middle_name']));
            $new_member['member_last_name']       =   StaticFunctionController::nullableToString(ucwords($data['last_name']));
            $new_member['member_birthdate']       =   StaticFunctionController::nullableToString(ucwords($data['birthdate']));
            $new_member['member_payment_mode']    =   StaticFunctionController::nullableToString(ucwords($data['mode_of_payment']));
            $new_member['company_id']             =   $companyData->company_id;
            $new_member['deployment_id']          =   StaticFunctionController::getid($data['deployment'], 'deployment');
            $new_member['coverage_plan_id']       =   StaticFunctionController::getid($data['coverage_plan'], 'coverage');
            $new_member['cal_id']                 =   $companyData->cal_id;
            $new_member['cal_payment_amount']     =   $payment_amount;
            $new_member['cal_payment_date']       =   Carbon::now();
            $new_member['cal_payment_count']      =   $payment_count;
            $new_member['cal_payment_start']      =   'start';
            $new_member['cal_payment_end']        =   'end';
            $new_member_id  = TblNewMemberModel::insertGetId($new_member);
            
            $payment_ref   = StaticFunctionController::newMemberModeOfPayment($new_member_id,$payment_count,$cal_id);
            
            $countNew++;
          }
        }
      }
      if(count($exportArray)>0)
      {
        Session::put('exportWarning',$exportArray);

      }
      if($count == 0&&$countExist==0&&$countNew==0)
      {
        $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
      }
      else
      {
        if(count($exportArray)>0)
        {
           $message = '<center><b><i style="color:#ac2925;">WARNING!</i><br>Click <a href="/get/export/warning" style="color:#3c8dbc;cursor:pointer;">EXPORT</a> to Export Warning<br><br><span class="color-green">'.$count.' Member/s has been added to cal.<br>'.$countNew.' new member <br>'.$countExist.' already exist.</span></b></center>';
        }
        else
        {
          $message = '<center><b><span class="color-green">'.$count.' Member/s has been added to cal.<br>'.$countNew.' new member <br>'.$countExist.' already exist.</span></b></center>';
        }
      }
      return $message;
    }
    else
    {
         return '<center><b><span class="color-red">Wrong file Format</span></b></center>';
    }
  }

  public function billing_cal_member_remove(Request $request)
  {
    if($request->ref=="old")
    {
      $archived['archived'] = 1;
      $remove = TblCalMemberModel::where('cal_member_id',$request->cal_member_id)->update($archived);
    }
    else
    {
      $remove = TblNewMemberModel::where('new_member_id',$request->cal_member_id)->delete();
                TblNewCalMemberModel::where('new_member_id',$request->cal_member_id)->delete();
    }
    if($remove)
    {
      return '<center><b><span class="color-red">Member Successfully Removed!</span></b></center>';
    }
    else
    {
      return "james";
    }

  }
  public function billing_cal_member_restore(Request $request)
  {
    $archived['archived'] = 0;
    $remove               = TblCalMemberModel::where('cal_member_id',$request->cal_member_id)->update($archived);
    return '<center><b><span class="color-red">Member Successfully Restored!</span></b></center>';
  }
  public function billing_cal_pending_submit(Request $request)
  {
    StaticFunctionController::getNewMember($request->cal_id,2);
    $update['archived']   = 2;//for pending cal
    $pending              = TblCalModel::where('cal_id',$request->cal_id)->update($update);
    $data['_cal_member']  = TblCalMemberModel::where('cal_id',$request->cal_id)->get();
    foreach($data['_cal_member'] as $key=>$cal_member)
    {
      TblCalPaymentModel::where('cal_member_id',$cal_member->cal_member_id)->update($update);
    }
    if($pending)
    {
      return '<center><b><span class="color-red">CAL successfully mark as Pending!</span></b></center>';
    }
    else
    {
      return "error";
    }
  }
  public function billing_cal_close($cal_id)
  {
    $data['cal_info'] = TblCalModel::where('cal_id',$cal_id)->first();
    $data['_cal_member']  = TblCalMemberModel::where('cal_id',$cal_id)->get();
    $sum = 0;
    foreach($data['_cal_member'] as $amount)
    {
      $sum = $sum + $amount->cal_payment_amount;
    }
    $data['total_amount']     = $sum;
    $data['total_member']     = count($data['_cal_member']);
    return view('carewell.modal_pages.billing_cal_close',$data);
  }
  public function billing_cal_close_submit(Request $request)
  {
    $unique_name            = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,5);
    $cal_info_attached_file = $request->file('cal_file');
    $fileCalRef             = $unique_name.'-'.$cal_info_attached_file->getClientOriginalName();
    $cal_info_attached_file->move('cal_file',$fileCalRef );

    $calCloseData                           =   new TblCalInfoModel;
    $calCloseData->cal_info_attached_file   =   '/cal_file/'.$fileCalRef.'';
    $calCloseData->cal_info_check_number    =   $request->cal_info_check_number;
    $calCloseData->cal_info_collection_date =   $request->cal_info_collection_date;
    $calCloseData->cal_info_check_date      =   $request->cal_info_check_date;
    $calCloseData->cal_info_or_number       =   $request->cal_info_or_number;
    $calCloseData->cal_info_amount          =   $request->cal_info_amount;
    $calCloseData->cal_info_created         =   Carbon::now();
    $calCloseData->cal_id                   =   $request->cal_id;
    $calCloseData->save();
  
    StaticFunctionController::getNewMember($request->cal_id,1);

    $update['archived']   = '1';
    $tblCal               = TblCalModel::where('cal_id',$request->cal_id)->update($update);
    $data['_cal_member']  = TblCalMemberModel::where('cal_id',$request->cal_id)->get();
    foreach($data['_cal_member'] as $key=>$cal_member)
    {
      TblCalPaymentModel::where('cal_member_id',$cal_member->cal_member_id)->update($update);
    }

    return StaticFunctionController::returnMessage('success','CAL CLOSED');    

  }

  /*MEDICAL*/
  public function availment()
  {

  	$data['page']       = 'Availment';
    $data['_company']   = TblCompanyModel::where('archived',0)->get();
    $data['_provider']  = TblProviderModel::where('archived',0)->get();
    $data['user']       = StaticFunctionController::global();
    $data['_approval']  = TblApprovalModel::where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
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
    $data['_specialization']  = TblSpecializationModel::get();
    return view('carewell.modal_pages.availment_approval_create',$data);
  }
  public function  availment_get_member_info(Request $request)
  {

    if($request->ajax())
    {
      $today                = date('Y-m-d');
      $mem_cal              = TblCalPaymentModel::where('member_id',$request->member_id)
                              ->where(function($query)
                              {
                                $query->where('archived',1);
                                $query->orWhere('archived',2);
                                
                              })
                              ->orderBy('cal_payment_end','DESC')
                              ->first();
      $data['member_info']  = TblMemberModel::where('tbl_member.member_id',$request->member_id)->where('tbl_member_company.archived',0)->Member()->first();
      $data['_member']      = TblMemberModel::where('tbl_member.archived',0)->where('tbl_member_company.archived',0)->Member()->get();
      $data['_availment']   = TblCoveragePlanProcedureModel::where('coverage_plan_id',$data['member_info']->coverage_plan_id)
                            ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_procedure.availment_id')
                            ->select([DB::RAW('DISTINCT(tbl_coverage_plan_procedure.availment_id)'),'tbl_availment.availment_name','tbl_availment.availment_id'])
                            ->get();
                            $data['_availment_list']  = '<option value="0">-SELECT AVAILMENT-';
                                                        foreach($data['_availment'] as $availment)
                                                        {
                                                            $data['_availment_list'].= '<option value='.$availment->availment_id.'>'.$availment->availment_name;
                                                        }

                            $data['_member_list']     = '<option value="0">-SELECT AVAILMENT-';
                                                        foreach($data['_member'] as $member)
                                                        {
                                                            $data['_member_list']    .= "<option value=".$member->member_id.">".$member->member_carewell_id."-".$member->member_first_name." ".$member->member_last_name;
                                                        }
      if($mem_cal==null)
      {
        return  response()->json(array('ref' => 'not_yet_paid','member_list' => $data['_member_list']));
      }
      else
      {
        print_r($data['member_info']->member_payment_mode,$mem_cal->cal_payment_end);
        $checkPayment = StaticFunctionController::checkIfMemberCanAvailed($data['member_info']->member_payment_mode,$mem_cal->cal_payment_end);
        if($checkPayment=="not_updated")
        {
          return  response()->json(array('ref' => 'not_updated','member_list' => $data['_member_list']));
        }
        else if(strtotime($checkPayment)  < strtotime($today))
        {
          return  response()->json(array('ref' => 'not_yet_paid','member_list' => $data['_member_list']));
        }
        else 
        {
          return  response()->json(array(
            'member_name'         => $data['member_info']->member_first_name." ".$data['member_info']->member_middle_name." ".$data['member_info']->member_last_name,
            'company_name'        => $data['member_info']->company_name,
            'member_universal_id' => $data['member_info']->member_universal_id,
            'member_carewell_id'  => $data['member_info']->member_carewell_id,
            'member_birthdate'    => $data['member_info']->member_birthdate,
            'member_age'          => date_create($data['member_info']->member_birthdate)->diff(date_create('today'))->y,
            'member_id'           => $data['member_info']->member_id,
            'availment_list'      => $data['_availment_list'],
            'member_list'         => $data['_member_list'],
            'ref'                 => 'already_paid',
          ));
        }
      }
    }
  }
  
  public function availment_create_approval_submit(Request $request)
  {
    StaticFunctionController::updateReferenceNumber('approval');
    $data['user'] = StaticFunctionController::global();
   
    $approvalData = new TblApprovalModel;
    $approvalData->approval_number            = StaticFunctionController::updateReferenceNumber('approval');
    $approvalData->approval_complaint         = $request->approval_complaint;
    $approvalData->approval_created           = Carbon::now();
    $approvalData->charge_diagnosis_id        = $request->charge_diagnosis_id;
    $approvalData->diagnosis_id               = $request->diagnosis_id;
    $approvalData->availment_id               = $request->availment_id;
    $approvalData->provider_id                = $request->provider_id;
    $approvalData->member_id                  = $request->member_id;
    $approvalData->user_id                    = $data['user']->user_id;
    $approvalData->save();
    
    foreach($request->final_diagnosis_id as $final_diagnosis_id)
    {
      $diagnosisData = new TblApprovalDiagnosisModel;
      $diagnosisData->approval_diagnosis_type = '0';
      $diagnosisData->diagnosis_id = $final_diagnosis_id;
      $diagnosisData->approval_id = $approvalData->approval_id;
      $diagnosisData->save();
    }
    foreach($request->procedure_id as $key=>$datas)
    {
      $procedureData = new TblApprovalProcedureModel;
      $procedureData->procedure_id              = $request->procedure_id[$key];
      $procedureData->procedure_gross_amount    = $request->procedure_gross_amount[$key];
      $procedureData->procedure_philhealth      = $request->procedure_philhealth[$key];
      $procedureData->procedure_charge_patient  = $request->procedure_charge_patient[$key];
      $procedureData->procedure_charge_carewell = $request->procedure_charge_carewell[$key];
      $procedureData->diagnosis_id              = 1;
      $procedureData->approval_id               = $approvalData->approval_id;
      $procedureData->save();
    }
    foreach($request->doctor_id as $key=>$data)
    {
      $doctorData = new TblApprovalDoctorModel;
      $doctorData->approval_doctor_actual_pf        = $request->approval_doctor_actual_pf[$key];
      $doctorData->approval_doctor_phil_charity     = $request->approval_doctor_phil_charity[$key];
      $doctorData->approval_doctor_charge_patient   = $request->approval_doctor_charge_patient[$key];
      $doctorData->approval_doctor_charge_carewell  = $request->approval_doctor_charge_carewell[$key];
      $doctorData->specialization_name              = $request->specialization_name[$key];
      $doctorData->doctor_id                        = $data;
      $doctorData->doctor_procedure_id              = $request->doctor_procedure_id[$key];
      $doctorData->approval_id                      = $approvalData->approval_id;
      $doctorData->save();
    }
    foreach($request->doctor_payee_id as $key=>$payee_id)
    {
      $payeeDocData = new TblApprovalPayeeModel;
      $payeeDocData->payee_id     = $payee_id;
      $payeeDocData->approval_id  = $approvalData->approval_id;
      $payeeDocData->payee_name   = 'doctor';
      $payeeDocData->type         = 'doctor';
      $payeeDocData->save();
    }
    foreach($request->payee_name as $key=>$payee_name)
    {
      $payeeData = new TblApprovalPayeeModel;
      $payeeData->payee_id     = '0';
      $payeeData->approval_id  = $approvalData->approval_id;
      $payeeData->payee_name   = $payee_name;
      $payeeData->type         = 'payee';
      $payeeData->save();
    }

    
      $totalData = new TblApprovalTotalModel;
      $totalData->total_gross_amount    = StaticFunctionController::nullableToString($request->procedure_total_gross_amount,'int');
      $totalData->total_philhealth      = StaticFunctionController::nullableToString($request->procedure_total_philhealth,'int');
      $totalData->total_charge_patient  = StaticFunctionController::nullableToString($request->procedure_total_charge_patient,'int');
      $totalData->total_charge_carewell = StaticFunctionController::nullableToString($request->procedure_total_charge_carewell,'int');
      $totalData->total_type            = 'procedure';
      $totalData->approval_id           = $approvalData->approval_id;
      $totalData->save();

      $totalDoctorData = new TblApprovalTotalModel;
      $totalDoctorData->total_gross_amount    = StaticFunctionController::nullableToString($request->doctor_total_gross_amount,'int');
      $totalDoctorData->total_philhealth      = StaticFunctionController::nullableToString($request->doctor_total_philhealth,'int');
      $totalDoctorData->total_charge_patient  = StaticFunctionController::nullableToString($request->doctor_total_charge_patient,'int');
      $totalDoctorData->total_charge_carewell = StaticFunctionController::nullableToString($request->doctor_total_charge_carewell,'int');
      $totalDoctorData->total_type            = 'doctor';
      $totalDoctorData->approval_id           = $approvalData->approval_id;
      $totalDoctorData->save();

    if($approvalData->save()&&$procedureData->save()&&$doctorData->save())
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
    $data['_provider']        = TblProviderModel::where('archived',0)->get();
    
    $data['approval_details'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->ApprovalDetails()->first();
    $data['charge_diagnosis'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)
                              ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval.charge_diagnosis_id')
                              ->first();
    $data['_final_diagnosis'] = TblApprovalDiagnosisModel::where('approval_id',$approval_id)
                              ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval_diagnosis.diagnosis_id')
                              ->get();
    $data['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$approval_id)
                              ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_approval_procedure.procedure_id')
                              ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval_procedure.diagnosis_id')
                              ->get();
    $data['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$approval_id)->ApprovalDoctor()->get();
    $data['_payee_doctor']           = TblApprovalPayeeModel::where('approval_id',$approval_id)
                              ->where('type','doctor')
                              ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_payee.payee_id')
                              ->get();
    $data['_payee_other']           = TblApprovalPayeeModel::where('approval_id',$approval_id)
                              ->where('type','payee')
                              ->get();
    $data['total_procedure']  = TblApprovalTotalModel::where('approval_id',$approval_id)->where('total_type','procedure')->first();
    $data['total_doctor']     = TblApprovalTotalModel::where('approval_id',$approval_id)->where('total_type','doctor')->first();
    return view('carewell.modal_pages.availment_approval_details',$data);
  }

  /*PAYABLE*/
  public function payable()
  {
  	$data['page']            = 'Payable';
    $data['user']            = StaticFunctionController::global();
    $data['_provider']       = TblProviderModel::where('archived',0)->get();
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
      $data['_payable_approval'][$key]['availed']   =  TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)
                                                    ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_approval_procedure.procedure_id')
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
      $data['_company'][$key]['company_availment']  =  TblAvailmentModel::get();
    }

    return view('carewell.pages.reports_availment',$data);
  }

   public function reports_monitoring_end_per_month()
  {
    $data['page']     = 'Ending Number Per Month Reports';
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


    return view('carewell.pages.reports_end_per_month',$data);
  }
  
  public function reports_breakdown()
  {
    $data['page']     = 'Breakdown Reports';
    $data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);
    $data['user']     = StaticFunctionController::global();

    return view('carewell.pages.reports_breakdown',$data);
  }
  public function reports_consolidation()
  {
    $data['page']     = 'Consolidation Reports';
    $data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
    $data['user']     = StaticFunctionController::global();

    return view('carewell.pages.reports_consolidation',$data);
  }


  /*SETTINGS*/
  public function settings_coverage_plan()
  {
    $data['page'] = 'Coverage PLan';
    $data['user'] = StaticFunctionController::global();

    $data['_active_coverage_plan'] = TblCoveragePlanModel::where('archived',0)->paginate(10);
    $data['_inactive_coverage_plan'] = TblCoveragePlanModel::where('archived',1)->paginate(10);

    return view('carewell.pages.settings_coverage_plan',$data);
  }

  public function settings_coverage_plan_create()
  {
    Session::forget('annual');
    Session::forget('os_consultation');
    Session::forget('os_laboratory');
    Session::forget('emergency');
    Session::forget('confinement');
    Session::forget('dental');
    Session::forget('assistance');
    Session::forget('minor_ops');
    
    
    $data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
    foreach ($data['_availment'] as $key => $availment) 
    {
      if($availment->availment_name=='Annual Physical Examination')
      {
        $data['_availment'][$key]['name']    =  'annual';
      }
      else if($availment->availment_name=='Outpatient Services(Consultation)')
      {
        $data['_availment'][$key]['name']    =  'os_consultation';
      }
      else if($availment->availment_name=='Outpatient Services(Laboratory)')
      {
        $data['_availment'][$key]['name']    =  'os_laboratory';
      }
      else if($availment->availment_name=='Minor Operation')
      {
        $data['_availment'][$key]['name']    =  'minor_ops';
      }
      else if($availment->availment_name=='Emergency Cases')
      {
        $data['_availment'][$key]['name']    =  'emergency';
      }
      else if($availment->availment_name=='Confinement')
      {
        $data['_availment'][$key]['name']    =  'confinement';
      }
      else if($availment->availment_name=='Dental')
      {
        $data['_availment'][$key]['name']    =  'dental';
      }
      else if($availment->availment_name=='Financial Assistance')
      {
        $data['_availment'][$key]['name']    =  'assistance';
      }
    }
    return view('carewell.modal_pages.settings_coverage_plan_create',$data);
  }
  public static function session_checker($session_name,$identifier)
  {
    $count = 0;
    foreach(Session::get($session_name) as $keys=>$session_items)
    {
      if(isset($session_items['identifier']))
      {
        if($session_items['identifier']==$identifier)
        {
          $count++;
        }
      }
    }
    return $count;
  }

  public function settings_coverage_items($availment_id,$session_name,$identifier)
  {

    $data['page']             =   'Coverage PLan';
    $data['user']             =   StaticFunctionController::global();
    $data['availment_id']     =   $availment_id;
    $data['session_name']     =   $session_name;
    $data['identifier']       =   $identifier;
 
    $data['_laboratory']      =   TblProcedureModel::where('archived',0)->where('type','LABORATORY')->get();
    $data['_complex']         =   TblProcedureModel::where('archived',0)->where('type','COMPLEX')->get();
    $data['_cardio']          =   TblProcedureModel::where('archived',0)->where('type','CARDIO')->get();
    $data['_ctscan']          =   TblProcedureModel::where('archived',0)->where('type','CTSCAN')->get();
    $data['_icunicu']         =   TblProcedureModel::where('archived',0)->where('type','ICUNICU')->get();
    $data['_utz']             =   TblProcedureModel::where('archived',0)->where('type','UTZ')->get();
    $data['_xray']            =   TblProcedureModel::where('archived',0)->where('type','XRAY')->get();
    if(Session::has($session_name))
    {
      $session_checker = Self::session_checker($session_name,$identifier);
      if($session_checker!=0)
      {
        foreach(Session::get($session_name) as $keys=>$session_items)
        {
          foreach($data['_laboratory'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']==$identifier)
            {
              $data['_laboratory'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_laboratory'][$pro]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_complex'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_complex'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_complex'][$pro]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_cardio'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_cardio'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_cardio'][$pro]['reference_number']    =  'hidden';
            }
          }
          
          foreach($data['_ctscan'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_ctscan'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_ctscan'][$pro]['reference_number']    =  'hidden';
            }
          }
          
          foreach($data['_icunicu'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_icunicu'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_icunicu'][$pro]['reference_number']    =  'hidden';
            }
          }
          
          foreach($data['_utz'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_utz'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_utz'][$pro]['reference_number']    =  'hidden';
            }
          }
          
          foreach($data['_xray'] as $pro=>$procedure)
          {
            if($session_items['procedure_id'] == $procedure->procedure_id)
            {
              $data['_xray'][$pro]['labs'] = "checked";
            }
            if($session_items['procedure_id'] == $procedure->procedure_id&&$session_items['identifier']!=$identifier)
            {
              $data['_xray'][$pro]['reference_number']    =  'hidden';
            }
          }
          
        }
      }
      else
      {
        $array  = array();
        foreach(Session::get($session_name) as $k=>$session_item)
        {
          if($session_item['availment_id']==$availment_id)
          {
            array_push($array,$session_item['procedure_id']);
          }
        } 
        $count                  = count($array)-1;
        for($i=0;  $i<=$count;  $i++)
        {
          foreach($data['_laboratory'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_laboratory'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_complex'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_complex'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_cardio'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_cardio'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_ctscan'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_ctscan'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_icunicu'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_icunicu'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_utz'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_utz'][$key]['reference_number']    =  'hidden';
            }
          }
          foreach($data['_xray'] as $key => $procedure)
          {
            $arr                = $array[$i];
            if($arr  ==   $procedure->procedure_id)
            {
              $data['_xray'][$key]['reference_number']    =  'hidden';
            }
          }
        }
      }
    }
    else
    {
      Session::put($session_name, array());
    }
    return view('carewell.additional_pages.coverage_plan_item',$data);
  }
  public function settings_coverage_items_submit(Request $request)
  {
    
    $identifiers      =  $request->identifier[0];
    $session_name     =  $request->session_name;
    $session_array    =  Session::get($session_name);
    foreach(Session::get($session_name) as $keys=>$session_items)
    {
      if(isset($session_items['identifier']))
      {
        if($session_items['identifier']==$identifiers)
        {
          unset($session_array[$keys]);
        }
      }
    }
    Session::put($session_name,$session_array);

    $array                  = Session::get($session_name);
    
    $availment_id           = $request->availment_id;
    $plan_charges           = $request->plan_charges;
    $plan_covered_amount    = $request->plan_covered_amount;
    $plan_limit             = $request->plan_limit;
    $identifier             = $request->identifier;
    $count = 0;
    
    foreach($request->procedure_id as $key=>$procedure_id)
    {
      
      $insert['procedure_id']         = $procedure_id;
      $insert['availment_id']         = $availment_id;
      $insert['plan_charges']         = $plan_charges;
      $insert['plan_covered_amount']  = $plan_covered_amount;
      $insert['plan_limit']           = $plan_limit;
      $insert['identifier']           = $identifier;
      array_push($array, $insert);
      $count++;
    }
    Session::put($session_name,$array);

    return StaticFunctionController::returnMessage('success','PROCEDURE');
  }
  public static function insert_all_session($session_name,$coverage_plan_id)
  {
    foreach(Session::get($session_name) as $key=>$item)
    {    
      $insert['procedure_id']         = $item['procedure_id'];
      $insert['availment_id']         = $item['availment_id'];
      $insert['plan_charges']         = $item['plan_charges'];
      $insert['plan_covered_amount']  = $item['plan_covered_amount'];
      $insert['plan_limit']           = $item['plan_limit'];
      $insert['coverage_plan_id']     = $coverage_plan_id;
      TblCoveragePlanProcedureModel::insert($insert);
    }
  }
  public function settings_coverage_plan_create_submit(Request $request)
  {

    $coverageData = new TblCoveragePlanModel;
    $coverageData->coverage_plan_name             = $request->coverage_plan_name;
    $coverageData->coverage_plan_preexisting      = $request->coverage_plan_preexisting;
    $coverageData->coverage_plan_annual_benefit   = $request->coverage_plan_annual_benefit;
    $coverageData->coverage_plan_maximum_benefit  = $request->coverage_plan_maximum_benefit;
    $coverageData->coverage_plan_mbl_illness      = $request->coverage_plan_mbl_illness;  
    $coverageData->coverage_plan_mbl_year         = $request->coverage_plan_mbl_year;
    $coverageData->coverage_plan_case_handling    = $request->coverage_plan_case_handling;
    $coverageData->coverage_plan_age_bracket      = $request->coverage_plan_age_bracket;
    $coverageData->coverage_plan_premium          = $request->coverage_plan_premium;
    $coverageData->coverage_plan_cari_fee         = $request->coverage_plan_cari_fee;
    $coverageData->coverage_plan_hib              = $request->coverage_plan_hib;
    $coverageData->coverage_plan_processing_fee   = $request->coverage_plan_processing_fee;
    $coverageData->coverage_plan_created          = Carbon::now();
    $coverageData->save();


    $session_array = array(0=>'annual',1=>'os_consultation',2=>'os_laboratory',3=>'emergency',4=>'confinement',5=>'dental',6=>'assistance');

    for($i=0;  $i<=6;  $i++)
    {
      $arr                = $session_array[$i];
      if(Session::has($arr))
      {
        Self::insert_all_session($arr,$coverageData->coverage_plan_id);
      }
    }
    
    
    if($coverageData->save())     
    {       
      return StaticFunctionController::returnMessage('success','COVERAGE PLAN'); 
    }
  }   
  public function settings_coverage_plan_details($coverage_plan_id)   
  {     
    $data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->first();     
    $data['_coverage_plan_covered'] = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage_plan_id)
                                    ->where('tbl_coverage_plan_procedure.archived',0)
                                    ->select(DB::raw('count(*) as totals, tbl_coverage_plan_procedure.availment_id,tbl_availment.availment_name'))
                                    ->groupBy('availment_id')
                                    ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_procedure.availment_id') 
                                    ->get();

    foreach($data['_coverage_plan_covered'] as $key=>$availment)
    {
      $data['_coverage_plan_covered'][$key]['procedure']   = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)
                                    ->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_coverage_plan_procedure.procedure_id') 
                                    ->get();

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
