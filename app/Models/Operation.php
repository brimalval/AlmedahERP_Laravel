<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'operations';
    protected $fiilable = [
        'operation_id',
        'operation_name',
        'description',
        'wc_code'
    ];

    public function routing() {
        return $this->hasOneThrough(Routing::class, RoutingOperation::class);
    }
}