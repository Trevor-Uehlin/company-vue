<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use App\Notifications\NewAccount;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;
    //use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    // Not going to use softDeletes for now.
    //protected $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One role belongs to this user?
    public function role() {

        return $this->belongsTo(Role::class);
    }

    public function isAdministrator() {

        if(!empty($this->role)) {

            return $this->role->name == 'administrator';
        }
    }

    public function sendNewAccountNotification(){

        $this->notify(new NewAccount($this));
    }

    public function toStandardClass() {

        $user = new \stdClass();

        $user->id = $this->id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->created = $this->created_at->format("M, d, Y");
        $user->role = $this->role->name;
        $user->isAdmin = $this->isAdministrator();

        return $user;
    }
}
