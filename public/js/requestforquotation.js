
function loadBuyingRequestForQuotation() {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('/rfquotation');
  });
}
function openBuyingRequestForQuotationForm() {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('/new-quotation');
  });
}
function viewBuyingRequestForQuotationForm() {
  $(document).ready(function () {
    $('#contentRequestforQuotation').load('/view-quotation');
  });
}

function loadIntoQuotationPage(url){
  $('#contentRequestforQuotation').load(url);
}

$(document).on('submit', '#req-forquotation-form', function(){
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
          console.log(data);
          $('#contentRequestforQuotation').load(data.redirect);
        },
        error: function(data){
          alert("Error! Make sure that all the fields are filled in");
        }
    });
    return false;
});

function addRFQ(){
  $('#req-forquotation-form').submit();
}

function addSupplier(){
  $('#no-suppliers').remove();
  let nextID = $('#rfq-suppliers-tbl tr:last').data('id') + 1 ?? 0;
  $('#suppliers-input-rows').append(`
    <tr data-id="${nextID}">
      <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input">
        </div>
      </td>
      <td class="rfq-supplier"></td>
      <td class="rfq-contact">
        <div class="form-group">
          <input type="text" class="form-control" id="" aria-describedby="helpId" placeholder="ex. John Doe">
        </div>
      </td>
      <td class="rfq-email">
        <div class="form-group">
          <input required type="text" class="form-control" readonly id="" aria-describedby="helpId" placeholder="example@gmail.com">
        </div>
      </td>
      <td>
        <button type="button" id="" class="btn delete-btn" role="button" onclick="$(this).parents('tr').remove()">
          <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
      </td>
    </tr>
  `);
  $('#selects select[data-id="supplier_id"]').clone().appendTo(`#rfq-suppliers-tbl tr:last .rfq-supplier`).selectpicker();
  $('#rfq-suppliers-tbl tr:last .rfq-email input').val($('#rfq-suppliers-tbl tr:last .rfq-supplier :selected').data('email'));
}

function rfqAddItem(){
    if($('#rfq-items-tbl #no-data')[0]){
        $('#rfq-items-tbl #no-data').remove();
    }
    let lastRow = $('#rfq-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#rfq-input-rows').append(
    `
    <tr data-id="${nextID}">
        <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"></td>
        <td style="width: 10%;" class="mr-qty-input"><input required class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-${lastRow}"></td>
        <td class="mr-unit-input"></td>
        <td id="mr-target-input-${nextID}" class="mr-target-input"></td>
        <td style="width: 20%" class="mr-procurement-input">
        <select name="procurement_method[]" required class="form-control selectpicker">
            <option value="buy">Buy</option>
            <option value="produce">Produce</option>
            <option value="buyproduce">Buy & Produce</option>
        </select>
        </td>
        <td>
            <button type="button" id="" class="btn item-edit-btn" role="button" onclick="openItemEditModal($(this).parents('tr'))">
                <i class="fa fa-caret-up" aria-hidden="true"></i>
            </button>
            <button type="button" id="" class="btn delete-btn" href="#" role="button" onclick="$(this).parents('tr').remove()">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
    `);
    $('#selects select[data-id="item_code"]').eq(0).clone().appendTo(`#rfq-items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').eq(0).clone().appendTo(`#rfq-items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').eq(0).clone().appendTo(`#rfq-items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#rfq-items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
    $('#contentRequestforQuotation').find('#no-data').remove();
}

function fillSupplierRow(select){
  let row = select.parents('tr');
  let email = select.find(':selected').data('email');
  console.log(email);
  row.find('.rfq-email input').val(email);
}

// Element argument is the HTML element that calls the function
function saveRequestLink(element){
  let parentPane = $(element).parents('.tab-pane');
  let selected = $(element).parents('.modal').find('#request-id-link-select').find(':selected');
  let tbody = parentPane.find('.mr-link-input-rows');
  tbody.html('');
  // If "None" was selected just clear the table for material request items and move on
  if(selected.val() == 'none'){
    return;
  }
  let items = JSON.parse(JSON.stringify(selected.data('items')));
  $('#rfq-request-id').val(selected.val());
  items.forEach(function(val, idx, array){
    var procurementMethodTitle;
    // Turn the procurement method into a title case string
    // like this -> Like This
    procurementMethodTitle = val.procurement_method.toLowerCase().replace(/\b[a-z]/g, function(c){
      return c.toUpperCase();
    });
    tbody.append(`
    <tr>
          <td>
          <div class="form-check">
              <input type="checkbox" class="form-check-input">
          </div>
          </td>
          <td id="mr-code-input-" class="mr-code-input">
            <select class="selectpicker" name="item_code[]">
            </select>
          </td>
          <td style="width: 10%;" class="mr-qty-input"><input required readonly class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-" value="${val.quantity_requested}"></td>
          <td class="mr-unit-input">
            <select class="selectpicker" name="uom_id[]">
            </select>
          </td>
          <td id="mr-target-input-" class="mr-target-input">
            <select class="selectpicker" name="station_id[]">
            </select>
          </td>
          <td class="mr-procurement-input">
            <select class="selectpicker" name="procurement_method[]">
              <option value="${val.procurement_method}">${procurementMethodTitle}</option>
            </select>
          </td>
          <td>
          </td>
      </tr>
    `)
    let itemCodeSelector = tbody.find('tr:last .mr-code-input select')[0]
    let targetSelector = tbody.find('tr:last .mr-target-input select')[0]
    let uomSelector = tbody.find('tr:last .mr-unit-input select')[0]
    $(`#selects select[data-id="item_code"] option[value="${val.item_code}"]`).eq(0).clone().appendTo(itemCodeSelector);
    $(`#selects select[data-id="station_id"] option[value="${val.station_id}"]`).eq(0).clone().appendTo(targetSelector);
    $(`#selects select[data-id="uom_id"] option[value="${val.uom_id}"]`).eq(0).clone().appendTo(uomSelector);
    tbody.find('tr:last select[name="procurement_method[]"]').selectpicker();
    $(itemCodeSelector).selectpicker();
    $(targetSelector).selectpicker();
    $(uomSelector).selectpicker();
  });
  $('#rfq-items-tbl #no-data').remove();
  $(element).parents('.modal').modal('hide');
}

function closeRequestLink(element){
  let parentPane = $(element).parents('.tab-pane');
  parentPane.find('#request-id-link-select').val('none').selectpicker('refresh'); 
  $(element).parents('.modal').modal('hide');
}

// When pressing the submit button on the editing form, trigger this
function submitRFQ(form){
    $.ajax({
        type: 'POST',
        url: form.action,
        data: new FormData(form),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
          loadBuyingRequestForQuotation();
        },
        error: function(data){
          alert("Error! Make sure that all the fields are filled in");
        }
    });
    return false;
}