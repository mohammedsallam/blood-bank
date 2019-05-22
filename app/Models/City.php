<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'government_id');

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function government()
    {
        return $this->belongsTo('App\Models\Government');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

}