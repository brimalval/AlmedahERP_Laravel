function addnewRow(){
    if($('#contentPricingRule').find('#no-data')[0]){
      $('#contentPricingRule').find('#no-data').parents('tr').remove();
  }
      let lastRow = $('#pricing-tabletr:last');
      let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
      $('#pricing-table').append(
      `<tr data-id="${nextID}">
          
          <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="Shipping_Amount" class="form-control"></td>
          <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="Shipping_Amount" class="form-control"></td>
          <td> 
          <i class="fa fa-minus" aria-hidden="true" onclick="$(this).parents('tr').remove()"></i>
          </td>
      </tr>`);
  
  }

  function openField1() {
    var check = document.getElementById('Selling');
    if (check.checked) {
      document.getElementById('cont').style.display = 'block';
    } else
      document.getElementById('cont').style.display = 'none';
  }
  function openField2() {
    var check = document.getElementById('Buying');
    if (check.checked) {
      document.getElementById('cont').style.display = 'block';
    } else
      document.getElementById('cont').style.display = 'none';
  }

  function openField3() {
    var check = document.getElementById('Validate_Applied');
    if (check.checked) {
      document.getElementById('include2').style.display = 'block';
    } else
      document.getElementById('include2').style.display = 'none';
  }

  function openField4() {
    var check = document.getElementById('Apply_Multiple');
    if (check.checked) {
      document.getElementById('include1').style.display = 'block';
    } else
      document.getElementById('include1').style.display = 'none';
  }