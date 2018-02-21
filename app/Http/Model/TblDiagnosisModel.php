<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblDiagnosisModel extends Model
{
    protected $table = 'tbl_diagnosis';
    protected $primaryKey = 'diagnosis_id';
    public $timestamps = false;

    
}

