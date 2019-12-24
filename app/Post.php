<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $id = "id";

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
