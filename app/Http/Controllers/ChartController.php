<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use App\Models\ChartModel;
use App\Models\MaterialRequest;
use App\Charts\MaterialRequestChart;
use App\Models\MaterialPurchased;
use App\Charts\PurchaseOrderChart;
use App\Models\Supplier;
use App\Models\supplierReports;
use App\Models\SalesOrder;
use App\Models\ManufacturingMaterials;
use Carbon\Carbon;
use DB;
use DataTables;
use App\Http\Controllers\ReportExcelExport\excel_export;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;


class ChartController extends Controller
{
    public function generate_sample_chart(Request $request){

        $date_from      = date('Y-m-d', strtotime($request->date_from));
        $date_to        = date('Y-m-d', strtotime($request->date_to));
        $filter_type    = $request->filter_type;

        $pie_chart      = \Lava::DataTable();

        if ($filter_type == 'yearly') {
            $date_from = !empty($date_from) ? date('Y',strtotime($date_from)) : date('Y');
        }
        else if ($filter_type == 'monthly') {
            $date_from = !empty($date_from) ? date('Y-m',strtotime($date_from)) : date('Y-m');
        }

        $chart_data = ChartModel::get_chart_data($date_from,$filter_type);
        $table_data = ChartModel::get_table_data($date_from,$filter_type);
        // $chart_data = !empty($chart_data) ? $chart_data[0] : [];
        $complete   = !empty($chart_data['Completed'])  ? array_column($chart_data['Completed'],'count','date') : [];
        $pending    = !empty($chart_data['Pending'])    ? array_column($chart_data['Pending'],  'count','date') : [];

        // dd($complete,$pending);

        $pie_chart->addStringColumn('Stocks')
        ->addNumberColumn('Completed')
        ->addNumberColumn('Pending');

        if ($filter_type == 'yearly') {
            for ($i=1; $i <= 12; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $complete_count = !empty($complete[$date_from . '-' . $i])   ? $complete[$date_from . '-' . $i]   : 0;
                $pending_count  = !empty($pending[$date_from . '-' . $i])    ? $pending[$date_from . '-' . $i]    : 0;
                $pie_chart->addRow([date('F Y',strtotime($date_from . '-' . $i)), $complete_count, $pending_count]);
            }
        }
        else if ($filter_type == 'monthly') {
            $end_day    = date('d',strtotime($date_to));
            for ($i = 1; $i <= $end_day; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $complete_count = !empty($complete[$date_from   . '-' . $i]) ? $complete[$date_from  . '-' . $i] : 0;
                $pending_count  = !empty($pending[$date_from    . '-' . $i]) ? $pending[$date_from   . '-' . $i] : 0;
                $pie_chart->addRow([date('F d, Y',strtotime($date_from . '-' . $i)), $complete_count, $pending_count]);
            }
        }

        // ->addRow(['Completed',      (!empty($chart_data['completed'])   ? $chart_data['completed']  : 0),(!empty($chart_data['pending'])     ? $chart_data['pending']    : 0)]);
        // ->addRow(['Pending',        (!empty($chart_data['pending'])     ? $chart_data['pending']    : 0)]);

        \Lava::BarChart('pie-chart', $pie_chart, [
            'title'  => 'Work Order Report ',
            'is3D'   => true,
            'isStacked' => true,
            'event' => [
                'ready' => 'getImageCallBack'],
            'PNG' => true,
            'animation' => [
                'easing' => 'inAndout',
                'startup' => true,
                'duration' => 600,
            ],
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#ffa600', '#003f5c'],
            'backgroundColor' => '#f7f7f7',
            'width' => 1550,
            'height' => 900,
            'pieSliceTextStyle' => [
                'fontSize' => 15, 
            ]
        ]);

    
        return View('chart.chart',['table_data' => $table_data,'is_excel' => false]);
    }

