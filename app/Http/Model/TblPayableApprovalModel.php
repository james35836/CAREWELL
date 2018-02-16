<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayableApprovalModel extends Model
{
    protected $table = 'tbl_payable_approval';
    protected $primaryKey = 'payable_approval_id';
    public $timestamps = false;

    
}

