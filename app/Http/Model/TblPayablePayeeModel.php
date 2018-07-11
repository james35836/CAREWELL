<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayablePayeeModel extends Model
{
    protected $table = 'tbl_payable_payee';
    protected $primaryKey = 'payable_payee_id';
    public $timestamps = false;

    public function scopePayablePayee($query,$payable_type)
    {
    	
    	if($payable_type=="PROVIDER_PAYEE")
    	{
    		$query  ->where('payable_payee_type','PROVIDER_PAYEE');
    		$query  ->join('tbl_provider','tbl_provider.provider_id','=','tbl_payable_payee.provider_id');
    	}
    	else
    	{
    		$query  ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_payable_payee.doctor_id');
    	}
    	return $query;
    	
    }
}

