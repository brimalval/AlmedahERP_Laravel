<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReorderLevel extends Model
{
    use HasFactory;
    protected $table = 'env_reorder_level';
    protected $fillable = [
        'reorder_id',
        'category_id',
        'reorder_qty',
        'reorder_level'
    ];
    public $timestamps = false;
    
    public function category(){
        return $this->belongsTo(MaterialCategory::class, 'category_id');
    }
}