    public function generate_reports_sales (Request $request){

        $date_from      = date('Y-m-d', strtotime($request->date_from));
        $date_to        = date('Y-m-d', strtotime($request->date_to));
        $filter_type    = $request->filter_type;

        $pie_chart1 = \Lava::DataTable();

        $pie_chart1->addStringColumn('Percent')
        ->addNumberColumn('Fully Paid')
        ->addNumberColumn('With Outstanding Balance');

        if ($filter_type == 'yearly') {
            $date_from = !empty($date_from) ? date('Y',strtotime($date_from)) : date('Y');
        }
        else if ($filter_type == 'monthly') {
            $date_from = !empty($date_from) ? date('Y-m',strtotime($date_from)) : date('Y-m');
        }

        $sales_data     = ChartModel::get_sales_data($date_from,$filter_type);
        $sales_data     = !empty($sales_data) ? array_column($sales_data,'total_count','sales_status') : [];
        $table_data     = ChartModel::get_sales_table_data($date_from,$filter_type);
        
        // $table_data1    = ChartModel::get_sales_table_data($date_from,$date_to);
      
        $fully          = !empty($chart_data['Fully Paid'])                  ? array_column($chart_data['Fully Paid'],'count','date') : [];
        $outstanding    = !empty($chart_data['With Outstanding Balance'])    ? array_column($chart_data['With Outstanding Balance'],  'count','date') : [];
        $sales = $sales_data->get();
        
        
        if ($filter_type == 'yearly') {
            for ($i=1; $i <= 12; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $fully_count           = !empty($fully[$date_from . '-' . $i])   ? $fully[$date_from . '-' . $i]   : 0;
                $outstanding_count     = !empty($outstanding[$date_from . '-' . $i])    ? $outstanding[$date_from . '-' . $i]    : 0;
                $pie_chart1->addRow([date('F Y',strtotime($date_from . '-' . $i)), $fully_count, $outstanding_count]);
            }
        }
        else if ($filter_type == 'monthly') {
            $end_day    = date('d',strtotime($date_to));
            for ($i = 1; $i <= $end_day; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $fully_count = !empty($fully[$date_from   . '-' . $i]) ? $fully[$date_from  . '-' . $i] : 0;
                $outstanding_count  = !empty($outstanding[$date_from    . '-' . $i]) ? $outstanding[$date_from   . '-' . $i] : 0;
                $pie_chart1->addRow([date('F d, Y',strtotime($date_from . '-' . $i)), $fully_count, $outstanding_count]);
            }
        }


        $pie_chart1->addStringColumn('Stocks')
        ->addNumberColumn('Percent')
        ->addRow(['Fully Paid',                 (!empty($sales_data['Fully Paid'])                      ? $sales_data['Fully Paid']                 : 0)])
        ->addRow(['With Outstanding Balance',   (!empty($sales_data['With Outstanding Balance'])        ? $sales_data['With Outstanding Balance']   : 0)]);

        \Lava::PieChart('pie-chart1', $pie_chart1, [
            'title'  => ' ',
            'is3D'   => true,
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#ffa600', '#003f5c'],
            'backgroundColor' => '#f7f7f7',
            'width' => 600,
            'height' => 600,
            'pieSliceTextStyle' => [
                'fontSize' => 15, 
            ]
            
        ]);

        return View('modules.reports.reports_sales',['table_data' => $table_data],['sales_status' => $sales_status] );
    }

    public function generate_report_trends (Request $request){
        $date_from      = date('Y-m-d', strtotime($request->date_from));
        $date_to        = date('Y-m-d', strtotime($request->date_to));
        $filter_type    = $request->filter_type;

        $line_chart = \Lava::DataTable();

        $line_data      = ChartModel::get_sales_order_data($filter_type,$date_from,$date_to);

        // dd($line_data)

        $line_chart->addDateColumn('Date')
             ->addNumberColumn('Sales');

        if (!empty($line_data)) {
            if ($filter_type == 'yearly') {
                foreach ($line_data as $key => $value) {
                    $line_chart->addRow([$key,  $value]); //With Outstandiong Balance ,$value[1]
                }
            }
            else{
                $start_day  = date('d',strtotime($date_from));
                $end_day    = date('d',strtotime($date_to));
                $temp_date  = explode('-',$date_from);
                $date       = '';
                for ($i = $start_day; $i < $end_day; $i++) {
                    $date = $temp_date[0] . '-' . $temp_date[1] . '-' . $i;
                    $date = date('Y-m-d',strtotime($date));
                    $line_chart->addRow([$date,  (!empty($line_data[$date]) ? $line_data[$date] : 0)]); //With Outstandiong Balance ,$value[1]
                }
            }
        }

        if ($filter_type == 'yearly') {
            $date_from = !empty($date_from) ? date('Y',strtotime($date_from)) : date('Y');
        }
        else if ($filter_type == 'monthly') {
            $date_from = !empty($date_from) ? date('Y-m',strtotime($date_from)) : date('Y-m');
        }
        
        $sales_data      = ChartModel::get_sales_data($date_from,$filter_type);
        $sales_data      = !empty($sales_data) ? array_column($sales_data,'total_count','sales_status') : [];
        $table_data1     = ChartModel::get_sales_trends_table($date_from,$filter_type);
        
        \Lava::LineChart('line-chart', $line_chart, [
            'title' => 'Sales Order Trends',
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'width' => 1200,
            'height' => 600,
            'backgroundColor' => '#f7f7f7',
            'hAxis' => [
                'format' => 'MMM',
            ],
            
            'chartArea' => [
                'width' => 960,
                'height' => 400,
            ],
            'pointSize' => 7,
            'series' => [
                0 => [
                    'color' => '#003f5c',
                ],
            ],
            
        ]);
        return view('chart.report_sales_line',['line_data' => $line_data , 'table_data1' => $table_data1]);
    }

