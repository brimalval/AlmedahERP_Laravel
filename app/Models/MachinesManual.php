<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachinesManual extends Model
{
    use HasFactory;
    protected $table = 'machines_manual';
    public $timestamps = true;
    protected $fillable = [
        'machine_code',
        'machine_name',
        'machine_image',
        'machine_description',
        'machine_process',
        'set-up_time',
        'running_time'
    ];
}
