<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblMemberCompanyModel extends Model
{
    protected $table = 'tbl_member_company';
    protected $primaryKey = 'member_company_id';
    public $timestamps = false;

    public function scopeMemberCompany($query)
    {
    	$query  ->select(DB::raw('tbl_member_company.archived as inactive,tbl_member_company.*,tbl_coverage_plan.*,tbl_member.*,tbl_company.*,tbl_company_deployment.*'))
              ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_member_company.coverage_plan_id')
              ->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id')
              ->join('tbl_company_deployment','tbl_company_deployment.deployment_id','=','tbl_member_company.deployment_id')
              ->orderBy('tbl_member_company.member_company_id','DESC');
        return $query;
                              
    }
    public function scopeCompanyMember($query)
    {
      $query  ->where('tbl_member_company.archived',0)
              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_member_company.coverage_plan_id')
              ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
              ->join('tbl_company_deployment','tbl_company_deployment.deployment_id','=','tbl_member_company.deployment_id');
       
      return $query;
    }

    public function scopeCountAvailment($query,$coverage_plan_id,$company_id)
    {
      $query -> where('tbl_member_company.archived',0)
                ->where('coverage_plan_id',$coverage_plan_id)
                ->where('company_id',$company_id)
                ->join('tbl_approval','tbl_approval.member_id','=','tbl_member_company.member_id');

                return $query;
    }
}