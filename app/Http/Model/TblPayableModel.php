<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TblPayableModel extends Model
{
    protected $table = 'tbl_payable';
    protected $primaryKey = 'payable_id';
    public $timestamps = false;

    public function scopePayableInfo($query)
    {
    	$query	->join('tbl_user_info','tbl_user_info.user_id','=','tbl_payable.user_id')
                ->join('tbl_provider','tbl_provider.provider_id','=','tbl_payable.provider_id');
    	$query  ->select("tbl_payable.archived as new_archived","tbl_payable.*","tbl_user_info.*","tbl_provider.*");
    	return $query;
    }    
}

