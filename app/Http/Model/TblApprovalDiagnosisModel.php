<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalDiagnosisModel extends Model
{
    protected $table = 'tbl_approval_diagnosis';
    protected $primaryKey = 'approval_diagnosis_id	';
    public $timestamps = false;

    public function scopeDiagnosis($query)
    {
    	$query->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','=','tbl_approval_diagnosis.diagnosis_id');
    	return $query;
    }
    
}

