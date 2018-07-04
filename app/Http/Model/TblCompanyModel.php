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
    public function scopeCompanyContact($query)
    {
        $query->join('tbl_company_contact_person','tbl_company_contact_person.company_id','=','tbl_company.company_id');
        return $query;
    }
    public function scopeCompanyCal($query)
    {
        $query->join('tbl_cal','tbl_cal.company_id','=','tbl_company.company_id');
        return $query;
    }
    public function scopeSearch($query,$key)
    {
        $query  ->where(function($query)use($key)
                {
                    $query->where('tbl_company.company_name','like','%'.$key.'%');
                    $query->orWhere('tbl_company.company_code','like','%'.$key.'%');
                });
        return $query;
    }
}