    //MATERIAL PURCHASE ORDER
    public function generate_reports_materials_purchased(Request $request){

        $date_from = date('Y-m-d', strtotime($request->date_from));
        $date_to   = date('Y-m-d', strtotime($request->date_to));
        $filter_type = $request->filter_type;
        // $lava = new Lavacharts;

        // $datefrom = request()->get('date_from');
        // $filter_type = request()->get('filter_type');
        // $date_to = request()->get('date_to');


        $yearly = date('Y', strtotime($date_from ));
        $month =  date('m', strtotime($date_from ));
        // return  $datefrom ;


        // $jas = 'monthly';
        if ( $filter_type == 'yearly'){
        $materials_purchasedPie     = \Lava::DataTable();
        $materials_purchasedDataTable = MaterialPurchased::whereYear('purchase_date', '=', $yearly)->get();
        $mp_status=  $materials_purchasedDataTable->pluck('mp_status')->unique();
        

        $purchase_order_Completed = MaterialPurchased::where('mp_status','=','Completed')
        ->whereYear('purchase_date', '=',  $yearly)->pluck('mp_status');
        $purchase_order_ToReceive = MaterialPurchased::where('mp_status','=','To Receive')
        ->whereYear('purchase_date', '=', $yearly)->pluck('mp_status'); 
        $purchase_order_ToReceiveBill = MaterialPurchased::where('mp_status','=','To Receive and bill')
        ->whereYear('purchase_date', '=',  $yearly)->pluck('mp_status');
        $purchase_order_ToBill = MaterialPurchased::where('mp_status','=','To Bill')
        ->whereYear('purchase_date', '=',  $yearly)->pluck('mp_status');  
        }

        else if( $filter_type== 'monthly'){
            $materials_purchasedPie     = \Lava::DataTable();
            $materials_purchasedDataTable = MaterialPurchased::whereYear('purchase_date', '=',  $yearly)
            ->whereMonth('purchase_date', '=', $month)
            ->get();
            $mp_status=  $materials_purchasedDataTable->pluck('mp_status')->unique();
            

            $purchase_order_Completed = MaterialPurchased::where('mp_status','=','Completed')
            ->whereYear('purchase_date', '=', $yearly)
            ->whereMonth('purchase_date', '=', $month)
            ->pluck('mp_status');
            $purchase_order_ToReceive = MaterialPurchased::where('mp_status','=','To Receive')
            ->whereYear('purchase_date', '=', $yearly)
            ->whereMonth('purchase_date', '=',  $month)
            ->pluck('mp_status'); 
            $purchase_order_ToReceiveBill = MaterialPurchased::where('mp_status','=','To Receive and bill')
            ->whereYear('purchase_date', '=',  $yearly)
            ->whereMonth('purchase_date', '=',  $month)
            ->pluck('mp_status');
            $purchase_order_ToBill = MaterialPurchased::where('mp_status','=','To Bill')
            ->whereYear('purchase_date', '=',  $yearly)
            ->whereMonth('purchase_date', '=',  $month)
            ->pluck('mp_status');  
    
        }


        $Count_purchase_order_Completed [] = $purchase_order_Completed->count();
        $Count_purchase_order_Receive [] = $purchase_order_ToReceive->count();
        $Count_purchase_order_ToReceiveBill [] = $purchase_order_ToReceiveBill->count();
        $Count_purchase_order_ToBill [] = $purchase_order_ToBill->count();

    

        $materials_purchasedPie->addStringColumn('Status')
                                ->addNumberColumn('Percent')
                                ->addRow(['Completed', $Count_purchase_order_Completed])
                                ->addRow(['Receive', $Count_purchase_order_Receive])
                                ->addRow(['To Receive and Bill', $Count_purchase_order_ToReceiveBill])
                                ->addRow(['To Bill', $Count_purchase_order_ToBill]);

        \Lava::PieChart('pie-chart', $materials_purchasedPie, [
            'title'  => ' ',
            'is3D'   => true,
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#003f5c','#ffa600','#93bcd4','#0f81c4'],
            'backgroundColor' => '#f7f7f7',
            'width' => 800,
            'height' => 500,
            'pieSliceTextStyle' => [
                'fontSize' => 15, 
            ]
        ]);

        return view('modules.reports.reports_materials_purchased',
            ['mp_status' => $mp_status],
            ['materials_purchasedDataTable' => $materials_purchasedDataTable],
            ['materials_purchasedPie' => $materials_purchasedPie]
        );
    }

