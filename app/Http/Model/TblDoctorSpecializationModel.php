<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDoctorSpecializationModel extends Model
{
    protected $table = 'tbl_doctor_specialization';
    protected $primaryKey = 'specialization_id';
    public $timestamps = false;

 
}
