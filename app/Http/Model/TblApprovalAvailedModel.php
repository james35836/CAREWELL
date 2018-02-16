<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalAvailedModel extends Model
{
    protected $table = 'tbl_approval_availed';
    protected $primaryKey = 'availed_id	';
    public $timestamps = false;

    public function scopeTotalAmount($query)
    {
    	$query ->select(DB::raw("SUM(numberofclick) as count"));
    	return $query;
    }
    
}

