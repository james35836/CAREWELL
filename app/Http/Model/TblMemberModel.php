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
    
}