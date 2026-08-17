<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    //

    protected $guarded = [];

    protected $fillable = [
        'name', 'email', 'password',
        //'user_id', 'token',
    ];
 
    public function user()
    {
        return $this->belongsTo('App\User', 'name');
    }
}