 //PURCHASE AND SALES
 public function generate_reports_purchase_and_sales(Request $request){
    $date_from = date('Y-m-d', strtotime($request->date_from));
    $date_to   = date('Y-m-d', strtotime($request->date_to));
    $filter_type = $request->filter_type;

    $yearly = date('Y', strtotime($date_from));
    $month=  date('m', strtotime($date_from));   

 
        $current_year = Carbon::now()->format('Y');

        //SCOREBOARDS DATA
        //ANNUAL PURCHASE
        $annual_purchase_sum = MaterialPurchased::select(
            MaterialPurchased::raw('SUM(total_cost) as sums'), 
            MaterialPurchased::raw("DATE_FORMAT(purchase_date,'%y') as year"))
            ->whereYear('purchase_date','=', $yearly)
            ->where('mp_status','=','Completed')
            ->groupBy('year')
            ->orderBy('purchase_date','asc')
            ->get();

         
        $purchase_order_Completed = MaterialPurchased::where('mp_status','=','Completed')->pluck('mp_status');
        $purchase_order_ToReceive = MaterialPurchased::where('mp_status','=','To Receive')->pluck('mp_status'); 
        $purchase_order_ToReceiveBill = MaterialPurchased::where('mp_status','=','To Receive and bill')->pluck('mp_status');
        $purchase_order_ToBill = MaterialPurchased::where('mp_status','=','To Bill')->pluck('mp_status'); 

        //PURCHASE ORDER TO RECEIVE
        $po_to_receive = $purchase_order_ToReceive->count() + $purchase_order_ToReceiveBill->count();
        //PURCHASE ORDER TO BILL
        $po_to_bill = $purchase_order_ToReceiveBill->count()  + $purchase_order_ToBill->count();
        //SUPPLIER
        $supplier =  MaterialPurchased::select('supp_quotation_id', DB::raw('count(supp_quotation_id) quantity'))->groupBy('supp_quotation_id')->get();
        $active_supplier = $supplier->count();
      
    
        if(count($annual_purchase_sum)){
            $annual_purchase = $annual_purchase_sum->pluck('sums')[0];
             
           }    
           else
           {
                $annual_purchase =  0;
                $po_to_receive =0;
                $po_to_bill =0;
                $active_supplier = 0;
           }      

        //COLUMN CHART
        if ( $filter_type == 'yearly'){
            $materials_purchasedDataTable = MaterialPurchased::where('mp_status','=','Completed')->whereYear('purchase_date', '=', $yearly)
            ->get();


        $purchase_order_trends = MaterialPurchased::select(
            MaterialPurchased::raw('SUM(total_cost) as sums'), 
            MaterialPurchased::raw("DATE_FORMAT(purchase_date,'%m') as months"))
                ->whereYear('purchase_date','=', $yearly)
                ->where('mp_status','=','Completed')
                ->groupBy('months')
                ->orderBy('purchase_date','asc')
                ->get();
                   $data = [0,0,0,0,0,0,0,0,0,0,0,0];
                    foreach($purchase_order_trends as $order){
                    $data[$order->months-1] = $order->sums;
                    }

        $sales_order_trends = SalesOrder::select(
            MaterialPurchased::raw('SUM(cost_price) as sums'), 
            MaterialPurchased::raw("DATE_FORMAT(transaction_date,'%m') as months"))
                ->whereYear('transaction_date','=', $yearly)
                ->where('sales_status','=','Fully Paid')
                ->groupBy('months')
                ->orderBy('transaction_date','asc')
                ->get();
                $data2 = [0,0,0,0,0,0,0,0,0,0,0,0];
                foreach($sales_order_trends as $order2){
                $data2[$order2->months-1] = $order2->sums;
                }


                $rawmats1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                ->join('materials_purchased', 'materials_purchased.purchase_id','=', 'materials_list_purchased.purchase_id')
                ->where('materials_purchased.mp_status', '=', 'Completed')
                ->groupBy('materials_list_purchased.item_code')
                ->whereYear('materials_purchased.purchase_date', '=', $yearly)
                ->get();
            
                
  
        }

        else{
           
            $materials_purchasedDataTable = MaterialPurchased::where('mp_status','=','Completed')->whereYear('purchase_date', '=', $yearly)
            ->whereMonth('purchase_date', '=', $month)->get();
           
        $purchase_order_trends = MaterialPurchased::select(
            MaterialPurchased::raw('SUM(total_cost) as sums'), 
            MaterialPurchased::raw("DATE_FORMAT(purchase_date,'%m') as months"))
                ->whereYear('purchase_date','=', $yearly)
                ->groupBy('months')
                ->orderBy('purchase_date','asc')
                ->get();
                   $data = [0,0,0,0,0,0,0,0,0,0,0,0];
                    foreach($purchase_order_trends as $order){
                    $data[$order->months-1] = $order->sums;
                    }

        $sales_order_trends = SalesOrder::select(
            MaterialPurchased::raw('SUM(cost_price) as sums'), 
            MaterialPurchased::raw("DATE_FORMAT(transaction_date,'%m') as months"))
                ->whereYear('transaction_date','=', $yearly)
                ->groupBy('months')
                ->orderBy('transaction_date','asc')
                ->get();
                $data2 = [0,0,0,0,0,0,0,0,0,0,0,0];
                foreach($sales_order_trends as $order2){
                $data2[$order2->months-1] = $order2->sums;
                }

                $rawmats1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                ->join('materials_purchased', 'materials_purchasedd.purchase_id','=', 'materials_list_purchased.purchase_id')
                ->where('materials_purchasedd.mp_status', '=', 'Completed')
                ->groupBy('materials_list_purchased.item_code')
                ->whereYear('materials_purchased.purchase_date', '=', $yearly)
                ->get();

        }
   
        $purchase_sales     = \Lava::DataTable();
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept', 'Oct', 'Nov', 'Dec'];

        $purchase_sales->addStringColumn('Status')
                ->addNumberColumn('Expenses')
                ->addNumberColumn('Sales');
                for($i=0; $i<=11; $i++){
                    $purchase_sales->addRow([$months[$i], $data[$i], $data2[$i]]);
                }
                

                \Lava::ColumnChart('column-chart', $purchase_sales, [
                    'title' => 'Purchase Order & Sales Order Trends',
                    'width' => 1200,
                    'height' => 600,
                    'legend' => [
                        'position' => 'bottom',
                        'textStyle' => [
                            'fontSize' => 12,
                        ]
                    ],
                    'chartArea' => [
                        'width' => 1100,
                        'height' => 400,
                    ],
                    'groupWidth' => '33%',
                    'colors' => ['#003f5c','#ffa600'],
                    'vAxis' => [
                        'format' => '₱#,###,###.##',
                        'textStyle' => [
                            'fontSize' => 10,
                        ]
                    ],   
                    'backgroundColor' => 'transparent',
                    
                ]);

                    
                //$product = MaterialPurchased::create($request->all());
                //return $product;

              // $jas = json_encode(MaterialPurchased::table('materials_purchased')->get()->toArray());
              // return $jas;


             return view('modules.reports.reports_purchase_and_sales',['purchase_sales' => $purchase_sales],
             compact('annual_purchase','po_to_receive','po_to_bill','active_supplier','rawmats1'));
}

//STOCKS AND SUPPLIER
public function generate_reports_stock_monitoring(Request $request){
    $date_from = date('Y-m-d', strtotime($request->date_from));
    $date_to   = date('Y-m-d', strtotime($request->date_to));
    $filter_type = $request->filter_type;
    $item_filter = $request->item_filter;

    $yearly = date('Y', strtotime($date_from));
    $month=  date('m', strtotime($date_from));


    //TOTAL NO OF RAW MATERIALS SCOREBOARD
    $data_table_raw_materials = ManufacturingMaterials::all();
    $total_raw_material_data = ManufacturingMaterials::select('item_name')->distinct('item_name')->pluck('item_name');
    $total_raw_material = $total_raw_material_data->count();

    //FOR COLUMN CHART
    //$total_raw_material_ids = ManufacturingMaterials::select('item_code')->distinct('item_code')->pluck('item_code');
    $all_id = supplierReports::pluck('id');
    $all_suppliers = supplierReports::select('supplier_id')->distinct('supplier_id')->pluck('supplier_id');
 
    $all_suppliers = supplierReports::where('item_code', $item_filter)->pluck('supplier_id')->unique();
 
    //Supplier
    $supplier =  supplierReports::pluck('supplier_id')->unique();
    $active_supplier = $supplier->count();

    //TABLE
   // $color = ['#003f5c','#ffa600','#93bcd4','#0f81c4', '#ef705f' , '4fd25c', 'ffe66d','#003f5c','#ffa600','#93bcd4','#0f81c4', '#ef705f' , '4fd25c', 'ffe66d'];
    $finances = \Lava::DataTable();
    $finances->addStringColumn('')
            ->addNumberColumn('Rate ₱')
            ->addRoleColumn('string','style');
            for($i = 0; $i < count($all_suppliers); $i++){
                $rates = supplierReports::where('supplier_id', $all_suppliers[$i])->where('item_code', $item_filter)->latest('date_created')->pluck('rate')->first();
                $supplier = Supplier::where('supplier_id', $all_suppliers[$i])->pluck('company_name')->first();
                $finances->addRow([$supplier, $rates]);
            }

            //for title name
            $total_raw_material_ids = DB::table('env_raw_materials')
            ->select('env_raw_materials.item_code','env_raw_materials.item_name')
            ->join('supplier_reports','supplier_reports.item_code', '=','env_raw_materials.item_code')
            ->distinct('item_code')
            ->get();

            $item = ManufacturingMaterials::where('item_code', '=',$item_filter)->pluck('item_name')->first();


            $title = "Supplier Rates for " . $item ;
            
        
            //SUPPLIER REPORTS
            if ( $filter_type == 'yearly'){
                $stockMonitoringTable = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                'supplier_reports.supplier_id','supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                ->where('supplier_reports.item_code', $item_filter)
                ->whereYear('date_created', '=', $yearly)->get();
                }
    
            else if ( $filter_type == 'monthly'){
    
                $stockMonitoringTable = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                'supplier_reports.supplier_id', 'supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                ->where('supplier_reports.item_code', $item_filter)
                ->whereYear('date_created', '=', $yearly)
                ->whereMonth('date_created', '=', $month)->get();
            }

\Lava::ColumnChart('column-chart', $finances, [
            'title'  =>   "$title",
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#003f5c'],
            'backgroundColor' => '#f7f7f7',
            'height' =>500,
            'vAxis' => [
                'format' => '₱#,###,###.##'
            ],
            'pointSize' => 7,
            'legend' => [
            'position' => 'none',
            'series' => [
                0 => [
                    'color' => '#003f5c',
                ],
            ],
        ],

    ]);

    return view('modules.reports.reports_stock_monitoring' ,compact( 'total_raw_material', 'total_raw_material_ids', 'active_supplier','stockMonitoringTable'));
}



