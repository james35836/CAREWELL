<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblUserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

 
}
