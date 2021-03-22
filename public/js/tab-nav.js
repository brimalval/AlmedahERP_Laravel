//--> start of Dashboard js <--//
if ($("#divMain").children().length == 0) {
  $(document).ready(function () {
    $('#divMain').load('modules/dashboard.php');
  });
}
//--> End of Dashboard js <--//

$(document).ready(function () {
  $("body").on("click", ".menu", function () {
    if (!$("#tabs").length) {
      $("#divMain").html(
        `<ul class="nav nav-tabs" id="tabs"></ul>
        <div class="tab-content border-secondary" id="contents"></div>`
      );
    }
    var name = $(this).attr("data-name");
    var moduleWithSpace;
    if(name == undefined){
      moduleWithSpace= $(this).text().trim();
    }
    else{
      moduleWithSpace= name;
    }
    
    var moduleWOSpace = moduleWithSpace.replace(/\s+/g, '');
    var menu = moduleWOSpace;
    //checks if the clicked item has its tab is shown
    if (!$(`#tab${menu}`).length) {
      $("#tabs").append(
        `<li class="nav-item menu-item">
            <a class="nav-link" data-toggle="tab" href="#content${menu}" id="tab${menu}">
                  ${moduleWithSpace} <b class="closeTab text close ml-4">x</b>
            </a>
        </li>`
      );
      // append the content of the tab
      $("#contents").append(
        `<div class="tab-pane active p-0" id="content${menu}">
        </div>`
      );
      //goes to a specific module
      var $link = `${menu}`;
      var $parent = $(this).attr("data-parent");
      // set custom module route defined in data-module attribute
      if (typeof $(this).attr('data-module-url') !== "undefined") {
        $link = $(this).attr('data-module-url');
      }

      $(`#content${menu}`).load("./modules/" + $link.toLowerCase() + "/" + $link.toLowerCase() + ".php", function (responseTxt, statusTxt, xhr) {
        if (statusTxt == "error"){
          console.log("Error: " + xhr.status + ": " + xhr.statusText);
          console.log($parent);
          $(`#content${menu}`).load("./modules/" + $parent.toLowerCase() + "/" + $link.toLowerCase() + ".php", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "error")
              alert("Error: " + xhr.status + ": " + xhr.statusText);
              
          });
        }
      });
      $(`#tab${menu}`).tab("show");
    }
    // if it's active, show it
    else {
      $(`#tab${menu}`).tab("show");
    }
  });
  // function for the close button of the tabs
  $("body").on("click", ".closeTab", function () {
    var $item = $(this).parent().text().trim();
    // if there are no shown tabs, remove all elements
    if (!$("#tabs li").length) {
      $("#divMain").html("");
    }
    else {
      $(".menu-item").each(function (index) {
        if ($(this).text().trim() == $item) {
          // checks for the previous sibling if it has one
          var goTo = ($(this).prev().text().trim().length) ? $(this).prev().children().attr("id") :
            $(this).next().children().attr("id");
          $(`#${goTo}`).tab("show");
        }
      });
    }
    $(this).parent().parent().remove();
    $($(this).parent().attr("href")).remove();

    //--> Additional Dashboard js (close tabs) <--//
    if ($("#tabs").children().length == 0) {
      $(document).ready(function () {
        $('#divMain').load('modules/dashboard.php');
      });
    }
    //--> End of Dashboard js (close tabs) <--//
  });
});

function loadNewBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('modules/manufacturing/bomsubModules/newbom.php');
  });
}

function subloadNewBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('modules/newbom.php');
  });
}

function loadBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('modules/manufacturing/bom.php');
  });
}

function openNewWorkorder(){
  $(document).ready(function () {
    $('#contentWorkOrder').load('modules/manufacturing/workordersubModules/NewWorkorder.php');
  });
}

function openBlueprint() {
  $(document).ready(function () {
    $('#contentBOM').load('modules/manufacturing/bominfo/bominfo.php');
  });
}
function openInventoryInfo() {
  $(document).ready(function () {
    $('#contentInventory').load('modules/manufacturing/inventoryInfo.php');
  });
}

