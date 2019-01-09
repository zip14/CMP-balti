<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table = 'gallery';
    protected $fillable=['id_category', 'image', 'description', 'title'];

    public function category()
    {
        return $this->hasOne('App\GallaryCategory', 'id', 'id_category');
    }
}
