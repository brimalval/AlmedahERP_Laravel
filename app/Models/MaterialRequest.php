<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;
    protected $table = 'env_material_requests';
    public $timestamps = true;
    
    protected $fillable = [
        'request_id',
        'request_date',
        'work_order_no',
        'required_date',
        'purpose',
        'mr_status'
    ]; 

    protected $casts = [
        'required_date' => 'date',
        'request_date' => 'date'
    ];

    public function raw_mats(){
        return $this->hasMany(RequestedRawMat::class, 'request_id', 'request_id');
    }
}
