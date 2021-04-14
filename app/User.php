<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tel',
        'fax',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    public function admin_livraison()
    {
        return $this->hasOne(AdminLivraison::class);
    }

    public function admin_commercial()
    {
        return $this->hasOne(AdminCommercial::class);
    }

    public function super_admin()
    {
        return $this->hasOne(SuperAdmin::class);
    }
}
