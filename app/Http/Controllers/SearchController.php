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


class SearchController extends ActiveAuthController
{
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
