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

    private function routingOperations() {
        return $this->hasMany(RoutingOperation::class, 'routing_id', 'routing_id');    
    }

    public function operations() {
        $r_operations = $this->routingOperations;
        $operations = array();
        foreach ($r_operations as $ro) {
            array_push($operations,
                array(
                    'operation' => Operation::where('operation_id', $ro->operation_id)->first(),
                    'sequence_id' => $ro->sequence_id,
                    'hour_rate' => $ro->hour_rate,
                    'operation_time' => $ro->operation_time,
                    'operating_cost' => $ro->operation_cost
                )
            );
        }
        return $operations;
    }
}
