<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblUserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function scopeUserInfo($query)
    {
    	$query->join('tbl_user_info','tbl_user_info.user_id','=','tbl_user.user_id');
    	return $query;
    }
}
