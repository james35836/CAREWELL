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
use App\Http\Model\TblPayablePayeeModel;

use App\Http\Model\TblSpecializationModel;

use App\Http\Model\TblApprovalModel;
use App\http\Model\TblApprovalAvailedModel;
use App\Http\Model\TblApprovalDoctorModel;
use App\Http\Model\TblApprovalProcedureModel;
use App\Http\Model\TblApprovalDiagnosisModel;
use App\Http\Model\TblApprovalPayeeModel;
use App\Http\Model\TblApprovalTotalModel;
use App\Http\Model\TblApprovalAjudicationModel;


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

use PDF;

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
		
		$data['company_active']   = TblCompanyModel::where('archived',0)->count();
		$data['member_active']    = TblMemberModel::where('archived',0)->count();
		$data['member_inactive']  = TblMemberModel::where('archived',1)->count();
		$data['provider_active']  = TblProviderModel::where('archived',0)->count();
		
		$data['_approval']        = TblApprovalModel::where('tbl_approval.archived',0)
		->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
		->orderBy('approval_created','DESC')->get();
		$data['total_approval'] =  count($data['_approval']);

		$data['sum_approval'] = TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
                ->where('tbl_approval.approval_created','LIKE','%'.$monthYear.'%')
            	->select([DB::raw("SUM(total_charge_carewell) as total_charge_carewell")])
            	->first();

            	if($data['sum_approval']->total_charge_carewell == null)
	            	{
	            		$data['sum_approval']->total_charge_carewell = 0;
	            	}

	            	//Request::has('grace_time_rule_late') ? Request::input("grace_time_rule_late") : 'first';


        $data['total_paid'] = TblPayableApprovalModel::join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
        ->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_payable_approval.approval_id')
        ->join('tbl_payable','tbl_payable_approval.payable_id','=','tbl_payable.payable_id')
        ->where('tbl_payable.archived',1)
        ->where('tbl_approval.approval_created','LIKE','%'.$monthYear.'%')
        ->select([DB::raw("SUM(total_charge_carewell) as total_charge_carewell")])
        ->first();

        	if($data['total_paid']->total_charge_carewell == null)
            	{
            		$data['total_paid']->total_charge_carewell = 0;
            	}
            	// dd($data['sum_approval']->total_charge_carewell );

