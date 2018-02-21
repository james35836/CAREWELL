<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblLaboratoryModel extends Model
{
    protected $table = 'tbl_laboratory';
    protected $primaryKey = 'laboratory_id';
    public $timestamps = false;
}

