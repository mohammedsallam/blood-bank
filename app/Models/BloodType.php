<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}