<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineManual extends Model
{
    use HasFactory;
    protected $table = 'machines_manual';
    public $timestamps = true;
    protected $fillable = [
        'machine_name',
        'machine_image',
        'machine_desc',
        'machine_process'
    ];
}