    public function generate_reports_delivery (Request $request){
        $date_from      = date('Y-m-d', strtotime($request->date_from));
        $date_to        = date('Y-m-d', strtotime($request->date_to));
        $filter_type    = $request->filter_type;

        $pie_chart2 = \Lava::DataTable();

        $pie_chart2->addStringColumn('Percent')
        ->addNumberColumn('To Ship')
        // ->addNumberColumn('Shipped')
        ->addNumberColumn('Received');

        if ($filter_type == 'yearly') {
            $date_from = !empty($date_from) ? date('Y',strtotime($date_from)) : date('Y');
        }
        else if ($filter_type == 'monthly') {
            $date_from = !empty($date_from) ? date('Y-m',strtotime($date_from)) : date('Y-m');
        }
        
        $delivery_data      = ChartModel::get_delivery_data($date_from,$filter_type);
        $delivery_data      = !empty($delivery_data) ? array_column($delivery_data,'total_count','delivery_status') : [];
        $table_data         = ChartModel::get_delivery_table_data($date_from,$filter_type);
        // dd($delivery_data);
        $to_ship            = !empty($delivery_data['To Ship'])        ?         :0;
        // $shipped            = !empty($delivery_data['Shipped'])         ?        :0;
        $received           = !empty($delivery_data['Received'])        ?        :0;
        if ($filter_type == 'yearly') {
            for ($i=1; $i <= 12; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $toship_count           = !empty($to_ship[$date_from . '-' . $i])   ? $to_ship[$date_from . '-' . $i]   : 0;
                // $shipped_count          = !empty($shipped[$date_from . '-' . $i])   ? $shipped[$date_from . '-' . $i]   : 0;
                $received_count         = !empty($received[$date_from . '-' . $i])  ? $received[$date_from . '-' . $i]  : 0;
                $pie_chart2->addRow([date('F Y',strtotime($date_from . '-' . $i)), $toship_count, $received_count]);
            }
        }
        else if ($filter_type == 'monthly') {
            $end_day    = date('d',strtotime($date_to));
            for ($i = 1; $i <= $end_day; $i++) { 
                $i = ($i < 10) ? '0' . $i : $i;
                $toship_count   =     !empty($to_ship[$date_from   . '-' . $i])     ? $to_ship[$date_from  . '-' . $i]      : 0;
                // $shipped_count  =     !empty($shipped[$date_from    . '-' . $i])    ? $shipped[$date_from   . '-' . $i]     : 0;
                $received_count  =    !empty($received[$date_from    . '-' . $i])   ? $received[$date_from   . '-' . $i]    : 0;
                $pie_chart2->addRow([date('F d, Y',strtotime($date_from . '-' . $i)), $toship_count, $received_count]);
            }
        }

        $pie_chart2->addStringColumn('Stocks')
        ->addNumberColumn('Percent')
        ->addRow(['To Ship      ',              (!empty($delivery_data['To Ship'])                          ? $delivery_data['To Ship']                 : 0)])
        // ->addRow(['Shipped      ',              (!empty($delivery_data['Shipped'])                          ? $delivery_data['Shipped']                 : 0)])
        ->addRow(['Received     ',              (!empty($delivery_data['Received'])                         ? $delivery_data['Received']                : 0)]);
        
        \Lava::PieChart('pie-chart2', $pie_chart2, [
            'title'  => 'Delivery Status ',
            'is3D'   => true,
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#ffa600', '#003f5c'],
            'backgroundColor' => '#f7f7f7',
            'width' => 600,
            'height' => 600,
            'pieSliceTextStyle' => [
                'fontSize' => 15, 
            ]

        ]);
        
        return view('modules.reports.reports_delivery', ['table_data' => $table_data]);

    }
 
