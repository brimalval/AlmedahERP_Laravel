<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBSModel extends Model
{
    use HasFactory;
    protected $table = 'wbs';
    public $timestamps = true;
    protected $fillable = [
        'wbs_name',
        'wbs_image',
        'wbs_description'
    ];
}
