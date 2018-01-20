<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\TblUserModel;
use Illuminate\Support\Facades\Input;
use Carbon;
use Excel;

use DB;



class TestController extends Controller
{
  public function global()
  {
    $user="James Omosora";
    return $user;
  }


  public function importExport()
  {
    return view('importExport');
  }
  public function downloadExcel($type)
  {
    $data = TblUserModel::get()->toArray();
    return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
          {
            $sheet->fromArray($data);
          });
    })->download($type);
  }
  public function importExcel()
  {
    $path = Input::file('import_file')->getRealPath();
    Excel::load($path, function($reader) {
        $sheetTitle = array();
        $results = $reader->all();
        foreach($results as $key=>$sheet)
        {
            $sheetTitle[$key]["email"] = $sheet->email;
            $sheetTitle[$key]["password"] = $sheet->password;
            $sheetTitle[$key]["user_info_id"] = $sheet->user_info_id;
        }
        DB::table('tbl_user')->insert($sheetTitle);
        return dd(\DB::table('tbl_user')->get());
    });
  }


  public function sample()
  {
    return view('sample');
  }
	public function testing_excel()
  {
    $data['page'] = 'Company';
    $data['name'] = $this->global();
    $excel='excel';
    $data=2;
    Excel::create("MERCHANT LIST",function($excel) 
        {
          $excel->sheet('clients',function($sheet) 
          {
            $sheet->loadView('welcome');
          });
        })->download('xls');
    
  }
  public function testing()
  {
    $encrypted = Crypt::encrypt('habagat');

    $decrypted = Crypt::decrypt($encrypted);
    dd($encrypted." ".$decrypted);
  }
  public function testing_excel2()
     {
          $excels['number_of_rows'] = 10;

          $excels['data'] = ['Company*','Gender (M/F)*'];
          \Excel::create('201 Template', function($excel) use ($excels) {

               $excel->sheet('template', function($sheet) use ($excels) {

                $data = $excels['data'];
                $number_of_rows = $excels['number_of_rows'];
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->freezeFirstRow();

                for($row = 1, $rowcell = 2; $row <= $number_of_rows; $row++, $rowcell++)
                {

                    /* COMPANY/CLIENT ROW */
                    $client_cell = $sheet->getCell('A'.$rowcell)->getDataValidation();
                    $client_cell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                    $client_cell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                    $client_cell->setAllowBlank(false);
                    $client_cell->setShowInputMessage(true);
                    $client_cell->setShowErrorMessage(true);
                    $client_cell->setShowDropDown(true);
                    $client_cell->setErrorTitle('Input error');
                    $client_cell->setError('Value is not in list.');
                    $client_cell->setFormula1('client');


                    /* GENDER ROW */
                    $gender_cell = $sheet->getCell('B'.$rowcell)->getDataValidation();
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
            $excel->sheet('reference', function($sheet) {

                $_company          = TblUserModel::get();

                $_status           = TblUserModel::get();
                $_department       = TblUserModel::get();
                $_position         = TblUserModel::get();

                $_country          = TblUserModel::get();

                /* COMPANY/CLIENT REFERENCES */
                $sheet->SetCellValue("A1", "Client");
                $client_number = 2;
                foreach($_company as $company)
                {
                    $sheet->SetCellValue("A".$client_number, 'james');
                    $client_number++;
                }
                $client_number--;

                

                /* GENDER REFERENCE */
                $sheet->SetCellValue("B1", "Gender");
                $sheet->SetCellValue("B2", "male");
                $sheet->SetCellValue("B3", "female");

                /* YES OR NO REFERENCE */
                $sheet->SetCellValue("D1", "Yes or No");
                $sheet->SetCellValue("D2", "Y");
                $sheet->SetCellValue("D3", "N");
                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                    'client', $sheet, 'A2:A'.$client_number
                    )
                );

                

                // $sheet->_parent->addNamedRange(
                //     new \PHPExcel_NamedRange(
                //     'gender', $sheet, 'B2:B4'
                //     )
                // );

                


            });


        })->download('xls');
     }

     public function import_201_template()
     {
          $file = Request::file('file');
          $_data = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();
          $first = $_data[0]; 
         
          /* check index exist */
          
          if(isset($first['company']) && isset($first['first_name']) && isset($first['department']) && isset($first['start_date']))
          {    
               $count = 0;
               foreach($_data as $data)
               {
                    $count_employee = Tbl_payroll_employee_basic::where('payroll_employee_company_id',Self::getid($data['company'], 'company'))
                                                               ->where('payroll_employee_first_name',Self::nullableToString($data['first_name']))
                                                               ->where('payroll_employee_middle_name', Self::nullableToString($data['middle_name']))
                                                               ->where('payroll_employee_last_name',Self::nullableToString($data['last_name']))
                                                               ->count();
                    // dd($count_employee);
                    if($count_employee == 0)
                    {
                         /* EMPLOYEE BASIC INSERT START */
                         $insert['shop_id']                                = Self::shop_id();
                         $insert['payroll_employee_company_id']       = Self::getid($data['company'], 'company');
                         $insert['payroll_employee_title_name']       = Self::nullableToString($data['title_name']);
                         $insert['payroll_employee_first_name']       = Self::nullableToString($data['first_name']);
                         $insert['payroll_employee_middle_name']      = Self::nullableToString($data['middle_name']);
                         $insert['payroll_employee_last_name']        = Self::nullableToString($data['last_name']);
                         $insert['payroll_employee_suffix_name']      = Self::nullableToString($data['suffix_name']);
                         $insert['payroll_employee_display_name']     = Self::nullableToString($data['title_name']).' '.Self::nullableToString($data['first_name']).' '.Self::nullableToString($data['middle_name']).' '.Self::nullableToString($data['last_name']).' '.Self::nullableToString($data['suffix_name']);

                         $insert['payroll_employee_contact']          = Self::nullableToString($data['contact']);
                         $insert['payroll_employee_email']            = Self::nullableToString($data['email_address']);
                         $insert['payroll_employee_birthdate']        = Self::nullableToString($data['birthdate']);
                         $insert['payroll_employee_gender']                = Self::nullableToString($data['gender_mf']);
                         $insert['payroll_employee_number']                = Self::nullableToString($data['employee_number']);
                         $insert['payroll_employee_atm_number']       = Self::nullableToString($data['atmaccount_number']);
                         $insert['payroll_employee_street']                = Self::nullableToString($data['street']);
                         $insert['payroll_employee_city']             = Self::nullableToString($data['citytown']);
                         $insert['payroll_employee_state']            = Self::nullableToString($data['stateprovince']);
                         $insert['payroll_employee_zipcode']          = Self::nullableToString($data['zip_code']);
                         $insert['payroll_employee_country']          = Self::getid($data['country'], 'country');
                         $insert['payroll_employee_tax_status']       = Self::nullableToString($data['tax_status']);
                         $insert['payroll_employee_tin']              = Self::nullableToString($data['tin']);
                         $insert['payroll_employee_sss']              = Self::nullableToString($data['sss_number']);
                         $insert['payroll_employee_pagibig']          = Self::nullableToString($data['pagibig_number']);
                         $insert['payroll_employee_philhealth']       = Self::nullableToString($data['philhealth_number']);
                         $insert['payroll_employee_remarks']          = Self::nullableToString($data['remarks']);


                         if(Self::getid($data['company'], 'company') != null && Self::checkemployee_exist($insert) == 0)
                         {
                              
                              // dd($insert);

                              $payroll_employee_id = Tbl_payroll_employee_basic::insertGetId($insert);
                              $new_data = AuditTrail::get_table_data("tbl_payroll_employee_basic","payroll_employee_id",$payroll_employee_id);
                               AuditTrail::record_logs("CREATED: Payroll Employee","Created Payroll Employee With Employee Name: ".Self::nullableToString($data['title_name']).' '.Self::nullableToString($data['first_name']).' '.Self::nullableToString($data['middle_name']).' '.Self::nullableToString($data['last_name']).' '.Self::nullableToString($data['suffix_name']),$payroll_employee_id,"",serialized($new_data));
                              /* EMPLOYEE BASIC INSERT END */

                              /*   EMPLOYEE CONTRACT START */
                              $insert_contract['payroll_employee_id']                          = $payroll_employee_id;
                              $insert_contract['payroll_department_id']                        = Self::getid($data['department'],'department');
                              $insert_contract['payroll_jobtitle_id']                          = Self::getid($data['position'],'jobtitle');
                              $insert_contract['payroll_employee_contract_date_hired']    = Self::nullableToString($data['start_date']);
                              $insert_contract['payroll_employee_contract_status']        = Self::getid($data['employment_status'],'employment_status');
                              
                              $payroll_contract_id=Tbl_payroll_employee_contract::insertGetId($insert_contract);
                              $new_data = AuditTrail::get_table_data("tbl_payroll_employee_basic","payroll_employee_id",$payroll_employee_id);
                              AuditTrail::record_logs("CREATED: Payroll Contract","Payroll Employee Contract Employee ID #".$payroll_employee_id,$payroll_contract_id,"",$new_data);

                              /*   EMPLOYEE CONTRACT END */


                              /* EMPLOYEE SALARY START */
                              $insert_salary['payroll_employee_id']                            = $payroll_employee_id;
                              $insert_salary['payroll_employee_salary_effective_date']    = Self::nullableToString($data['start_date']);
                              $insert_salary['payroll_employee_salary_minimum_wage']           = Self::yesNotoInt($data['minimum_wage_yn']);
                              $insert_salary['payroll_employee_salary_monthly']                = Self::nullableToString($data['monthly_salary'],'int');
                              $insert_salary['payroll_employee_salary_daily']             = Self::nullableToString($data['daily_rate'],'int');
                              $insert_salary['payroll_employee_salary_taxable']                = Self::nullableToString($data['taxable_salary'],'int');
                              $insert_salary['payroll_employee_salary_sss']                    = Self::nullableToString($data['sss_salary'],'int');
                              $insert_salary['payroll_employee_salary_pagibig']                = Self::nullableToString($data['hdmf_salary'],'int');
                              $insert_salary['payroll_employee_salary_philhealth']        = Self::nullableToString($data['phic_salary'],'int');
                              AuditTrail::record_logs("ADDED: Payroll Employee Salary","Added Payroll Employee Salary with employee ID #".$payroll_employee_id,$payroll_employee_id,"","");
                              Tbl_payroll_employee_salary::insert($insert_salary);
                              
                              /* EMPLOYEE SALARY END */

                              /* EMPLOYEE  REQUIREMENTS START*/
               
                              $insert_requirement['payroll_employee_id']        = $payroll_employee_id;
                              $insert_requirement['has_resume']                 = Self::yesNotoInt($data['biodataresumeyn'],'int');
                              $insert_requirement['has_police_clearance']       = Self::yesNotoInt($data['police_clearanceyn'],'int');
                              $insert_requirement['has_nbi']                    = Self::yesNotoInt($data['nbiyn'],'int');
                              $insert_requirement['has_health_certificate']     = Self::yesNotoInt($data['health_certificateyn'],'int');
                              $insert_requirement['has_school_credentials']     = Self::yesNotoInt($data['school_credentialsyn'],'int');
                              $insert_requirement['has_valid_id']               = Self::yesNotoInt($data['valid_idyn'],'int');
                              AuditTrail::record_logs("Adding Employee Requirements","Adding Payroll Employee Requirements with Employee ID #".$payroll_employee_id,$payroll_employee_id,"",serialize($new_data));
                              Tbl_payroll_employee_requirements::insert($insert_requirement);
                              /* EMPLOYEE  REQUIREMENTS END*/
                              
                              

                              /* EMPLOYEE DEPENDENT START */
                              $insert_dependent = array();
                              $temp = '';
                              for($i = 1; $i <= 4; $i++)
                              {
                                   if($data['dependent_full_name'.$i] != null || $data['dependent_full_name'.$i] != "")
                                   {
                                        $temp['payroll_employee_id']            = $payroll_employee_id;
                                        $temp['payroll_dependent_name']         = Self::nullableToString($data['dependent_full_name'.$i]);
                                        $temp['payroll_dependent_relationship'] = Self::nullableToString($data['dependent_relationship'.$i]);
                                        $temp['payroll_dependent_birthdate']    = Self::nullableToString($data['dependent_birthdate'.$i]);
                                        array_push($insert_dependent, $temp);
                                   }
                              }
                              
                              if(!empty($insert_dependent))
                              {
                                   Tbl_payroll_employee_dependent::insert($insert_dependent);
                                   AuditTrail::record_logs("CREATED: Payroll Employee Dependent","Payroll Employee Dependent #".$paroll_employee_id,$paroll_employee_id,"","");
                              }
                              
                              $count++;
                         }
                         
                         /* EMPLOYEE DEPENDENT END */
                    }
                    
               }    

               $message = '<center><b><span class="color-green">'.$count.' Employee/s has been inserted.</span></b></center>';
               $return['status'] = 'success';
               if($count == 0)
               {
                    $message = '<center><b><span class="color-gray">There is nothing to insert</span></b></center>';
                    $return['status'] = 'none';
               }
               $return['message'] = $message;


               return $return;
          }
          else
          {
               $return['status']   = 'error';
               $return['message']  = '<center><b><span class="color-red">Wrong file Format</span></b></center>';
               return $return;
          }
     }
}
