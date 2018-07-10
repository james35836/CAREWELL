<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblApprovalDoctorModel extends Model
{
    protected $table = 'tbl_approval_doctor';
    protected $primaryKey = 'approval_doctor_id';
    public $timestamps = false;

    public function scopeApprovalDoctor($query)
    {
    	$query	->join('tbl_doctor_procedure','tbl_doctor_procedure.doctor_procedure_id','=','tbl_approval_doctor.doctor_procedure_id')
              	->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id');
        return $query;
    }
    public function scopeDistinctDoctor($query)
    {
    	$query  ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id')
                ->select([DB::RAW('DISTINCT(tbl_approval_doctor.doctor_id)'),'tbl_doctor.doctor_full_name','tbl_doctor.doctor_id']);
        return $query;
    }
}

