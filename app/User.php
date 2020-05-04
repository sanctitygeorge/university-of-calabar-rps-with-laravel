<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastName', 'otherNames', 'regNo', 'phone', 'gender', 'state', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function bio010(){
        return $this->hasOne('App\Bio010');
    }

    public function bio020(){
        return $this->hasOne('App\Bio020');
    }

    public function chm010(){
        return $this->hasOne('App\Chm010');
    }

    public function chm020(){
        return $this->hasOne('App\Chm020');
    }

    public function eng010(){
        return $this->hasOne('App\Eng010');
    }

    public function eng020(){
        return $this->hasOne('App\Eng020');
    }

    public function mth010(){
        return $this->hasOne('App\Mth010');
    }

    public function mth020(){
        return $this->hasOne('App\Mth020');
    }

    public function phy010(){
        return $this->hasOne('App\Phy010');
    }

    public function phy020(){
        return $this->hasOne('App\Phy020');
    }

}