function loadInv() {
    $(document).ready(function () {
    $('#contentInventory').load('modules/manufacturing/inventory.php');
  });
}

function loadWorkOrder() {
  $(document).ready(function () {
    $('#contentWorkOrder').load('modules/manufacturing/workorder.php');
  });
}

function loadWorkOrderInfo() {
  $(document).ready(function () {
    $('#contentWorkOrder').load('modules/manufacturing/workordersubModules/workorder_info.php');
  });
}

function loadReportsBuilder() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('modules/reports/reportsbuilder.php');
  });
}
function loadReportsBuilderShowReport() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('modules/reports/reportsbuilderform_showreport.php');
  });
}

function openReportsBuilderForm() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('modules/reports/reportsbuilderform.php');
  });
}

function loadManufacturingProductionPlan() {
  $(document).ready(function () {
    $('#contentProductionPlan').load('modules/manufacturing/productionplan.php');
  });
}
function openManufacturingProductionPlanForm() {
  $(document).ready(function () {
    $('#contentProductionPlan').load('modules/manufacturing/productionplanform.php');
  });
}

function loadManufacturingWorkstation() {
  $(document).ready(function () {
    $('#contentWorkstation').load('modules/manufacturing/workstation.php');
  });
}
function openManufacturingWorkstationForm() {
  $(document).ready(function () {
    $('#contentWorkstation').load('modules/manufacturing/workstationform.php');
  });
}

function loadManufacturingRouting() {
  $(document).ready(function () {
    $('#contentRouting').load('modules/manufacturing/routing.php');
  });
}
function openManufacturingRoutingForm() {
  $(document).ready(function () {
    $('#contentRouting').load('modules/manufacturing/routingform.php');
  });
}

function loadProjectsTimesheet() {
  $(document).ready(function () {
    $('#contentTimesheet').load('modules/manufacturing/timesheet.php');
  });
}
function openManufacturingTimesheetForm() {
  $(document).ready(function () {
    $('#contentTimesheet').load('modules/manufacturing/timesheetform.php');
  });
}


function loadManufacturingItemAttribute() {
  $(document).ready(function () {
    $('#contentItemAttribute').load('modules/manufacturing/itemattribute.php');
  });
}
function openManufacturingItemAttributeForm() {
  $(document).ready(function () {
    $('#contentItemAttribute').load('modules/manufacturing/itemattributeform.php');
  });
}

function loadManufacturingItemPrice() {
  $(document).ready(function () {
    $('#contentItemPrice').load('modules/manufacturing/itemprice.php');
  });
}
function openManufacturingItemPriceForm () {
  $(document).ready(function () {
    $('#contentItemPrice').load('modules/manufacturing/itempriceform.php');
  });
}

function loadBuyingRequestForQuotation() {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('modules/buying/requestforquotation.php');
  });
}
function openBuyingRequestForQuotationForm () {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('modules/buying/requestforquotationform.php?form_type=1');
  });
}
function viewBuyingRequestForQuotationForm () {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('modules/buying/requestforquotationform.php?form_type=2');
  });
}

function loadSupplier() {
  $(document).ready(function () {
    $('#contentSupplier').load('modules/buying/supplier.php');
  });
}

function openSupplierInfo() {
  $(document).ready(function () {
    $('#contentSupplier').load('modules/buying/supplierInfo.php');
  });
}

function openSaleInfo() {
  $(document).ready(function () {
    $('#contentSalesOrder').load('modules/selling/saleInfo.php');
  });
}

function loadSalesOrder() {
  $(document).ready(function () {
    $('#contentSalesOrder').load('modules/selling/salesorder.php');
  });
}
function openNewSaleOrder() {
  $(document).ready(function () {
    $('#contentSalesOrder').load('modules/selling/newsaleorder.php');
  });
}
function openSalesInvoiceItem(){
  $(document).ready(function () {
    $('#contentSalesInvoice').load('modules/selling/salesinvoiceitem.php');
  });
}

function loadSalesInvoice(){
  $(document).ready(function () {
    $('#contentSalesInvoice').load('modules/selling/salesinvoice.php');
  });
}

