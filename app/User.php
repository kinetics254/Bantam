<?php

namespace App;

use App\Notifications\SetPassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    //Get employee record of the user
    public function Employee_Record(){
        return $this->hasOne("App\Employee");
    }

    // Notification  recipient
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        if($this->activation_link_sent){
            $this->notify(new ResetPassword($token));
        }
        else $this->notify(new SetPassword($token));

    }
}
