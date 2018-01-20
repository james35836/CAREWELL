<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyContractModel extends Model
{
    protected $table = 'tbl_company_contract';
    protected $primaryKey = 'contract_id';
    public $timestamps = false;
}