<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use Notifiable;

    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $guard = 'admin';

}
