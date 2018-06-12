<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayableApprovalModel extends Model
{
    protected $table = 'tbl_payable_approval';
    protected $primaryKey = 'payable_approval_id';
    public $timestamps = false;

    public function scopePayableApproval($query)
    {
    	$query	->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_member.member_id');
    	return $query;
    }
    public function scopePayableStatus($query)
    {
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        return $query;
    }
}

