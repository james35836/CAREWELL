<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblNewMemberModel extends Model
{
    protected $table = 'tbl_new_member';
    protected $primaryKey = 'new_member_id';
    public $timestamps = false;
    public function scopeMemberExist($query,$member_first_name,$member_middle_name,$member_last_name,$member_birthdate)
    {
    	$query->where('member_first_name',$member_first_name)
              ->where('member_middle_name',$member_middle_name)
              ->where('member_last_name',$member_last_name);
              // ->where('member_birthdate',$member_birthdate);
        return $query;
    }

 
}
