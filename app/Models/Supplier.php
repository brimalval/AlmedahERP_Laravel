<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    public $timestamps = true;
    protected $fillable = [
        'supplier_id',
        'company_name',
        'supplier_group',
        'contact_name',
        'phone_number',
        'supplier_email',
        'supplier_address'
    ];
}
