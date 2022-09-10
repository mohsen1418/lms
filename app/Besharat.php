<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Besharat extends Model
{
    protected $table = 'besharat';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_persuasion','date','name'
    ];
}
