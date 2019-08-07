<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'name', 'img', 'score',
    ];

    protected $table = 'scores';
}
