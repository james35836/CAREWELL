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


use App\Http\Controllers\StaticFunctionController;






use Excel;
use Input;
// use Request;
use DB;
use Carbon\Carbon;
use Paginate;
use Crypt;



class CarewellController extends Controller
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
  	$data['page'] = 'Dashboard';
    $data['user'] = $this->global();
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
    $data['_company_availment_plan']  = TblCompanyJobsiteModel::where('company_id',$company_id)->get();
    $data['company_contract']        = TblCompanyContractModel::where('company_id',$company_id)->first();

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
        $companyData->company_address         = $request->company_address;
        $companyData->company_trunk_line      = $request->company_trunk_line;
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
        $contractData->contract_mode_of_payment = $request->company_address;
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

    return view('carewell.modal_pages.member_create_member');
  }
  public function member_view_details($member_id)
  {
    $data['member_details']    = TblMemberModel::where('member_id',$member_id)->first();
    $data['_member_dependent'] = TblMemberDependentModel::where('member_id',$member_id)->get();
    $data['member_government'] = TblMemberGovernmentCardModel::where('member_id',$member_id)->first();
    $data['_member_company']    = TblMemberCompanyModel::where('member_id',$member_id)
                                 ->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id')
                                 ->join('tbl_company_jobsite','tbl_company_jobsite.jobsite_id','=','tbl_member_company.jobsite_id')
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

    return view('carewell.modal_pages.member_transaction_details',$data);
  }
  public function member_import_member(Request $request)
  {

    $data['_company']     =   TblCompanyModel::get();
    return view('carewell.modal_pages.member_import',$data);
    
  }
  public function member_download_template($company_id)
  {
        $excels['number_of_rows'] =   10;
        $excels['company_id']     =   $company_id;
        $company_template         =   TblCompanyModel::where('company_id',$company_id)->first();
        $excels['company_name']   =   $company_template->company_name;
        $excels['data'] = ['COMPANY','MEMBER LAST NAME','MEMBER FIRST NAME','MEMBER MIDDLE NAME','MEMBER BIRTHDATE','MEMBER GENDER','MEMBER MARITAL STATUS','MEMBER MONTHER MAIDEN NAME','MEMBER PERMANENT ADDRESS','MEMBER PRESENT ADDRESS','MEMBER CONTACT NUMBER','MEMBER EMAIL ADDRESS','MEMBER JOBSITE','MEMBER DEPENDENT FULL NAME','MEMBER DEPENDENT BIRTHDATE','MEMBER DEPENDENT RELATIONSHIP','AVAILMENT PLAN NAME','MEMBER GOVERNMENT CARD PHILHEALTH','MEMBER GOVERNMENT CARD SSS','MEMBER GOVERNMENT CARD TIN','MEMBER GOVERNMENT CARD HDMF'];
         Excel::create('CAREWELL - '.$company_template->company_name.' - TEMPLATE', function($excel) use ($excels) 
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
                  $sheet->setCellValue('A'.$rowcell, $excels['company_name']);
              
                  /* GENDER ROW */
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
                  /* MARITAL STATUS ROW */
                  $marital_cell = $sheet->getCell('G'.$rowcell)->getDataValidation();
                  $marital_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $marital_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $marital_cell->setAllowBlank(false);
                  $marital_cell->setShowInputMessage(true);
                  $marital_cell->setShowErrorMessage(true);
                  $marital_cell->setShowDropDown(true);
                  $marital_cell->setErrorTitle('Input error');
                  $marital_cell->setError('Value is not in list.');
                  $marital_cell->setFormula1('marital');
                  /* DEPLOYMENT*/
                  $deployment_cell = $sheet->getCell('M'.$rowcell)->getDataValidation();
                  $deployment_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $deployment_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $deployment_cell->setAllowBlank(false);
                  $deployment_cell->setShowInputMessage(true);
                  $deployment_cell->setShowErrorMessage(true);
                  $deployment_cell->setShowDropDown(true);
                  $deployment_cell->setErrorTitle('Input error');
                  $deployment_cell->setError('Value is not in list.');
                  $deployment_cell->setFormula1('deployment');
                  /* Dependent Relationship*/
                  $relation_cell = $sheet->getCell('P'.$rowcell)->getDataValidation();
                  $relation_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                  $relation_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                  $relation_cell->setAllowBlank(false);
                  $relation_cell->setShowInputMessage(true);
                  $relation_cell->setShowErrorMessage(true);
                  $relation_cell->setShowDropDown(true);
                  $relation_cell->setErrorTitle('Input error');
                  $relation_cell->setError('Value is not in list.');
                  $relation_cell->setFormula1('dependent_relationship');
                  /* AVAILMENT*/
                  $availment_cell = $sheet->getCell('Q'.$rowcell)->getDataValidation();
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
              $company_id = $excels['company_id'];
              $_company          = TblCompanyModel::get();

              $_jobsite          = TblCompanyJobsiteModel::where('company_id',$company_id)->get();
              $_availment        = TblCompanyCoveragePlanModel::where('company_id',$company_id)
                                  ->join('tbl_availment_plan','tbl_availment_plan.availment_plan_id','=','tbl_company_coverage_plan.availment_plan_id')
                                  ->get();

              /* COMPANY/CLIENT REFERENCES */
              // $sheet->SetCellValue("A1", "Client");
              // $client_number = 2;
              // foreach($_company as $company)
              // {
              //     $sheet->SetCellValue("A".$client_number, $company->company_name);
              //     $client_number++;
              // }
              // $client_number--;
              


              /* GENDER REFERENCE */
              $sheet->SetCellValue("B1", "Gender");
              $sheet->SetCellValue("B2", "male");
              $sheet->SetCellValue("B3", "female");

              /* MARITAL REFERENCE */
              $sheet->SetCellValue("C1", "Marital Status");
              $sheet->SetCellValue("C2", "Single");
              $sheet->SetCellValue("C3", "Maried");

              /* DEPLOYMENT REFERENCES */
              $sheet->SetCellValue("D1", "Deployment");
              $job_number = 2;
              foreach($_jobsite as $jobsite)
              {
                  $sheet->SetCellValue("D".$job_number, $jobsite->jobsite_name);
                  $job_number++;
              }
              $job_number--;

              /* Relationship REFERENCE */
              $sheet->SetCellValue("E1", "relationship");
              $sheet->SetCellValue("E2", "Father");
              $sheet->SetCellValue("E3", "Mother");
              $sheet->SetCellValue("E4", "Asawa");
              $sheet->SetCellValue("E5", "Kabit");
              $sheet->SetCellValue("E6", "Mother");
              $sheet->SetCellValue("E7", "Mother");
              $sheet->SetCellValue("E8", "Mother");

              /* AVAILMENT REFERENCES */
              $sheet->SetCellValue("F1", "availment");
              $availment_number = 2;
              foreach($_availment as $availment)
              {
                  $sheet->SetCellValue("F".$availment_number, $availment->availment_plan_name);
                  $availment_number++;
              }
              $availment_number--;

              // $sheet->_parent->addNamedRange(
              //     new \PHPExcel_NamedRange(
              //     'client', $sheet, 'A2:A'.$client_number
              //     )
              // );
              
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'gender', $sheet, 'B2:B3'
                  )
              );
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'marital', $sheet, 'C2:C3'
                  )
              );
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'deployment', $sheet, 'D2:D'.$job_number
                  )
              );
              $sheet->_parent->addNamedRange(
                  new \PHPExcel_NamedRange(
                  'dependent_relationship', $sheet, 'E2:E8'
                  )
              );
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
    $company_id = $request->company_id;
    $companyData = TblCompanyModel::where('company_id',$company_id)->first();
    $first  = $_data[0]; 
          if(isset($first['company']))
          {    
               $count = 0;
               foreach($_data as $data)
               {
                    $count_member = TblMemberModel::where('member_first_name',StaticFunctionController::nullableToString($data['member_first_name']))
                                                  ->where('member_last_name', StaticFunctionController::nullableToString($data['member_last_name']))
                                                  ->where('member_middle_name',StaticFunctionController::nullableToString($data['member_middle_name']))
                                                  ->where('member_email_address',StaticFunctionController::nullableToString($data['member_email_address']))
                                                  ->count();
                    if($count_member == 0 && $data['member_birthdate']!=null)
                    {
                        
                          $member['member_first_name']        =   StaticFunctionController::nullableToString($data['member_first_name']);
                          $member['member_middle_name']       =   StaticFunctionController::nullableToString($data['member_middle_name']);
                          $member['member_last_name']         =   StaticFunctionController::nullableToString($data['member_last_name']);
                          $member['member_birthdate']         =   date_format($data['member_birthdate'],"d-m-Y");  
                          $member['member_gender']            =   StaticFunctionController::nullableToString($data['member_gender']);
                          $member['member_marital_status']    =   StaticFunctionController::nullableToString($data['member_marital_status']);
                          $member['member_monther_maiden_name'] = StaticFunctionController::nullableToString($data['member_monther_maiden_name']);
                          $member['member_permanet_address']  =   StaticFunctionController::nullableToString($data['member_permanent_address']);
                          $member['member_present_address']   =   StaticFunctionController::nullableToString($data['member_present_address']);
                          $member['member_contact_number']    =   StaticFunctionController::nullableToString($data['member_contact_number']);
                          $member['member_email_address']     =   StaticFunctionController::nullableToString($data['member_email_address']);
                          $member['member_date_created']      =   Carbon::now();
                          $member['member_universal_id']      =   'UNIVERSAL ID';

                          if(StaticFunctionController::getid($data['company'], 'company') != null )
                          {

                          $display_name                       =   $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
                          $member_id                          =   TblMemberModel::insertGetId($member);
                          $update['member_universal_id']      =   StaticFunctionController::initials($display_name)."-".str_replace(' ','',preg_replace('/[^a-z0-9\s]/i', '', $member['member_birthdate']))."-".sprintf("%05d",$member_id);
                                                                  TblMemberModel::where('member_id',$member_id)->update($update);

                          $dependent['member_dependent_full_name']        =   StaticFunctionController::nullableToString($data['member_dependent_full_name']);
                          $dependent['member_dependent_birthdate']        =   date_format($data['member_dependent_birthdate'],"d-m-Y");  
                          $dependent['member_dependent_relationship']     =   StaticFunctionController::nullableToString($data['member_dependent_relationship']);
                          $dependent['member_id']       =   $member_id;

                          TblMemberDependentModel::insert($dependent);

                          $government['member_government_card_philhealth'] =   StaticFunctionController::nullableToString($data['member_government_card_philhealth']);
                          $government['member_government_card_sss']        =   StaticFunctionController::nullableToString($data['member_government_card_sss']);
                          $government['member_government_card_tin']        =   StaticFunctionController::nullableToString($data['member_government_card_tin']);
                          $government['member_government_card_hdmf']       =   StaticFunctionController::nullableToString($data['member_government_card_hdmf']);
                          $government['member_id']       =   $member_id;
                          
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
                          $company['member_company_carewell_id']  =  $companyData->company_code."-".date("my")."-".sprintf("%05d",$member_company_data);
                          $company['member_company_status']       =   "active";
                          $company['availment_plan_id']           =   StaticFunctionController::getid($data['availment_plan_name'], 'availment');
                          $company['jobsite_id']                  =   StaticFunctionController::getid($data['member_jobsite'], 'jobsite');
                          $company['member_id']                   =   $member_id;
                          $company['company_id']                  =   $companyData->company_id;
                          TblMemberCompanyModel::insert($company);
                            
                            $count++;
                        }
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
  	return view('carewell.pages.medical_representative',$data);
  }
  public function medical_create_approval()
  {
    $data['_member']  = TblMemberModel::get();
    return view('carewell.modal_pages.medical_create_approval',$data);
  }
  public function medical_create_approval_get_info($member_id)
  {
    $data['member_info']  =  TblMemberModel::where('tbl_member.member_id',$member_id)->Member()->first();
    $data['_member']        = TblMemberModel::get();
    foreach ($data['_member'] as $key => $member) 
    {
      $data['_member'][$key]['display_name'] =  $member['member_first_name']." ".$member['member_middle_name']." ".$member['member_last_name'];
    }
    return view('carewell.modal_pages.medical_create_approval_info',$data);
  }
  public function medical_approval_details()
  {
    return view('carewell.modal_pages.medical_approval_details');
  }

  /*HOSPITAL*/
  public function hospital()
  {
  	$data['page'] = 'Hospital';
    $data['user'] = $this->global();
  	return view('carewell.pages.hospital_center',$data);
  }

  /*PAYABLE*/
  public function payable()
  {
  	$data['page'] = 'Payable';
    $data['user'] = $this->global();
  	return view('carewell.pages.payable',$data);
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

    print_r($request->james);
    foreach($request->ajaxData as $key=> $availment_id)
    {
      $ins['availment_id']      = $availment_id;
      $ins['availment_plan_id'] = $availmentPlanData->availment_plan_id;
      $ins['availment_type_coverage_amount']  =   '155222';
      TblAvailmentTagModel::insert($ins);
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


}
