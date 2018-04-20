<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCompanyContactPersonModel extends Model
{
    protected $table = 'tbl_company_contact_person';
    protected $primaryKey = 'contact_person_id';
    public $timestamps = false;

    
}

