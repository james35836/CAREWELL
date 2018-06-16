<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\TblUserModel;
use App\Http\Model\TblUserInfoModel;
use App\Http\Model\TblCompanyModel;
use App\Http\Model\TblCompanyContractModel;
use App\Http\Model\TblCompanyJobsiteModel;
use App\Http\Model\TblMemberModel;
use App\Http\Model\TblMemberCompanyModel;
use App\Http\Model\TblMemberPaymentModel;

use Carbon\Carbon;
use DB;
use Crypt;

class MaintenanceController extends Controller
{
    public function developer_truncate()
    {
        dd('SORRY YOU ARE NOT ALLOWED HERE!');
        DB::table('tbl_approval')->truncate();
        DB::table('tbl_approval_availed')->truncate();
        DB::table('tbl_approval_diagnosis')->truncate();
        DB::table('tbl_approval_doctor')->truncate();
        DB::table('tbl_approval_payee')->truncate();

        DB::table('tbl_approval_procedure')->truncate();
        DB::table('tbl_approval_total')->truncate();
        DB::table('tbl_cal')->truncate();
        DB::table('tbl_cal_info')->truncate();
        DB::table('tbl_cal_member')->truncate();

        DB::table('tbl_cal_payment')->truncate();
        DB::table('tbl_company')->truncate();
        DB::table('tbl_company_contact_person')->truncate();
        DB::table('tbl_company_contract')->truncate();
        DB::table('tbl_company_contract_benefits')->truncate();

        DB::table('tbl_company_contract_image')->truncate();
        DB::table('tbl_company_coverage_plan')->truncate();
        DB::table('tbl_company_deployment')->truncate();
        DB::table('tbl_company_number')->truncate();
        DB::table('tbl_coverage_plan')->truncate();

        DB::table('tbl_coverage_plan_procedure')->truncate();
        DB::table('tbl_coverage_plan_tag')->truncate();
        DB::table('tbl_member')->truncate();
        DB::table('tbl_member_company')->truncate();
        DB::table('tbl_member_dependent')->truncate();

        DB::table('tbl_member_government_card')->truncate();
        DB::table('tbl_new_cal_member')->truncate();
        DB::table('tbl_new_member')->truncate();
        DB::table('tbl_payable')->truncate();
        DB::table('tbl_payable_approval')->truncate();


        echo "SUCCESS";
        
       
    // tbl_approval    
    // tbl_approval_availed    
    // tbl_approval_diagnosis  
    // tbl_approval_doctor
    // tbl_approval_payee  

    // tbl_approval_procedure   
    // tbl_approval_total
    // tbl_cal 
    // tbl_cal_info    
    // tbl_cal_member

    // tbl_cal_payment
    // tbl_company
    // tbl_company_contact_person  
    // tbl_company_contract    
    // tbl_company_contract_benefits

    // tbl_company_contract_image  
    // tbl_company_coverage_plan        
    // tbl_company_deployment  
    // tbl_company_number  
    // tbl_coverage_plan

    // tbl_coverage_plan_procedure
    // tbl_coverage_plan_tag   
    // tbl_member  
    // tbl_member_company  
    // tbl_member_dependent
        
    // tbl_member_government_card  
    // tbl_new_cal_member  
    // tbl_new_member  
    // tbl_payable 
    // tbl_payable_approval
            
    }
    public function developer_credential()
    {
        if (DB::table('tbl_user')->count() <= 0) 
        {
            $user[0]["user_id"]           = 1;
            $user[0]["user_email"]        = "carewelladmin@admin.com";
            $user[0]["user_password"]     = Crypt::encrypt('carewelladmin');
            $user[0]["user_position"]     = "ADMIN";
        
            DB::table('tbl_user')->insert($user);
        }
        if (DB::table('tbl_user_info')->count() <= 0) 
        {
            $user_info[0]["user_info_id"]       = 1;
            $user_info[0]["user_profile"]       = '/profile/default_profile.jpg';
            $user_info[0]["user_first_name"]    = "CAREWELL";
            $user_info[0]["user_middle_name"]   = "HMO";
            $user_info[0]["user_last_name"]     = "ADMIN";
            $user_info[0]["user_gender"]        = "NOT AVAILABLE";
            $user_info[0]["user_birthdate"]     = "NOT AVAILABLE";
            $user_info[0]["user_contact_number"]= "NOT AVAILABLE";
            $user_info[0]["user_number"]        = "CW-0000001";
            $user_info[0]["user_address"]       = "NOT AVAILABLE";
            $user_info[0]["user_created"]       = Carbon::now();
            $user_info[0]["user_id"]            = 1;
              
            DB::table('tbl_user_info')->insert($user_info);
        }
    }
	public function developer_maintenance()
    {
        if (DB::table('tbl_specialization')->count() <= 0) 
        {
            $specialization[0]["specialization_id"]    = 1;
            $specialization[0]["specialization_name"]   = "Allergist or Immunologist";
            
            $specialization[1]["specialization_id"]    = 2;
            $specialization[1]["specialization_name"]   = "Anesthesiologist";

            $specialization[2]["specialization_id"]    = 3;
            $specialization[2]["specialization_name"]   = "Cardiologist";

            $specialization[3]["specialization_id"]    = 4;
            $specialization[3]["specialization_name"]   = "Dermatologist";

            $specialization[4]["specialization_id"]    = 5;
            $specialization[4]["specialization_name"]   = "Gastroenterologist";

            $specialization[5]["specialization_id"]    = 6;
            $specialization[5]["specialization_name"]   = "Hematologist/Oncologist";

            $specialization[6]["specialization_id"]    = 7;
            $specialization[6]["specialization_name"]   = "Internal Medicine Physician";

            $specialization[7]["specialization_id"]    = 8;
            $specialization[7]["specialization_name"]   = "Nephrologist";

            $specialization[8]["specialization_id"]    = 9;
            $specialization[8]["specialization_name"]   = "Neurologist";
                              
            $specialization[9]["specialization_id"]    = 10;
            $specialization[9]["specialization_name"]   = "Neurosurgeon";

            $specialization[10]["specialization_id"]    = 11;
            $specialization[10]["specialization_name"]   = "Obstetrician";

            $specialization[11]["specialization_id"]    = 12;
            $specialization[11]["specialization_name"]   = "Gynecologist";

            $specialization[12]["specialization_id"]    = 13;
            $specialization[12]["specialization_name"]   = "Nurse-Midwifery";
            
            $specialization[13]["specialization_id"]    = 14;
            $specialization[13]["specialization_name"]   = "Occupational Medicine Physician";

            $specialization[14]["specialization_id"]    = 15;
            $specialization[14]["specialization_name"]   = "Ophthalmologist";
            
            $specialization[15]["specialization_id"]    = 16;
            $specialization[15]["specialization_name"]   = "Oral and Maxillofacial Surgeon";

            $specialization[16]["specialization_id"]    = 17;
            $specialization[16]["specialization_name"]   = "Orthopaedic Surgeon";

            $specialization[17]["specialization_id"]    = 18;
            $specialization[17]["specialization_name"]   = "Otolaryngologist (Head and Neck Surgeon)";

            $specialization[18]["specialization_id"]    = 19;
            $specialization[18]["specialization_name"]   = "Pathologist";

            $specialization[19]["specialization_id"]    = 20;
            $specialization[19]["specialization_name"]   = "Pediatrician";

            $specialization[20]["specialization_id"]    = 21;
            $specialization[20]["specialization_name"]   = "Plastic Surgeon";

            $specialization[21]["specialization_id"]    = 22;
            $specialization[21]["specialization_name"]   = "Podiatrist"; 

            $specialization[22]["specialization_id"]    = 23;
            $specialization[22]["specialization_name"]   = "Psychiatrist"; 

            $specialization[23]["specialization_id"]    = 24;
            $specialization[23]["specialization_name"]   = "Pulmonary Medicine Physician";

            $specialization[24]["specialization_id"]    = 25;
            $specialization[24]["specialization_name"]   = "Radiation Onconlogist";

            $specialization[25]["specialization_id"]    = 26;
            $specialization[25]["specialization_name"]   = "Diagnostic Radiologist";

            $specialization[26]["specialization_id"]    = 27;
            $specialization[26]["specialization_name"]   = "Rheumatologist";

            $specialization[27]["specialization_id"]    = 28;
            $specialization[27]["specialization_name"]   = "Urologist";

            
            DB::table('tbl_specialization')->insert($specialization);
        }
        if (DB::table('tbl_availment')->count() <= 0) 
        {
            $insert[0]["availment_id"]    = 1;
            $insert[0]["availment_name"]   = "Annual Physical Examination";
            $insert[0]["availment_parent_id"]    = 0;
            
            $insert[1]["availment_id"]    = 2;
            $insert[1]["availment_name"]   = "Outpatient Services(Consultation)";
            $insert[1]["availment_parent_id"]    = 0;

            $insert[2]["availment_id"]    = 3;
            $insert[2]["availment_name"]   = "Outpatient Services(Laboratory)";
            $insert[2]["availment_parent_id"]    = 0;

            $insert[3]["availment_id"]    = 4;
            $insert[3]["availment_name"]   = "Minor Operation";
            $insert[3]["availment_parent_id"]    = 0;

            $insert[4]["availment_id"]    = 5;
            $insert[4]["availment_name"]   = "Emergency Cases";
            $insert[4]["availment_parent_id"]    = 0;

            $insert[5]["availment_id"]    = 6;
            $insert[5]["availment_name"]   = "Confinement";
            $insert[5]["availment_parent_id"]    = 0;

            $insert[6]["availment_id"]    = 7;
            $insert[6]["availment_name"]   = "Dental";
            $insert[6]["availment_parent_id"]    = 0;

            $insert[7]["availment_id"]    = 8;
            $insert[7]["availment_name"]   = "Financial Assistance";
            $insert[7]["availment_parent_id"]    = 0;

            
            
            DB::table('tbl_availment')->insert($insert);
        }
        if (DB::table('tbl_payment_mode')->count() <= 0) 
        {
            $payment[0]["payment_mode_id"]    = 1;
            $payment[0]["payment_mode_name"]   = "SEMI-MONTHLY";
            
            $payment[1]["payment_mode_id"]    = 2;
            $payment[1]["payment_mode_name"]   = "MONTHLY";
            
            $payment[2]["payment_mode_id"]    = 3;
            $payment[2]["payment_mode_name"]   = "QUARTERLY";
            

            $payment[3]["payment_mode_id"]    = 4;
            $payment[3]["payment_mode_name"]   = "SEMESTRAL";
            
            $payment[4]["payment_mode_id"]    = 5;
            $payment[4]["payment_mode_name"]   = "ANNUAL";
            

            DB::table('tbl_payment_mode')->insert($payment);
        }
        if (DB::table('tbl_availment_charges')->count() <= 0) 
        {
            $charges[0]["availment_charges_id"]    = 1;
            $charges[0]["availment_charges_name"]   = "CHARGE TO MBL";
            
            $charges[1]["availment_charges_id"]    = 2;
            $charges[1]["availment_charges_name"]   = "OPEN WARD";
            
            $charges[2]["availment_charges_id"]    = 3;
            $charges[2]["availment_charges_name"]   = "COVERED 80%";
            

            $charges[3]["availment_charges_id"]    = 4;
            $charges[3]["availment_charges_name"]   = "60,000/CONFINEMENT";
            

            $charges[4]["availment_charges_id"]    = 5;
            $charges[4]["availment_charges_name"]   = "COVERED";
            

            DB::table('tbl_availment_charges')->insert($charges);
        }
        
        if (DB::table('tbl_doctor_procedure')->count() <= 0) 
        {
            $doctor_procedure[0]["doctor_procedure_id"]       = 1;
            $doctor_procedure[0]["doctor_procedure_code"]     = "10060";
            $doctor_procedure[0]["doctor_procedure_descriptive"]   = 'Incision and drainage of abscess (e.g., carbuncle, suppurative hidradenitis, cutaneous or subcutaneous abscess, cyst, furuncle, or paronychia)';
            $doctor_procedure[0]["doctor_procedure_rvu"]      = "10";
            $doctor_procedure[0]["doctor_procedure_case"]     = "100";

            $doctor_procedure[1]["doctor_procedure_id"]       = 2;
            $doctor_procedure[1]["doctor_procedure_code"]     = "10080";
            $doctor_procedure[1]["doctor_procedure_descriptive"]   = 'Incision and drainage of pilonidal cyst';
            $doctor_procedure[1]["doctor_procedure_rvu"]      = "10";
            $doctor_procedure[1]["doctor_procedure_case"]     = "100";

            $doctor_procedure[2]["doctor_procedure_id"]       = 3;
            $doctor_procedure[2]["doctor_procedure_code"]     = "10120";
            $doctor_procedure[2]["doctor_procedure_descriptive"]   = 'Incision and removal of foreign body, subcutaneous tissues';
            $doctor_procedure[2]["doctor_procedure_rvu"]      = "10";
            $doctor_procedure[2]["doctor_procedure_case"]     = "100";

            $doctor_procedure[3]["doctor_procedure_id"]       = 4;
            $doctor_procedure[3]["doctor_procedure_code"]     = "10140";
            $doctor_procedure[3]["doctor_procedure_descriptive"]   = 'Incision and drainage of hematoma, seroma, or fluid collection';
            $doctor_procedure[3]["doctor_procedure_rvu"]      = "10";
            $doctor_procedure[3]["doctor_procedure_case"]     = "100";

            $doctor_procedure[4]["doctor_procedure_id"]       = 5;
            $doctor_procedure[4]["doctor_procedure_code"]     = "10160";
            $doctor_procedure[4]["doctor_procedure_descriptive"]   = 'Puncture aspiration of abscess, hematoma, bulla, or cyst';
            $doctor_procedure[4]["doctor_procedure_rvu"]      = "10";
            $doctor_procedure[4]["doctor_procedure_case"]     = "100";

            $doctor_procedure[5]["doctor_procedure_id"]       = 6;
            $doctor_procedure[5]["doctor_procedure_code"]     = "10180";
            $doctor_procedure[5]["doctor_procedure_descriptive"]   = 'Incision and drainage, complex, postoperative wound infection';
            $doctor_procedure[5]["doctor_procedure_rvu"]      = "15";
            $doctor_procedure[5]["doctor_procedure_case"]     = "100";

            DB::table('tbl_doctor_procedure')->insert($doctor_procedure);
        }
        if (DB::table('tbl_procedure')->count() <= 0) 
        {
            $procedure[0]["procedure_id"]       = 1;
            $procedure[0]["procedure_name"]     = "Sakit sa tiyan";
            $procedure[0]["procedure_amount"]   = '2870';
            $procedure[0]["procedure_created"]  = Carbon::now();
            
            $procedure[1]["procedure_id"]       = 2;
            $procedure[1]["procedure_name"]     = "sakit sa puso";
            $procedure[1]["procedure_amount"]   = '5571';
            $procedure[1]["procedure_created"]  = Carbon::now();

            $procedure[2]["procedure_id"]       = 3;
            $procedure[2]["procedure_name"]     = "sakit sa baga";
            $procedure[2]["procedure_amount"]   = '1';
            $procedure[2]["procedure_created"]  = Carbon::now();

            $procedure[3]["procedure_id"]       = 4;
            $procedure[3]["procedure_name"]     = "sakit sa ulo";
            $procedure[3]["procedure_amount"]   = '851';
            $procedure[3]["procedure_created"]  = Carbon::now();

            $procedure[4]["procedure_id"]       = 5;
            $procedure[4]["procedure_name"]     = "sakit sa katawan";
            $procedure[4]["procedure_amount"]   = '875870';
            $procedure[4]["procedure_created"]  = Carbon::now();

            DB::table('tbl_procedure')->insert($procedure);
        }
        if (DB::table('tbl_laboratory')->count() <= 0) 
        {
            $laboratory[0]["laboratory_id"]       = 1;
            $laboratory[0]["laboratory_name"]     = "ABG ( ARTERIAL BLOOD GAS)";
            $laboratory[0]["laboratory_amount"]   = '2870';
            
            $laboratory[1]["laboratory_id"]       = 2;
            $laboratory[1]["laboratory_name"]     = "CARDIAC MONITOR/ DAY";
            $laboratory[1]["laboratory_amount"]   = '5571';
            
            $laboratory[2]["laboratory_id"]       = 3;
            $laboratory[2]["laboratory_name"]     = "CPAP MACHINE/ DAY";
            $laboratory[2]["laboratory_amount"]   = '1';
            
            $laboratory[3]["laboratory_id"]       = 4;
            $laboratory[3]["laboratory_name"]     = "DEFIBRILATOR MONITORING";
            $laboratory[3]["laboratory_amount"]   = '851';
            
            $laboratory[4]["laboratory_id"]       = 5;
            $laboratory[4]["laboratory_name"]     = "INFUSION PUMP";
            $laboratory[4]["laboratory_amount"]   = '870';

            $laboratory[5]["laboratory_id"]       = 6;
            $laboratory[5]["laboratory_name"]     = "NEBULIZATION";
            $laboratory[5]["laboratory_amount"]   = '270';
            
            $laboratory[6]["laboratory_id"]       = 7;
            $laboratory[6]["laboratory_name"]     = "O2 SPOT CHECK";
            $laboratory[6]["laboratory_amount"]   = '551';
            
            $laboratory[7]["laboratory_id"]       = 8;
            $laboratory[7]["laboratory_name"]     = "PFT W/OUT BRONCHODILTOR";
            $laboratory[7]["laboratory_amount"]   = '1';
            
            $laboratory[8]["laboratory_id"]       = 9;
            $laboratory[8]["laboratory_name"]     = "PFT WITH BRONCHODILATOR";
            $laboratory[8]["laboratory_amount"]   = '851';
            
            $laboratory[9]["laboratory_id"]       = 10;
            $laboratory[9]["laboratory_name"]     = "PULSE OXIMETER /DAY";
            $laboratory[9]["laboratory_amount"]   = '870';

            $laboratory[10]["laboratory_id"]       = 11;
            $laboratory[10]["laboratory_name"]     = "SYRINGE PUMP";
            $laboratory[10]["laboratory_amount"]   = '270';
            
            $laboratory[11]["laboratory_id"]       = 12;
            $laboratory[11]["laboratory_name"]     = "VENTILATOR (PB 7200)";
            $laboratory[11]["laboratory_amount"]   = '571';
            
            $laboratory[12]["laboratory_id"]       = 13;
            $laboratory[12]["laboratory_name"]     = "VENTILATOR (PLV/ IS)";
            $laboratory[12]["laboratory_amount"]   = '1';
            
            $laboratory[13]["laboratory_id"]       = 14;
            $laboratory[13]["laboratory_name"]     = "VENTILATOR BIPAP";
            $laboratory[13]["laboratory_amount"]   = '81';
            
            $laboratory[14]["laboratory_id"]       = 15;
            $laboratory[14]["laboratory_name"]     = "VENTILATOR PEDIA STR";
            $laboratory[14]["laboratory_amount"]   = '870';

            $laboratory[15]["laboratory_id"]       = 16;
            $laboratory[15]["laboratory_name"]     = "2D ECHO & VASCULAR CD COPY";
            $laboratory[15]["laboratory_amount"]   = '851';
            

            $laboratory[16]["laboratory_id"]       = 17;
            $laboratory[16]["laboratory_name"]     = "ACHIEVA VENT";
            $laboratory[16]["laboratory_amount"]   = '80';
            
            DB::table('tbl_laboratory')->insert($laboratory);
        }

        if (DB::table('tbl_position_access')->count() <= 0) 
        {
            $access[0]["access_id"]          = 1;
            $access[0]["access_name"]        = "Dashboard";
            $access[0]["access_segment"]     = "dashboard";
            $access[0]["access_parent_id"]   = 0;

            $access[1]["access_id"]          = 2;
            $access[1]["access_name"]        = "Create";
            $access[1]["access_segment"]     = "none";
            $access[1]["access_parent_id"]   = 1;

            $access[2]["access_id"]          = 3;
            $access[2]["access_name"]        = "Modify";
            $access[2]["access_segment"]     = "none";
            $access[2]["access_parent_id"]   = 1;

            $access[3]["access_id"]          = 4;
            $access[3]["access_name"]        = "Delete";
            $access[3]["access_segment"]     = "none";
            $access[3]["access_parent_id"]   = 1;

            $access[4]["access_id"]          = 5;
            $access[4]["access_name"]        = "View";
            $access[4]["access_segment"]     = "none";
            $access[4]["access_parent_id"]   = 1;


            $access[5]["access_id"]          = 6;
            $access[5]["access_name"]        = "Company";
            $access[5]["access_segment"]     = "company";
            $access[5]["access_parent_id"]   = 0;

            $access[6]["access_id"]          = 7;
            $access[6]["access_name"]        = "Create";
            $access[6]["access_segment"]     = "none";
            $access[6]["access_parent_id"]   = 6;

            $access[7]["access_id"]          = 8;
            $access[7]["access_name"]        = "Modify";
            $access[7]["access_segment"]     = "none";
            $access[7]["access_parent_id"]   = 6;

            $access[8]["access_id"]          = 9;
            $access[8]["access_name"]        = "Delete";
            $access[8]["access_segment"]     = "none";
            $access[8]["access_parent_id"]   = 6;

            $access[9]["access_id"]          = 10;
            $access[9]["access_name"]        = "View";
            $access[9]["access_segment"]     = "none";
            $access[9]["access_parent_id"]   = 6;

            $access[10]["access_id"]          = 11;
            $access[10]["access_name"]        = "Member";
            $access[10]["access_segment"]     = "member";
            $access[10]["access_parent_id"]   = 0;

            $access[11]["access_id"]          = 12;
            $access[11]["access_name"]        = "Create";
            $access[11]["access_segment"]     = "none";
            $access[11]["access_parent_id"]   = 11;

            $access[12]["access_id"]          = 13;
            $access[12]["access_name"]        = "Modify";
            $access[12]["access_segment"]     = "none";
            $access[12]["access_parent_id"]   = 11;

            $access[13]["access_id"]          = 14;
            $access[13]["access_name"]        = "Delete";
            $access[13]["access_segment"]     = "none";
            $access[13]["access_parent_id"]   = 11;

            $access[14]["access_id"]          = 15;
            $access[14]["access_name"]        = "View";
            $access[14]["access_segment"]     = "none";
            $access[14]["access_parent_id"]   = 11;

            $access[15]["access_id"]          = 16;
            $access[15]["access_name"]        = "Billing";
            $access[15]["access_segment"]     = "billing";
            $access[15]["access_parent_id"]   = 0;

            $access[16]["access_id"]          = 17;
            $access[16]["access_name"]        = "Create";
            $access[16]["access_segment"]     = "none";
            $access[16]["access_parent_id"]   = 16;

            $access[17]["access_id"]          = 18;
            $access[17]["access_name"]        = "Modify";
            $access[17]["access_segment"]     = "none";
            $access[17]["access_parent_id"]   = 16;

            $access[18]["access_id"]          = 19;
            $access[18]["access_name"]        = "Delete";
            $access[18]["access_segment"]     = "none";
            $access[18]["access_parent_id"]   = 16;

            $access[19]["access_id"]          = 20;
            $access[19]["access_name"]        = "View";
            $access[19]["access_segment"]     = "none";
            $access[19]["access_parent_id"]   = 16;


            $access[20]["access_id"]          = 21;
            $access[20]["access_name"]        = "Availment";
            $access[20]["access_segment"]     = "availment";
            $access[20]["access_parent_id"]   = 0;

            $access[21]["access_id"]          = 22;
            $access[21]["access_name"]        = "Create";
            $access[21]["access_segment"]     = "none";
            $access[21]["access_parent_id"]   = 21;

            $access[22]["access_id"]          = 23;
            $access[22]["access_name"]        = "Modify";
            $access[22]["access_segment"]     = "none";
            $access[22]["access_parent_id"]   = 21;

            $access[23]["access_id"]          = 24;
            $access[23]["access_name"]        = "Delete";
            $access[23]["access_segment"]     = "none";
            $access[23]["access_parent_id"]   = 21;

            $access[24]["access_id"]          = 25;
            $access[24]["access_name"]        = "View";
            $access[24]["access_segment"]     = "none";
            $access[24]["access_parent_id"]   = 21;

            $access[25]["access_id"]          = 26;
            $access[25]["access_name"]        = "Payable";
            $access[25]["access_segment"]     = "payable";
            $access[25]["access_parent_id"]   = 0;

            $access[26]["access_id"]          = 27;
            $access[26]["access_name"]        = "Create";
            $access[26]["access_segment"]     = "none";
            $access[26]["access_parent_id"]   = 26;

            $access[27]["access_id"]          = 28;
            $access[27]["access_name"]        = "Modify";
            $access[27]["access_segment"]     = "none";
            $access[27]["access_parent_id"]   = 26;

            $access[28]["access_id"]          = 29;
            $access[28]["access_name"]        = "Delete";
            $access[28]["access_segment"]     = "none";
            $access[28]["access_parent_id"]   = 26;

            $access[29]["access_id"]          = 30;
            $access[29]["access_name"]        = "View";
            $access[29]["access_segment"]     = "none";
            $access[29]["access_parent_id"]   = 26;

            $access[30]["access_id"]          = 31;
            $access[30]["access_name"]        = "Reports";
            $access[30]["access_segment"]     = "reports";
            $access[30]["access_parent_id"]   = 0;

            $access[31]["access_id"]          = 32;
            $access[31]["access_name"]        = "Create";
            $access[31]["access_segment"]     = "none";
            $access[31]["access_parent_id"]   = 31;

            $access[32]["access_id"]          = 33;
            $access[32]["access_name"]        = "Modify";
            $access[32]["access_segment"]     = "none";
            $access[32]["access_parent_id"]   = 31;

            $access[33]["access_id"]          = 34;
            $access[33]["access_name"]        = "Delete";
            $access[33]["access_segment"]     = "none";
            $access[33]["access_parent_id"]   = 31;

            $access[34]["access_id"]          = 36;
            $access[34]["access_name"]        = "View";
            $access[34]["access_segment"]     = "none";
            $access[34]["access_parent_id"]   = 31;

            
            DB::table('tbl_position_access')->insert($access);
        }
            
    }
}
