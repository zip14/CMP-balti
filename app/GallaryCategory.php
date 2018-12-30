<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GallaryCategory extends Model
{
    protected $table = 'gallary_categories';
    protected $fillable=['name'];
}
