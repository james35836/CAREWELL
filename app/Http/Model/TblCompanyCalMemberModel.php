<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyCalMemberModel extends Model
{
    protected $table = 'tbl_company_cal_member';
    protected $primaryKey = 'cal_member_id';
    public $timestamps = false;

}

