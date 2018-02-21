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
    	
                            
}

