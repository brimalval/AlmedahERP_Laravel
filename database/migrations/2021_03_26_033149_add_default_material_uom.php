<?php

use App\Models\MaterialUOM;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultMaterialUom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Default unit for all materials
        $default_unit = new MaterialUOM();
        $default_unit->uom_id = "nos";
        $default_unit->item_uom = "Nos";
        $default_unit->conversion_factor = 1;
        $default_unit->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        MaterialUOM::where('uom_id', '=', 'nos')->first()->delete();
    }
}