    public function export (Request $request) {

        $date_filter_type   = $request->input('date-filter-option');
        $date_from          = $request->input('date-from');
        $report_type        = $request->input('report-name');
        $export_type        = $request->input('button-export');
        //$item_filter        = $request->all();

        $date_from2 = date('Y-m-d', strtotime($request->date_from));

        $yearly = date('Y', strtotime($date_from ));
        $month = date('m', strtotime($date_from ));
   

        if ($date_filter_type == 'monthly') {
            $date_from = !empty($date_from) ? explode('/',$date_from)               : [];
            $date_from = !empty($date_from) ? $date_from[1] . '-' . $date_from[0]   : date('Y-m');
            $month = date('m', strtotime($date_from));
        
        }
        else if($date_filter_type == 'yearly'){
            $date_from = !empty($date_from) ? $date_from : date('Y');
            $yearly = date('Y', strtotime($date_from));
           
        }

        $report_name = "";

        if ($report_type == 1){
            $report_name = "Work_Order_Report";
        }
        else if ($report_type == 2){
            $report_name = "Sales_Order_Report";
        }
        else if ($report_type == 3){
            $report_name = "Sales_Trends_Report";
        }
        else if ($report_type == 4){
            $report_name = "Purchase_Order_Report";
        }
        else if ($report_type == 5){
            $report_name = "Purchase_Sales_Report";
        }
        else if ($report_type == 6){
            $report_name = "Stock_Monitoring_Report";
        }
        else if ($report_type == 7){
            $report_name = "Delivery_Report";
        }
        else if ($report_type == 8){
            $report_name = "Fast_Moving_Report";
        }



        $data = [
            'date_filter_type'  => $date_filter_type,
            'date_from'         => $date_from,
            'report_type'       => $report_type,
            'filename'          => $report_name,
            'yearly'            => $yearly,
            'month'             => $month,
            'date_from2'        => $date_from2,

        ];

        if ($export_type == 'excel') {
            return $this->export_excel($data);
        }
        else if ($export_type == 'pdf') {
            return $this->export_pdf($data);
        }

    }

