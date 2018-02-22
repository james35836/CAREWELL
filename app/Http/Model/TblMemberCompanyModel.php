<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblMemberCompanyModel extends Model
{
    protected $table = 'tbl_member_company';
    protected $primaryKey = 'member_company_id';
    public $timestamps = false;

    public function scopeMemberCompany($query)
    {
    	$query  ->join('tbl_member','tbl_member.member_id','=','tbl_member_company.member_id')
              ->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_member_company.coverage_plan_id')
              ->join('tbl_company','tbl_company.company_id','=','tbl_member_company.company_id')
              ->join('tbl_company_deployment','tbl_company_deployment.deployment_id','=','tbl_member_company.deployment_id');
        return $query;
                              
    }
}