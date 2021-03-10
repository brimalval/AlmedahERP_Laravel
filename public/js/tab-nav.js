//--> start of Dashboard js <--//
if ($("#divMain").children().length == 0) {
  $(document).ready(function () {
    $('#divMain').load('modules.dashboard');
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
    $('#contentBOM').load('/newBOM');
  });
}

function subloadNewBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('/subNewBOM');
  });
}

function loadBOM() {
  $(document).ready(function () {
    $('#contentBOM').load('/loadBOM');
  });
}

function openNewWorkorder(){
  $(document).ready(function () {
    $('#contentWorkOrder').load('/openNewWorkorder');
  });
}

function openBlueprint() {
  $(document).ready(function () {
    $('#contentBOM').load('/openBlueprint');
  });
}
function openInventoryInfo() {
  $(document).ready(function () {
    $('#contentInventory').load('/openInventoryInfo');
  });
}

function loadInv() {
    $(document).ready(function () {
    $('#contentInventory').load('/loadInv');
  });
}

function loadWorkOrder() {
  $(document).ready(function () {
    $('#contentWorkOrder').load('/loadWorkOrder');
  });
}

function loadWorkOrderInfo() {
  $(document).ready(function () {
    $('#contentWorkOrder').load('/loadWorkOrderInfo');
  });
}

function loadReportsBuilder() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('/loadReportsBuilder');
  });
}
function loadReportsBuilderShowReport() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('/loadReportsBuilderShowReport');
  });
}

function openReportsBuilderForm() {
  $(document).ready(function () {
    $('#contentReportsBuilder').load('/openReportsBuilderForm');
  });
}

function loadManufacturingProductionPlan() {
  $(document).ready(function () {
    $('#contentProductionPlan').load('/loadManufacturingProductionPlan');
  });
}

function openManufacturingProductionPlanForm() {
  $(document).ready(function () {
    $('#contentProductionPlan').load('/openManufacturingProductionPlanForm');
  });
}

function loadManufacturingWorkstation() {
  $(document).ready(function () {
    $('#contentWorkstation').load('/loadManufacturingWorkstation');
  });
}
function openManufacturingWorkstationForm() {
  $(document).ready(function () {
    $('#contentWorkstation').load('/openManufacturingWorkstationForm');
  });
}

function loadManufacturingRouting() {
  $(document).ready(function () {
    $('#contentRouting').load('/loadManufacturingRouting');
  });
}
function openManufacturingRoutingForm() {
  $(document).ready(function () {
    $('#contentRouting').load('/openManufacturingRoutingForm');
  });
}

function loadProjectsTimesheet() {
  $(document).ready(function () {
    $('#contentTimesheet').load('/loadProjectsTimesheet');
  });
}
function openManufacturingTimesheetForm() {
  $(document).ready(function () {
    $('#contentTimesheet').load('/openManufacturingTimesheetForm');
  });
}


function loadManufacturingItemAttribute() {
  $(document).ready(function () {
    $('#contentItemAttribute').load('/loadManufacturingItemAttribute');
  });
}
function openManufacturingItemAttributeForm() {
  $(document).ready(function () {
    $('#contentItemAttribute').load('/openManufacturingItemAttributeForm');
  });
}

function loadManufacturingItemPrice() {
  $(document).ready(function () {
    $('#contentItemPrice').load('/loadManufacturingItemPrice');
  });
}
function openManufacturingItemPriceForm () {
  $(document).ready(function () {
    $('#contentItemPrice').load('/openManufacturingItemPriceForm');
  });
}

function loadSupplier() {
  $(document).ready(function () {
    $('#contentSupplier').load('/loadSupplier');
  });
}

function openSupplierInfo() {
  $(document).ready(function () {
    $('#contentSupplier').load('/openSupplierInfo');
  });
}

function openSaleInfo() {
  $(document).ready(function () {
    $('#contentSalesOrder').load('/openSaleInfo');
  });
}

function loadSalesOrder() {
  $(document).ready(function () {
    $('#contentSalesOrder').load('/loadSalesOrder');
  });
}
function openNewSaleOrder(x) {
  $(document).ready(function () {
    $('#contentSalesOrder').load('/openNewSaleOrder');
  });
}

function loadPurchaseOrder(){
  $(document).ready(function () {
    $('#contentPurchaseOrder').load('/loadPurchaseOrder');
  });
}

function openNewPurchaseOrder(){
  $(document).ready(function () {
    $('#contentPurchaseOrder').load('/openNewPurchaseOrder');
  });
}

function loadMaterialRequest(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('/loadMaterialRequest');
  });
}

function openNewMaterialRequest(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('/openNewMaterialRequest');
  });
}

function openMaterialRequestInfo(){
  $(document).ready(function () {
    $('#contentMaterialRequest').load('/openMaterialRequestInfo');
  });
}

function loadJobsched(){
  $(document).ready(function () {
    $('#contentJobScheduling').load('/loadJobsched');
  });
}

function loadJobschedhome(){
  $(document).ready(function () {
    $('#contentJobScheduling').load('/loadJobschedhome');
  });
}

function loadUOM(){
  $(document).ready(function () {
    $('#contentUOM').load('/loadUOM');
  });
}

function openUOMNew(){
  $(document).ready(function () {
    $('#contentUOM').load('/openUOMNew');
  });
}

function openUOMEdit(){
  $(document).ready(function () {
    $('#contentUOM').load('/openUOMEdit');
  });
}

function openNewStockEntry(){
  $(document).ready(function () {
    $('#contentStockEntry').load('/openNewStockEntry');
  });
}

function loadStockEntry(){
  $(document).ready(function () {
    $('#contentStockEntry').load('/loadStockEntry');
  });
}

function openNewTask(){
    $('#contentTask').load('/openNewTask');
}

function loadTask(){
    $('#contentTask').load('/loadTask');
}

function openNewPriceList(){
    $('#contentPriceList').load('/openNewPriceList');
}

function loadPriceList(){
    $('#contentPriceList').load('/loadPriceList');
}

function openNewProjectTemplate(){
    $('#contentProjectTemplate').load('/openNewProjectTemplate');
}

function loadProjectTemplate(){
  $('#contentProjectTemplate').load('/loadProjectTemplate');
}

function loadWarehouse(){
  $(document).ready(function () {
    $('#contentWarehouse').load('/loadWarehouse');
  });
}

function openWarehouseNew(){
  $(document).ready(function () {
    $('#contentWarehouse').load('/openWarehouseNew');
  });
}

function openWarehouseEdit(){
  $(document).ready(function () {
    $('#contentWarehouse').load('/openWarehouseEdit');
  });
}

function openItemVariantSettings() {
  $(document).ready(function () {
    $('#contentItemVariantSetting').load('/openItemVariantSettings')
  });
}