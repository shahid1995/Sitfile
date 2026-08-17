<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPageSlider extends Model
{
    protected $table = "static_page_slider";

    public function detail()
    {
    	return $this->belongsTo('App\Models\StaticPageDetail', 'page_details_id', 'id');
    }
}
