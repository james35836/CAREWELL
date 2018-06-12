<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblCoveragePlanProcedureModel extends Model
{
    protected $table = 'tbl_coverage_plan_procedure';
    protected $primaryKey = 'coverage_plan_procedure_id';
    public $timestamps = false;

    public function scopeCoveragePlanTag($query)
    {
    	$query->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_coverage_plan_procedure.procedure_id')
    			->join('tbl_availment_charges','tbl_availment_charges.availment_charges_id','=','tbl_coverage_plan_procedure.availment_charges_id');
    	return $query;
    }
    public function scopeProcedure($query)
    {
    	$query->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_coverage_plan_procedure.procedure_id');
    	return $query;
    }
    public function scopeCoveragePlan($query)
    {
    	$query->where('tbl_coverage_plan_procedure.archived',0)
            ->select(DB::raw('count(*) as totals, tbl_coverage_plan_procedure.availment_id,tbl_availment.availment_name'))
            ->groupBy('availment_id')
            ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_procedure.availment_id');
    	return $query;
    }
    public function scopeAvailment($query)
    {
        $query  ->where('tbl_coverage_plan_procedure.archived',0)
                ->select(DB::raw('count(*) as totals, tbl_coverage_plan_procedure.availment_id,tbl_availment.availment_name'))
                ->groupBy('availment_id')
                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_procedure.availment_id');
        return $query;
    }
    
}

