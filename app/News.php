<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable=['title', 'description', 'content', 'image', 'id_category', 'alias'];

    public function category()
    {
        return $this->hasOne('App\NewsCategory', 'id', 'id_category');
    }
}
