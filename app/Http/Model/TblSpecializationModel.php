<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblSpecializationModel extends Model
{
    protected $table = 'tbl_specialization';
    protected $primaryKey = 'specialization_id';
    public $timestamps = false;
}
