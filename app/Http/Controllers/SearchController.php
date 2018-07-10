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
use App\Http\Model\TblCalModel;
use App\Http\Model\TblCalInfoModel;
use App\Http\Model\TblCalMemberModel;
use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberDependentModel;
use App\Http\Model\TblMemberGovernmentCardModel;
use App\Http\Model\TblNewMemberModel;
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
use App\Http\Model\TblLaboratoryModel;
use App\Http\Model\TblDiagnosisModel;
use App\Http\Model\TblProcedureModel;
use App\Http\Model\TblScheduleOfBenefitsModel;
use DB;

class SearchController extends ActiveAuthController
{
	public function selectFiltering(Request $request)
	{
		dd($request->ref);	
	}

	public function dateFiltering(Request $request)
	{
		$date = $request->date;

		switch ($request->ref)
		{
			case 'breakdown':
					$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);

					$data['link']		= '/reports/reports_breakdown/export_excel/'.$date;
			        $data['date']      = $date;

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
					}
					$view = view('carewell.filtering_date.reports_breakdown_filtering',$data);
				break;

			case 'availment_per_month':
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

				$view = view('carewell.filtering_date.reports_availment_per_month_filtering',$data);
			break;

			case 'availment_monitoring':

					$data['page']     = 'Availment per Month Monitoring Summary';
					$data['user']     = StaticFunctionController::global();
					$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

					$data['link']		= '/reports/availment_monitoring/export_excel/'.date('Y');
			        $data['date']      	= $date;

			        //total patient count
			        $data['count_approval'] = TblApprovalModel::where('archived',0)->where('approval_created','LIKE','%'.$date.'%')->count();
			        
			        //total amount
			        $data['sum_approval'] = TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
			                ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
			                ->where('tbl_approval.archived',0)
			            	->sum('total_gross_amount');
			        
			        $_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
					$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
					$_param_key			= array(0,1,2,3,4,5,6,7,8,9,10,11);

					$param_name_key = array_combine($_param_key, $_param_name);
					$param_val_key = array_combine($_param_key, $_param_val);    

					//total patient and amount
					foreach ($param_name_key as $key => $_param_key) 
					{	
						//total patient
						$data['total'][$key] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$param_val_key[$key].'%')->where('tbl_approval.archived',0)->count();       
						
