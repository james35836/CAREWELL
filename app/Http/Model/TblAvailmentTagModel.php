<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TblAvailmentTagModel extends Model
{
    protected $table = 'tbl_availment_tag';
    protected $primaryKey = 'availment_tag_id';
    public $timestamps = false;

    public function scopeAvailmentTag($query,$availment_plan_id)
    {
    	// $query->join('tbl_availment_tag','tbl_availment_tag.availment_plan_id','=','tbl_availment_plan.availment_plan_id');
    	$query->join('tbl_availment','tbl_availment.availment_id','=','tbl_availment_tag.availment_id');
    	// $query->where('tbl_availment_tag.availment_plan_id',$availment_plan_id);
    	return $query;
    }
}

