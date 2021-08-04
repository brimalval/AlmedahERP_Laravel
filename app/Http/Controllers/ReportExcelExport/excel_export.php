<?php 
namespace App\Http\Controllers\ReportExcelExport;

use App\Models\ChartModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class excel_export implements FromView
{
    public $date_filter_type;
    public $date_from;
    public $report_type;
    
    public function __construct($data = []) {
        $this->date_filter_type = $data['date_filter_type'];
        $this->date_from        = $data['date_from'];
        $this->report_type      = $data['report_type'];
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