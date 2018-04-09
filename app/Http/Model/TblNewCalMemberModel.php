<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblNewCalMemberModel extends Model
{
    protected $table = 'tbl_new_cal_member';
    protected $primaryKey = 'new_cal_member_id	';
    public $timestamps = false;

    public function scopeTotalAmount($query)
    {
    	$query ->select(DB::raw("SUM(numberofclick) as count"));
    	return $query;
    }
    
}

