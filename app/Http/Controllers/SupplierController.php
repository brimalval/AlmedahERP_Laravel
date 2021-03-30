<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Exception;
use DB;

class SupplierController extends Controller
{
    //
    public function index()
    {
        $suppliers = Supplier::all();
        return view('modules.buying.supplier', ['suppliers' => $suppliers]);
    }

    public function store(Request $request)
    {
        try {
            $data = new Supplier();

            $form_data = $request->input();

            $lastSupplier = Supplier::orderby('created_at', 'desc')->first();
            $nextId = ($lastSupplier)
                ? Supplier::orderby('created_at', 'desc')->first()->id + 1 :
                1;

            $data->supplier_id = "SUP" . $nextId;

            $data->company_name = $form_data['company_name'];
            $data->supplier_group = $form_data['supplier_group'];
            $data->phone_number = $form_data['phone_number'];
            $data->supplier_email = $form_data['supplier_email'];
            $data->supplier_address = $form_data['supplier_address'];

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function get($id)
    {
        $supplier = Supplier::find($id);
        return view('modules.buying.supplierInfo', ['supplier' => $supplier]);
    }

    public function getBySuppID($supplier_id)
    {
        $supplier = Supplier::where('supplier_id', $supplier_id)->get();
        return ['supplier' => $supplier];
    }

    public function searchSupplier(Request $request)
    {
        try {
            $search = $request->search;
            if ($search == '')
                $suppliers = Supplier::orderby('created_at', 'desc')->limit(5)->get();
            else
                $suppliers = Supplier::where('company_name', 'like', '%'.$search.'%')->orderby('created_at', 'desc')->limit(5)->get();
            $supplier_data = array();
            foreach($suppliers as $supplier) {
                $supplier_data[] = array(
                                    "supplier_id" => $supplier->supplier_id,
                                    "address" => $supplier->supplier_address,
                                    "company_name" => $supplier->company_name,
                                    "phone_number" => $supplier->phone_number,
                                    "email" => $supplier->supplier_email
                                );
            }
            return response()->json($supplier_data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
