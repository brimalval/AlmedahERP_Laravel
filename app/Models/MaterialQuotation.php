<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialQuotation extends Model
{
    use HasFactory;
    protected $table = 'request_quotation';
    public $timestamps = true;

    protected $fillable = [
        'req_quotation_id',
        'date_created',
        'request_id',
        'item_list',
        'req_status',
        'supplier_message',
    ];

    protected $casts = [
        'date_created' => 'date',
    ];

    public function suppliers()
    {
        return $this
            ->hasManyThrough(
                Supplier::class,
                RequestQuotationSuppliers::class,
                // Foreign keys
                'req_quotation_id',
                'supplier_id',
                // Local keys
                'req_quotation_id',
                'supplier_id',
            );
    }

    public function request_quotation()
    {
        return $this->belongsTo(MaterialRequest::class, 'request_id', 'request_id');
    }

    public function supplier_links(){
        return $this->hasMany(RequestQuotationSuppliers::class, 'req_quotation_id', 'req_quotation_id');
    }

    public function item_list(){
        $item_list = json_decode($this->item_list);
        for($i=0, $len=sizeof($item_list); $i < $len; $i++){
            $item_code = $item_list[$i]->item_code;
            $item_list[$i]->item = ManufacturingMaterials::where('item_code', '=', $item_code)->first();
        }
        return $item_list;
    }
}
