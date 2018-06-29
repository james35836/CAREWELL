<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblUserInfoModel extends Model
{
    protected $table = 'tbl_user_info';
    protected $primaryKey = 'user_info_id';
    public $timestamps = false;

 	public function scopeUser($query)
 	{
 		$query  ->join('tbl_user','tbl_user.user_id','=','tbl_user_info.user_id');
 		return $query;
 	}
}
