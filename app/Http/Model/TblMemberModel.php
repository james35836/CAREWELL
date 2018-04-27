<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblMemberModel extends Model
{
    protected $table = 'tbl_member';
    protected $primaryKey = 'member_id';
    public $timestamps = false;

    public function scopeMember($query)
    {
    	$query->join('tbl_member_company','tbl_member_company.member_id','=','tbl_member.member_id');
        $query->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id');
        return $query;
                      
    }
    public function scopeMemberExist($query,$member_first_name,$member_middle_name,$member_last_name)
    {
    	$query->where('member_first_name',$member_first_name)
              ->where('member_middle_name',$member_middle_name)
              ->where('member_last_name',$member_last_name);
              // ->where('member_birthdate',$member_birthdate);
        return $query;
    }
    
}