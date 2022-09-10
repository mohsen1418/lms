<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cost extends Model
{
    protected $table = 'cost';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'kind', 'title', 'date', 'source', 'issue_track', 'photo','description','rate'
    ];
}
