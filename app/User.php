<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Cache;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname','f_fname','m_lname', 'id_paye', 'id_room', 'mobile','f_job','f_adr','m_job','m_adr','adr', 'password', 'role','f_number','m_number','p_number','home','pass','date','zipcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }
}
