<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutingOperation extends Model
{
    use HasFactory;
    protected $table = 'routings_operations';
    public $timestamps = true;
    protected $fillable = [
        'operation_id',
        'routing_id',
        'sequence_id',
        'hour_rate', 
        'operation_time',
        'operating_cost'
    ];
}
