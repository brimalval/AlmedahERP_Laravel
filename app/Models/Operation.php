<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'operations';
    protected $fillable = [
        'operation_id',
        'operation_name',
        'description',
        'wc_code'
    ];

    public function routing()
    {
        return $this->hasOneThrough(Routing::class, RoutingOperation::class);
    }

    public function work_center()
    {
        return $this->hasOne(WorkCenter::class, 'wc_code', 'wc_code');
    }
}
