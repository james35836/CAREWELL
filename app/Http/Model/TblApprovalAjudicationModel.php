<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblApprovalAjudicationModel extends Model
{
    protected $table = 'tbl_approval_ajudication';
    protected $primaryKey = 'ajudication_id	';
    public $timestamps = false;

    public function scopeUser($query)
    {
    	$query ->join('tbl_user_info','tbl_user_info.user_id','=','tbl_approval_ajudication.user_id');
    	return $query;
    }
    
}

