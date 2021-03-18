<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_code',
        'part_name',
        'part_image',
        'part_description',
    ];
}
