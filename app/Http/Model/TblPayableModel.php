<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPayableModel extends Model
{
    protected $table = 'tbl_payable';
    protected $primaryKey = 'payable_id';
    public $timestamps = false;

    
}

