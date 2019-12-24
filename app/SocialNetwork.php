<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $table = "social_networks";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
