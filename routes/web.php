<?php

use App\Http\Controllers\MaterialsController;
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

Route::get('accounting', function() {
    return view('modules.accounting.accounting');
});

/**BOM ROUTES */
Route::get('/bom', function() {
    return view('modules.manufacturing.bom');
});
Route::get('/newBOM', function() { 
    return view('modules.manufacturing.bomsubModules.newbom');
});
Route::get('/subNewBOM', function() {
    return view('modules.newbom');
});
Route::get('/openBlueprint', function() {
    return view('modules.manufacturing.bominfo.bominfo');
});

/**BUYING ROUTES */
Route::get('/buying', function() {
    return view('modules.buying.Buying');
});

/**CRM ROUTES */
Route::get('/contacts', function() {
    return view('modules.crm.contacts');
});
Route::get('/crm', function() {
    return view('modules.crm.crm');
});
Route::get('/customers', function() {
    return view('modules.crm.customers');
});
Route::get('/leads', function() {
    return view('modules.crm.leads');
});
Route::get('/objectives', function() {
    return view('modules.crm.objectives');
});
Route::get('/opportunities', function() {
    return view('modules.crm.opportunities');
});

/**HR ROUTES */
Route::get('/hr', function() {
    return view('modules.hr.hr');
});

/**INVENTORY ROUTES */
Route::get('/openInventoryInfo', function() {
    return view('modules.manufacturing.inventoryInfo');
});
Route::get('/inventory', [MaterialsController::class, 'index'])->name('inventory');
Route::get('/inventory/{id}', [MaterialsController::class, 'get'])->name('inventory.specific');
Route::post('/create-material', [MaterialsController::class, 'store']);
Route::patch('/update-material/{id}', [MaterialsController::class,'update'])->name('material.update');
Route::post('/delete-material/{id}', [MaterialsController::class, 'delete']);
Route::post('/create-categories' , [MaterialsController::class, 'storeCategory']);
Route::post('/add-stock/{id}', [MaterialsController::class,'addStock'])->name('material.add-stock');

/**ITEM ROUTES */
Route::get('/item', function() {
    return view('modules.manufacturing.item');
});

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

/**MANUFACTURING ROUTES */
Route::get('/manufacturing', function() {
    return view('modules.manufacturing.manufacturing');
});

/**MANUFACTURING ITEM ATTRIBUTE ROUTES */
Route::get('/itemattribute', function() {
    return view('modules.manufacturing.itemattribute');
});
Route::get('/openManufacturingItemAttributeForm', function() {
    return view('modules.manufacturing.itemattributeform');
});

/**MANUFACTURING ITEM PRICE ROUTES */
Route::get('/itemprice', function() {
    return view('modules.manufacturing.itemprice');
});
Route::get('/openManufacturingItemPriceForm', function() {
    return view('modules.manufacturing.itempriceform');
});

/**MANUFACTURING ROUTING ROUTES */
Route::get('/routing', function() {
    return view('modules.manufacturing.routing');
});
Route::get('/openManufacturingRoutingForm', function(){
    return view('modules.manufacturing.routingform');
});

/**MATERIAL REQUEST ROUTES */
Route::get('/materialrequest', function() {
    return view('modules.buying.materialrequest');
});
Route::get('/openNewMaterialRequest', function(){
    return view('modules.buying.newMaterialRequest');
});
Route::get('/openMaterialRequestInfo', function() {
    return view('modules.buying.MaterialRequestInfo');
});

/**MESSAGING ROUTES */
Route::get('/inbox', function() {
    return view('modules.messaging.inbox');
});
Route::get('/important', function() {
    return view('modules.messaging.important');
});
Route::get('/archived', function() {
    return view('modules.messaging.archived');
});

/**PAYMENT ENTRY ROUTES*/
Route::get('/paymententry', function() {
    return view('modules.accounting.paymententry');
});

/**PRICE LIST ROUTES */
Route::get('/openNewPriceList', function() {
    return view('modules/selling/pricelistitem.php');
});
Route::get('/loadPriceList', function() {
    return view('modules.selling.pricelist');
});

/**PRODUCTION ROUTES */
Route::get('/production', function() {
    return view('modules.manufacturing.production');
});

/**PRODUCTION PLAN ROUTES */
Route::get('/productionplan', function() {
    return view('modules.manufacturing.productionplan');
});
Route::get('/openManufacturingProductionPlanForm', function() {
    return view('modules.manufacturing.productionplanform');
});

/**PROJECTS ROUTES */
Route::get('/projects', function() {
    return view('modules.projects.projects');
});
Route::get('/task', function() {
    return view('modules.projects.task');
});

/**PROJECT TEMPLATE */
Route::get('/openNewProjectTemplate', function() {
    return view('modules.projects.newprojecttemplate');
});
Route::get('/loadProjectTemplate', function() {
    return view('modules.projects.projecttemplate');
});

/**PURCHASE ORDER ROUTES */
Route::get('/purchaseorder', function() {
    return view('modules.buying.purchaseorder');
});
Route::get('/openNewPurchaseOrder', function() {
    return view('modules.buying.newpurchaseorder');
});

/**QUALITY ROUTES */
Route::get('/quality', function() {
    return view('modules.quality.quality');
});

/**REPORTS ROUTES*/
Route::get('/reportsbuilder', function() {
    return view('modules.reports.reportsbuilder');
});
Route::get('/loadReportsBuilderShowReport', function() {
    return view('modules.reports.reportsbuilderform_showreport');
});
Route::get('/openReportsBuilderForm', function() {
    return view('modules.reports.reportsbuilderform');
}); 

/**RETAIL ROUTES */
Route::get('/retail', function() {
    return view('modules.retail.retail');
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

/**SELLING ROUTES */
Route::get('/selling', function() {
    return view('modules.selling.selling');
});

/**STOCK ROUTES */
Route::get('/stock', function() {
    return view('modules.stock.stock');
});

/**STOCK ENTRY ROUTES */
Route::get('/openNewStockEntry', function() {
    return view('modules.manufacturing.NewStockEntry');
});
Route::get('/loadStockEntry', function() {
    return view('modules.manufacturing.stockentry');
});

/**SUPPLIER ROUTES */
Route::get('/supplier', function() {
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
Route::get('/workstation', function() {
    return view('modules.manufacturing.workstation');
});
Route::get('/openManufacturingWorkstationForm', function() {
    return view('modules.manufacturing.workstationform');
});
