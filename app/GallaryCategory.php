<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GallaryCategory extends Model
{
    protected $table = 'gallary_categories';
    protected $fillable=['name'];

    public function images()
    {
        return $this->hasMany('App\Gallary', 'id_category', 'id');
    }
}
