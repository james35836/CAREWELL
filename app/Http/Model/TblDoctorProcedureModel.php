<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDoctorProcedureModel extends Model
{
    protected $table = 'tbl_doctor_procedure';
    protected $primaryKey = 'doctor_procedure_id';
    public $timestamps = false;

    
}

