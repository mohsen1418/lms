<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etude extends Model
{
    protected $table = 'etude';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clock', 'day','id_course','id_user'
    ];
}
