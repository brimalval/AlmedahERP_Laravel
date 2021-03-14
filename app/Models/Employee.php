<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'env_employees';
    protected $fillable = [
        'last_name',
        'first_name',
        'position',
        'profile_picture',
        'gender',
        'contact_number',
        'email',
        'password',
        'active_status',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword(){
        return $this->password;
    }
}
