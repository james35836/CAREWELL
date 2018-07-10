<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblApprovalPayeeModel extends Model
{
    protected $table = 'tbl_approval_payee';
    protected $primaryKey = 'payee_approval_id	';
    public $timestamps = false;

    public function scopePayeeDoctor($query)
    {
    		$query  ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_payee.doctor_id');
    		return $query;
    }
    public function scopePayeeProvider($query)
    {
    		$query  ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval_payee.provider_id');
    		return $query;
    }
    public function scopeDistinctProvider($query)
    {

    }
    public function scopeDistinctDoctor($query)
    {
        
    }
    
}

