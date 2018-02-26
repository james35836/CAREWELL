<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyModel extends Model
{
    protected $table = 'tbl_company';
    protected $primaryKey = 'company_id';
    public $timestamps = false;

    public function scopeCompany($query)
    {
    	$query->join('tbl_company_contract','tbl_company_contract.company_id','=','tbl_company.company_id');
        // // $query -> join('tbl_company_jobsite','tbl_company_jobsite.company_id','=','tbl_company.company_id');
        // $query -> join('tbl_company_coverage_plan','tbl_company_coverage_plan.company_id','=','tbl_company.company_id');
        return $query;
    }
    public function scopeComp($query)
    {
        $query->join('tbl_user_info','tbl_user_info.user_id','=','tbl_payable.user_id')
        ->join('tbl_provider','tbl_provider.provider_id','=','tbl_payable.provider_id');
        return $query;

    }
}

