<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDoctorModel extends Model
{
    protected $table = 'tbl_doctor';
    protected $primaryKey = 'doctor_id';
    public $timestamps = false;

    
}

