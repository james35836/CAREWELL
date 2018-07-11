<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayableReferenceModel extends Model
{
    protected $table = 'tbl_payable_reference';
    protected $primaryKey = 'payable_reference_id';
    public $timestamps = false;

    
}

