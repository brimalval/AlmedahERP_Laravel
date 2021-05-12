<?php

namespace App\Http\Controllers;

use App\Mail\SupplierQuotationEmail;
use App\Models\ManufacturingMaterials;
use App\Models\MaterialQuotation;
use App\Models\MaterialRequest;
use App\Models\MaterialUOM;
use App\Models\Supplier;
use App\Models\SuppliersQuotation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SupplierQuotationController extends Controller
{
    /**
     * Constructor.
     * 
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = ManufacturingMaterials::get();
        $squotations = SuppliersQuotation::with('supplier')->get();
        return view('modules.buying.supplierQuotation', [
            'squotations' => $squotations,
            'materials' => $materials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $units = MaterialUOM::get();
        $items = ManufacturingMaterials::get();
        $vars = [
            'units' => $units,
            'items' => $items,
        ];
        if(count($request->all())){
            if(!$request->hasValidSignature()){
                abort(403);
            }
            $rfq = MaterialQuotation::where('req_quotation_id', '=', request('r'))->first();
            $supplier = Supplier::where('supplier_id', '=', request('s'))->first();
            $vars['req_items'] = $rfq->item_list();
            $vars['supplier'] = $supplier;
            $vars['req_quotation_id'] = $rfq->req_quotation_id;
            $vars['from_email'] = true;
        } else{
            $vars['suppliers'] = Supplier::get();
        }
        return view('modules.buying.supplierquotationform', $vars);
    }

    public function getQuotation($id)
    {
        $quotation = SuppliersQuotation::find($id);
        $supplier = $quotation->supplier;
        $items = $quotation->items();
        $req_date = $quotation->req_quotation->material_request->required_date;

        return ['quotation' => $quotation, 'supplier' => $supplier, 'items' => $items, 'req_date' => date_format($req_date, "Y-m-d")];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        try {
            $supp_quotation = new SuppliersQuotation();
            $supp_quotation->supp_quotation_id = 'new';
            $supp_quotation->date_created = Carbon::now();
            $supp_quotation->req_quotation_id = request('req_quotation_id');
            $supp_quotation->supplier_id = request('supplier_id');
            $supp_quotation->grand_total = 0;
            $supp_quotation->remarks = request('remarks') ?? '';
            $supp_quotation->sq_status = request('sq_status');

            $item_codes = request('item_code');
            $quantities = request('qty_requested');
            $rates = request('rate');
            $units = request('uom_id');
            $items_list_rate_amt = array();
            for ($i = 0, $len = count($item_codes); $i < $len; $i++) {
                $item = [
                    'item_code' => $item_codes[$i],
                    'quantity_requested' => $quantities[$i],
                    'rate' => $rates[$i] ?? 0,
                    'uom_id' => $units[$i],
                ];
                array_push($items_list_rate_amt, $item);
            }
            $supp_quotation->items_list_rate_amt = json_encode($items_list_rate_amt);

            foreach ($items_list_rate_amt as $item) {
                $supp_quotation->grand_total += ($item['quantity_requested'] * $item['rate']);
            }
            $supp_quotation->save();
            $id = $supp_quotation->id;
            $supp_quotation->supp_quotation_id = "PUR-SQTN-" . Carbon::now()->year . "-" . str_pad($id, 5, '0', STR_PAD_LEFT);
            $supp_quotation->save();
            return response()->json([
                'redirect' => route('supplierquotation.index')               
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuppliersQuotation  $suppliersQuotation
     * @return \Illuminate\Http\Response
     */
    public function show(SuppliersQuotation $supplierquotation)
    {
        $units = MaterialUOM::get();
        $items = ManufacturingMaterials::get();
        return view('modules.buying.supplierQuotationInfo', [
            'sq' => $supplierquotation,
            'units' => $units,
            'suppliers' => array(),
            'items' => $items,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuppliersQuotation  $supplierquotation
     * @return \Illuminate\Http\Response
     */
    public function edit(SuppliersQuotation $supplierquotation)
    {
        $units = MaterialUOM::get();
        $suppliers = Supplier::get();
        $items = ManufacturingMaterials::get();
        return view('modules.buying.supplierQuotationInfo', [
            'sq' => $supplierquotation,
            'units' => $units,
            'editable' => true,
            'suppliers' => $suppliers,
            'items' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuppliersQuotation  $supplierquotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuppliersQuotation $supplierquotation)
    {
        try {
            $supplierquotation->date_created = Carbon::now();
            $supplierquotation->supplier_id = request('supplier_id');
            $supplierquotation->grand_total = 0;
            $supplierquotation->remarks = request('remarks') ?? '';
            $supplierquotation->supplier_id = request('supplier_id');

            $item_codes = request('item_code');
            $quantities = request('qty_requested');
            $rates = request('rate');
            $units = request('uom_id');
            $items_list_rate_amt = array();
            for ($i = 0, $len = count($item_codes); $i < $len; $i++) {
                $item = [
                    'item_code' => $item_codes[$i],
                    'quantity_requested' => $quantities[$i],
                    'rate' => $rates[$i] ?? 0,
                    'uom_id' => $units[$i],
                ];
                array_push($items_list_rate_amt, $item);
            }
            $supplierquotation->items_list_rate_amt = json_encode($items_list_rate_amt);

            foreach ($items_list_rate_amt as $item) {
                $supplierquotation->grand_total += ($item['quantity_requested'] * $item['rate']);
            }
            $supplierquotation->save();
            return response()->json([
                'message' => 'Successfully updated ' . $supplierquotation->supp_quotation_id,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuppliersQuotation  $suppliersQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuppliersQuotation $suppliersQuotation)
    {
        //
    }

    /**
     * Return supplier quotation table data.
     * 
     * @return array
     */
    public function get_supplier_quotations(Request $request)
    {
        $query = SuppliersQuotation::where(
            'items_list_rate_amt', 'LIKE', '%'.$request->item_code.'%'
        )->with('supplier');
        return DataTables::of($query)
            ->editColumn('supplier.company_name', function ($row) {
                return $this->get_section($row, 'company_name');
            })
            ->editColumn('grand_total', function ($row) {
                return $this->get_section($row, 'grand_total');
            })
            ->editColumn('date_created', function ($row) {
                return $this->get_section($row, 'date_created');
            })
            ->editColumn('sq_status', function ($row) {
                return $this->get_section($row, 'sq_status');
            })
            ->editColumn('time_diff', function ($row) {
                return $this->get_section($row, 'time_diff');
            })
            ->rawColumns([
                'supplier.company_name',
                'date_created',
                'grand_total',
                'sq_status',
                'time_diff',
            ])
            ->make(true);
    }

    /**
     * Used to return the HTML of a section within datatable_rows.
     *
     * @param array $row
     * @param string $section_name
     * @return string
     */
    private function get_section($row, $section_name)
    {
        // Check if there is a row currently being processed
        // If there is, don't render the view again
        // If the row is different (different row calling get_section), render the view
        if(!isset($this->current_row) || $this->current_row != $row){
            $this->current_row = $row;
            $view = view('modules.buying.supplierquotation.datatable_rows', ['row' => $row]);
            // Return a collection of section => html pairs
            $this->datatable_sections = $view->renderSections();
        }
        return $this->datatable_sections[$section_name];
    }

    public function get_items($id) {
        $quotation = SuppliersQuotation::find($id);
        return ['items' => $quotation->items()];
    }

    /**
     * Change the status of a draft supplierquotation to submitted.
     *
     * @param SuppliersQuotation $supplierquotation
     * @return void
     */
    public function submit(SuppliersQuotation $supplierquotation){
        $supplierquotation->sq_status = "Submitted";
        $supplierquotation->save();
        return response()->json([
            'message' => $supplierquotation->supp_quotation_id . " has been submitted!",
        ]);
    }
}
