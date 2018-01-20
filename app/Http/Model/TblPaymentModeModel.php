<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblPaymentModeModel extends Model
{
    protected $table = 'tbl_payment_mode';
    protected $primaryKey = 'payment_mode_id';
    public $timestamps = false;

    
}

