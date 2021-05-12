<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routings extends Model
{
    use HasFactory;
    protected $table = 'routings';
    public $timestamps = true;
    protected $fillable = [
        'routings_id',
        'routing_name',
        'sequence_id',
        'operation_id',
        'hour_rate',
        'operation_time',
        'operating_cost'
    ];
}
