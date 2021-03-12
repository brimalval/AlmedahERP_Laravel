<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'man_customers';
    protected $fillable = [
        'customer_lname',
        'customer_fname',
        'branch_name',
        'contact_number',
        'address',
        'email_address',
        'company_name',
        'profile_picture',
    ];
}

