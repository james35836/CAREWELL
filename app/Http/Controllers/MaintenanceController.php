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
            DB::table('tbl_company')->truncate();
            DB::table('tbl_cal')->truncate();
            DB::table('tbl_cal_member')->truncate();
            DB::table('tbl_company_contract')->truncate();
            DB::table('tbl_company_coverage_plan')->truncate();
            DB::table('tbl_member')->truncate();
            DB::table('tbl_member_company')->truncate();
            DB::table('tbl_member_dependent')->truncate();
            DB::table('tbl_member_government_card')->truncate();
            DB::table('tbl_member_payment')->truncate();
            
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
         // $up['user_profile']  = '/profile/sam.jpg';
         // TblUserInfoModel::where('user_info_id',1)->update($up);  

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
            $insert[0]["availment_name"]   = "Anual Physical Examination";
            $insert[0]["availment_parent_id"]    = 0;
            
            $insert[1]["availment_id"]    = 2;
            $insert[1]["availment_name"]   = "Basic 5(Urinalysis, Complete Blood Count, Chest X-ray, Fecalysis, Physical Exam)";
            $insert[1]["availment_parent_id"]    = 1;

            $insert[2]["availment_id"]    = 3;
            $insert[2]["availment_name"]   = "Drug Test";
            $insert[2]["availment_parent_id"]    = 1;

            $insert[3]["availment_id"]    = 4;
            $insert[3]["availment_name"]   = "Hepatitis A and Hepatitis B Test";
            $insert[3]["availment_parent_id"]    = 1;

            $insert[4]["availment_id"]    = 5;
            $insert[4]["availment_name"]   = "Electrocardiogram";
            $insert[4]["availment_parent_id"]    = 1;

            $insert[5]["availment_id"]    = 6;
            $insert[5]["availment_name"]   = "Pap Smear";
            $insert[5]["availment_parent_id"]    = 1;

            $insert[6]["availment_id"]    = 7;
            $insert[6]["availment_name"]   = "Charge to Client";
            $insert[6]["availment_parent_id"]    = 1;

            $insert[7]["availment_id"]    = 8;
            $insert[7]["availment_name"]   = "No Coverage";
            $insert[7]["availment_parent_id"]    = 1;

            $insert[8]["availment_id"]    = 9;
            $insert[8]["availment_name"]   = "dfgdfg";
            $insert[8]["availment_parent_id"]    = 1;

            $insert[9]["availment_id"]    = 10;
            $insert[9]["availment_name"]   = "Outpatient Services(consultation)";
            $insert[9]["availment_parent_id"]    = 0;

            $insert[10]["availment_id"]    = 11;
            $insert[10]["availment_name"]   = "No Limit";
            $insert[10]["availment_parent_id"]    = 10;

            $insert[11]["availment_id"]    = 12;
            $insert[11]["availment_name"]   = "Once a Month";
            $insert[11]["availment_parent_id"]    = 10;

            $insert[12]["availment_id"]    = 13;
            $insert[12]["availment_name"]   = "Charge to MBL";
            $insert[12]["availment_parent_id"]    = 10;
            
            $insert[13]["availment_id"]    = 14;
            $insert[13]["availment_name"]   = "Charge to Client";
            $insert[13]["availment_parent_id"]    = 10;

            $insert[14]["availment_id"]    = 15;
            $insert[14]["availment_name"]   = "Prenatal Consultation(Once a Month)";
            $insert[14]["availment_parent_id"]    = 10;

            $insert[15]["availment_id"]    = 16;
            $insert[15]["availment_name"]   = "Outpatient Services(Laboratory)";
            $insert[15]["availment_parent_id"]    = 0;

            $insert[16]["availment_id"]    = 17;
            $insert[16]["availment_name"]   = "No Limit";
            $insert[16]["availment_parent_id"]    = 16;

            $insert[17]["availment_id"]    = 18;
            $insert[17]["availment_name"]   = "2, 000/Year";
            $insert[17]["availment_parent_id"]    = 16;

            $insert[18]["availment_id"]    = 19;
            $insert[18]["availment_name"]   = "5, 000/Year";
            $insert[18]["availment_parent_id"]    = 16;

            $insert[19]["availment_id"]    = 20;
            $insert[19]["availment_name"]   = "10, 000/Year";
            $insert[19]["availment_parent_id"]    = 16;

            $insert[20]["availment_id"]    = 21;
            $insert[20]["availment_name"]   = "30, 000/Year";
            $insert[20]["availment_parent_id"]    = 16;

            $insert[21]["availment_id"]    = 22;
            $insert[21]["availment_name"]   = "Charge to MBL";
            $insert[21]["availment_parent_id"]    = 16;

            $insert[22]["availment_id"]    = 23;
            $insert[22]["availment_name"]   = "Charge to Client";
            $insert[22]["availment_parent_id"]    = 16;

            $insert[23]["availment_id"]    = 24;
            $insert[23]["availment_name"]   = "Emergency";
            $insert[23]["availment_parent_id"]    = 0;

            $insert[24]["availment_id"]    = 25;
            $insert[24]["availment_name"]   = "No Limit";
            $insert[24]["availment_parent_id"]    = 24;

            $insert[25]["availment_id"]    = 26;
            $insert[25]["availment_name"]   = "5, 000/Year";
            $insert[25]["availment_parent_id"]    = 24;

            $insert[26]["availment_id"]    = 27;
            $insert[26]["availment_name"]   = "10, 000/Year";
            $insert[26]["availment_parent_id"]    = 24;

            $insert[27]["availment_id"]    = 28;
            $insert[27]["availment_name"]   = "20, 000/Year";
            $insert[27]["availment_parent_id"]    = 24;

            $insert[28]["availment_id"]    = 29;
            $insert[28]["availment_name"]   = "30, 000/Year";
            $insert[28]["availment_parent_id"]    = 24;

            $insert[29]["availment_id"]    = 30;
            $insert[29]["availment_name"]   = "Charge to MBL";
            $insert[29]["availment_parent_id"]    = 24;

            $insert[30]["availment_id"]    = 31;
            $insert[30]["availment_name"]   = "Charge to Client";
            $insert[30]["availment_parent_id"]    = 24;

            $insert[31]["availment_id"]    = 32;
            $insert[31]["availment_name"]   = "Motorcycle Accident - Not Covered";
            $insert[31]["availment_parent_id"]    = 24;

            $insert[32]["availment_id"]    = 33;
            $insert[32]["availment_name"]   = "Motorcycle Accident - 10, 000/Year";
            $insert[32]["availment_parent_id"]    = 24;

            $insert[33]["availment_id"]    = 34;
            $insert[33]["availment_name"]   = "Motorcycle Accident - 30, 000/Year";
            $insert[33]["availment_parent_id"]    = 24;

            $insert[34]["availment_id"]    = 35;
            $insert[34]["availment_name"]   = "Confinement";
            $insert[34]["availment_parent_id"]    = 0;

            $insert[35]["availment_id"]    = 36;
            $insert[35]["availment_name"]   = "10, 000/Year";
            $insert[35]["availment_parent_id"]    = 35;

            $insert[36]["availment_id"]    = 37;
            $insert[36]["availment_name"]   = "30, 000/Single Confinement/Illness/Disease";
            $insert[36]["availment_parent_id"]    = 35;

            $insert[37]["availment_id"]    = 38;
            $insert[37]["availment_name"]   = "30, 000/Single Confinement";
            $insert[37]["availment_parent_id"]    = 35;

            $insert[38]["availment_id"]    = 39;
            $insert[38]["availment_name"]   = "50, 000 MBL";
            $insert[38]["availment_parent_id"]    = 35;

            $insert[39]["availment_id"]    = 40;
            $insert[39]["availment_name"]   = "60, 000 MBL";
            $insert[39]["availment_parent_id"]    = 35;

            $insert[40]["availment_id"]    = 41;
            $insert[40]["availment_name"]   = "60, 000/Year";
            $insert[40]["availment_parent_id"]    = 35;

            $insert[41]["availment_id"]    = 42;
            $insert[41]["availment_name"]   = "60, 000/Year/Illnesss/Disease";
            $insert[41]["availment_parent_id"]    = 35;

            $insert[42]["availment_id"]    = 43;
            $insert[42]["availment_name"]   = "100, 000/Year/Illnesss/Disease";
            $insert[42]["availment_parent_id"]    = 35;

            $insert[43]["availment_id"]    = 44;
            $insert[43]["availment_name"]   = "200, 000/Year/Illnesss/Disease";
            $insert[43]["availment_parent_id"]    = 35;

            $insert[44]["availment_id"]    = 45;
            $insert[44]["availment_name"]   = "Charge to MBL";
            $insert[44]["availment_parent_id"]    = 35;

            $insert[45]["availment_id"]    = 46;
            $insert[45]["availment_name"]   = "Charge to Client";
            $insert[45]["availment_parent_id"]    = 35;

            $insert[46]["availment_id"]    = 47;
            $insert[46]["availment_name"]   = "Motorcycle Accident- Not Covered";
            $insert[46]["availment_parent_id"]    = 35;

            $insert[47]["availment_id"]    = 48;
            $insert[47]["availment_name"]   = "Motorcycle Accident- 10, 000/Year";
            $insert[47]["availment_parent_id"]    = 35;

            $insert[48]["availment_id"]    = 49;
            $insert[48]["availment_name"]   = "Motorcycle Accident- 30, 000/Year";
            $insert[48]["availment_parent_id"]    = 35;

            $insert[49]["availment_id"]    = 50;
            $insert[49]["availment_name"]   = "Dental";
            $insert[49]["availment_parent_id"]    = 0;
            
            $insert[50]["availment_id"]    = 51;
            $insert[50]["availment_name"]   = "Consultation";
            $insert[50]["availment_parent_id"]    = 50;


            $insert[51]["availment_id"]    = 52;
            $insert[51]["availment_name"]   = "Simple Tooth Extraction";
            $insert[51]["availment_parent_id"]    = 50;

            $insert[52]["availment_id"]    = 53;
            $insert[52]["availment_name"]   = "Temporary Pasta";
            $insert[52]["availment_parent_id"]    = 50;


            $insert[53]["availment_id"]    = 54;
            $insert[53]["availment_name"]   = "Two Pasta/Year";
            $insert[53]["availment_parent_id"]    = 50;

            $insert[54]["availment_id"]    = 55;
            $insert[54]["availment_name"]   = "Oral Prophylaxis(Once a Year)";
            $insert[54]["availment_parent_id"]    = 50;

            $insert[55]["availment_id"]    = 56;
            $insert[55]["availment_name"]   = "No Dental Coverage";
            $insert[55]["availment_parent_id"]    = 50;

            $insert[56]["availment_id"]    = 57;
            $insert[56]["availment_name"]   = "Charge to Client";
            $insert[56]["availment_parent_id"]    = 50;

            $insert[57]["availment_id"]    = 58;
            $insert[57]["availment_name"]   = "Charge to MBL";
            $insert[57]["availment_parent_id"]    = 50;

            $insert[58]["availment_id"]    = 59;
            $insert[58]["availment_name"]   = "Financial Assistance";
            $insert[58]["availment_parent_id"]    = 0;

            $insert[59]["availment_id"]    = 60;
            $insert[59]["availment_name"]   = "Natural Death";
            $insert[59]["availment_parent_id"]    = 59;

            $insert[60]["availment_id"]    = 61;
            $insert[60]["availment_name"]   = "P 5, 000";
            $insert[60]["availment_parent_id"]    = 60;

            $insert[61]["availment_id"]    = 62;
            $insert[61]["availment_name"]   = "P 10, 000";
            $insert[61]["availment_parent_id"]    = 60;

            $insert[62]["availment_id"]    = 63;
            $insert[62]["availment_name"]   = "No Coverage";
            $insert[62]["availment_parent_id"]    = 60;

            $insert[63]["availment_id"]    = 64;
            $insert[63]["availment_name"]   = "Accidental Death";
            $insert[63]["availment_parent_id"]    = 59;

            $insert[64]["availment_id"]    = 65;
            $insert[64]["availment_name"]   = "P 10, 000";
            $insert[64]["availment_parent_id"]    = 64;

            $insert[65]["availment_id"]    = 66;
            $insert[65]["availment_name"]   = "P 20, 000";
            $insert[65]["availment_parent_id"]    = 64;

            $insert[66]["availment_id"]    = 67;
            $insert[66]["availment_name"]   = "P 100, 000";
            $insert[66]["availment_parent_id"]    = 64;

            $insert[67]["availment_id"]    = 68;
            $insert[67]["availment_name"]   = "P 120, 000";
            $insert[67]["availment_parent_id"]    = 64;

            $insert[68]["availment_id"]    = 69;
            $insert[68]["availment_name"]   = "No Coverage";
            $insert[68]["availment_parent_id"]    = 64;
            
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









    }

}
