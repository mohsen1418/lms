<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rebate extends Model
{
    protected $table = 'rebate';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_rebate', 'title','rate','count'
    ];
}