    public function export_excel ($data) {

        $date_from          = !empty($data['date_from'])        ? $data['date_from']        : '';
        $date_from2         = !empty($data['date_from2'])       ? $data['date_from2']        : '';
        $report_type        = !empty($data['report_type'])      ? $data['report_type']      : '';
        $date_filter_type   = !empty($data['date_filter_type']) ? $data['date_filter_type'] : '';
        $filename           = !empty($data['filename'])         ? $data['filename']         : '';
        $yearly             = !empty($data['yearly'])           ? $data['yearly']         : '';
        $month              = !empty($data['month'])            ? $data['month']         : '';
        $item_filter        = !empty($data['item_filter'])      ? $data['item_filter']         : '';

        return Excel::download(new excel_export($data),$filename . '.xlsx');
    }

    public function export_pdf ($data = []) {
        $paper_size         = !empty($data['paper_size'])       ? $data['paper_size']       : array(0,0,612,1009); // default paper size (A4)
        $file_name          = !empty($data['filename'])         ? $data['filename']         : 'Test.pdf';
        $date_from          = !empty($data['date_from'])        ? $data['date_from']        : '';
        $report_type        = !empty($data['report_type'])      ? $data['report_type']      : '';
        $date_filter_type   = !empty($data['date_filter_type']) ? $data['date_filter_type'] : '';
        $yearly             = !empty($data['yearly'])           ? $data['yearly']           : '';
        $month              = !empty($data['month'])            ? $data['month']            : '';
        $item_filter        = !empty($data['item_filter'])      ? $data['item_filter']         : '';
    
        if (!empty($data['report_type']) && $data['report_type'] == 1) {

            $table_data = ChartModel::get_table_data($date_from,$date_filter_type);
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.work_order_report',['table_data' => $table_data,'has_width' => true]);
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 2) {

            $table_data     = ChartModel::get_sales_table_data($date_from,$date_filter_type);
            $sales_data     = ChartModel::get_sales_data($date_from,$date_filter_type);
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.sales_report',['pie-chart1' => $sales_data, 'table_data' => $table_data,'has_width' => false]);
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 3) {

            $table_data1     = ChartModel::get_sales_trends_table($date_from,$date_filter_type);
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.sales_trends',['table_data1' => $table_data1, 'has_width' => true]);
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 4) {

            if ($date_filter_type == 'yearly'){
            $table_data1 = MaterialPurchased::whereYear('purchase_date', '=', $date_from)->get();
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.purchase_order',['materials_purchasedDataTable' => $table_data1, 'has_width' => true]);
            }
            else{
                $table_data1 = MaterialPurchased::whereYear('purchase_date', '=',  $date_from)
                ->whereMonth('purchase_date', '=', $month)
                ->get();
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.purchase_order',['materials_purchasedDataTable' => $table_data1, 'has_width' => true]);
            }  
            
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 5) {

            if ($date_filter_type == 'yearly'){
                $table_data1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                    ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                    ->join('materials_purchased', 'materials_purchased.purchase_id','=', 'materials_list_purchased.purchase_id')
                    ->where('materials_purchased.mp_status', '=', 'Completed')
                ->groupBy('materials_list_purchased.item_code')
                ->whereYear('purchase_date', '=', $date_from)
                ->get();
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.purchase_sales',['rawmats1' => $table_data1, 'has_width' => true]);
            }
            else{
                $table_data1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                    ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                    ->join('materials_purchased', 'materials_purchased.purchase_id','=', 'materials_list_purchased.purchase_id')
                    ->where('materials_purchased.mp_status', '=', 'Completed')
                ->groupBy('materials_list_purchased.item_code')
                ->whereYear('purchase_date', '=', $date_from)
                ->whereMonth('purchase_date', '=', $month)
                ->get();
                $pdf = PDF::loadView('modules.reports.ExcelExportBlade.purchase_sales',['rawmats1' => $table_data1, 'has_width' => true]);
            }
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 6) {
                if ($date_filter_type == 'yearly'){
                    $table_data1 = DB::table('env_raw_materials')
                    ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                    'supplier_reports.supplier_id','supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                    ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                    ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                    ->whereYear('date_created', '=', $date_from)
                    ->orderBy('env_raw_materials.item_name', 'ASC')
                    ->get();
                    // dd($table_data1);
                    $pdf = PDF::loadView('modules.reports.ExcelExportBlade.stock_monitoring',['stockMonitoringTable' => $table_data1, 'has_width' => true]);
                    }
                else{
                    $table_data1 = DB::table('env_raw_materials')
                    ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                    'supplier_reports.supplier_id','supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                    ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                    ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                    ->whereYear('date_created', '=', $date_from)
                    ->whereMonth('date_created', '=', $month)
                    ->orderBy('env_raw_materials.item_name', 'ASC')
                    ->get();
                    $pdf = PDF::loadView('modules.reports.ExcelExportBlade.stock_monitoring',['stockMonitoringTable' => $table_data1, 'has_width' => true]);
                } 
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 7) {

            $table_data         = ChartModel::get_delivery_table_data($date_from,$date_filter_type);
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.delivery_reports',['table_data' => $table_data, 'has_width' => true]);
        }
        else if (!empty($data['report_type']) && $data['report_type'] == 8) {

            $table_data         = ChartModel::get_fast_moving_table($date_from,$date_filter_type);
            $pdf = PDF::loadView('modules.reports.ExcelExportBlade.fast_move',['table_data' => $table_data, 'has_width' => true]);
        }

        $pdf->setPaper($paper_size);

        return $pdf->download($file_name . '.pdf');
}


