<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalModel extends Model
{
    protected $table = 'tbl_approval';
    protected $primaryKey = 'approval_id';
    public $timestamps = false;
    
    public function scopeApprovalDetails($query)
    {
    	$query 	->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id')
                ->join('tbl_user_info','tbl_user_info.user_id','tbl_approval.user_id')
                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','tbl_approval.diagnosis_id');
    	return $query;
    }
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
                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id')
                ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval.charge_diagnosis_id');
 		return $query;
 	}
    public function scopeDiagnosis($query)
    {
        $query  ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval.charge_diagnosis_id');
        return $query;
    }
    public function scopeGetAvailment($query, $company_id,$availment_id,$date)
    {
        $query  ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_approval.member_id')
                ->where('tbl_member_company.company_id',$company_id)
                ->where('tbl_approval.availment_id',$availment_id)
                ->where('tbl_member_company.archived',0)
                ->where('tbl_approval.approval_created','LIKE','%'.$date.'%');
        return $query;
    }
    public function scopeProcedure($query)
    {
        $query ->join('tbl_approval_procedure','tbl_approval_procedure.approval_id','tbl_approval.approval_id');
        return $query;
    }
    public function scopeSearch($query,$key)
    {
        $query  ->where('tbl_member_company.archived',0)
                ->where(function($query)use($key)
                {
                    $query->where('tbl_approval.approval_number','like','%'.$key.'%');
                    $query->orWhere('tbl_member.member_first_name','like','%'.$key.'%');
                    $query->orWhere('tbl_company.company_name','like','%'.$key.'%');
                    $query->orWhere('tbl_provider.provider_name','like','%'.$key.'%');
                });
        return $query;
    }
    public function scopeApprovalDashboard($query)
    {
        $query  ->where('tbl_approval.archived',0)
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->orderBy('approval_created','DESC');
        return $query;
    }
    public function scopePayeeDistinct($query)
    {
        $query  ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_approval.approval_id');
        return $query;
    }

}
