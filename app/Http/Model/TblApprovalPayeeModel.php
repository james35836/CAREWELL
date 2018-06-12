<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalPayeeModel extends Model
{
    protected $table = 'tbl_approval_payee';
    protected $primaryKey = 'payee_approval_id	';
    public $timestamps = false;

    public function scopePayeeDoctor($query)
    {
    		$query->where('type','doctor')->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_payee.payee_id');
    		return $query;
    }
    
}

