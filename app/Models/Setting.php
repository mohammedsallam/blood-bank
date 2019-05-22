<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'phone', 'instagram', 'facebook', 'about_us', 'terms_conditions', 'twitter', 'youtube', 'whatsapp', 'google_plus');

}