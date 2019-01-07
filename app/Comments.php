<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['name', 'email', 'comment', 'id_news'];

    public function news()
    {
        return $this->hasOne('App\News', 'id', 'id_news');
    }
}
