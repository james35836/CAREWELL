<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalProcedureModel extends Model
{
    protected $table = 'tbl_approval_procedure';
    protected $primaryKey = 'procedure_approval_id	';
    public $timestamps = false;

    public function scopeProcedureDiagnosis($query)
    {
    	$query->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_approval_procedure.procedure_id')
               ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval_procedure.diagnosis_id');
        return $query;
    }
    public function scopeProcedure($query)
    {
    	$query->join('tbl_procedure','tbl_procedure.procedure_id','=','tbl_approval_procedure.procedure_id');
        return $query;
    }
    
}

