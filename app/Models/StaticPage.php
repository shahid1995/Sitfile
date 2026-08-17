<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = "static_page";

    public function details()
    {
    	return $this->hasMany('App\Models\StaticPageDetails', 'page_id', 'id');
    }
}
