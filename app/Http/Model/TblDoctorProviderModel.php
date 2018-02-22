<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDoctorProviderModel extends Model
{
    protected $table = 'tbl_doctor_provider';
    protected $primaryKey = 'doctor_provider_id';
    public $timestamps = false;

    public function scopeDoctorProvider($query)
    {
    	$query->join('tbl_provider','tbl_provider.provider_id','=','tbl_doctor_provider.provider_id')
              ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_doctor_provider.doctor_id');
        return $query;
                              
    }
 
}
