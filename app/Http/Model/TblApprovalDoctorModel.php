<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalDoctorModel extends Model
{
    protected $table = 'tbl_approval_doctor';
    protected $primaryKey = 'approval_doctor_id';
    public $timestamps = false;

    public function scopeApprovalDoctor($query)
    {
    	$query	->join('tbl_doctor_procedure','tbl_doctor_procedure.doctor_procedure_id','=','tbl_approval_doctor.doctor_procedure_id')
              	->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id')
              	->join('tbl_specialization','tbl_specialization.specialization_id','=','tbl_approval_doctor.specialization_id');
    	return $query;
    }
}

