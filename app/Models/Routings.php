<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Matrix\Operators\Operator;

class Routings extends Model
{
    use HasFactory;
    protected $table = 'routings';
    public $timestamps = true;
    protected $fillable = [
        'routings_id',
        'routing_name',
    ];

    public function operations()
    {
        return $this->hasManyThrough(
            Operation::class,
            RoutingOperation::class,
            'routing_id',
            'operation_id',
            'routings_id',
            'operation_id'
        );
    }
}
