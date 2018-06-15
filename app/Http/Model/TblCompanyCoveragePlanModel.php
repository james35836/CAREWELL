<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyCoveragePlanModel extends Model
{
    protected $table = 'tbl_company_coverage_plan';
    protected $primaryKey = 'company_coverage_plan_id';
    public $timestamps = false;

    public function scopeCoveragePlan($query)
    {
    	$query->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id');
    	return $query;
    }
    public function scopeCompanyCoverage($query)
    {
    	$query  ->join('tbl_company','tbl_company.company_id','=','tbl_company_coverage_plan.company_id')
				->join('tbl_coverage_plan','tbl_coverage_plan.coverage_plan_id','=','tbl_company_coverage_plan.coverage_plan_id');
    	return $query;
    }
}

