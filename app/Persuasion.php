<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persuasion extends Model
{
    protected $table = 'persuasion';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'score','kind','section'
    ];
}
