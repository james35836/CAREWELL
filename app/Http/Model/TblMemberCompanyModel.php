<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblMemberCompanyModel extends Model
{
    protected $table = 'tbl_member_company';
    protected $primaryKey = 'member_company_id';
    public $timestamps = false;
}