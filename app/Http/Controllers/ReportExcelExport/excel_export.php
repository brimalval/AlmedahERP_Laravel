<?php 
namespace App\Http\Controllers\ReportExcelExport;

use App\Models\ChartModel;
use App\Models\MaterialPurchased;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class excel_export implements FromView
{
    public $date_filter_type;
    public $date_from;
    public $report_type;
    public $month;
    public $yearly;
    
    public function __construct($data = []) {
        $this->date_filter_type = $data['date_filter_type'];
        $this->date_from        = $data['date_from'];
        $this->report_type      = $data['report_type'];
        $this->month            = $data['month'];
        $this->yearly            = $data['yearly'];
    }

    public function view(): View
    {
        if ($this->report_type == 1) {
            $table_data = ChartModel::get_table_data($this->date_from,$this->date_filter_type);
            return View('modules.reports.ExcelExportBlade.work_order_xlxs',['table_data' => $table_data,'has_width' => true]);
        }
        else if ($this->report_type == 2) {
            $table_data     = ChartModel::get_sales_table_data($this->date_from,$this->date_filter_type);
            return View('modules.reports.ExcelExportBlade.sales_report_xlxs',['table_data' => $table_data,'has_width' => true]);
        }
        else if ($this->report_type == 3) {
            $table_data1     = ChartModel::get_sales_trends_table($this->date_from,$this->date_filter_type);
            return view('modules.reports.ExcelExportBlade.sales_trends_xlxs',['table_data1' => $table_data1, 'has_width' => true]);
        }
        else if ($this->report_type == 4) {

            if ($this->date_filter_type == 'yearly'){
                $table_data1 = MaterialPurchased::whereYear('purchase_date', '=', $this->date_from)->get();
                return view('modules.reports.ExcelExportBlade.purchase_order_xlxs',['materials_purchasedDataTable' => $table_data1, 'has_width' => true]);
            }
            else{
                $table_data1 = MaterialPurchased::whereYear('purchase_date', '=',  $this->date_from)
                ->whereMonth('purchase_date', '=', $this->month)
                ->get();
                return view('modules.reports.ExcelExportBlade.purchase_order_xlxs',['materials_purchasedDataTable' => $table_data1, 'has_width' => true]);
            }

        }
        else if ($this->report_type == 5) {
            if ($this->date_filter_type == 'yearly'){
                $table_data1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                    ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                    ->join('materials_purchased', 'materials_purchased.purchase_id','=', 'materials_list_purchased.purchase_id')
                    ->where('materials_purchased.mp_status', '=', 'Completed')
                    ->groupBy('materials_list_purchased.item_code')
                    ->whereYear('purchase_date', '=', $this->date_from)
                    ->get();
                return view('modules.reports.ExcelExportBlade.purchase_sales_xlxs',['rawmats1' => $table_data1, 'has_width' => true]);
            }
            else{
                $table_data1 = DB::table('env_raw_materials')
                ->select('env_raw_materials.item_code','env_raw_materials.item_name',DB::raw('SUM(materials_list_purchased.subtotal) as sums'), 
                DB::raw("DATE_FORMAT(materials_purchased.purchase_date, '%M, %Y') as rm_date"),DB::raw('materials_purchased.purchase_id'))
                    ->join('materials_list_purchased','materials_list_purchased.item_code', '=','env_raw_materials.item_code')
                    ->join('materials_purchased', 'materials_purchased.purchase_id','=', 'materials_list_purchased.purchase_id')
                    ->where('materials_purchased.mp_status', '=', 'Completed')
                    ->groupBy('materials_list_purchased.item_code')
                    ->whereYear('purchase_date', '=', $this->date_from)
                    ->whereMonth('purchase_date', '=', $this->month)
                    ->get();
                return view('modules.reports.ExcelExportBlade.purchase_sales_xlxs',['rawmats1' => $table_data1, 'has_width' => true]);
            }
        }
        else if ($this->report_type == 6) {
            if ($this->date_filter_type == 'yearly'){
                $table_data1 = DB::table('env_raw_materials')
                    ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                    'supplier_reports.supplier_id','supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                    ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                    ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                    ->whereYear('date_created', '=', $this->date_from)
                    ->orderBy('env_raw_materials.item_name', 'ASC')
                    ->get();
                    return view('modules.reports.ExcelExportBlade.stock_monitoring_xlxs',['stockMonitoringTable' => $table_data1, 'has_width' => true]);
            }
            else{
                $table_data1 = DB::table('env_raw_materials')
                    ->select('env_raw_materials.item_code','env_raw_materials.item_name', DB::raw('suppliers.supplier_id'),DB::raw('suppliers.company_name'),
                    'supplier_reports.supplier_id','supplier_reports.rate','supplier_reports.item_code','supplier_reports.date_created')
                    ->join('supplier_reports','supplier_reports.item_code','=','env_raw_materials.item_code')
                    ->join('suppliers','suppliers.supplier_id','=','supplier_reports.supplier_id')
                    ->whereYear('date_created', '=', $this->date_from)
                    ->whereMonth('date_created', '=', $this->month)
                    ->orderBy('env_raw_materials.item_name', 'ASC')
                    ->get();
                    return view('modules.reports.ExcelExportBlade.stock_monitoring_xlxs',['stockMonitoringTable' => $table_data1, 'has_width' => true]);
            }
            
        }
        else if ($this->report_type == 7) {
            $table_data         = ChartModel::get_delivery_table_data($this->date_from,$this->date_filter_type);
            return view('modules.reports.ExcelExportBlade.delivery_reports_xlxs',['table_data' => $table_data, 'has_width' => true]);
        }
        else if ($this->report_type == 8) {
            $table_data         = ChartModel::get_fast_moving_table($this->date_from,$this->date_filter_type);
            return view('modules.reports.ExcelExportBlade.fast_moving_xlxs',['table_data' => $table_data, 'has_width' => true]);
        }
        

    }
}