<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyJobsiteModel extends Model
{
    protected $table = 'tbl_company_jobsite';
    protected $primaryKey = 'jobsite_id';
    public $timestamps = false;
}