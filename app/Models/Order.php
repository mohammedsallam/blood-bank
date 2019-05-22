<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'blood_type_id', 'bags_num', 'hospital_name', 'hospital_address', 'longitud', 'latitude', 'city_id', 'client_id', 'phone', 'description');

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}