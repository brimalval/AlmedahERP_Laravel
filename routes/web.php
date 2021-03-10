<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function() {
    return view('modules.dashboard');
});

/**BOM ROUTES */
Route::get('/newBOM', function() { 
    return view('modules.manufacturing.bomsubModules.newbom');
});
Route::get('/subNewBOM', function() {
    return view('modules.newbom');
});
Route::get('/loadBOM', function() {
    return view('modules.manufacturing.bom');
});
Route::get('/openBlueprint', function() {
    return view('modules.manufacturing.bominfo.bominfo');
});

/**INVENTORY ROUTES */
Route::get('/openInventoryInfo', function() {
    return view('modules.manufacturing.inventoryInfo');
});
Route::get('/loadInv', function() {
    return view('modules.manufacturing.inventory');
});

/**ITEM ROUTES */

/**ITEM VARIANT ROUTES */
Route::get('/openItemVariantSettings', function() {
    return view('modules.stock.itemvariantsettings');
});

/**JOB SCHEDULING ROUTES */
Route::get('/loadJobsched', function() {
    return view('modules.manufacturing.jobschedulinginfo');
});
Route::get('/loadJobschedhome', function() {
    return view('modules.manufacturing.jobscheduling');
});

/**PRODUCTION PLAN ROUTES */
Route::get('/loadManufacturingProductionPlan', function() {
    return view('modules.manufacturing.productionplan');
});
Route::get('/openManufacturingProductionPlanForm', function() {
    return view('modules.manufacturing.productionplanform');
});

/**MANUFACTURING ITEM ATTRIBUTE ROUTES */
Route::get('/loadManufacturingItemAttribute', function() {
    return view('modules.manufacturing.itemattribute');
});
Route::get('/openManufacturingItemAttributeForm', function() {
    return view('modules.manufacturing.itemattributeform');
});

/**MANUFACTURING ITEM PRICE ROUTES */
Route::get('/loadManufacturingItemPrice', function() {
    return view('modules.manufacturing.itemprice');
});
Route::get('/openManufacturingItemPriceForm', function() {
    return view('modules.manufacturing.itempriceform');
});

/**MANUFACTURING ROUTING ROUTES */
Route::get('/loadManufacturingRouting', function() {
    return view('modules.manufacturing.routing');
});
Route::get('/openManufacturingRoutingForm', function(){
    return view('modules.manufacturing.routingform');
});

/**MATERIAL REQUEST ROUTES */
Route::get('/loadMaterialRequest', function() {
    return view('modules.buying.materialrequest');
});
Route::get('/openNewMaterialRequest', function(){
    return view('modules.buying.newMaterialRequest');
});
Route::get('/openMaterialRequestInfo', function() {
    return view('modules.buying.MaterialRequestInfo');
});

/**PRICE LIST ROUTES */
Route::get('/openNewPriceList', function() {
    return view('modules/selling/pricelistitem.php');
});
Route::get('/loadPriceList', function() {
    return view('modules.selling.pricelist');
});

/**PROJECT TEMPLATE */
Route::get('/openNewProjectTemplate', function() {
    return view('modules.projects.newprojecttemplate');
});
Route::get('/loadProjectTemplate', function() {
    return view('modules.projects.projecttemplate');
});

/**PURCHASE ORDER ROUTES */
Route::get('/loadPurchaseOrder', function() {
    return view('modules.buying.purchaseorder');
});
Route::get('/openNewPurchaseOrder', function() {
    return view('modules.buying.newpurchaseorder');
});

/**REPORTS ROUTES*/
Route::get('/loadReportsBuilder', function() {
    return view('modules.reports.reportsbuilder');
});
Route::get('/loadReportsBuilderShowReport', function() {
    return view('modules.reports.reportsbuilderform_showreport');
});
Route::get('/openReportsBuilderForm', function() {
    return view('modules.reports.reportsbuilderform');
}); 

/**SALES ORDER ROUTES */
Route::get('/openSaleInfo', function() {
    return view('modules.selling.saleInfo');
});
Route::get('/loadSalesOrder', function() {
    return view('modules.selling.salesorder');
});
Route::get('/openNewSaleOrder', function() {
    return view('modules.selling.newsaleorder');
});

/**STOCK ENTRY ROUTES */
Route::get('/openNewStockEntry', function() {
    return view('modules.manufacturing.NewStockEntry');
});
Route::get('/loadStockEntry', function() {
    return view('modules.manufacturing.stockentry');
});

/**SUPPLIER ROUTES */
Route::get('/loadSupplier', function() {
    return view('modules.buying.supplier');
});
Route::get('/openSupplierInfo', function() {
    return view('modules.buying.supplierInfo');
});

/**TASK ROUTES */
Route::get('/openNewTask', function() {
    return view('modules.projects.taskitem');
});
Route::get('/loadTask', function() {
    return view('modules.projects.task');
});

/**TIMESHEETS ROUTES */
Route::get('/loadProjectsTimesheet', function() {
    return view('modules.manufacturing.timesheet');
});
Route::get('/openManufacturingTimesheetForm', function(){
    return view('modules.manufacturing.timesheetform');
});

/**UOM ROUTES */
Route::get('/loadUOM', function() {
    return view('modules.stock.UOM');
});
Route::get('/openUOMNew', function() {
    return view('modules.stock.UOMNEW');
});
Route::get('/openUOMEdit', function() {
    return view('modules.stock.UOMEDIT');
});

/**WORK ORDER ROUTES*/
Route::get('/loadWorkOrder', function() {
    return view('modules.manufacturing.workorder');
});
Route::get('/openNewWorkorder', function() {
    return view('modules.manufacturing.workordersubModules.NewWorkorder');
});
Route::get('/loadWorkOrderInfo', function() {
    return view('modules.manufacturing.workordersubModules.workorder_info');
});

/**WAREHOUSE ROUTES */
Route::get('/loadWarehouse', function() {
    return view('modules.stock.warehouse');
});
Route::get('/openWarehouseNew', function(){
    return view('modules.stock.warehouseSubModules.warehouseNEW');
});
Route::get('/openWarehouseEdit', function() {
    return view('modules.stock.warehouseSubModules.warehouseEDIT');
});

/**WORKSTATION ROUTES */
Route::get('/loadManufacturingWorkstation', function() {
    return view('modules.manufacturing.workstation');
});
Route::get('/openManufacturingWorkstationForm', function() {
    return view('modules.manufacturing.workstationform');
});
