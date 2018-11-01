<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPasswordMail;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $table="users";
    protected $fillable = ['name', 'email', 'password','yetki','onay','hasta_id','kurum_id','aktif','silinme_tarihi','token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*  public function sendPasswordResetNotification($token)
      {
          $this->notify(new ResetPasswordNotification($token));}
        */

    public function sendPasswordResetNotification($token)
      {
          $this->notify(new MyResetPasswordMail($token));
      }
}
