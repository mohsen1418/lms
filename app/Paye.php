<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paye extends Model
{
    protected $table = 'paye';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
