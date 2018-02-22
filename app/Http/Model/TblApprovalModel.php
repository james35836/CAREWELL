<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalModel extends Model
{
    protected $table = 'tbl_approval';
    protected $primaryKey = 'approval_id';
    public $timestamps = false;

 	public function scopeApprovalInfo($query)
 	{
 		$query->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
              ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
              ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
              ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id');
        return $query;
                          
 	}
 	public function scopeAvailmentHistory($query)
 	{
 		$query	->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id');
 		return $query;
 	}
}
