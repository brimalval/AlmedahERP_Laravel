<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;
    protected $table = 'products_item_group';
    protected $fillable = [
        'item_group'
    ];
    public $timestamps = true;
}
