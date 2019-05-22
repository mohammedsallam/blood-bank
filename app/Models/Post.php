<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'img', 'category_id');
    protected $appends = ['is_fav'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function getIsFavAttribute()
    {

        if (auth('client')->user()){
            $id = auth('client')->user()->id;
            $client = Client::find($id);
            $favoritePosts = $client->posts()->pluck('post_id')->toArray();
            if (in_array($this->id, $favoritePosts)){
                return $value = true;
            } else {
                return $value = false;
            }
        }

    }

}