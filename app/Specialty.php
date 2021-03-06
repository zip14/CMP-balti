<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialities';
    protected $fillable=['name', 'alias', 'description', 'content', 'image', 'schedule_link'];
}
