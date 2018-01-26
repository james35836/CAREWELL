<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDoctorModel extends Model
{
    protected $table = 'tbl_doctor';
    protected $primaryKey = 'doctor_id';
    public $timestamps = false;

    public function scopeDoctor($query)
    {
    	$query->join('tbl_doctor_provider','tbl_doctor_provider.doctor_id','=','tbl_doctor.doctor_id');
    	$query->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id');
    	return $query;
    }
    
}

