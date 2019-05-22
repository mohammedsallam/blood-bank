<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_date', 'blood_type_id', 'phone', 'password', 'code', 'city_id','government_id');
    protected $hidden = ['password', 'api_token', 'remember_token'];


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function governments()
    {
        return $this->belongsToMany('App\Models\Government');
    }

    public function government()
    {
        return $this->belongsTo('App\Models\Government');
    }

}