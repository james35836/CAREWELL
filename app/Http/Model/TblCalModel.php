<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCalModel extends Model
{
    protected $table = 'tbl_cal';
    protected $primaryKey = 'cal_id';
    public $timestamps = false;

    public function scopeCalInfo($query,$ref)
    {
    	if($ref==1)
    	{
    		$query->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id')
                   ->join('tbl_cal_info','tbl_cal_info.cal_id','=','tbl_cal.cal_id');
        }
        else
        {
        	$query->join('tbl_company','tbl_company.company_id','=','tbl_cal.company_id');
        }
        return $query;
    }
}

