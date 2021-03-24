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
        'required_date',
        'purpose',
        'mr_status',
    ]; 

    public function raw_mats(){
        return $this->hasMany(RequestedRawMat::class, 'request_id', 'request_id');
    }

    protected $casts = [
        'required_date' => 'date',
        'request_date' => 'date'
    ];
}