    public function generate_reports_fast_move (Request $request){
        $date_from      = date('Y-m-d', strtotime($request->date_from));
        $date_to        = date('Y-m-d', strtotime($request->date_to));
        $filter_type    = $request->filter_type;

        $pie_chart      = \Lava::DataTable();

        if ($filter_type == 'yearly') {
            $date_from = !empty($date_from) ? date('Y',strtotime($date_from)) : date('Y');
        }
        else if ($filter_type == 'monthly') {
            $date_from = !empty($date_from) ? date('Y-m',strtotime($date_from)) : date('Y-m');
        }

        $chart_data     = ChartModel::get_fast_moving_data($date_from,$filter_type);
        $chart_data     = !empty($chart_data) ? array_column($chart_data,'product_count','product_name') : [];
        $table_data     = ChartModel::get_fast_moving_table($date_from,$filter_type);
       

        $pie_chart->addStringColumn('Purchased Product');
        $pie_chart->addNumberColumn('Products');
        foreach ($chart_data as $key => $value) {
            // $pie_chart->addNumberColumn($key);
            $pie_chart->addRow([$key,$value]);
        }
       
        \Lava::BarChart('pie-chart', $pie_chart, [
            'title'  => 'Fast Moving Products Report ',
            'bars' => 'vertical',
            'animation' => [
                'easing' => 'inAndout',
                'startup' => true,
                'duration' => 600,
            ],
            'hAxis'  => [
                'minValue' => 10,
            ],
                
            'legend' => [
                'position' => 'bottom',
                'textStyle' => [
                    'fontSize' => 16,
                ]
            ],
            'colors' => ['#003f5c'],
            'backgroundColor' => '#f7f7f7',
            'width' => 1550,
            'height' => 900,
            'fontSize' => 20,

           
            
        ]);


        return View('modules.reports.reports_fastMove',['table_data' => $table_data,'is_excel' => false]);
    }

}//end


