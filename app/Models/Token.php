<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'type', 'client_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token', 'api_token'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
