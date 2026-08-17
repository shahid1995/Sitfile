<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPageDetails extends Model
{
    protected $table = "static_page_details";

    public function page()
    {
    	return $this->belongsTo('App\Models\StaticPage', 'page_id', 'id');
    }

    public function sliders()
    {
    	return $this->hasMany('App\Models\StaticPageSlider', 'page_details_id', 'id');
    }
}
