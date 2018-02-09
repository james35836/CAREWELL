<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyDeploymentModel extends Model
{
    protected $table = 'tbl_company_deployment';
    protected $primaryKey = 'jobsite_id';
    public $timestamps = false;
}