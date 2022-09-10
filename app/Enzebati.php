<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enzebati extends Model
{
    protected $table = 'enzebati';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_discipline','date','kind','detail','sms'
    ];
}
