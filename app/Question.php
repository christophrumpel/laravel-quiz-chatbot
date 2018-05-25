<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text', 'points'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
