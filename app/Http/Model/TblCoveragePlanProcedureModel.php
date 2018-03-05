<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

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

    
}

