<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCalMemberModel extends Model
{
    protected $table = 'tbl_cal_member';
    protected $primaryKey = 'cal_member_id';
    public $timestamps = false;

    public function scopeCalMemberExist($query,$member_id,$cal_id)
    {
    	$query	->where('member_id',$member_id)
              	->where('cal_id',$cal_id);
        return $query;
    }
    public function scopePaymentHistory($query)
    {
        $query  ->join('tbl_member','tbl_member.member_id','=','tbl_cal_member.member_id')
                ->join('tbl_cal','tbl_cal.cal_id','=','tbl_cal_member.cal_id')
                ->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id');
        return $query;
    }
    	
                            
}

