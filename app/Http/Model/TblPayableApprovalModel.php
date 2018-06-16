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
    public function scopeApprovalDetails($query)
    {
        $query  ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id')
                ->join('tbl_user_info','tbl_user_info.user_id','tbl_approval.user_id')
                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','tbl_approval.diagnosis_id');
        return $query;
    }
}

