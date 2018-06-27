<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayablePayeeModel extends Model
{
    protected $table = 'tbl_payable_payee';
    protected $primaryKey = 'payable_payee_id';
    public $timestamps = false;

    
}

