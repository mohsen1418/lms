<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trouble extends Model
{
    protected $table = 'trouble';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_homework', 'id_user', 'date', 'time','score'
    ];
}