// select sum(tbl_approval_total.total_charge_carewell) from tbl_payable_approval 
// inner join tbl_approval on tbl_approval.approval_id = tbl_payable_approval .approval_id
// inner join tbl_approval_total on tbl_approval_total.approval_id = tbl_payable_approval .approval_id
// inner join tbl_payable on tbl_payable_approval.payable_id = tbl_payable.payable_id
// where tbl_payable.archived =1 ;

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
			$data['_company_active'][$key]['coverage_plan']   = TblCompanyCoveragePlanModel::CoveragePlan()->where('company_id',$company->company_id)->get();
			$data['_company_active'][$key]['member']          = TblMemberCompanyModel::where('company_id',$company->company_id)->where('archived',0)->count();
		}
		foreach ($data['_company_inactive'] as $key => $company) 
		{
			$data['_company_inactive'][$key]['coverage_plan'] = TblCompanyCoveragePlanModel::CoveragePlan()->where('company_id',$company->company_id)->get();
		}
		return view('carewell.pages.company_center',$data);
	}
	public function company_details($company_id)
	{
		$data['company_details']      = TblCompanyModel::where('tbl_company.company_id',$company_id)->CompanyContact()->first();
		$data['_company_deployment']  = TblCompanyDeploymentModel::where('company_id',$company_id)->get();
		$data['_coverage_plan']       = TblCompanyCoveragePlanModel::where('company_id',$company_id)->CoveragePlan()->get();
		$data['_company_member']      = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)->CompanyMember(0)->paginate(10);
		//edrich
		$data['_company_member_inactive']      = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)->CompanyMember(1)->paginate(10);
		//edrich
		$data['company_contract']     = TblCompanyContractModel::where('company_id',$company_id)->first();
		$data['_contract_images']     = TblCompanyContractImageModel::where('archived',0)->where('contract_id',$data['company_contract']->contract_id)->get();
		$data['_benefits_images']     = TblCompanyContractBenefitsModel::where('archived',0)->where('contract_id',$data['company_contract']->contract_id)->get();
		
		return view('carewell.modal_pages.company_details',$data);
	}

	//edrich
	public function company_details_export_excel($company_id,$data_pick)
	{
		$filename = "";
		if($data_pick == 0) // active member
		{
			$data['_company_member']      = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)->CompanyMember(0)->get();
			$filename = "ACTIVE MEMBER";
		}
		else //inactive member
		{
			$data['_company_member']      = TblMemberCompanyModel::where('tbl_member_company.company_id',$company_id)->CompanyMember(1)->get();
			$filename = "INACTIVE MEMBER";
		}

		Excel::create($filename,function($excel) use ($data)
		{
			$excel->sheet('clients',function($sheet) use ($data)
			{
				$sheet->loadView('carewell.additional_pages.company_details_inactive_active_member_export_excel',$data);
			});
		})->download('xls');
	}
	//edrich
	public function company_create_company()
	{
		$data['_payment_mode']    = TblPaymentModeModel::get();
		$_coverage                = TblCompanyCoveragePlanModel::where('archived',0)->get();
		$data['_coverage_plan']   = TblCoveragePlanModel::where('archived',0)->get();
		foreach($_coverage as $keys=>$coverage_plan)
		{
			foreach($data['_coverage_plan'] as $key=>$coverage)
			{
				if($coverage->coverage_plan_id==$coverage_plan->coverage_plan_id)
				{
					$data['_coverage_plan'][$key]['ref']="hidden";
				}
			}
		}
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

		$check =  TblCompanyModel::where('tbl_company.company_id',$request->company_id)->CompanyContact()->update($update);

		return StaticFunctionController::returnMessage('success','COMPANY');
	}
	public function company_add_coverage_plan($company_id)
	{
		$data['company_id']       = $company_id;
		$_coverage                = TblCompanyCoveragePlanModel::where('archived',0)->get();
		$data['_coverage_plan']   = TblCoveragePlanModel::where('archived',0)->get();
		foreach($_coverage as $keys=>$coverage_plan)
		{
			foreach($data['_coverage_plan'] as $key=>$coverage)
			{
				if($coverage->coverage_plan_id==$coverage_plan->coverage_plan_id)
				{
					$data['_coverage_plan'][$key]['ref']="hidden";
				}
			}
		}
		return view('carewell.modal_pages.company_add_plan',$data);
	}
	public function  company_add_coverage_plan_submit(Request $request)
	{
		foreach($request->coveragePlanData as $coverage_plan_id)
		{
			$check  = TblCompanyCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->count();
			if($check==0)
			{
				$coverageData                   = new TblCompanyCoveragePlanModel;
				$coverageData->coverage_plan_id = $coverage_plan_id;
				$coverageData->company_id       = $request->company_id;
				$coverageData->save();
			}
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
		// $companyData->company_code            = StaticFunctionController::updateReferenceNumber('company');
		$companyData->company_code            = $request->company_code;
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
		$data['_member_active']       = TblMemberModel::where('tbl_member.archived',0)->where('tbl_member_company.archived',0)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10, ['*'], 'active');
		$data['_member_inactive']     = TblMemberModel::where('tbl_member.archived',1)->where('tbl_member_company.archived',0)->Member()->orderBy('tbl_member.member_id','ASC')->paginate(10, ['*'], 'inactive');
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
		$memberData->member_gender              = StaticFunctionController::nullableToString($request->member_gender);
		$memberData->member_marital_status      = StaticFunctionController::nullableToString($request->member_marital_status);
		$memberData->member_mother_maiden_name  = StaticFunctionController::nullableToString($request->member_mother_maiden_name);
		$memberData->member_contact_number      = StaticFunctionController::nullableToString($request->member_contact_number);
		$memberData->member_email_address       = StaticFunctionController::nullableToString($request->member_email_address);
		$memberData->member_permanet_address    = StaticFunctionController::nullableToString($request->member_permanet_address);
		$memberData->member_present_address     = StaticFunctionController::nullableToString($request->member_present_address);
		$memberData->member_created             = Carbon::now();
		$display_name                           = $memberData->member_first_name." ".$memberData->member_middle_name." ".$memberData->member_last_name;
		$memberData->member_universal_id        = StaticFunctionController::generateUniversalId($display_name,$memberData->member_birthdate);
		$memberData->save();

		foreach($request->dependent_full_name as $key=>$data)
		{
			$dependentData = new TblMemberDependentModel;
			$dependentData->dependent_full_name    = StaticFunctionController::nullableToString($request->dependent_full_name[$key]);
			$dependentData->dependent_birthdate    = StaticFunctionController::nullableToString($request->dependent_birthdate[$key]);
			$dependentData->dependent_relationship = StaticFunctionController::nullableToString($request->dependent_relationship[$key]);
			$dependentData->member_id              = $memberData->member_id;
			$dependentData->save();
		}

		$governmentData = new TblMemberGovernmentCardModel;
		$governmentData->government_card_philhealth  = StaticFunctionController::nullableToString($request->government_card_philhealth);
		$governmentData->government_card_sss         = StaticFunctionController::nullableToString($request->government_card_sss);
		$governmentData->government_card_tin         = StaticFunctionController::nullableToString($request->government_card_tin);
		$governmentData->government_card_hdmf        = StaticFunctionController::nullableToString($request->government_card_hdmf);
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
		$companyMemberData->member_payment_mode     = $request->member_payment_mode;
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
		
		$update['government_card_philhealth'] = $request->government_card_philhealth;
		$update['government_card_sss']        = $request->government_card_sss;
		$update['government_card_tin']        = $request->government_card_tin;
		$update['government_card_hdmf']       = $request->government_card_hdmf;

		$check    =  TblMemberModel::where('tbl_member.member_id',$request->member_id)->MemberCards()->update($update);
		if($check)
		{
			return StaticFunctionController::returnMessage('success','MEMBER');
		}
		else
		{
			return StaticFunctionController::returnMessage('danger','MEMBER');
		}
	}
  //edrich
	public function member_transaction_details($member_id)
	{

		$coverage                       = TblMemberCompanyModel::where('archived',0)->where('member_id',$member_id)->first();
		$data['_payment_history']       = TblCalMemberModel::where('tbl_cal_member.member_id',$member_id)->PaymentHistory()->get();
		$data['_availment_history']     = TblApprovalModel::where('tbl_approval.member_id',$member_id)->AvailmentHistory()->get();
		$data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage->coverage_plan_id)->first();     
		$data['_coverage_plan_covered'] = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage->coverage_plan_id)->CoveragePlan()->get();
		foreach($data['_coverage_plan_covered'] as $key=>$availment)
		{
			$data['_coverage_plan_covered'][$key]['procedure']   = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)->Procedure()->get();
		}
		foreach($data['_payment_history'] as $key=>$payment)
		{
			$data['_payment_history'][$key]['amount'] = $payment->cal_payment_amount/$payment->cal_payment_count;
		}
		foreach($data['_availment_history'] as $key=>$availment_history)
		{
			$data['_availment_history'][$key]['charge_carewell_doctor'] 	= TblApprovalTotalModel::where('approval_id',$availment_history->approval_id)->where('total_type','doctor')->value('total_charge_carewell');
			$data['_availment_history'][$key]['charge_carewell_procedure'] 	= TblApprovalTotalModel::where('approval_id',$availment_history->approval_id)->where('total_type','doctor')->value('total_charge_carewell');
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
		$excels['data']           =   ['COMPANY CODE','CAREWELL ID','EMPLOYEE NUMBER','MEMBER LAST NAME','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER GENDER','MEMBER BIRTHDATE','DEPLOYMENT','COVERAGE PLAN','MODE OF PAYMENT','STATUS'];
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
					
					/**MEMBER GENDER*/
					$gender_cell = $sheet->getCell('G'.$rowcell)->getDataValidation();
					$gender_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
					$gender_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
					$gender_cell->setAllowBlank(false);
					$gender_cell->setShowInputMessage(true);
					$gender_cell->setShowErrorMessage(true);
					$gender_cell->setShowDropDown(true);
					$gender_cell->setErrorTitle('Input error');
					$gender_cell->setError('Value is not in list.');
					$gender_cell->setFormula1('gender');

					/* DEPLOYMENT*/
					$deployment_cell = $sheet->getCell('I'.$rowcell)->getDataValidation();
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
					$availment_cell = $sheet->getCell('J'.$rowcell)->getDataValidation();
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
					$payment_cell = $sheet->getCell('K'.$rowcell)->getDataValidation();
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

				/*GENDER*/
				$sheet->SetCellValue("G1", "gender");
				$sheet->SetCellValue("G2","MALE" );
				$sheet->SetCellValue("G3","FEMALE" );

				/* DEPLOYMENT REFERENCES */
				$sheet->SetCellValue("I1", "deployment");
				$deployment_number = 2;
				foreach($_deployment as $deployment)
				{
					$sheet->SetCellValue("I".$deployment_number, $deployment->deployment_name);
					$deployment_number++;
				}
				$deployment_number--;
				/* AVAILMENT REFERENCES */
				$sheet->SetCellValue("J1", "coverage");
				$coverage_number = 2;
				foreach($_coverage as $coverage)
				{
					$sheet->SetCellValue("J".$coverage_number, $coverage->coverage_plan_name);
					$coverage_number++;
				}
				$coverage_number--;

				/* PAYMENT REFERENCES */
				$sheet->SetCellValue("K1", "payment");
				$payment_mode_number = 2;
				foreach($_payment_mode as $payment_mode)
				{
					$sheet->SetCellValue("K".$payment_mode_number, $payment_mode->payment_mode_name);
					$payment_mode_number++;
				}
				$payment_mode_number--;
				/* STATUS REFERENCES */
				$sheet->SetCellValue("L1", "status");
				$sheet->SetCellValue("L2", 'ACTIVE');
				$sheet->SetCellValue("L3", 'INACTIVE');

				/*GENDER*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'gender', $sheet, 'G2:G3'
					)
				);
				/*DEPLOYMENT*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'deployment', $sheet, 'I2:I'.$deployment_number
					)
				);
				/*AVAILMENT*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'coverage', $sheet, 'J2:J'.$coverage_number
					)
				);

				/*PAYMENT*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'payment', $sheet, 'K2:K'.$payment_mode_number
					)
				);
				/*STATUS*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'status', $sheet, 'L2:L3'
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
				if($data['carewell_id']!=null||$data['carewell_id']!="")
				{
					$companyID        = StaticFunctionController::getid($data['company_code'], 'company');
					$companyData      = TblCompanyModel::where('company_id',$companyID)->first();
					$count_member     = TblMemberModel::MemberExist($data['member_first_name'],$data['member_middle_name'],$data['member_last_name'])->first();
					$carewellCheck    = TblMemberCompanyModel::where('member_carewell_id',$data['carewell_id'])->count();
					if($carewellCheck!=0)
					{
						$name['first']  = $data['member_first_name'];
						$name['middle'] = $data['member_middle_name'];
						$name['last']   = $data['member_last_name'];
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
						$member['member_gender']            =   StaticFunctionController::nullableToString($data['member_gender']);
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
						$name['middle']   = $data['member_middle_name'];
						$name['last'] = $data['member_last_name'];
						$name['type']   = 'ALL FILEDS ARE REQUIRED - PLEASE CHECK';
						array_push($exportArray,$name);
						$countError++;
					}
					if(count($exportArray)>0)
					{
						Session::put('exportWarning',$exportArray);
					}
				}
			}    

			if($count == 0&&$countError==0)
			{
				$message = '<center><b><span class="color-gray">There is nothing to insert, Please check if all rows has CAREWELL ID</span></b></center>';
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
		$data['_payment']   = TblPaymentModeModel::where('archived',0)->get();

		return view('carewell.modal_pages.member_adjustment',$data);
	}
	public function member_adjustment_submit(Request $request)
	{
		$companyData       = TblCompanyModel::where('company_id',$request->company_id_adjustment)->first();
		$companyMemberData = new TblMemberCompanyModel;
		$companyMemberData->member_carewell_id      = StaticFunctionController::generateCarewellId($companyData->company_code);
		$companyMemberData->member_employee_number  = $request->employee_number_adjustment;
		$companyMemberData->member_company_status   = "active";
		$companyMemberData->member_payment_mode     = $request->member_payment_mode_adjustment;
		$companyMemberData->member_transaction_date = Carbon::now();
		$companyMemberData->coverage_plan_id        = $request->coverage_plan_id_adjustment;
		$companyMemberData->deployment_id           = $request->deployment_id_adjustment;
		$companyMemberData->member_id               = $request->member_id_adjustment;
		$companyMemberData->company_id              = $companyData->company_id;
		$companyMemberData->save();

		$update['archived'] = 1;
		$memberCompany      = TblMemberCompanyModel::where('member_company_id','!=',$companyMemberData->member_company_id)->where('member_id',$request->member_id_adjustment)->update($update);

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
		$data['_provider_inactive']= TblProviderModel::where('archived',1)->paginate(10);

		return view('carewell.pages.provider_center',$data);
	}
	public function provider_create()
	{
		return view('carewell.modal_pages.provider_create');
	}


	

	public function provider_create_submit(Request $request)
	{
	     $provider_id = StaticFunctionController::getIdNorName($request->provider_name,'provider');
	    	if($provider_id==$request->provider_name)
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
	          $notif    = "Provider Inserted";
	    	     $inserted = StaticFunctionController::provider_add_tag_doctor($request->doctorProviderData,$providerData->provider_id);
	    	}
	    	else
	    	{
	    		$inserted = StaticFunctionController::provider_add_tag_doctor($request->doctorProviderData,$provider_id);
	          $notif    = "Provider Exist";
		}
	     return "<div class='alert alert-success' style='text-align: center;'>".$notif." and ".$inserted." doctors tag!</div>";
		
	}

	public function provider_details(Request $request,$provider_id)
	{
		$data['_provider_payee']  = TblProviderPayeeModel::where('provider_id',$provider_id)->get();
		$data['provider_details'] = TblProviderModel::where('tbl_provider.provider_id',$provider_id)->first();
		$data['_provider_doctor'] = TblDoctorProviderModel::where('tbl_doctor_provider.provider_id',$provider_id)->DoctorProvider()->get();
	    
		foreach ($data['_provider_doctor'] as $key => $doctor) 
	  	{
	    	$data['_provider_doctor'][$key]['doctor_archive'] =  TblDoctorModel::where('doctor_id',$doctor->doctor_id)->value('archived');
	  	}

	  	$data['_payable'] = TblPayableModel::where('tbl_payable.provider_id',$provider_id)->PayableInfo()->get();
	  	foreach ($data['_payable'] as $key => $payable) 
		{
			$data['_payable'][$key]['approval_number']    =  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
		}
	  	
	  	return view('carewell.modal_pages.provider_details',$data);
	}
	public function provider_import()
	{
		return view('carewell.modal_pages.provider_import');
	}
	
	public function provider_import_submit(Request $request)
	{
		$file   = $request->file('importProviderFile')->getRealPath();
		$_data  = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
		$first  = $_data[0]; 
		if(isset($first['provider_name'])&&isset($first['provider_payee']))
		{
			$count      	= 0;
			$countPayee 	= 0;
			foreach($_data as $data)
			{
				if($data['provider_name']!=null)
				{
					$provider_id 		= TblProviderModel::where('provider_name', $data['provider_name'])->value('provider_id');
					$doctor_id   		= TblDoctorModel::where('doctor_full_name', $data['provider_payee'])->value('doctor_id');
	                    $provider_name  	= $data['provider_name'];
	                    $doctor_name    	= $data['provider_payee'];
					if($provider_id==null)
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

						$countPayee = StaticFunctionController::provider_doctor_insert($provider_name,$providerData->provider_id,$doctor_name,$doctor_id);
					}
					else
					{
						$countPayee = StaticFunctionController::provider_doctor_insert($provider_name,$provider_id,$doctor_name,$doctor_id);
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

				for($row = 1, $rowcell = 2; $row <= 1000; $row++, $rowcell++)
				{
					/* STATUS*/
					$status_cell = $sheet->getCell('C'.$rowcell)->getDataValidation();
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
			$excel->sheet('reference', function($sheet) use($excels) 
			{
				/* STATUS REFERENCES */
				$sheet->SetCellValue("C1", "status");
				$sheet->SetCellValue("C2", '2001');
				$sheet->SetCellValue("C3", '2009');
				/*STATUS*/
				$sheet->_parent->addNamedRange(
					new \PHPExcel_NamedRange(
						'status', $sheet, 'C2:C3'
					)
				);
			});
		})->download('xlsx');
	}

	  //edrich
	public function provider_update_provider_submit(Request $request)
	{
		$update['provider_name']              = $request->provider_name;
		$update['provider_rvs']               = $request->provider_rvs;
		$update['provider_contact_person']    = $request->provider_contact_person;
		$update['provider_contact_email']     = $request->provider_contact_email;
		$update['provider_telephone_number']  = $request->provider_telephone_number;
		$update['provider_mobile_number']     = $request->provider_mobile_number;
		$update['provider_address']           = $request->provider_address;
		$check =  TblProviderModel::where('provider_id',$request->provider_id)->update($update);

		return StaticFunctionController::returnMessage('success','PROVIDER');
	}

	/*DOCTOR*/
	public function doctor(Request $request)
	{
		$data['page']             = 'Doctor';
		$data['user']             = StaticFunctionController::global();
		$data['_provider']        = TblProviderModel::where('archived',0)->get();
		$data['_doctor_active']   = TblDoctorModel::where('archived',0)->paginate(10);
		$data['_doctor_inactive'] = TblDoctorModel::where('archived',1)->paginate(10);
		foreach ($data['_doctor_active'] as $key => $doctor) 
		{
			$data['_doctor_active'][$key]['provider']   =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
	                                                  ->where('tbl_doctor_provider.archived',0)
	                                                  ->Provider()->get();
		}
		foreach ($data['_doctor_inactive'] as $key => $doctor) 
		{
			$data['_doctor_inactive'][$key]['provider'] =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
	                                                  ->where('tbl_doctor_provider.archived',0)
	                                                  ->Provider()->get();
		}
		return view('carewell.pages.doctor_center',$data);
	}

	public function doctor_view_details(Request $request,$doctor_id)
	{
		$data['doctor_details']         = TblDoctorModel::where('doctor_id',$doctor_id)->first();
		$data['_doctor_provider']       = TblDoctorProviderModel::where('tbl_doctor_provider.doctor_id',$doctor_id)->Provider()->get();

	  foreach ($data['_doctor_provider'] as $key => $doctor) 
	  {
	    // $data['_doctor_provider'][$key]['doctor_archive'] =  TblDoctorProviderModel::where('doctor_id',$doctor_id)->value('archived');
	    $data['_doctor_provider'][$key]['doctor_archive'] = TblDoctorProviderModel::where('provider_id',$doctor->provider_id)->value('archived');
	  }
		return view('carewell.modal_pages.doctor_details',$data);
	}

	public function doctor_update_submit(Request $request)
	{
		$update['doctor_full_name']     = $request->doctor_full_name;
		$update['doctor_gender']        = $request->doctor_gender;
		$update['doctor_contact_number']= $request->doctor_contact_number;
		$update['doctor_email_address'] = $request->doctor_email_address;
		$check =  TblDoctorModel::where('doctor_id',$request->doctor_id)->update($update);
		if($check)
		{
			return StaticFunctionController::returnMessage('success','DOCTOR');   
		} 
	}

	public function add_doctor()
	{
		$data['_provider']        = TblProviderModel::where('archived',0)->get();
		$data['_specialization']  = TblSpecializationModel::get();
		return view('carewell.modal_pages.doctor_create',$data);
	}

	public function add_doctor_submit(Request $request)
	{
		$check_name = TblDoctorModel::where('doctor_full_name',$request->doctor_full_name)->count();
		if($check_name==0)
		{
			$doctorData = new TblDoctorModel;
			$doctorData->doctor_number          = StaticFunctionController::updateReferenceNumber('doctor');
			$doctorData->doctor_full_name       = $request->doctor_full_name;
			$doctorData->doctor_gender          = $request->doctor_gender;
			$doctorData->doctor_contact_number  = $request->doctor_contact_number;
			$doctorData->doctor_email_address   = $request->doctor_email_address;
			$doctorData->doctor_created         = Carbon::now();
			$doctorData->save();

			foreach($request->doctorProviderData as $provider_id)
			{
				$check = TblDoctorProviderModel::where('provider_id',$provider_id)->where('doctor_id',$doctorData->doctor_id)->count();
				if($check==0)
				{
					$providerData = new TblDoctorProviderModel;
					$providerData->provider_id  = $provider_id;
					$providerData->doctor_id    = $doctorData->doctor_id;
					$providerData->save();
				}
			}
			$message = StaticFunctionController::returnMessage('success','DOCTOR');    
		}
		else
		{
			$message = '<center><b><span class="color-gray">Doctor Name Exist</span></b></center>';
		}
		
		return $message;
		
	}
	
	public function doctor_add_doctor_provider($doctor_id)
	{
		$data['doctor_id'] = $doctor_id;
		$_doctor_provider  = TblDoctorProviderModel::where('doctor_id',$doctor_id)->get();  
		$data['_provider'] = TblProviderModel::where('archived',0)->get();
		foreach($_doctor_provider as $keys=>$doctor_provider)
		{
			foreach($data['_provider'] as $key=>$provider)
			{
				if($provider->provider_id==$doctor_provider->provider_id)
				{
					$data['_provider'][$key]['ref']="hidden";
				}
			}
		}
		return view('carewell.modal_pages.doctor_add_provider',$data);
	}
	public function doctor_add_doctor_provider_submit(Request $request)
	{
		$countInsert   = 0;
		$countReject   = 0;
		foreach($request->doctorProviderData as $provider_id)
		{
			$doctor_provider  = TblDoctorProviderModel::where('provider_id',$provider_id)->where('doctor_id',$request->doctor_id)->count();  
			if($doctor_provider==0)
			{
				$providerData              = new TblDoctorProviderModel;
				$providerData->provider_id = $provider_id;
				$providerData->doctor_id   = $request->doctor_id;
				$providerData->save();
				
				$countInsert++;
			}
			else
			{
				$countReject++;
			}
		}
		return '<center><b><span class="color-red">'.$countInsert.' inserted<br>'. $countReject.' rejected</span></b></center>';
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
			$data['_cal_open'][$key]['members']   = TblCalMemberModel::where('cal_id',$cal_open->cal_id)->where('archived',0)->count();
			$data['_cal_open'][$key]['reference'] = 'show';
		}
		foreach ($data['_cal_close'] as $key => $cal_close) 
		{
			$data['_cal_close'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_close->cal_id)->count();
			$data['_cal_close'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_close->cal_id)->where('archived',0)->count();
			$data['_cal_close'][$key]['reference'] = 'none';
		}
		foreach ($data['_cal_pending'] as $key => $cal_pending) 
		{
			$data['_cal_pending'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_pending->cal_id)->count();
			$data['_cal_pending'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_pending->cal_id)->where('archived',0)->count();
			$data['_cal_pending'][$key]['reference'] = 'show';
		}
		return view('carewell.pages.billing_center',$data);
	}
	public function billing_create_cal()
	{
		$data['_company']         = TblCompanyModel::where('archived',0)->get();
		$data['_period']          = TblPaymentModeModel::get();
		return view('carewell.modal_pages.billing_create_cal',$data);
	}
	public function billing_create_cal_submit(Request $request)
	{
		$companyCalData                             =   new TblCalModel;
		$companyCalData->cal_number                 =   StaticFunctionController::updateReferenceNumber('billing_cal');;
		$companyCalData->cal_reveneu_period_year    =   $request->cal_reveneu_period_year;
		$companyCalData->cal_payment_mode           =   $request->cal_payment_mode;
		$companyCalData->cal_remarks                =   'REMARKS';
		$companyCalData->cal_start                  =   $request->cal_start;
		$companyCalData->cal_end                    =   $request->cal_end;
		$companyCalData->cal_created                =   Carbon::now();
		$companyCalData->company_id                 =   $request->company_id;
		$companyCalData->save();

		return StaticFunctionController::customMessage('success','CAL CREATED SUCCESFULLY');
	}
	public function billing_cal_details($cal_id)
	{
		$sum                          = 0;
		$sums                         = 0;
		$data['_company']             = TblCompanyModel::where('archived',0)->get();
		$data['_period']              = TblPaymentModeModel::get();
		$data['cal_check']            = TblCalModel::where('cal_id',$cal_id)->value('archived');
		$data['_cal_member']          = TblCalMemberModel::where('tbl_cal_member.cal_id',$cal_id)->where('tbl_cal_member.archived',0)->CalMember()->get();
		$data['_cal_member_remove']   = TblCalMemberModel::where('tbl_cal_member.cal_id',$cal_id)->where('tbl_cal_member.archived',1)->CalMember()->get();
		$data['_cal_new_member']      = TblNewMemberModel::where('cal_id',$cal_id)->get();
		if($data['cal_check']==0||$data['cal_check']==2)
		{
			$data['cal_details']    = TblCalModel::where('tbl_cal.cal_id',$cal_id)->CalInfo(0)->first();
		}
		else
		{
			$data['cal_details']    = TblCalModel::where('tbl_cal.cal_id',$cal_id)->CalInfo(1)->first();
		}
		
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
	public function billing_update_cal_details_submit(Request $request)
	{
		$companyCalData['cal_reveneu_period_year']  =   $request->cal_reveneu_period_year;
		$companyCalData['cal_payment_mode']         =   $request->cal_payment_mode;
		$companyCalData['cal_start']                =   $request->cal_start;
		$companyCalData['cal_end']                  =   $request->cal_end;
		$companyCalData['company_id']               =   $request->company_id;
		$check  = TblCalModel::where('cal_id',$request->cal_id)->update($companyCalData);
		return StaticFunctionController::returnMessage('success','CAL');
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
		$data['_payment_breakdown'] = TblCalPaymentModel::where('member_id',$member_id)->where('archived',1)->orderBy('cal_payment_end','DESC')->limit(10)->get();
		$data['member_id']          = 'disabled';
		$data['ref']                = 'old';
		$data['archived']           = 1;  
		return view('carewell.modal_pages.billing_payment_breakdown',$data);
	}
	public function billing_update_payment_date(Request $request)
	{
		
		$update['cal_payment_start']  = date('Y-m-d', strtotime($request->cal_payment_start));
		$update['cal_payment_end']    = date('Y-m-d', strtotime($request->cal_payment_end));
		$update['cal_payment_type']   = "UPDATED";

		$updates['cal_payment_start']  = date('Y-m-d', strtotime($request->cal_payment_start));
		$updates['cal_payment_end']    = date('Y-m-d', strtotime($request->cal_payment_end));
		if($request->ref=='old')
		{
			$TblCalPaymentModel   = TblCalPaymentModel::where('cal_payment_id',$request->cal_payment_id);
			$member_id            = $TblCalPaymentModel->value('member_id');
			$check                = StaticFunctionController::checkPaymentUpdate($update['cal_payment_start'],$update['cal_payment_end'],$member_id,'old');
			if($check==0)
			{
				$updateCheck        = $TblCalPaymentModel->update($update);
				$message            = "check";
			}
			else
			{
				$message = "overlapping"; 
			}
		}
		else
		{
			$updateCheck = TblNewCalMemberModel::where('cal_new_member_id',$request->cal_new_member_id)->update($updates);
			$message    = "check";
		}
		return $message;
		
	}
	public function billing_import_cal_members($cal_id,$company_id)
	{
		$data['cal_id']           = $cal_id;
		$data['company_id']       = $company_id;
		return view('carewell.modal_pages.billing_import',$data);
	}
	public function billing_cal_download_template($cal_id,$company_id)
	{
		$excels['number_of_rows'] 	= 10;
		$excels['company_id']     	= $company_id;
		$cal_template             	= TblCalModel::where('cal_id',$cal_id)
								->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
								->first();
		$excels['company_name']   	= $cal_template->company_name;
		$excels['company_id']     	= $cal_template->company_id;
		$excels['cal_number']     	= $cal_template->cal_number;

		$excels['_payment']       	= TblPaymentModeModel::where('archived',0)->get();
		$excels['_deployment']    	= TblCompanyDeploymentModel::where('tbl_company_deployment.company_id',$company_id)->get();
		$excels['_coverage']      	= TblCompanyCoveragePlanModel::where('tbl_company_coverage_plan.company_id',$company_id)->CoveragePlan()->get();
		$excels['_member']        	= TblMemberCompanyModel::where('tbl_member_company.archived',0)
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
		$companyData        = TblCompanyModel::CompanyCal()->where('tbl_company.company_id',$request->company_id)->where('tbl_cal.cal_id',$request->cal_id)->first();
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
							$name['middle'] = $data['middle_name'];
							$name['last']   = $data['last_name'];
							$name['type']   = 'EXISTING IN CAL';
							array_push($exportArray,$name);
							$countExist++;
						}
						else
						{
							$coverage_plan_id = StaticFunctionController::getid($data['coverage_plan'], 'coverage');
							$deployment_id    = StaticFunctionController::getid($data['deployment'], 'deployment');
							
							
							$payment_amount   = $data['payment_amount'];
							$cal_id           = $companyData->cal_id;
							$member_id        = $checkingMember->member_id;
							$premium          = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->value('coverage_plan_premium');
							if($payment_amount%$premium == 0)
							{
								$payment_count    = str_replace(',','',$payment_amount) /$premium;
								$payment_mode     = $member_data->member_payment_mode;
								if($payment_count > 1)
								{
									$name['first']  = $data['first_name'];
									$name['middle'] = $data['middle_name'];
									$name['last']   = $data['last_name'];
									$name['type']   = 'NEED ADJUSTMENT';
									array_push($exportArray,$name);
								}
								$cal_member['cal_payment_amount']   =   $payment_amount;
								$cal_member['cal_payment_date']     =   Carbon::now();
								$cal_member['cal_payment_count']    =   $payment_count;
								$cal_member['member_id']            =   $checkingMember->member_id;
								$cal_member['cal_id']               =   $companyData->cal_id;
								$cal_member_id                      =   TblCalMemberModel::insertGetId($cal_member);
								$payment_ref                        =   StaticFunctionController::paymentDateComputation($member_id,$cal_member_id,$payment_count,$payment_mode);
								if($coverage_plan_id!=$member_data->coverage_plan_id)
								{
									StaticFunctionController::archivedCurrentCompany($checkingMember->member_id,$coverage_plan_id,'coverage_plan');
								}
								else if($deployment_id!=$member_data->deployment_id)
								{
									StaticFunctionController::archivedCurrentCompany($checkingMember->member_id,$deployment_id,'deployment');
								}
								$count++; 
							}
							else
							{
								$name['first']  = $data['first_name'];
								$name['middle'] = $data['middle_name'];
								$name['last']   = $data['last_name'];
								$name['type']   = 'Check Payment Amount';
								array_push($exportArray,$name);
							}
						     
						}
					}
					else if($checkingNewMember==null)
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
    	$update['archived']     = 2; //for pending cal
    	$update['cal_remarks']  = $request->cal_remarks;
    	$pending                = TblCalModel::where('cal_id',$request->cal_id)->update($update);
    	$data['_cal_member']    = TblCalMemberModel::where('cal_id',$request->cal_id)->get();
    	foreach($data['_cal_member'] as $key=>$cal_member)
    	{
    		$member['archived']   = 2;
    		TblCalPaymentModel::where('cal_member_id',$cal_member->cal_member_id)->update($member);
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
		$sum                  = 0;
		$data['cal_info']     = TblCalModel::where('cal_id',$cal_id)->first();
		$data['_cal_member']  = TblCalMemberModel::where('cal_id',$cal_id)->get();
		
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
		$check  = TblCalInfoModel::where('cal_info_check_number',$request->cal_info_check_number)->orWhere('cal_info_or_number',$request->cal_info_or_number)->count();
		if($check==0)
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
			$message['alert'] 	= "success";
			$message['message'] = StaticFunctionController::customMessage('success','CAL CLOSED SUCCESSFULLY');
			
		}
		else
		{
			$message['alert'] 	= "danger";
			$message['message'] = "OR number or Check Number Exist";
		}
		return $message;
	}

	/*MEDICAL*/
	public function availment()
	{
		$data['page']       		= 'Availment';
		$data['_company']  			= TblCompanyModel::where('archived',0)->get();
		$data['_provider']  		= TblProviderModel::where('archived',0)->get();
		$data['user']       		= StaticFunctionController::global();
		$data['_approval_active']  	= TblApprovalModel::where('tbl_approval.archived',0)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
		$data['_approval_pending']  	= TblApprovalModel::where('tbl_approval.archived',2)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
		$data['_approval_inactive']  	= TblApprovalModel::where('tbl_approval.archived',1)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
		return view('carewell.pages.availment_center',$data);
	}

	public function availment_create_approval()
	{
		$data['_member']          = TblMemberModel::MemberCompany()->where('tbl_member_company.archived',0)->get();
		$data['_provider']        = TblProviderModel::where('archived',0)->get();
		$data['_availment']       = TblAvailmentModel::where('availment_parent_id',0)->get();
		$data['_procedure_doctor']= TblDoctorProcedureModel::where('archived',0)->get();
		$data['_doctor']          = TblDoctorModel::where('archived',0)->get();
		$data['_payee']           = TblProviderPayeeModel::where('archived',0)->get();
		$data['_diagnosis']       = TblDiagnosisModel::where('archived',0)->get();
		$data['_specialization']  = TblSpecializationModel::get();
		return view('carewell.modal_pages.availment_approval_create',$data);
	}
	public function  availment_get_member_info(Request $request)
	{
		if($request->ajax())
		{
			$today      = date('Y-m-d');
			$mem_cal    = TblCalPaymentModel::where('member_id',$request->member_id)
						->where(function($query)
						{
							$query->where('archived',1);
							$query->orWhere('archived',2);
							
						})
						->orderBy('cal_payment_end','DESC')
						->first();
			$data['member_info']  	= TblMemberModel::where('tbl_member.member_id',$request->member_id)->where('tbl_member_company.archived',0)->Member()->first();
			$data['_member']     	= TblMemberModel::where('tbl_member.archived',0)->where('tbl_member_company.archived',0)->Member()->get();
			$data['_availment']   	= TblCoveragePlanProcedureModel::where('coverage_plan_id',$data['member_info']->coverage_plan_id)
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
						'member_employee_number'  => $data['member_info']->member_employee_number,
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

		$member_company_id = TblMemberCompanyModel::where('member_id',$request->member_id)->where('tbl_member_company.archived',0)->value('member_company_id');
		
		$approvalData = new TblApprovalModel;
		$approvalData->approval_number            = StaticFunctionController::updateReferenceNumber('approval');
		$approvalData->approval_complaint         = StaticFunctionController::nullableToString($request->approval_complaint,'string');
		$approvalData->approval_date_availed      = $request->approval_date_availed;
		$approvalData->approval_created           = Carbon::now();
		$approvalData->charge_diagnosis_id        = $request->charge_diagnosis_id;
		$approvalData->diagnosis_id               = $request->diagnosis_id;
		$approvalData->availment_id               = $request->availment_id;
		$approvalData->provider_id                = $request->provider_id;
		$approvalData->member_id                  = $request->member_id;
		$approvalData->member_company_id		  = $member_company_id;
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
		if($request->procedure_id!=null)
		{
			foreach($request->procedure_id as $key=>$datas)
			{
				$procedureData = new TblApprovalProcedureModel;
				$procedureData->procedure_id              = $request->procedure_id[$key];
				$procedureData->procedure_gross_amount    = $request->procedure_gross_amount[$key];
				$procedureData->procedure_philhealth      = $request->procedure_philhealth[$key];
				$procedureData->procedure_charge_patient  = $request->procedure_charge_patient[$key];
				$procedureData->procedure_charge_carewell = $request->procedure_charge_carewell[$key];
				$procedureData->procedure_remarks         = StaticFunctionController::nullableToString($request->procedure_remarks[$key],'string');
				$procedureData->procedure_disapproved     = StaticFunctionController::checkboxValue($request->procedure_disapproved[$key]);
				$procedureData->diagnosis_id              = 1;
				$procedureData->approval_id               = $approvalData->approval_id;
				$procedureData->save();
			}
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
		
		

		if($approvalData->save())
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
		$approval_doctor_actual_pf 			= 0;
		$approval_doctor_phil_charity    	= 0;
		$approval_doctor_charge_patient 	= 0;
		$approval_doctor_charge_carewell    = 0;

		$procedure_gross_amount 	= 0;
		$procedure_philhealth    	= 0;
		$procedure_charge_patient 	= 0;
		$procedure_charge_carewell  = 0;

		$data['approval_details'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->ApprovalDetails()->first();
		$data['charge_diagnosis'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->Diagnosis()->first();
		$data['_final_diagnosis'] = TblApprovalDiagnosisModel::where('approval_id',$approval_id)->Diagnosis()->get();
		$data['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$approval_id)->ProcedureDiagnosis()->get();
		$data['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$approval_id)->ApprovalDoctor()->get();
		
		foreach($data['_availed'] as $key=>$availed)
		{
			$procedure_gross_amount 	= $procedure_gross_amount 		+ $availed->procedure_gross_amount;
			$procedure_philhealth 		= $procedure_philhealth 		+ $availed->procedure_philhealth;
			$procedure_charge_patient 	= $procedure_charge_patient 	+ $availed->procedure_charge_patient;
			$procedure_charge_carewell 	= $procedure_charge_carewell 	+ $availed->procedure_charge_carewell;
		}
		foreach($data['_doctor_assigned'] as $key=>$doctor_assigned)
		{
			$approval_doctor_actual_pf 			= $approval_doctor_actual_pf 		+ $doctor_assigned->approval_doctor_actual_pf;
			$approval_doctor_phil_charity 		= $approval_doctor_phil_charity 	+ $doctor_assigned->approval_doctor_phil_charity;
			$approval_doctor_charge_patient 	= $approval_doctor_charge_patient 	+ $doctor_assigned->approval_doctor_charge_patient;
			$approval_doctor_charge_carewell 	= $approval_doctor_charge_carewell 	+ $doctor_assigned->approval_doctor_charge_carewell;
		}

		$data['procedure_gross_amount'] 	= $procedure_gross_amount;
		$data['procedure_philhealth']    	= $procedure_philhealth;
		$data['procedure_charge_patient'] 	= $procedure_charge_patient;
		$data['procedure_charge_carewell']  = $procedure_charge_carewell;

		$data['approval_doctor_actual_pf'] 			= $approval_doctor_actual_pf;
		$data['approval_doctor_phil_charity']    	= $approval_doctor_phil_charity;
		$data['approval_doctor_charge_patient'] 	= $approval_doctor_charge_patient;
		$data['approval_doctor_charge_carewell']    = $approval_doctor_charge_carewell;

		$data['grand_total']      = $approval_doctor_charge_carewell + $procedure_charge_carewell;
        $data['payee_company']    = $procedure_charge_carewell;
        $data['ajudication']      = TblApprovalAjudicationModel::where('approval_id',$approval_id)->User()->first();

		/*BELOW ARE FOR UPDATE DATA*/
		$approval                 = TblApprovalModel::where("approval_id",$approval_id)->first();
		$coverage_plan_id         = TblMemberCompanyModel::where('member_id',$approval->member_id)->where('tbl_member_company.archived',0)->value('coverage_plan_id');
		
		$data['_procedure'] 	  = TblMemberCompanyModel::CovaragePlanProcedure($approval->member_id,$approval->availment_id)->where('tbl_member_company.archived',0)->get();
        $data['_availment']       = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage_plan_id)->Availment()->get();
		$data['_provider']        = TblProviderModel::where('archived',0)->get();

		$data['_procedure_doctor']= TblDoctorProcedureModel::where('archived',0)->get();
		$data['_doctor']          = TblDoctorProviderModel::where('provider_id',$approval->provider_id)->Doctor()->where('tbl_doctor.archived',0)->get();
		
		$data['_payee']           = TblProviderPayeeModel::where('archived',0)->get();
		$data['_diagnosis']       = TblDiagnosisModel::where('archived',0)->get();
		$data['_specialization']  = TblSpecializationModel::get();

		return view('carewell.modal_pages.availment_approval_details',$data);
	}
    public static function update_insert_procedure($request)
    {
    	if($request['procedure_id']!=null||$request['procedure_id']!="")
    	{
    		foreach($request['procedure_id'] as $key=>$datas)
			{
				if($request['procedure_approval_id'][$key]==0)
				{
					$procedureData = new TblApprovalProcedureModel;
					$procedureData->procedure_id              = $request['procedure_id'][$key];
					$procedureData->procedure_gross_amount    = $request['procedure_gross_amount'][$key];
					$procedureData->procedure_philhealth      = $request['procedure_philhealth'][$key];
					$procedureData->procedure_charge_patient  = $request['procedure_charge_patient'][$key];
					$procedureData->procedure_charge_carewell = $request['procedure_charge_carewell'][$key];
					$procedureData->procedure_remarks         = $request['procedure_remarks'][$key];
					$procedureData->diagnosis_id              = 1;
					$procedureData->approval_id               = $request['approval_id'];
					$procedureData->save();
				}
				else
				{
					$procedureData['procedure_id']              = $request['procedure_id'][$key];
					$procedureData['procedure_gross_amount']    = $request['procedure_gross_amount'][$key];
					$procedureData['procedure_philhealth']      = $request['procedure_philhealth'][$key];
					$procedureData['procedure_charge_patient']  = $request['procedure_charge_patient'][$key];
					$procedureData['procedure_charge_carewell'] = $request['procedure_charge_carewell'][$key];
					$procedureData['procedure_remarks']         = $request['procedure_remarks'][$key];
					TblApprovalProcedureModel::where('procedure_approval_id',$request['procedure_approval_id'][$key])->update($procedureData);
				}
				
			}
    	}
    	
	}
	public static function update_insert_doctor($request)
	{
		foreach($request['doctor_id'] as $key=>$data)
		{
			if($request['approval_doctor_id'][$key]==0)
			{
				$doctorData = new TblApprovalDoctorModel;
				$doctorData->approval_doctor_actual_pf        = $request['approval_doctor_actual_pf'][$key];
				$doctorData->approval_doctor_phil_charity     = $request['approval_doctor_phil_charity'][$key];
				$doctorData->approval_doctor_charge_patient   = $request['approval_doctor_charge_patient'][$key];
				$doctorData->approval_doctor_charge_carewell  = $request['approval_doctor_charge_carewell'][$key];
				$doctorData->specialization_name              = $request['specialization_name'][$key];
				$doctorData->doctor_id                        = $data;
				$doctorData->doctor_procedure_id              = $request['doctor_procedure_id'][$key];
				$doctorData->approval_id                      = $request['approval_id'];
				$doctorData->save();
			}
			else
			{
				$doctorData['approval_doctor_actual_pf']        = $request['approval_doctor_actual_pf'][$key];
				$doctorData['approval_doctor_phil_charity']     = $request['approval_doctor_phil_charity'][$key];
				$doctorData['approval_doctor_charge_patient']   = $request['approval_doctor_charge_patient'][$key];
				$doctorData['approval_doctor_charge_carewell']  = $request['approval_doctor_charge_carewell'][$key];
				$doctorData['specialization_name']              = $request['specialization_name'][$key];
				$doctorData['doctor_id']                        = $request['doctor_id'][$key];
				$doctorData['doctor_procedure_id']              = $request['doctor_procedure_id'][$key];
				TblApprovalDoctorModel::where('approval_doctor_id',$request['approval_doctor_id'][$key])->update($doctorData);
			}
		}
	}
	public function availment_update_approval_submit(Request $request)
	{
	    /*AJUDICATED HERE*/
	    $user       			= StaticFunctionController::global();
	    $ajudicate['user_id'] 				= $user->user_id;
	    $ajudicate['approval_id'] 			= $request->approval_id;
	    $ajudicate['ajudication_created'] 	= Carbon::now();

	    $ajudication = TblApprovalAjudicationModel::where('approval_id',$request->approval_id);
	    if($ajudication->count()==0)
	    {
	    	$ajudication->insert($ajudicate);
	    }
	    else
	    {
	    	$ajudication->update($ajudicate);
	    }


		$approval = TblApprovalModel::where('approval_id',$request->approval_id)->first();
        if($approval->availment_id==$request->availment_id)
		{
			Self::update_insert_procedure($request->all());
		}
		else
		{
			TblApprovalProcedureModel::where('approval_id',$request->approval_id)->delete();
			
			if($request->procedure_id!=null||$request->procedure_id!="")
			{
				foreach($request->procedure_id as $key=>$datas)
				{
					$procedureData = new TblApprovalProcedureModel;
					$procedureData->procedure_id              = $request->procedure_id[$key];
					$procedureData->procedure_gross_amount    = $request->procedure_gross_amount[$key];
					$procedureData->procedure_philhealth      = $request->procedure_philhealth[$key];
					$procedureData->procedure_charge_patient  = $request->procedure_charge_patient[$key];
					$procedureData->procedure_charge_carewell = $request->procedure_charge_carewell[$key];
					$procedureData->procedure_remarks         = $request->procedure_remarks[$key];
					$procedureData->diagnosis_id              = 1;
					$procedureData->approval_id               = $request->approval_id;
					$procedureData->save();
				}
			}
			
		}
		if($approval->provider_id==$request->provider_id)
		{
			Self::update_insert_doctor($request->all());
		}
		else
		{
			TblApprovalDoctorModel::where('approval_id',$request->approval_id)->delete();
			
			foreach($request->doctor_id as $key=>$data)
			{
				$doctorData = new TblApprovalDoctorModel;
				$doctorData->approval_doctor_actual_pf        = $request->approval_doctor_actual_pf[$key];
				$doctorData->approval_doctor_phil_charity     = $request->approval_doctor_phil_charity[$key];
				$doctorData->approval_doctor_charge_patient   = $request->approval_doctor_charge_patient[$key];
				$doctorData->approval_doctor_charge_carewell  = $request->approval_doctor_charge_carewell[$key];
				$doctorData->specialization_name              = $request->specialization_name[$key];
				$doctorData->doctor_id                        = $request->doctor_id[$key];
				$doctorData->doctor_procedure_id              = $request->doctor_procedure_id[$key];
				$doctorData->approval_id                      = $request->approval_id;
				$doctorData->save();
			}
		}

		
		$approvalData['approval_complaint']         = $request->approval_complaint;
		$approvalData['approval_date_availed']      = $request->approval_date_availed;
		$approvalData['availment_id']               = $request->availment_id;
		$approvalData['provider_id']                = $request->provider_id;
		$checkApproval = TblApprovalModel::where('approval_id',$request->approval_id)->update($approvalData);
		
		return StaticFunctionController::returnMessage('success','APPROVAL');
		// foreach($request->final_diagnosis_id as $final_diagnosis_id)
		// {
		// 	$diagnosisData = new TblApprovalDiagnosisModel;
		// 	$diagnosisData->approval_diagnosis_type = '0';
		// 	$diagnosisData->diagnosis_id = $final_diagnosis_id;
		// 	$diagnosisData->approval_id = $approvalData->approval_id;
		// 	$diagnosisData->save();
		// }
		// if($checkApproval)
		// {
		// 	return StaticFunctionController::returnMessage('success','APPROVAL');
		// }
		// else
		// {
		// 	return StaticFunctionController::returnMessage('danger','APPROVAL');
		// }
     
	}

	public function approval_export_pdf($approval_id)
	{
    	$approval_doctor_actual_pf 			= 0;
		$approval_doctor_phil_charity    	= 0;
		$approval_doctor_charge_patient 	= 0;
		$approval_doctor_charge_carewell    = 0;

		$procedure_gross_amount 	= 0;
		$procedure_philhealth    	= 0;
		$procedure_charge_patient 	= 0;
		$procedure_charge_carewell  = 0;

		$data['approval_details'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->ApprovalDetails()->first();
		$data['charge_diagnosis'] = TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->Diagnosis()->first();
		$data['_final_diagnosis'] = TblApprovalDiagnosisModel::where('approval_id',$approval_id)->Diagnosis()->get();
		$data['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$approval_id)->ProcedureDiagnosis()->get();
		$data['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$approval_id)->ApprovalDoctor()->get();
		
		foreach($data['_availed'] as $key=>$availed)
		{
			$procedure_gross_amount 	= $procedure_gross_amount 		+ $availed->procedure_gross_amount;
			$procedure_philhealth 		= $procedure_philhealth 		+ $availed->procedure_philhealth;
			$procedure_charge_patient 	= $procedure_charge_patient 	+ $availed->procedure_charge_patient;
			$procedure_charge_carewell 	= $procedure_charge_carewell 	+ $availed->procedure_charge_carewell;
		}
		foreach($data['_doctor_assigned'] as $key=>$doctor_assigned)
		{
			$approval_doctor_actual_pf 			= $approval_doctor_actual_pf 		+ $doctor_assigned->approval_doctor_actual_pf;
			$approval_doctor_phil_charity 		= $approval_doctor_phil_charity 	+ $doctor_assigned->approval_doctor_phil_charity;
			$approval_doctor_charge_patient 	= $approval_doctor_charge_patient 	+ $doctor_assigned->approval_doctor_charge_patient;
			$approval_doctor_charge_carewell 	= $approval_doctor_charge_carewell 	+ $doctor_assigned->approval_doctor_charge_carewell;
		}

		$data['procedure_gross_amount'] 	= $procedure_gross_amount;
		$data['procedure_philhealth']    	= $procedure_philhealth;
		$data['procedure_charge_patient'] 	= $procedure_charge_patient;
		$data['procedure_charge_carewell']  = $procedure_charge_carewell;

		$data['approval_doctor_actual_pf'] 			= $approval_doctor_actual_pf;
		$data['approval_doctor_phil_charity']    	= $approval_doctor_phil_charity;
		$data['approval_doctor_charge_patient'] 	= $approval_doctor_charge_patient;
		$data['approval_doctor_charge_carewell']    = $approval_doctor_charge_carewell;

		$data['grand_total']      = $approval_doctor_charge_carewell + $procedure_charge_carewell;
        $data['payee_company']    = $procedure_charge_carewell;
        $data['ajudication']      = TblApprovalAjudicationModel::where('approval_id',$approval_id)->User()->first();


	    $format["format"] 			= "Legal";
	    $format["default_font"] 	= "sans-serif";
	    $pdf = PDF::loadView('carewell.additional_pages.approval_export_pdf', $data, [], $format);
	    return $pdf->stream('document.pdf');
	}

	public function availment_remove_approval_details_submit(Request $request)
	{
		$ref = $request->ref;
		
		switch ($ref)
		{
			case 'PROCEDURE':
			     $remove = TblApprovalProcedureModel::where('procedure_approval_id',$request->id)->delete();
			break;

			case 'PHYSICIAN':
				$remove = TblApprovalDoctorModel::where('approval_doctor_id',$request->id)->delete();
			break;
			case 'doctor payee':
				$remove = TblApprovalPayeeModel::where('approval_payee_id',$request->id)->delete();
			break;		
			case 'other payee':
				$remove = TblApprovalPayeeModel::where('approval_payee_id',$request->id)->delete();
			break;
		}
		if($remove)
		{
            $message = StaticFunctionController::customMessage("success", $ref." successfully deleted!");
		}
		else
		{
			$message = StaticFunctionController::customMessage("danger","Transaction Failed");
		}
		return $message;
     }
     public function availment_create_new_provider($warning)
     {
     	$data['warning']         = $warning;
     	$data['user']            = StaticFunctionController::global();
     	return view('carewell.modal_pages.availment_new_provider_doctor',$data);
     }
     public function availment_create_new_provider_submit(Request $request)
     {
     	$provider_id = StaticFunctionController::getIdNorName($request->provider_name,'provider');
    	if($provider_id==$request->provider_name)
    	{
    		$providerData = new TblProviderModel;
	    	$providerData->provider_name            = $request->provider_name;
	    	$providerData->provider_rvs             = $request->provider_rvs;
	    	$providerData->provider_contact_person  = 'N/A';
	    	$providerData->provider_telephone_number= 'N/A';
	    	$providerData->provider_mobile_number   = 'N/A';
	    	$providerData->provider_contact_email   = 'N/A';
	    	$providerData->provider_address         = 'N/A';
	    	$providerData->provider_created         = Carbon::now();
	    	$providerData->save();
          	$notif    			= "Provider Inserted";
    	    $inserted 			= StaticFunctionController::provider_add_tag_doctor($request->doctorProviderData,$providerData->provider_id);
    		$new_provider_id 	= $providerData->provider_id;
    		$new_provider_name 	= $providerData->provider_name;
    	}
    	else
    	{
    		$inserted 			= StaticFunctionController::provider_add_tag_doctor($request->doctorProviderData,$provider_id);
          	$notif    			= "Provider Exist";
          	$new_provider_id 	= $provider_id;
          	$new_provider_name 	= TblProviderModel::where('provider_id',$provider_id)->value('provider_name');
		}
		$message  	= StaticFunctionController::customMessage('success',$notif.' and '.$inserted.' doctors tag!'); 
		$_doctors 	= TblDoctorProviderModel::where('provider_id',$new_provider_id)->Doctor()->get();
		$data['_doctor_list'] = '<option value="0">-SELECT  DOCTOR-';
      	foreach($_doctors as $doctor)
      	{
            $data['_doctor_list']     .= '<option value='.$doctor->doctor_id.'>'.$doctor->doctor_full_name;
      	}
        return  response()->json(array('provider_id' => $new_provider_id,'provider_name' => $new_provider_name,'doctor_list' => $data['_doctor_list'],'message'=>$message));
	}
	public function availment_add_approval_details($ref,$id)
	{
		switch ($ref)
		{
			case 'procedure':
				$approval 				= TblApprovalModel::where("approval_id",$id)->first();
				$data['_procedure'] 	= TblMemberCompanyModel::CovaragePlanProcedure($approval->member_id,$approval->availment_id)->where('tbl_member_company.archived',0)->get();
		        $data['ref']        	= $ref;
		        $data['title']      	= 'PROCEDURE';
		        $data['approval_id'] 	= $id;
		     break;
		}
		return view('carewell.modal_pages.availment_approval_add_details',$data);
	}

	public function availment_add_approval_details_submit(Request $request)
	{
		switch ($request->ref)
		{
			case 'procedure':
				foreach($request->procedure_id as $key=>$datas)
				{
					if($request->procedure_id[$key]!="")
					{
						$procedureData = new TblApprovalProcedureModel;
						$procedureData->procedure_id              = $request->procedure_id[$key];
						$procedureData->procedure_gross_amount    = $request->procedure_gross_amount[$key];
						$procedureData->procedure_philhealth      = $request->procedure_philhealth[$key];
						$procedureData->procedure_charge_patient  = $request->procedure_charge_patient[$key];
						$procedureData->procedure_charge_carewell = $request->procedure_charge_carewell[$key];
						$procedureData->procedure_remarks         = $request->procedure_remarks[$key];
						$procedureData->diagnosis_id              = 1;
						$procedureData->approval_id               = $request->approval_id;
						$procedureData->save();
					}
				}
				$message =  StaticFunctionController::customMessage('success','PROCEDURE ADDED'); 
			break;
		}
		return $message;
	}
	/*PAYABLE*/
	public function payable()
	{
		$data['page']            = 'Payable';
		$data['user']            = StaticFunctionController::global();
		$data['_provider']       = TblProviderModel::where('archived',0)->get();
		$data['_payable_open']   = TblPayableModel::where('tbl_payable.archived',0)->PayableInfo()->paginate(10);
		$data['_payable_close']  = TblPayableModel::where('tbl_payable.archived',1)->PayableInfo()->paginate(10);
		foreach ($data['_payable_open'] as $key => $payable) 
		{
			
			$data['_payable_open'][$key]['payable_age']   		= date_create($payable->payable_due)->diff(date_create('today'))->m.' Months and '.date_create($payable->payable_due)->diff(date_create('today'))->d.' Days';
			$data['_payable_open'][$key]['approval_number']    	=  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
		
		}
		foreach ($data['_payable_close'] as $key => $payable) 
		{
			$data['_payable_close'][$key]['payable_age']   		= date_create($payable->payable_due)->diff(date_create('today'))->m.' Months and '.date_create($payable->payable_due)->diff(date_create('today'))->d.' Days';
			$data['_payable_close'][$key]['approval_number']    =  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
		}
		return view('carewell.pages.payable_center',$data);
	}

	public function payable_create()
	{
		$data['_provider']  = TblProviderModel::where('archived',0)->get();
		$data['_approval_active']  = TblApprovalModel::where('tbl_member_company.archived',0)->where('tbl_approval.archived',0)->ApprovalInfo()->get();
		return view('carewell.modal_pages.payable_create',$data);
	}

	public function payable_create_get_approval($provider_id)
	{
		$data['_approval_active']  = TblApprovalModel::where('tbl_approval.provider_id',$provider_id)->where('tbl_member_company.archived',0)->where('tbl_approval.archived',0)->ApprovalInfo()->get();
		return view('carewell.additional_pages.payable_get_approval',$data);
	}
	
	public function payable_create_submit(Request $request)
	{
		$user         = StaticFunctionController::global();
		$payableDatas = new TblPayableModel;
		$payableDatas->payable_number      = StaticFunctionController::updateReferenceNumber('payable');
		$payableDatas->payable_soa_number  = $request->payable_soa_number;
		$payableDatas->payable_recieved    = $request->payable_recieved; 
		$payableDatas->payable_due         = $request->payable_due;
		$payableDatas->payable_created     = Carbon::now();
		$payableDatas->provider_id         = $request->provider_id;  
		$payableDatas->user_id             = $user->user_id;
		$payableDatas->save();
		foreach($request->approval_id as $approval_id)
		{
			$payApprovalData = new TblPayableApprovalModel;
			$payApprovalData->approval_id = $approval_id; 
			$payApprovalData->payable_id  = $payableDatas->payable_id;
			$payApprovalData->save();
	        if($payApprovalData->save())
	        {
	          	$archived['archived'] = '2';
				TblApprovalModel::where('tbl_approval.approval_id',$approval_id)->update($archived);
	        }
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
		$data['_payable_approval']  = TblPayableApprovalModel::where('payable_id',$payable_id)->where('tbl_member_company.archived',0)->PayableApproval()->get();
	     $data['link']               = "payable/payable_details/export_excel/".$payable_id;
		foreach ($data['_payable_approval'] as $key => $payable_approval) 
		{
			$TblApprovalDoctorModel                             = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id);
			$data['_payable_approval'][$key]['availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)->Procedure()->get();
			$data['_payable_approval'][$key]['doctor']          = $TblApprovalDoctorModel->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id')->get();
			$data['_payable_approval'][$key]['doctor_fee']      = $TblApprovalDoctorModel->sum('approval_doctor_charge_carewell');
			$data['_payable_approval'][$key]['charge_carewell'] = $TblApprovalDoctorModel->sum('approval_doctor_charge_carewell');                                          
		}
		return view('carewell.modal_pages.payable_details',$data);
	}
	public function payable_details_export_excel($payable_id)
	{
		$data['_provider']          = TblProviderModel::where('archived',0)->get();
		$data['payable_details']    = TblPayableModel::where('tbl_payable.payable_id',$payable_id)->PayableInfo()->first();
		$data['_payable_approval']  = TblPayableApprovalModel::where('payable_id',$payable_id)->where('tbl_member_company.archived',0)->PayableApproval()->get();
	    $data['link']               = "/payable/payable_details/export_excel/".$payable_id;
		foreach ($data['_payable_approval'] as $key => $payable_approval) 
		{
			$TblApprovalDoctorModel                             = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id);
			$data['_payable_approval'][$key]['availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)->Procedure()->get();
			$data['_payable_approval'][$key]['doctor']          = $TblApprovalDoctorModel->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id')->get();
			$data['_payable_approval'][$key]['doctor_fee']      = $TblApprovalDoctorModel->sum('approval_doctor_charge_carewell');
			$data['_payable_approval'][$key]['charge_carewell'] = $TblApprovalDoctorModel->sum('approval_doctor_charge_carewell');                                          
		}

		Excel::create("PAYABLE - ".$data['payable_details']->provider_name,function($excel) use ($data)
		{
			$excel->sheet('clients',function($sheet) use ($data)
			{
				$sheet->loadView('carewell.additional_pages.payable_details_export_excel',$data);
			});
		})->download('xls');
		
	}
	public function payable_update_submit(Request $request)
	{
		$update['payable_soa_number'] = $request->payable_soa_number;
		$update['payable_recieved'] 	= $request->payable_recieved;
		$update['payable_due'] 		= $request->payable_due;
		$check = TblPayableModel::where('payable_id',$request->payable_id)->update($update);
		if($check)
		{
	        return StaticFunctionController::returnMessage('success','PAYABLE');
		}
		else
		{
	        return StaticFunctionController::returnMessage('danger','PAYABLE');
		}
	}
	public function payable_mark_close($payable_id)
	{
		$approval_doctor_charge_carewell    = 0;
		$procedure_charge_carewell  		= 0;
		$data['_payable_approval']   		= TblPayableApprovalModel::where('payable_id',$payable_id)->PayableStatus()->get();
        foreach($data['_payable_approval'] as $keys=> $approval)
        {
        	$data['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$approval->approval_id)->ProcedureDiagnosis()->get();
			$data['_payable_approval'][$keys]['doctor_assigned'] = $data['_doctor_assigned']= TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$approval->approval_id)->ApprovalDoctor()->get();
			
			foreach($data['_availed'] as $key=>$availed)
			{
				$procedure_charge_carewell 	= $procedure_charge_carewell 	+ $availed->procedure_charge_carewell;
			}
			foreach($data['_doctor_assigned'] as $key=>$doctor_assigned)
			{
				$approval_doctor_charge_carewell 	= $approval_doctor_charge_carewell 	+ $doctor_assigned->approval_doctor_charge_carewell;
			}
			$data['_payable_approval'][$keys]['procedure_charge_carewell']  = $procedure_charge_carewell;
	    }
	    return view('carewell.modal_pages.payable_mark_close',$data);
    }
    public function payable_mark_close_submit(Request $request)
    {
    	foreach($request->doctor_approval_id as $key=>$payee)
    	{
    		$payablePayee = new TblPayablePayeeModel;
	    	$payablePayee->payable_check_number 	= $request->payable_check_number[$key];
	    	$payablePayee->payable_release_date 	= $request->payable_release_date[$key];
	    	$payablePayee->payable_check_date 		= $request->payable_check_date[$key];
	    	$payablePayee->payable_cv_number 		= $request->payable_cv_number[$key];
	    	$payablePayee->payable_amount 			= $request->payable_amount[$key];
	    	$payablePayee->payable_bank_name 		= $request->payable_bank_name[$key];
	    	$payablePayee->payable_refrence_number 	= $request->payable_refrence_number[$key];
	    	$payablePayee->payable_payee_created 	= Carbon::now();
	    	$payablePayee->doctor_approval_id 		= $request->doctor_approval_id[$key];
	    	$payablePayee->provider_id 				= $request->provider_id[$key];
	    	$payablePayee->approval_id 				= $request->approval_id;
	    	$payablePayee->payable_id 				= $request->payable_id;
	    	$payablePayee->save();
	    }
	    $archived['archived'] 	= 1; 
	    $payable 				= TblPayableModel::where('payable_id',$request->payable_id)->update($archived);
	    $_payable_approval 		= TblPayableApprovalModel::where('payable_id',$request->payable_id)->get(); 
	    foreach($_payable_approval as $payable_approval)
	    {
	    	$approval = TblApprovalModel::where('approval_id',$payable_approval->approval_id)->update($archived);
	    }
	    return   StaticFunctionController::customMessage('success','PAYABLE CLOSED'); 
	}
	public function payable_export_pdf($payable_id)
	{
		$procedure_total   = 0;
		$doctor_total      = 0;
	   	$data['payable_details']    = TblPayableModel::where('tbl_payable.payable_id',$payable_id)->PayableInfo()->first();
		$data['_payable_approval']  = TblPayableApprovalModel::where('tbl_payable_approval.payable_id',$payable_id)->ApprovalDetails()->where('tbl_member_company.archived',0)->where('tbl_payable_approval.archived',0)->get();
	    foreach ($data['_payable_approval'] as $key => $payable_approval) 
		{
			$data['_payable_approval'][$key]['charge_diagnosis'] = TblApprovalModel::where('tbl_approval.approval_id',$payable_approval->approval_id)->Diagnosis()->first();
			$data['_payable_approval'][$key]['_final_diagnosis'] = TblApprovalDiagnosisModel::where('approval_id',$payable_approval->approval_id)->Diagnosis()->get();
			$data['_payable_approval'][$key]['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)->ProcedureDiagnosis()->get();
			$data['_payable_approval'][$key]['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id)->ApprovalDoctor()->get();
			$data['_payable_approval'][$key]['_payee_doctor']    = TblApprovalPayeeModel::where('approval_id',$payable_approval->approval_id)->PayeeDoctor()->get();
			$data['_payable_approval'][$key]['_payee_other']     = TblApprovalPayeeModel::where('approval_id',$payable_approval->approval_id)->where('type','payee')->get();
			$data['_payable_approval'][$key]['total_procedure']  = TblApprovalTotalModel::where('approval_id',$payable_approval->approval_id)->where('total_type','procedure')->first();
			$data['_payable_approval'][$key]['total_doctor']     = TblApprovalTotalModel::where('approval_id',$payable_approval->approval_id)->where('total_type','doctor')->first();

			$procedure_total   =   $procedure_total   + $procedure_totals  = TblApprovalTotalModel::where('approval_id',$payable_approval->approval_id)->where('total_type','procedure')->value('total_charge_carewell');
			$doctor_total      =   $doctor_total      + $doctor_totals     = TblApprovalTotalModel::where('approval_id',$payable_approval->approval_id)->where('total_type','doctor')->value('total_charge_carewell');
		    
		}
		$data['procedure_total'] = $procedure_total;
		$data['doctor_total']    = $doctor_total;
        $format["format"] 			= "Legal";
	    $format["default_font"] 	= "sans-serif";
	    $pdf = PDF::loadView('carewell.additional_pages.payable_details_export_pdf', $data, [], $format);
	    return $pdf->stream('document.pdf');
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
		$data['page']     	= 'Ending Number Per Month Reports';
		$data['user']     	= StaticFunctionController::global();
		$data['_company'] 	= TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);

		$data['link']		= '/reports/ending_number_per_reports/export_excel/'.date('Y');
        $data['date']      	= $date  = date('Y');
        
        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
		$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
		
		foreach($data['_company'] as $key => $company) 
		{
			$parameter = array($company->coverage_plan_id,$company->company_id);
			$data['_company'][$key]['company_coverage'] = TblMemberCompanyModel::Approval($company->coverage_plan_id,$company->company_id)->get();

			foreach($_param_name as $param=>$param_name)
            {
            	$data['_company'][$key][''.$_param_name[$param].''] 	= TblMemberCompanyModel::CountAvailment($parameter,$date.'-'.$_param_val[$param].'%')->count(); 
            }			      
		}

		return view('carewell.pages.reports_end_per_month',$data);

	}

	public function reports_availment_per_month()
		{
			$data['page']     = 'Availment per Month Summary';
			$data['user']     = StaticFunctionController::global();
			$data['_company'] = TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);
				                    
			$data['link']		= '/reports/availment_per_month_summary/export_excel/'.date('Y');
	        $data['date']      	= $date  = date('Y');

	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 

			foreach($data['_company'] as $key => $company) 
			{
				$parameter = array($company->coverage_plan_id,$company->company_id);

				$data['_company'][$key]['company_coverage'] = TblMemberCompanyModel::where('tbl_member_company.archived',0)
				                                             ->where('coverage_plan_id',$company->coverage_plan_id)
				                                             ->where('company_id',$company->company_id)
				                                             ->join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
				                                             ->get();

				$data['_company'][$key]['count'] 			= TblMemberCompanyModel::CountAvailment($parameter,$date)->count();

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_company'][$key][''.$_param_name[$param].''] 	= TblMemberCompanyModel::CountAvailment($parameter,$date.'-'.$_param_val[$param].'%')->count(); 
	            }	
			}

			return view('carewell.pages.reports_availment_per_month',$data);
		}

	public function reports_availment_monitoring()
		{
			$data['page']     = 'Availment per Month Monitoring Summary';
			$data['user']     = StaticFunctionController::global();
			$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

			$data['link']		= '/reports/availment_monitoring/export_excel/'.date('Y');
	        $data['date']      	= $date  = date('Y');

	        $data['count_approval'] = TblApprovalModel::where('archived',0)->where('approval_created','LIKE','%'.$date.'%')->count();
	        $data['sum_approval'] = TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
	                ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
	            	->first();

	            	if($data['sum_approval']->total_gross == null)
	            	{
	            		$data['sum_approval']->total_gross = 0;
	            	}
	        
	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 

			foreach ($data['_availment'] as $key => $availment)
			{
				$data['_availment'][$key]['count'] 		= TblApprovalModel::where('availment_id',$availment->availment_id)
													->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
													->where('archived',0)
													->count();

				$data['_availment'][$key]['count_sum']	= TblApprovalModel::where('availment_id',$availment->availment_id)
												    ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
									            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
									            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
									            	->first();

	            	if($data['_availment'][$key]['count_sum']->total_gross == null)
	            	{
	            		$data['_availment'][$key]['count_sum']->total_gross = 0;
	            	}

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_availment'][$key][$_param_name[$param]]					= TblApprovalModel::where('availment_id',$availment->availment_id)->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')->count();

	            	$data['_availment'][$key][$_param_name[$param].'_member_avail']	= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')->count();

	            	$data['_availment'][$key][$_param_name[$param].'_amount']		= TblApprovalModel::where('availment_id',$availment->availment_id)
																	            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																	            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
																	            	->first();

	            	if($data['_availment'][$key][$_param_name[$param].'_amount']->total_gross == null)
	            	{
	            		$data['_availment'][$key][$_param_name[$param].'_amount']->total_gross = 0;
	            	}

	            	$data['_availment'][$key][$_param_name[$param].'_total_amount']	= TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																	            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
																	            	->first();

					if( $data['_availment'][$key][$_param_name[$param].'_total_amount']->total_gross == null)
	            	{
	            		$data['_availment'][$key][$_param_name[$param].'_total_amount']->total_gross = 0;
	            	}
	            }
			}

			return view('carewell.pages.reports_availment_monitoring_report',$data);
		}

	public function reports_breakdown()
		{
			$data['page']     = 'Breakdown Reports';
			$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);

			$data['user']     = StaticFunctionController::global();

			$data['link']		= '/reports/reports_breakdown/export_excel/'.date('Y-m');
	        $data['date']      = date('Y-m');
			
			foreach ($data['_company'] as $key => $company) 
			{

				$data['_company'][$key]['count_mem'] = TblMemberCompanyModel::where('archived',0)->where('company_id',$company->company_id)->distinct('member_id')->count('member_id'); 

	            $data['_company'][$key]['count_ape'] = TblApprovalModel::GetAvailment($company->company_id,1,date('Y-m'))->count(); // Annual Physical Examination
	            $data['_company'][$key]['count_con'] = TblApprovalModel::GetAvailment($company->company_id,2,date('Y-m'))->count(); // Outpatient Services(Consultation)
	            $data['_company'][$key]['count_lab'] = TblApprovalModel::GetAvailment($company->company_id,3,date('Y-m'))->count(); // Outpatient Services(Laboratory)
	            $data['_company'][$key]['count_mop'] = TblApprovalModel::GetAvailment($company->company_id,4,date('Y-m'))->count(); // Minor Operation
	            $data['_company'][$key]['count_emc'] = TblApprovalModel::GetAvailment($company->company_id,5,date('Y-m'))->count(); // Emergency Cases
	            $data['_company'][$key]['count_cot'] = TblApprovalModel::GetAvailment($company->company_id,6,date('Y-m'))->count(); // Confinement
	            $data['_company'][$key]['count_den'] = TblApprovalModel::GetAvailment($company->company_id,7,date('Y-m'))->count(); // Dental
	            $data['_company'][$key]['count_fas'] = TblApprovalModel::GetAvailment($company->company_id,8,date('Y-m'))->count(); //Financial Assistance
			}	

			return view('carewell.pages.reports_breakdown',$data);
		}

	public function reports_company_availment()
		{
			$data['page'] 		= 'Company Monthly Availment Report';
			$data['user']    	= StaticFunctionController::global();
			$data['_company'] 	= TblCompanyModel::where('archived',0)->paginate(10);
			$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

			$data['link']		= '/reports/reports_company_availment/export_excel/'.date('Y');
	        $data['date']      	=  $date = date('Y');

	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
			
			$data['grand_total_all'] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'%')
					                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
														            ->where('tbl_member_company.archived',0)
																	->count();

			foreach ($data['_company'] as $key => $company) 
			{

				$data['_company'][$key]['availment']  = TblAvailmentModel::where('archived',0)->get();

				foreach($data['_company'][$key]['availment'] as $avail=>$availment)
				{
					$data['_company'][$key]['availment'][$avail]['total'] 	= TblApprovalModel::where('availment_id',$availment->availment_id)
																			->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																            ->where('tbl_member_company.company_id',$company->company_id)
																            ->where('tbl_member_company.archived',0)
																			->count();

					$data['_company'][$key]['total_all'] 					= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'%')
							                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																            ->where('tbl_member_company.company_id',$company->company_id)
																            ->where('tbl_member_company.archived',0)
																			->count();

					foreach($_param_name as $param=>$param_name)
		            {
		            	$data['_company'][$key]['availment'][$avail][$_param_name[$param]]	= TblApprovalModel::where('availment_id',$availment->availment_id)->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																			            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																			            	->where('tbl_member_company.company_id',$company->company_id)
																			            	->where('tbl_member_company.archived',0)
																			            	->count();

						$data['_company'][$key][$_param_name[$param].'_total']				= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																			            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																			            	->where('tbl_member_company.company_id',$company->company_id)
																			            	->where('tbl_member_company.archived',0)
																			            	->count();

			            $data['_company'][$key][$_param_name[$param].'_grand_total']		= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																			            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																			            	->where('tbl_member_company.archived',0)
																			            	->count();									            	
		            }

				}
			}
			
			return view('carewell.pages.reports_company_availment',$data);
		}

	public function reports_consolidation()
		{
			$data['page']       = 'Consolidation Reports';
			$data['_availment'] = TblAvailmentModel::where('availment_parent_id',0)->get();
			$data['user']       = StaticFunctionController::global();

			return view('carewell.pages.reports_consolidation',$data);
		}

	public function reports_active_per_month()
		{
			$data['page']     = 'Active Member Per Month Report';
			$data['user']     = StaticFunctionController::global();
			// $data['_company'] = TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);
			$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);
			$data['_deployment'] = TblCompanyDeploymentModel::get();
			$data['_payment'] = TblPaymentModeModel::get();
	 			                    
			$data['link']		= '/reports/active_memeber_report/export_excel/'.date('Y');
	        $data['date']      	= $date  = date('Y');

	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 

			foreach($data['_company'] as $key => $company) 
			{
					foreach($_param_name as $param=>$param_name)
		            {
		            	$data['_company'][$key][$_param_name[$param]] 	= TblMemberCompanyModel::where('company_id',$company->company_id)
		            	->where('member_transaction_date','LIKE','%'.$date.'-'.$_param_val[$param].'%')
		            	->where('archived',0)
		            	->count();
		            }			      
			}

			return view('carewell.pages.reports_active_member_per_month',$data);
		}

	public function reports_payment_report()
	{
		$data['page']       = 'Payment Reports';
		$data['user']       = StaticFunctionController::global();
		$data['_company']   = TblCompanyModel::where('archived',0)->paginate(10);
		$data['_member']    = TblMemberModel::where('tbl_member.archived',0)->where('tbl_member_company.archived',0)->Member()->paginate(10);
		return view('carewell.pages.reports_payment_report',$data);
	}

	public function reports_payment_report_member($member_id)

	{
		$new_year           = date('Y'); 
		$payment_mode 		= 'SEMI-MONTHLY';
		$data['member_id'] 	= $member_id;
		$data['link'] 		= '/reports/payment_report/excel/0/'.$payment_mode.'/'.$member_id;
		$data['_payment']   = TblCalPaymentModel::where('tbl_cal_payment.archived',1)->where('member_id',$member_id)->select(DB::raw("YEAR(cal_payment_start) as year"))->groupby('year')->orderBy('year','ASC')->get();
		foreach($data['_payment'] as $key=> $year)
		{
			$TblCalPaymentModel = TblCalPaymentModel::where('tbl_cal_payment.member_id',$member_id)->orderBy('cal_payment_start','ASC')
			                                        ->whereYear('tbl_cal_payment.cal_payment_start', '=', $year->year)
			                                        ->where('tbl_cal_payment.archived',1);
	          
	          $data['_payment'][$key]['cal_payment'] = $TblCalPaymentModel->CalInfo()->get();
	        	$date                                  = $TblCalPaymentModel->first();
			$data['_payment'][$key]['colspan']     = StaticFunctionController::moth_reference($date->cal_payment_start);
			
		}
		return view('carewell.modal_pages.reports_payment_report_member',$data);
	}

	public function reports_payment_member_excel($new_year,$payment_mode,$member_id)
		{
			$data['member_id'] 	= $member_id;
			$data['link'] 		= '/reports/payment_report/excel/'.$new_year.'/'.$payment_mode.'/'.$member_id;
			$data['_payment']   = TblCalPaymentModel::where('member_id',$member_id)->select(DB::raw("YEAR(cal_payment_start) as year"))->groupby('year')->orderBy('year','ASC')->get();
			foreach($data['_payment'] as $key=> $year)
			{
				$TblCalPaymentModel = TblCalPaymentModel::where('tbl_cal_payment.member_id',$member_id)->orderBy('cal_payment_start','ASC')
				                                        ->whereYear('tbl_cal_payment.cal_payment_start', '=', $year->year);
		          
		          $data['_payment'][$key]['cal_payment'] = $TblCalPaymentModel->CalInfo()->get();
		        	$date                                  = $TblCalPaymentModel->first();
				$data['_payment'][$key]['colspan']     = StaticFunctionController::moth_reference($date->cal_payment_start);
			}

			Excel::create("MEMBER PAYMENT REPORT",function($excel) use ($data)
			{
				$excel->sheet('clients',function($sheet) use ($data)
				{
					$sheet->loadView('carewell.additional_pages.reports_member_payment_excel',$data);
				});
			})->download('xls');
		}

	public function reports_end_per_month_export_excel($date)
		{
			$data['page']     	= 'Ending Number Per Month Reports';
			$data['user']     	= StaticFunctionController::global();
			$data['_company'] 	= TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);

			$data['link']		= '/reports/ending_number_per_reports/export_excel/'.date('Y');
	        $data['date']      	= $date;
	        
	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
			
			foreach($data['_company'] as $key => $company) 
			{
				$parameter = array($company->coverage_plan_id,$company->company_id);
				$data['_company'][$key]['company_coverage'] = TblMemberCompanyModel::Approval($company->coverage_plan_id,$company->company_id)->get();

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_company'][$key][''.$_param_name[$param].''] 	= TblMemberCompanyModel::CountAvailment($parameter,$date.'-'.$_param_val[$param].'%')->count(); 
	            	
	            	$data['_company'][$key][$_param_name[$param].'_total'] 	= TblMemberCompanyModel::join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
														                ->where('tbl_member_company.archived',0)
														                ->where('coverage_plan_id',$company->coverage_plan_id)
														                ->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$_param_val[$param].'%')
														                ->count();
	            }			      
			}

			Excel::create("ENDING NUMBER PER MONTH ".$date,function($excel) use ($data)
			{
				$excel->sheet('clients',function($sheet) use ($data)
				{
					$sheet->loadView('carewell.additional_pages.ending_number_per_month_export_excel',$data);
				});
			})->download('xls');
		}

	public function reports_availment_per_month_export_excel($date)
		{
			$data['page']     = 'Availment per Month Summary';
			$data['user']     = StaticFunctionController::global();
			$data['_company'] = TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);
				                    
			$data['link']		= '/reports/availment_per_month_summary/export_excel/'.$date;
	        $data['date']      	= $date;

	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
			$_param_key			= array(0,1,2,3,4,5,6,7,8,9,10,11);

			$param_name_key = array_combine($_param_key, $_param_name);
			$param_val_key = array_combine($_param_key, $_param_val);

			$data['total_count'] = TblMemberCompanyModel::where('tbl_member_company.archived',0)
				                                        ->join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
				                                        ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
				                                        ->count();     

			foreach ($param_name_key as $key => $_param_key) 
			{
				$data['total'][$key] = TblMemberCompanyModel::where('tbl_member_company.archived',0)
				                                        ->join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
				                                        ->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$param_val_key[$key].'%')
				                                        ->count(); 	                                                              
			}



			foreach($data['_company'] as $key => $company) 
			{
				$parameter = array($company->coverage_plan_id,$company->company_id);

				$data['_company'][$key]['company_coverage'] = TblMemberCompanyModel::where('tbl_member_company.archived',0)
				                                             ->where('coverage_plan_id',$company->coverage_plan_id)
				                                             ->where('company_id',$company->company_id)
				                                             ->join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
				                                             ->get();

				$data['_company'][$key]['count'] 			= TblMemberCompanyModel::CountAvailment($parameter,$date)->count();

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_company'][$key][''.$_param_name[$param].''] 	= TblMemberCompanyModel::CountAvailment($parameter,$date.'-'.$_param_val[$param].'%')->count(); 
	            }	
			}
	
			Excel::create("AVAILMENT PER MONTH SUMMARY ".$date,function($excel) use ($data)
				{
					$excel->sheet('clients',function($sheet) use ($data)
					{
						$sheet->loadView('carewell.additional_pages.reports_availment_per_month_export_excel',$data);
					});
				})->download('xls');
		}

	public function reports_availment_monitoring_export_excel($date)
		{
			$data['page']     = 'Availment per Month Summary Monitoring';
			$data['user']     = StaticFunctionController::global();
			$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

			$data['date'] = $date;

			 $data['count_approval'] = TblApprovalModel::where('archived',0)->where('approval_created','LIKE','%'.$date.'%')->count();
	        $data['sum_approval'] = TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
	                ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
	            	->first();

	            	if($data['sum_approval']->total_gross == null)
	            	{
	            		$data['sum_approval']->total_gross = 0;
	            	}
	        
	        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
			$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 

			foreach ($data['_availment'] as $key => $availment)
			{
				$data['_availment'][$key]['count'] = TblApprovalModel::where('availment_id',$availment->availment_id)
													->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
													->where('archived',0)	
													->count();

				$data['_availment'][$key]['count_sum']	= TblApprovalModel::where('availment_id',$availment->availment_id)
				    ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
	            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
	            	->first();

	            	if($data['_availment'][$key]['count_sum']->total_gross == null)
	            	{
	            		$data['_availment'][$key]['count_sum']->total_gross = 0;
	            	}

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_availment'][$key][$_param_name[$param]]	= TblApprovalModel::where('availment_id',$availment->availment_id)->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')->count();

	            	$data['_availment'][$key][$_param_name[$param].'_member_avail']	= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')->count();

	            	$data['_availment'][$key][$_param_name[$param].'_amount']	= TblApprovalModel::where('availment_id',$availment->availment_id)
																            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
																            	->first();

	            	$data['_availment'][$key][$_param_name[$param].'_total_amount']	= TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																	            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																	            	->select([DB::raw("SUM(total_gross_amount) as total_gross")])
																	            	->first();

	            	if($data['_availment'][$key][$_param_name[$param].'_amount']->total_gross == null)
	            	{
	            		$data['_availment'][$key][$_param_name[$param].'_amount']->total_gross = 0;
	            	}

	            	if( $data['_availment'][$key][$_param_name[$param].'_total_amount']->total_gross == null)
	            	{
	            		$data['_availment'][$key][$_param_name[$param].'_total_amount']->total_gross = 0;
	            	}
	            }
			}

				Excel::create("AVAILMENT PER MONTH SUMMARY MONITORING".$date,function($excel) use ($data)
				{
					$excel->sheet('clients',function($sheet) use ($data)
					{
						$sheet->loadView('carewell.additional_pages.reports_availment_monitoring_report_export_excel',$data);
					});
				})->download('xls');
		}

	public function reports_breakdown_export_excel($date)
	{

		$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);

		$data['link']		= '/reports/breakdown/export_excel/'.$date;
       	$data['date']      = $date;

		$data['total_mem'] = 0; 
		$data['total_ape'] = 0; 
		$data['total_con'] = 0; 
		$data['total_lab'] = 0; 
		$data['total_mop'] = 0; 
		$data['total_emc'] = 0; 
		$data['total_cot'] = 0; 
		$data['total_den'] = 0; 
		$data['total_fas'] = 0; 
		
		foreach ($data['_company'] as $key => $company) 
		{

			$data['_company'][$key]['count_mem'] = TblMemberCompanyModel::where('archived',0)->where('company_id',$company->company_id)->distinct('member_id')->count('member_id'); 
            $data['_company'][$key]['count_ape'] = TblApprovalModel::GetAvailment($company->company_id,1,$date)->count(); // Annual Physical Examination
            $data['_company'][$key]['count_con'] = TblApprovalModel::GetAvailment($company->company_id,2,$date)->count(); // Outpatient Services(Consultation)
            $data['_company'][$key]['count_lab'] = TblApprovalModel::GetAvailment($company->company_id,3,$date)->count(); // Outpatient Services(Laboratory)
            $data['_company'][$key]['count_mop'] = TblApprovalModel::GetAvailment($company->company_id,4,$date)->count(); // Minor Operation
            $data['_company'][$key]['count_emc'] = TblApprovalModel::GetAvailment($company->company_id,5,$date)->count(); // Emergency Cases
            $data['_company'][$key]['count_cot'] = TblApprovalModel::GetAvailment($company->company_id,6,$date)->count(); // Confinement
            $data['_company'][$key]['count_den'] = TblApprovalModel::GetAvailment($company->company_id,7,$date)->count(); // Dental
            $data['_company'][$key]['count_fas'] = TblApprovalModel::GetAvailment($company->company_id,8,$date)->count(); //Financial Assistance

            $data['total_mem'] = $data['total_mem'] + $data['_company'][$key]['count_mem'];
			$data['total_ape'] = $data['total_ape'] + $data['_company'][$key]['count_ape'];
			$data['total_con'] = $data['total_con'] + $data['_company'][$key]['count_con'];
			$data['total_lab'] = $data['total_lab'] + $data['_company'][$key]['count_lab'];
			$data['total_mop'] = $data['total_mop'] + $data['_company'][$key]['count_mop'];
			$data['total_emc'] = $data['total_emc'] + $data['_company'][$key]['count_emc'];
			$data['total_cot'] = $data['total_cot'] + $data['_company'][$key]['count_cot'];
			$data['total_den'] = $data['total_den'] + $data['_company'][$key]['count_den'];
			$data['total_fas'] = $data['total_fas'] + $data['_company'][$key]['count_fas'];
		}	

		Excel::create("BREAKDOWN OF AVAILMENTS ".$date,function($excel) use ($data)
		{
			$excel->sheet('clients',function($sheet) use ($data)
			{
				$sheet->loadView('carewell.additional_pages.reports_breakdown_export_excel',$data);
			});
		})->download('xls');

	}

	public function reports_company_availment_per_month_export_excel($date)
	{
		$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);
		$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

        $data['date']      =  $date;

        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
		$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
		
		$data['grand_total_all'] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'%')
				                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
													            ->where('tbl_member_company.archived',0)
																->count();

		foreach ($data['_company'] as $key => $company) 
		{

			$data['_company'][$key]['availment']  = TblAvailmentModel::where('archived',0)->get();

			foreach($data['_company'][$key]['availment'] as $avail=>$availment)
			{
				$data['_company'][$key]['availment'][$avail]['total'] = TblApprovalModel::where('availment_id',$availment->availment_id)
																->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
													            ->where('tbl_member_company.company_id',$company->company_id)
													            ->where('tbl_member_company.archived',0)
																->count();

				$data['_company'][$key]['total_all'] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'%')
				                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
													            ->where('tbl_member_company.company_id',$company->company_id)
													            ->where('tbl_member_company.archived',0)
																->count();

				foreach($_param_name as $param=>$param_name)
	            {
	            	$data['_company'][$key]['availment'][$avail][$_param_name[$param]]	= TblApprovalModel::where('availment_id',$availment->availment_id)->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
														            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
														            	->where('tbl_member_company.company_id',$company->company_id)
														            	->where('tbl_member_company.archived',0)
														            	->count();

					$data['_company'][$key][$_param_name[$param].'_total']	= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
		            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
		            	->where('tbl_member_company.company_id',$company->company_id)
		            	->where('tbl_member_company.archived',0)
		            	->count();

		            $data['_company'][$key][$_param_name[$param].'_grand_total']	= TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
		            	->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
		            	->where('tbl_member_company.archived',0)
		            	->count();									            	
	            }

			}
		}

		Excel::create("COMPANY MONTHLY AVAILMENT REPORTS ".$date,function($excel) use ($data)
		{
			$excel->sheet('clients',function($sheet) use ($data)
			{
				$sheet->loadView('carewell.additional_pages.reports_company_availment_per_month_export_excel',$data);
			});
		})->download('xls');

	}
	public function reports_ajudication()
	{
		$data['page']       = 'AJUDICATION REPORT';
		$data['user']       = StaticFunctionController::global();
		$data['_provider']  = TblProviderModel::where('archived',0)->get();
		$data['_payable']  = TblPayableModel::where('tbl_payable.archived',1)->orWhere('tbl_payable.archived',0)->PayableInfo()->paginate(10);
		foreach ($data['_payable'] as $key => $payable) 
		{
			$data['_payable'][$key]['approval_number']    =  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
		}
		return view('carewell.pages.reports_judication',$data);
	}
	public function reports_ajudication_pdf($payable_id)
	{
		$approval_doctor_actual_pf 			= 0;
		$approval_doctor_phil_charity    	= 0;
		$approval_doctor_charge_patient 	= 0;
		$approval_doctor_charge_carewell    = 0;

		$procedure_gross_amount 			= 0;
		$procedure_philhealth    			= 0;
		$procedure_charge_patient 			= 0;
		$procedure_charge_carewell  		= 0;

		$disprocedure_gross_amount 			= 0;
		$disprocedure_philhealth    			= 0;
		$disprocedure_charge_patient 			= 0;
		$disprocedure_charge_carewell  		= 0;

		$data['payable_details']    = TblPayableModel::where('tbl_payable.payable_id',$payable_id)->PayableInfo()->first();
		$data['_payable_approval']  = TblPayableApprovalModel::where('tbl_payable_approval.payable_id',$payable_id)->ApprovalDetails()->where('tbl_member_company.archived',0)->where('tbl_payable_approval.archived',0)->get();
	    foreach ($data['_payable_approval'] as $keys => $payable_approval) 
		{
			$data['_payable_approval'][$keys]['charge_diagnosis'] = TblApprovalModel::where('tbl_approval.approval_id',$payable_approval->approval_id)->Diagnosis()->first();
			$data['_payable_approval'][$keys]['_final_diagnosis'] = TblApprovalDiagnosisModel::where('approval_id',$payable_approval->approval_id)->Diagnosis()->get();
			$data['_payable_approval'][$keys]['_availed']         = TblApprovalProcedureModel::where('tbl_approval_procedure.procedure_disapproved','off')->where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)->ProcedureDiagnosis()->get();
			$data['_payable_approval'][$keys]['_doctor_assigned'] = TblApprovalDoctorModel::where('tbl_approval_doctor.approval_id',$payable_approval->approval_id)->ApprovalDoctor()->get();
			$data['_payable_approval'][$keys]['_disapproved']         = TblApprovalProcedureModel::where('tbl_approval_procedure.procedure_disapproved','on')->where('tbl_approval_procedure.approval_id',$payable_approval->approval_id)->ProcedureDiagnosis()->get();
			foreach($data['_payable_approval'][$keys]['_availed'] as $key=>$availed)
			{
				$procedure_gross_amount 	= $procedure_gross_amount 		+ $availed->procedure_gross_amount;
				$procedure_philhealth 		= $procedure_philhealth 		+ $availed->procedure_philhealth;
				$procedure_charge_patient 	= $procedure_charge_patient 	+ $availed->procedure_charge_patient;
				$procedure_charge_carewell 	= $procedure_charge_carewell 	+ $availed->procedure_charge_carewell;
			}
			foreach($data['_payable_approval'][$keys]['_doctor_assigned'] as $key=>$doctor_assigned)
			{
				$approval_doctor_actual_pf 			= $approval_doctor_actual_pf 		+ $doctor_assigned->approval_doctor_actual_pf;
				$approval_doctor_phil_charity 		= $approval_doctor_phil_charity 	+ $doctor_assigned->approval_doctor_phil_charity;
				$approval_doctor_charge_patient 	= $approval_doctor_charge_patient 	+ $doctor_assigned->approval_doctor_charge_patient;
				$approval_doctor_charge_carewell 	= $approval_doctor_charge_carewell 	+ $doctor_assigned->approval_doctor_charge_carewell;
			}
			foreach($data['_payable_approval'][$keys]['_disapproved'] as $key=>$disapproved)
			{
				$disprocedure_gross_amount 		= $disprocedure_gross_amount 	+ $disapproved->procedure_gross_amount;
				$disprocedure_philhealth 		= $disprocedure_philhealth 		+ $disapproved->procedure_philhealth;
				$disprocedure_charge_patient 	= $disprocedure_charge_patient 	+ $disapproved->procedure_charge_patient;
				$disprocedure_charge_carewell 	= $disprocedure_charge_carewell + $disapproved->procedure_charge_carewell;
			}
			$data['_payable_approval'][$keys]['procedure_gross_amount'] 	= $procedure_gross_amount;
			$data['_payable_approval'][$keys]['procedure_philhealth']    	= $procedure_philhealth;
			$data['_payable_approval'][$keys]['procedure_charge_patient'] 	= $procedure_charge_patient;
			$data['_payable_approval'][$keys]['procedure_charge_carewell']  = $procedure_charge_carewell;

			$data['_payable_approval'][$keys]['approval_doctor_actual_pf'] 			= $approval_doctor_actual_pf;
			$data['_payable_approval'][$keys]['approval_doctor_phil_charity']    	= $approval_doctor_phil_charity;
			$data['_payable_approval'][$keys]['approval_doctor_charge_patient'] 	= $approval_doctor_charge_patient;
			$data['_payable_approval'][$keys]['approval_doctor_charge_carewell']    = $approval_doctor_charge_carewell;

			$data['_payable_approval'][$keys]['grand_total']      = $approval_doctor_charge_carewell + $procedure_charge_carewell;
	        $data['_payable_approval'][$keys]['payee_company']    = $procedure_charge_carewell;

	        $data['_payable_approval'][$keys]['disapproved']    = $disprocedure_charge_carewell;
		    
		}
		$data['approval_doctor_charge_carewell']    = $approval_doctor_charge_carewell;
		$data['procedure_charge_carewell'] 		    = $procedure_charge_carewell;
        $format["format"] 			= "Legal";
	    $format["default_font"] 	= "sans-serif";
	    $pdf = PDF::loadView('carewell.additional_pages.reports_ajudication_export_pdf', $data, [], $format);
	    return $pdf->stream('document.pdf');
	}
		
	/*SETTINGS*/
	public function settings_coverage_plan()
	{
		$data['page']                     = 'Coverage Plan';
		$data['user']                     = StaticFunctionController::global();
		$data['_active_coverage_plan']    = TblCoveragePlanModel::where('archived',0)->paginate(10);
		$data['_inactive_coverage_plan']  = TblCoveragePlanModel::where('archived',1)->paginate(10);
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
		// dd($request->all());
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
		 // dd($request->all());
		$coverageData = new TblCoveragePlanModel;
		$coverageData->coverage_plan_name             = $request->coverage_plan_name;
		$coverageData->coverage_plan_preexisting      = $request->coverage_plan_preexisting;
		$coverageData->coverage_plan_annual_benefit   = $request->coverage_plan_annual_benefit;
		$coverageData->coverage_plan_maximum_benefit  = $request->coverage_plan_maximum_benefit;
		$coverageData->coverage_plan_mbl_illness      = StaticFunctionController::checkboxValue($request->coverage_plan_mbl_illness);  
		$coverageData->coverage_plan_mbl_year         = StaticFunctionController::checkboxValue($request->coverage_plan_mbl_year);
		$coverageData->coverage_plan_case_handling    = $request->coverage_plan_case_handling;
		$coverageData->coverage_plan_age_bracket      = $request->coverage_plan_age_bracket;
		$coverageData->coverage_plan_premium          = $request->coverage_plan_premium;
		$coverageData->coverage_plan_cari_fee         = $request->coverage_plan_cari_fee;
		$coverageData->coverage_plan_hib              = $request->coverage_plan_hib;
		$coverageData->coverage_plan_processing_fee   = $request->coverage_plan_processing_fee;
		$coverageData->coverage_plan_created          = Carbon::now();
		$coverageData->save();
		$session_array = array(0=>'annual',1=>'os_consultation',2=>'os_laboratory',3=>'emergency',4=>'confinement',5=>'dental',6=>'assistance',7=>'minor_ops');

		for($i=0;  $i<=7;  $i++)
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
		$data['_coverage_plan_covered'] = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage_plan_id)->CoveragePlan()->get();
		foreach($data['_coverage_plan_covered'] as $key=>$availment)
		{
			if($availment->availment_id==4)
			{

				$data['_coverage_plan_covered'][$key]['procedure']  = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)->where('coverage_plan_id',$coverage_plan_id)->get();
			}
			else
			{
				$data['_coverage_plan_covered'][$key]['procedure']   = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)->where('coverage_plan_id',$coverage_plan_id)->Procedure()->get();
			}
			
		}
		// dd($data['_coverage_plan_covered']);
		return view('carewell.modal_pages.settings_coverage_plan_details',$data);
	}

	public function settings_coverage_plan_mark_new_submit(Request $request)
	{
		$coverageData = new TblCoveragePlanModel;
		$coverageData->coverage_plan_name             = $request->coverage_plan_name;
		$coverageData->coverage_plan_preexisting      = $request->coverage_plan_preexisting;
		$coverageData->coverage_plan_annual_benefit   = $request->coverage_plan_annual_benefit;
		$coverageData->coverage_plan_maximum_benefit  = $request->coverage_plan_maximum_benefit;
		$coverageData->coverage_plan_mbl_illness      = StaticFunctionController::checkboxValue($request->coverage_plan_mbl_illness);  
		$coverageData->coverage_plan_mbl_year         = StaticFunctionController::checkboxValue($request->coverage_plan_mbl_year);
		$coverageData->coverage_plan_case_handling    = $request->coverage_plan_case_handling;
		$coverageData->coverage_plan_age_bracket      = $request->coverage_plan_age_bracket;
		$coverageData->coverage_plan_premium          = $request->coverage_plan_premium;
		$coverageData->coverage_plan_cari_fee         = $request->coverage_plan_cari_fee;
		$coverageData->coverage_plan_hib              = $request->coverage_plan_hib;
		$coverageData->coverage_plan_processing_fee   = $request->coverage_plan_processing_fee;
		$coverageData->coverage_plan_created          = Carbon::now();
		$coverageData->save();

		StaticFunctionController::coverage_plan_mark_new($coverageData->coverage_plan_id,$request->coverage_plan_id);
		if($coverageData->save())     
		{       
			return StaticFunctionController::customMessage('success','NEW COVERAGE PLAN CREATED'); 
		}
		else     
		{       
			return StaticFunctionController::returnMessage('danger','PLEASE CHECK DETAILS'); 
		}


	}

	public function settings_coverage_plan_details_print($coverage_plan_id)
	{
		$data['coverage_plan_details']  = TblCoveragePlanModel::where('coverage_plan_id',$coverage_plan_id)->first();     
		$data['_coverage_plan_covered'] = TblCoveragePlanProcedureModel::where('coverage_plan_id',$coverage_plan_id)->CoveragePlan()->get();
		foreach($data['_coverage_plan_covered'] as $key=>$availment)
		{
			$data['_coverage_plan_covered'][$key]['procedure']   = TblCoveragePlanProcedureModel::where('availment_id',$availment->availment_id)->where('coverage_plan_id',$coverage_plan_id)->Procedure()->get();
		}

		$format["format"] 			= "Legal";
	    $format["default_font"] 	= "sans-serif";
	    $pdf = PDF::loadView('carewell.additional_pages.coverage_plan_details_export_pdf', $data, [], $format);
	    return $pdf->stream('document.pdf');
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
