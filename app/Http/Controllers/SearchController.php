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
					$data['_company'] = TblCompanyCoveragePlanModel::join('tbl_company','tbl_company.company_id','=','tbl_company_coverage_plan.company_id')
														  ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
			                                              ->paginate(10);
			        $data['link']		= '/reports/availment_per_month_summary/export_excel/'.$date; 
			        $data['date']    = $date;      

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

						$data['_company'][$key]['count'] = TblMemberCompanyModel::CountAvailment($parameter,$date)->count();

						$data['_company'][$key]['count_total'] 		= TblMemberCompanyModel::join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
											                ->where('tbl_member_company.archived',0)
											                ->where('coverage_plan_id',$company->coverage_plan_id)
											                ->where('tbl_approval.approval_created','LIKE','%'.$date.'%')->count();

						foreach($_param_name as $param=>$param_name)
			            {
			            	$data['_company'][$key][''.$_param_name[$param].''] 	= TblMemberCompanyModel::CountAvailment($parameter,$date.'-'.$_param_val[$param].'%')->count();  

			            	$data['_company'][$key][$_param_name[$param].'_total'] 	= TblMemberCompanyModel::join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id')
																	                ->where('tbl_member_company.archived',0)
																	                ->where('coverage_plan_id',$company->coverage_plan_id)
																	                ->where('tbl_approval.approval_created','LIKE','%'.$date.'-'.$_param_val[$param].'%')->count();
			            }				      
					}
					$view = view('carewell.filtering_date.reports_availment_per_month_filtering',$data);
				break;

			case 'availment_monitoring':

					$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

					$data['link']		= '/reports/availment_monitoring/export_excel/'.$date;
			        $data['date']      = $date;
				
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

					$view = view('carewell.filtering_date.reports_availment_monitoring_filtering',$data);
			break;

			case 'end_per_month':

					$data['_company'] = TblCompanyCoveragePlanModel::join('tbl_company','tbl_company.company_id','=','tbl_company_coverage_plan.company_id')
															  ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
				                                              ->paginate(10);

					$data['link']		= '/reports/ending_number_per_reports/export_excel/'.$date;
			        $data['date']      = $date;

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

					$view = view('carewell.filtering_date.reports_end_per_month',$data);
			break;

			case 'company_availment_per_month':

					$data['page'] = 'Company Monthly Availment Report';
					$data['user']     = StaticFunctionController::global();
					$data['_company'] = TblCompanyModel::where('archived',0)->paginate(10);
					$data['_availment'] = TblAvailmentModel::where('archived',0)->paginate(10);

					$data['link']		= '/reports/reports_company_availment/export_excel/'.$date;
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
				$output 	= "";
			if($request->val_archived==0)
			{
				switch ($reference)
			{
					case 'member':
				$data['_member_active'] = TblMemberCompanyModel::where('tbl_member.archived',0)->where('tbl_member_company.company_id', $id)->MemberCompany()->paginate(10);
				$output = view('carewell.filtering.member_filtering_active',$data);
					break;
					case 'doctor':
				$data['_doctor_active']    = TblDoctorProviderModel::where('tbl_doctor.archived',1)->where('tbl_doctor_provider.archived',0)->where('tbl_doctor_provider.provider_id',$id)->DoctorProvider()->paginate(10);
											foreach ($data['_doctor_active'] as $key => $doctor)
											{
													$data['_doctor_active'][$key]['provider']  	=  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
												->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
												->get();
											}
				$output = view('carewell.filtering.doctor_filtering_active',$data);
					break;
					case 'billing':
				$data['_cal_open']  =  TblCalModel::where('tbl_cal.archived',0)->where('tbl_cal.company_id', $id)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
					foreach ($data['_cal_open'] as $key => $cal_open)
						{
						$data['_cal_open'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_open->cal_id)->count();
						$data['_cal_open'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_open->cal_id)->count();
						}
				$output = view('carewell.filtering.billing_filtering_active',$data);
					break;
					case 'availment':
						$data['_approval_active']  	= TblApprovalModel::where('tbl_approval.archived',0)->where('tbl_provider.provider_id',$id)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
						$output = view('carewell.filtering.availment_filtering_active',$data);
					break;
				}
			}
			else if($request->val_archived==1)
			{
				switch ($reference)
			{
					case 'member':
				$data['_member_inactive'] = TblMemberCompanyModel::where('tbl_member.archived',1)->where('tbl_member_company.company_id', $id)->MemberCompany()->paginate(10);
				$output = view('carewell.filtering.member_filtering_inactive',$data);
					break;
					case 'doctor':
				$data['_doctor_inactive']    = TblDoctorProviderModel::where('tbl_doctor.archived',1)->where('tbl_doctor_provider.archived',0)->where('tbl_doctor_provider.provider_id',$id)->DoctorProvider()->paginate(10);
						foreach ($data['_doctor_inactive'] as $key => $doctor)
						{
						$data['_doctor_inactive'][$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
					->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
					->get();
						}
						$output = view('carewell.filtering.doctor_filtering_inactive',$data);
					break;
					case 'billing':
				$data['_cal_close']  =  TblCalModel::where('tbl_cal.archived',0)->where('tbl_cal.company_id', $id)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
					foreach ($data['_cal_close'] as $key => $cal_close)
						{
						$data['_cal_close'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_close->cal_id)->count();
						$data['_cal_close'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_close->cal_id)->count();
						}
					$output = view('carewell.filtering.billing_filtering_inactive',$data);
					break;
					case 'availment':
						$data['_approval_inactive']  	= TblApprovalModel::where('tbl_approval.archived',1)->where('tbl_provider.provider_id',$id)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
						$output = view('carewell.filtering.availment_filtering_inactive',$data);
					break;
				}
				
			}
			else if($request->val_archived==2)
			{
				switch ($reference)
			{
					
					case 'billing':
				$data['_cal_pending']  =  TblCalModel::where('tbl_cal.archived',2)->where('tbl_cal.company_id', $id)->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')->paginate(10);
					foreach ($data['_cal_pending'] as $key => $cal_pending)
						{
						$data['_cal_pending'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_pending->cal_id)->count();
						$data['_cal_pending'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_pending->cal_id)->count();
						}
					$output = view('carewell.filtering.billing_filtering_pending',$data);
					break;
					case 'availment':
						$data['_approval_active']  	= TblApprovalModel::where('tbl_approval.archived',2)->where('tbl_provider.provider_id',$id)->where('tbl_member_company.archived',0)->ApprovalInfo()->paginate(10);
						$output = view('carewell.filtering.availment_filtering_pending',$data);
					break;
				}
			}
			return  $output;
	}
	}
	public function pageSearching(Request $request)
	{
		if($request->ajax())
	{
				$reference 	= $request->val_name;
					$key  		= $request->val_key;
				$output 	= "";
			if($request->val_archived==0)
			{
				switch ($reference)
			{
				case 'company':
					$data['_company_active']    = TblCompanyModel::where('tbl_company.archived',0)
												->where(function($query)use($key)
						{
						$query->where('tbl_company.company_name','like','%'.$key.'%');
						$query->orWhere('tbl_company.company_code','like','%'.$key.'%');
						})
												->Company()->paginate(10);
					foreach ($data['_company_active'] as $key => $company)
					{
					$data['_company_active'][$key]['coverage_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)
					->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
					->get();
					}
					$output = view('carewell.filtering.company_filtering_active',$data);
				break;
					case 'member':
				$data['_member_active'] = TblMemberModel::where('tbl_member.archived',0)
									->where('tbl_member_company.archived',0)
									->where(function($query)use($key)
					{
					$query->where('tbl_member.member_last_name','like','%'.$key.'%');
					$query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
					$query->orWhere('tbl_member_company.member_carewell_id','like','%'.$key.'%');
					$query->orWhere('tbl_member.member_universal_id','like','%'.$key.'%');
					})
									->Member()
									->paginate(10);
				$output = view('carewell.filtering.member_filtering_active',$data);
					break;
					case 'provider':
						$data['_provider_active']  = TblProviderModel::where('archived',0)
											->where('tbl_provider.provider_name','like','%'.$key.'%')
				->paginate(10);
					foreach ($data['_provider_active'] as $key => $provider)
					{
					$data['_provider_active'][$key]['provider_payee'] =  TblProviderPayeeModel::where('provider_id',$provider->provider_id)->get();
					}
					$output = view('carewell.filtering.provider_filtering_active',$data);
					break;
					case 'doctor':
				$data['_doctor_active'] = TblDoctorModel::where('tbl_doctor.archived',0)
									->where('tbl_doctor.doctor_full_name','like','%'.$key.'%')
									->paginate(10);
					foreach ($data['_doctor_active'] as $key => $doctor)
					{
					$data['_doctor_active'][$key]['specialization']  =  TblDoctorSpecializationModel::where('doctor_id',$doctor->doctor_id)
							->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_doctor_specialization.specialization_id')
							->get();
					$data['_doctor_active'][$key]['provider']        =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
							->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
							->get();
					}
				$output = view('carewell.filtering.doctor_filtering_active',$data);
					break;
					case 'billing':
					$data['_cal_open'] 	= TblCalModel::join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
								->where('tbl_cal.archived',0)
								->where(function($query)use($key)
				{
				$query->where('tbl_cal.cal_number','like','%'.$key.'%');
				$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
				})
								->paginate(10);
					foreach ($data['_cal_open'] as $key => $cal_open)
						{
						$data['_cal_open'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_open->cal_id)->count();
						$data['_cal_open'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_open->cal_id)->count();
						}
					$output = view('carewell.filtering.billing_filtering_active',$data);
					break;
					case 'availment':
					$data['_approval_active'] = TblApprovalModel::where('tbl_approval.archived',0)->where('tbl_member_company.archived',0)
														->where(function($query)use($key)
									{
									$query->where('tbl_approval.approval_number','like','%'.$key.'%');
			$query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
			$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
			$query->orWhere('tbl_provider.provider_name','like','%'.$key.'%');
									})
									->ApprovalInfo()
									->paginate(10);
				$output = view('carewell.filtering.availment_filtering_active',$data);
					break;
					case 'coverage_plan':
					$data['_active_coverage_plan']    = TblCoveragePlanModel::where('archived',0)->where('coverage_plan_name','like','%'.$key.'%')->paginate(10);
				$output = view('carewell.filtering.coverage_filtering_active',$data);
					break;
				}
			}
			else if($request->val_archived==1)
			{
				switch ($reference)
			{
				case 'company':
					$data['_company_inactive']    = TblCompanyModel::where('tbl_company.archived',1)
											->where(function($query)use($key)
						{
						$query->where('tbl_company.company_name','like','%'.$key.'%');
						$query->orWhere('tbl_company.company_code','like','%'.$key.'%');
						})
										->Company()->paginate(10);
					foreach ($data['_company_inactive'] as $key => $company)
					{
					$data['_company_inactive'][$key]['coverage_plan']  = TblCompanyCoveragePlanModel::where('company_id',$company->company_id)
									->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id')
							->get();
					}
					$output = view('carewell.filtering.company_filtering_inactive',$data);
				break;
					case 'member':
					$data['_member_inactive'] 	= TblMemberModel::where('tbl_member.archived',1)
										->where('tbl_member_company.archived',0)
										->where(function($query)use($key)
						{
						$query->where('tbl_member.member_last_name','like','%'.$key.'%');
						$query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
						$query->orWhere('tbl_member_company.member_carewell_id','like','%'.$key.'%');
						$query->orWhere('tbl_member.member_universal_id','like','%'.$key.'%');
						})
										->Member()
										->paginate(10);
				$output = view('carewell.filtering.member_filtering_inactive',$data);
					break;
					case 'billing':
					$data['_cal_close'] 	= TblCalModel::join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
									->where('tbl_cal.archived',1)
									->where(function($query)use($key)
					{
					$query->where('tbl_cal.cal_number','like','%'.$key.'%');
					$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
					})
									->paginate(10);
					foreach ($data['_cal_close'] as $key => $cal_close)
						{
					$data['_cal_close'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_close->cal_id)->count();
					$data['_cal_close'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_close->cal_id)->count();
						}
					$output = view('carewell.filtering.billing_filtering_inactive',$data);
					break;
					case 'provider':
						$data['_provider_inactive']  = TblProviderModel::where('archived',1)
											->where('tbl_provider.provider_name','like','%'.$key.'%')
				->paginate(10);
						foreach ($data['_provider_inactive'] as $key => $provider)
						{
						$data['_provider_inactive'][$key]['provider_payee'] =  TblProviderPayeeModel::where('provider_id',$provider->provider_id)->get();
						}
						$output = view('carewell.filtering.provider_filtering_inactive',$data);
					break;
					case 'doctor':
				$data['_doctor_inactive'] = TblDoctorModel::where('tbl_doctor.archived',1)
									->where('tbl_doctor.doctor_full_name','like','%'.$key.'%')
									->paginate(10);
						foreach ($data['_doctor_inactive'] as $key => $doctor)
						{
						$data['_doctor_inactive'][$key]['provider']   =  TblDoctorProviderModel::where('doctor_id',$doctor->doctor_id)
					->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
					->get();
						}
				$output = view('carewell.filtering.doctor_filtering_inactive',$data);
					break;
					case 'availment':
						$data['_approval_inactive']   = TblApprovalModel::where('tbl_approval.archived',1)->where('tbl_member_company.archived',0)
												->where(function($query)use($key)
							{
							$query->where('tbl_approval.approval_number','like','%'.$key.'%');
			$query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
			$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
			$query->orWhere('tbl_provider.provider_name','like','%'.$key.'%');
							})
							->ApprovalInfo()
							->paginate(10);
					$output = view('carewell.filtering.availment_filtering_inactive',$data);
					break;
					case 'coverage_plan':
					$data['_active_coverage_plan']    = TblCoveragePlanModel::where('archived',1)->where('coverage_plan_name','like','%'.$key.'%')->paginate(10);
				$output = view('carewell.filtering.coverage_filtering_inactive',$data);
					break;
				}
				
			}
			else if($request->val_archived==2)
			{
				switch ($reference)
			{
				
					case 'billing':
					$data['_cal_pending'] 	= TblCalModel::join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
									->where('tbl_cal.archived',2)
									->where(function($query)use($key)
					{
					$query->where('tbl_cal.cal_number','like','%'.$key.'%');
					$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
					})
									->paginate(10);
					foreach ($data['_cal_pending'] as $key => $cal_pending)
						{
						$data['_cal_pending'][$key]['new_member']= TblNewMemberModel::where('cal_id',$cal_pending->cal_id)->count();
						$data['_cal_pending'][$key]['members']   =  TblCalMemberModel::where('cal_id',$cal_pending->cal_id)->count();
						}
					$output = view('carewell.filtering.billing_filtering_pending',$data);
					break;
					case 'availment':
			$data['_approval_pending']  	= TblApprovalModel::where('tbl_approval.archived',2)->where('tbl_member_company.archived',0)
												->where(function($query)use($key)
							{
							$query->where('tbl_approval.approval_number','like','%'.$key.'%');
					$query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
					$query->orWhere('tbl_company.company_name','like','%'.$key.'%');
					$query->orWhere('tbl_provider.provider_name','like','%'.$key.'%');
							})
							->ApprovalInfo()
							->paginate(10);
					$output = view('carewell.filtering.availment_filtering_pending',$data);
					break;
					
				}
			}
			return  $output;
	}
	}

}