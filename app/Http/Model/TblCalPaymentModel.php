<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCalPaymentModel extends Model
{
    protected $table = 'tbl_cal_payment';
    protected $primaryKey = 'cal_payment_id';
    public $timestamps = false;
    
    public function scopeCalInfo($query)
    {
    		$query 	->join('tbl_cal_member','tbl_cal_member.cal_member_id','tbl_cal_payment.cal_member_id')
    		        ->join('tbl_cal','tbl_cal.cal_id','=','tbl_cal_member.cal_id');
    		return $query;
    }
    public function scopeCalStatus($query)
    {
    	$query 	->where(function($query)
				{
					$query->where('archived',1);
					$query->orWhere('archived',2);
					
				});
    	return $query;
    }
    
}

