<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblPayableApprovalModel extends Model
{
    protected $table = 'tbl_payable_approval';
    protected $primaryKey = 'payable_approval_id';
    public $timestamps = false;

    public function scopePayableApproval($query)
    {
    	$query	->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->join('tbl_member_company','tbl_member_company.member_id','=','tbl_member.member_id');
    	return $query;
    }
    public function scopePayableStatus($query)
    {
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id');
        $query ->join('tbl_user_info','tbl_user_info.user_id','=','tbl_approval.user_id');
        return $query;
    }
    public function scopePayableDoctorGroupBy($query)
    {
        $query ->join('tbl_approval_doctor','tbl_approval_doctor.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id');
        $query ->select(DB::raw('tbl_approval_doctor.doctor_id'));
        $query ->groupBy('doctor_id');
        return $query;
    }
    public function scopeDoctorPayee($query)
    {
        $query ->where('tbl_approval_payee.provider_id',0);
        $query ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_payee.doctor_id');
        $query ->select(DB::raw('tbl_approval_payee.doctor_id'));
        $query ->groupBy('doctor_id');
        return $query;
    }
    public function scopeProviderPayee($query)
    {
        $query ->where('tbl_approval_payee.doctor_id',0);
        $query ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id');
        $query ->select(DB::raw('tbl_approval_payee.provider_id','tbl_approval.*'));
        $query ->groupBy('provider_id');
        return $query;
    }
    public function scopePayableDoctor($query)
    {
        $query ->join('tbl_approval_doctor','tbl_approval_doctor.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id');
        return $query;
    }
    public function scopePayableProcedure($query)
    {
        $query ->join('tbl_approval_procedure','tbl_approval_procedure.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_payable_approval.approval_id');
        return $query;
    }
    public function scopePayableDoctorApproval($query)
    {
        $query ->join('tbl_approval_doctor','tbl_approval_doctor.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_doctor','tbl_doctor.doctor_id','=','tbl_approval_doctor.doctor_id');
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        $query ->select([DB::RAW('DISTINCT(tbl_approval.approval_id)'),'tbl_approval.*']);
        return $query;
    }
    public function scopePayableDoctorProviderPayee($query)
    {
        $query ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        $query ->select([DB::RAW('DISTINCT(tbl_approval.approval_id)'),'tbl_approval.*']);
        return $query;
    }
    public function scopePayableProviderPayee($query)
    {
        $query ->join('tbl_approval_payee','tbl_approval_payee.approval_id','=','tbl_payable_approval.approval_id');
        $query ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval_payee.provider_id');
        $query ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id');
        $query ->select([DB::RAW('DISTINCT(tbl_approval.approval_id)'),'tbl_approval.*']);
        return $query;
    }
    public function scopeApprovalDetails($query)
    {
        $query  ->join('tbl_approval','tbl_approval.approval_id','=','tbl_payable_approval.approval_id')
                ->join('tbl_availment','tbl_availment.availment_id','=','tbl_approval.availment_id')
                ->join('tbl_user_info','tbl_user_info.user_id','tbl_approval.user_id')
                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_approval.provider_id')
                ->join('tbl_member','tbl_member.member_id','=','tbl_approval.member_id')
                ->join('tbl_member_company','tbl_member_company.member_id','tbl_member.member_id')
                ->join('tbl_company','tbl_company.company_id','tbl_member_company.company_id')
                ->join('tbl_diagnosis','tbl_diagnosis.diagnosis_id','tbl_approval.diagnosis_id');
        return $query;
    }
}

