<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblCoveragePlanTagModel extends Model
{
    protected $table = 'tbl_coverage_plan_tag';
    protected $primaryKey = 'coverage_plan_tag_id';
    public $timestamps = false;

    public function scopeCoveragePlanTag($query,$coverage_plan_id)
    {
    	$query->join('tbl_availment','tbl_availment.availment_id','=','tbl_coverage_plan_tag.availment_id');
    	$query->join('tbl_availment_charges','tbl_availment_charges.availment_charges_id','=','tbl_coverage_plan_tag.availment_charges_id');
    	return $query;
    }

    
}

