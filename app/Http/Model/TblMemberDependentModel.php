<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblMemberDependentModel extends Model
{
    protected $table = 'tbl_member_dependent';
    protected $primaryKey = 'member_dependent_id';
    public $timestamps = false;

    
}