						//total amount
						$data['total_amount'][$key] = TblApprovalModel::join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																			            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$param_val_key[$key].'%')
																			            	->where('tbl_approval.archived',0)
																			            	->sum('total_gross_amount');                                                       
					}		

					foreach ($data['_availment'] as $key => $availment)
					{
						//total number of patient (column)
						$data['_availment'][$key]['count'] 		= TblApprovalModel::where('availment_id',$availment->availment_id)
															->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
															->where('archived',0)
															->count();

						//total amount (column)
						$data['_availment'][$key]['count_sum']	= TblApprovalModel::where('availment_id',$availment->availment_id)
														    ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')
											            	->where('tbl_approval.archived',0)
											            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
											            	->sum('total_gross_amount');

						//jan, feb , mar, apr, may, jun, jul, aug, sep, oct, nov ,dec				            	
						foreach($_param_name as $param=>$param_name)
			            {
			            	//number of patient per month and availment
			            	$data['_availment'][$key][$_param_name[$param]]					= TblApprovalModel::where('availment_id',$availment->availment_id)->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')->where('tbl_approval.archived',0)->count();

			            	//amount of patient per month and availment
			            	$data['_availment'][$key][$_param_name[$param].'_amount']		= TblApprovalModel::where('availment_id',$availment->availment_id)
																			            	->join('tbl_approval_total','tbl_approval_total.approval_id','=','tbl_approval.approval_id')
																			            	->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.sprintf("%02d", $param+1).'%')
																			            	->where('tbl_approval.archived',0)
																			            	->sum('total_gross_amount');
			            }
					}
					

					$view = view('carewell.filtering_date.reports_availment_monitoring_filtering',$data);
			break;

			case 'end_per_month':

				$data['page']     	= 'Ending Number Per Month Reports';
				$data['user']     	= StaticFunctionController::global();
				$data['_company'] 	= TblCompanyCoveragePlanModel::CompanyCoverage()->paginate(10);

				$data['link']		= '/reports/ending_number_per_reports/export_excel/'.$date;
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
		            }			      
				}

					$view = view('carewell.filtering_date.reports_end_per_month',$data);
			break;

			case 'company_availment_per_month':

					$data['page'] 		= 'Company Monthly Availment Report';
					$data['user']    	= StaticFunctionController::global();
					$data['_company'] 	= TblCompanyModel::where('archived',0)->paginate(10);
					$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

					$data['link']		= '/reports/reports_company_availment/export_excel/'.$date;
			        $data['date']      	=  $date;
					
					$_param_name        = array('count_jan','count_feb','count_mar','count_apr','count_may','count_jun','count_jul','count_aug','count_sep','count_oct','count_nov','count_dec');
					$_param_val         = array('01','02','03','04','05','06','07','08','09','10','11','12'); 
					$_param_key			= array(0,1,2,3,4,5,6,7,8,9,10,11);

					$data['grand_total_all'] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'%')
							                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																            ->where('tbl_member_company.archived',0)
																			->count();

					$param_name_key = array_combine($_param_key, $_param_name);
					$param_val_key = array_combine($_param_key, $_param_val);

					foreach ($param_name_key as $key => $_param_key) 
					{
						$data['total'][$key] = TblApprovalModel::where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$param_val_key[$key].'%')
							                                                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
																            ->where('tbl_member_company.archived',0)
																			->count();                                                            
					}

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

			return view('carewell.filtering_date.reports_company_availment_per_month_filtering',$data);

			break;

			default:
				# code...
				break;
		}
		return $view;
	}
	public function pageFiltering(Request $request)
	{
		if($request->ajax())
		{
			$reference 	= $request->val_name;
			$id  		= $request->val_id;
			$archived   = $request->val_archived;
			$output 	= "";
			switch ($reference)
			{
				case 'member':
					$result = TblMemberCompanyModel::where('tbl_member.archived',$archived)->where('tbl_member_company.company_id', $id)->MemberCompany()->paginate(10);
					
				break;
				case 'doctor':
					$result    = TblDoctorProviderModel::where('tbl_doctor.archived',$archived)->where('tbl_doctor_provider.archived',0)->where('tbl_doctor_provider.provider_id',$id)->DoctorProvider()->paginate(10);
					foreach ($result as $key => $doctor_provider)
					{
						$result[$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor_provider->doctor_id)->Provider()->get();
					}
					
				break;
				case 'billing':
					$result  =  TblCalModel::where('tbl_cal.archived',$archived)->where('tbl_cal.company_id', $id)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
					foreach ($result as $key => $cal)
					{
					$result[$key]['new_member']= TblNewMemberModel::where('cal_id',$cal->cal_id)->count();
					$result[$key]['members']   =  TblCalMemberModel::where('cal_id',$cal->cal_id)->count();
					}
					
				break;
				case 'availment':
					$result  	= TblApprovalModel::where('tbl_approval.archived',$archived)->where('tbl_provider.provider_id',$id)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
					
				break;
				case 'payable':
					$result   = TblPayableModel::where('tbl_payable.archived',$archived)->where('tbl_payable.provider_id',$id)->PayableInfo()->paginate(10);
					foreach ($result as $key => $payable) 
					{
						$result[$key]['payable_age']   		= date_create($payable->payable_due)->diff(date_create('today'))->m.' Months and '.date_create($payable->payable_due)->diff(date_create('today'))->d.' Days';
						$result[$key]['approval_number']    	=  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
					}
				break;
			}
			return  Self::return_output($reference,$archived,$result);
		}
	}
	public function pageSearching(Request $request)
	{
		if($request->ajax())
		{
			$reference 	= $request->val_name;
			$key  		= $request->val_key;
			$archived   = $request->val_archived;
			$output 	= "";
			switch ($reference)
			{
				case 'company':
					$result    = TblCompanyModel::where('tbl_company.archived',$archived)->Search($key)->Company()->paginate(10);
					foreach ($result as $key => $company)
					{
						$result[$key]['coverage_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)->CoveragePlan()->get();
					}
				break;
				case 'member':
					$result = TblMemberModel::where('tbl_member.archived',$archived)->Search($key)->Member()->paginate(10);
					
				break;
				case 'provider':
					$result  = TblProviderModel::where('tbl_provider.archived',$archived)->where('tbl_provider.provider_name','like','%'.$key.'%')->paginate(10);
					foreach ($result as $key => $provider)
					{
					$result[$key]['provider_payee'] =  TblProviderPayeeModel::where('provider_id',$provider->provider_id)->get();
					}
					
				break;
				case 'doctor':
					$result = TblDoctorModel::where('tbl_doctor.archived',$archived)->Search($key)->paginate(10);
					foreach ($result as $key => $doctor)
					{
						$result[$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)->Provider()->get();
					}
					
				break;
				case 'billing':
					$result 	= TblCalModel::where('tbl_cal.archived',$archived)->Search($key)->paginate(10);
					foreach ($result as $key => $cal)
					{
					$result[$key]['new_member']= TblNewMemberModel::where('cal_id',$cal->cal_id)->count();
					$result[$key]['members']   =  TblCalMemberModel::where('cal_id',$cal->cal_id)->count();
					}
					
				break;
				case 'availment':
					$result = TblApprovalModel::where('tbl_approval.archived',$archived)->Search($key)->ApprovalInfo()->paginate(10);
					
				break;
				case 'coverage_plan':
					$result    = TblCoveragePlanModel::where('archived',$archived)->where('coverage_plan_name','like','%'.$key.'%')->paginate(10);
				break;
				case 'payable':
					$result    = TblPayableModel::where('archived',$archived)->where('payable_number','like','%'.$key.'%')->PayableInfo()->paginate(10);
					foreach ($result as $key => $payable) 
					{
						$result[$key]['payable_age']   		= date_create($payable->payable_due)->diff(date_create('today'))->m.' Months and '.date_create($payable->payable_due)->diff(date_create('today'))->d.' Days';
						$result[$key]['approval_number']    	=  TblPayableApprovalModel::where('payable_id',$payable->payable_id)->PayableStatus()->get();
					}
				break;
				case 'payment-member-report':
					$result    = TblMemberModel::where('tbl_member.archived',$archived)->Search($key)->Member()->paginate(10);
				break;
			}
			return  Self::return_output($reference,$archived,$result);
		}
	}
	public static function return_output($reference,$archived,$returnData)
	{
		$output = "NO DATA RESULT";
		switch ($reference)
		{
			case 'company':
				$data['archived']  		= $archived;
				$data['_return_data'] 	= $returnData;
				$output = view('carewell.filtering.company_filtering_searching',$data);
			break;
			case 'member':
				$data['archived']  		= $archived;
				$data['_return_data'] 	= $returnData;
				$output = view('carewell.filtering.member_filtering_searching',$data);
				
			break;
			case 'provider':
				$data['archived']  		= $archived;
				$data['_return_data'] 	= $returnData;
				$output = view('carewell.filtering.provider_filtering_searching',$data);
			break;
			case 'doctor':
				$data['archived']  		= $archived;
				$data['_return_data'] 	= $returnData;
				$output = view('carewell.filtering.doctor_filtering_searching',$data);	
			break;
			case 'billing':
				$data['archived']  		= $archived;
				$data['_return_data'] 	= $returnData;
				$output = view('carewell.filtering.billing_filtering_searching',$data);
			break;
			case 'availment':
				$data['archived']  	= $archived;
				$data['_return_data'] = $returnData;
				$output = view('carewell.filtering.availment_filtering_searching',$data);
			break;
			case 'payable':
				$data['archived']  	= $archived;
				$data['_return_data'] = $returnData;
				$output = view('carewell.filtering.payable_filtering_searching',$data);
			break;
			case 'coverage_plan':
				$data['archived']  	= $archived;
				$data['_return_data'] = $returnData;
				$output = view('carewell.filtering.coverage_filtering_searching',$data);
			break;
			case 'payment-member-report':
				$data['_member'] = $returnData;
				$output = view('carewell.filtering.reports_payment_report_filtering',$data);
			break;
		}
		return $output;
	}

}