function loadPurchaseOrder(){
  $(document).ready(function () {
    $('#contentPurchaseOrder').load('modules/buying/purchaseorder.php');
  });
}

function openNewPurchaseOrder(){
  $(document).ready(function () {
    $('#contentPurchaseOrder').load('modules/buying/newpurchaseorder.php');
  });
}

function loadMaterialRequest(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('modules/buying/materialrequest.php');
  });
}

function openNewMaterialRequest(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('modules/buying/newMaterialRequest.php');
  });
}

function openMaterialRequestInfo(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('modules/buying/MaterialRequestInfo.php');
  });
}

function loadJobsched(){
  $(document).ready(function () {
    $('#contentJobScheduling').load('modules/manufacturing/jobschedulinginfo.php');
  });
}

function loadJobschedhome(){
  $(document).ready(function () {
    $('#contentJobScheduling').load('modules/manufacturing/jobscheduling.php');
  });
}

function loadUOM(){
  $(document).ready(function () {
    $('#contentUOM').load('modules/stock/UOM.php');
  });
}

function openUOMNew(){
  $(document).ready(function () {
    $('#contentUOM').load('modules/stock/UOMNEW.php');
  });
}

function openUOMEdit(){
  $(document).ready(function () {
    $('#contentUOM').load('modules/stock/UOMEDIT.php');
  });
}

function openNewStockEntry(){
  $(document).ready(function () {
    $('#contentStockEntry').load('modules/manufacturing/NewStockEntry.php');
  });
}

function loadStockEntry(){
  $(document).ready(function () {
    $('#contentStockEntry').load('modules/manufacturing/stockentry.php');
  });
}

function openNewTask(){
    $('#contentTask').load('modules/projects/taskitem.php');
}

function loadTask(){
    $('#contentTask').load('modules/projects/task.php');
}

function openNewPriceList(){
    $('#contentPriceList').load('modules/selling/pricelistitem.php');
}

function loadPriceList(){
    $('#contentPriceList').load('modules/selling/pricelist.php');
}

function openNewProjectTemplate(){
    $('#contentProjectTemplate').load('modules/projects/newprojecttemplate.php');
}

function loadProjectTemplate(){
  $('#contentProjectTemplate').load('modules/projects/projecttemplate.php');
}

function loadWarehouse(){
  $(document).ready(function () {
    $('#contentWarehouse').load('modules/stock/warehouse.php');
  });
}

function openWarehouseNew(){
  $(document).ready(function () {
    $('#contentWarehouse').load('modules/stock/warehouseSubModules/warehouseNEW.php');
  });
}

function openWarehouseEdit(){
  $(document).ready(function () {
    $('#contentWarehouse').load('modules/stock/warehouseSubModules/warehouseEDIT.php');
  });
}

function openItemVariantSettings() {
  $(document).ready(function () {
    $('#contentItemVariantSetting').load('modules/stock/itemvariantsettings.php')
  });
}

function loadPendingOrders(){
  $(document).ready(function () {
    $('#contentPendingOrders').load('modules/buying/pendingorders.php')
  });
}

function openPendingOrdersInfo(){
  $(document).ready(function () {
    $('#contentPendingOrders').load('modules/buying/pendingordersinfo.php')
  });
}

function openDeliveryInfo(){
  $(document).ready(function () {
    $('#contentDelivery').load('modules/productreleasing/deliveryinfo.php')
  });
}

function loadDelivery(){
  $(document).ready(function () {
    $('#contentDelivery').load('modules/productreleasing/delivery.php')
  });
}

function loadSupplierQuotationInfo(){
  $(document).ready(function () {
    $('#contentSupplierQuotation').load('modules/buying/supplierQuotation1.php')
  });
}

function loadSupplierQuotation(){
  $(document).ready(function () {
    $('#contentSupplierQuotation').load('modules/buying/supplierQuotation.php')
  });
}

function openNewSupplierQuotation(){
  $(document).ready(function () {
    $('#contentSupplierQuotation').load('modules/buying/new_supplier_quotation.php')
  });
}