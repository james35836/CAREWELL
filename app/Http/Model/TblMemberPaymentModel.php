<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblMemberPaymentModel extends Model
{
    protected $table = 'tbl_member_payment';
    protected $primaryKey = 'member_payment_id';
    public $timestamps = false;
}