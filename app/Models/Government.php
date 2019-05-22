<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Government extends Model 
{

    protected $table = 'governments';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function client()
    {
        return $this->hasMany('App\Models\Client');
    }

}