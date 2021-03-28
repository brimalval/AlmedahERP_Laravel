function addRow2(){

    if($('#no-data')[0]){
    $('#no-data').remove();
    }
    let table = $('#items-input-rows');
    let lastRow = table[0].rows.length;
    table.append(
    `<tr>
    <td>
    <div class="form-check">
        <input type="checkbox" class="form-check-input">
    </div>
    </td>

    <td id="" class="mr-code-input">
    <input required value="" class="form-control"  type="text" name="item_code" id="item_code">
    </td>

    <td id="" class="mr-code-input">
      <select required="true" name="" class="form-control">
      <option value="UOM1">UOM1</option>
      <option value="UOM2">UOM2</option>
      <option value="UOM3">UOM3</option><option value="" ></option>
      </select>
    </td>

    <td style="width: 10%;"><input required value="" class="form-control"  type="number" min="0" name="quantity" id="quantity"></td>
    
    <td id="" class="mr-target-input">
      <input required value="" class="form-control"  type="date" name="required_date" id="required_date">
    </td>
    
    <td id="" class="mr-code-input">
      <select required="true" name="" class="form-control">
      <option value="Station1">Station1</option>
      <option value="Station2">Station2</option>
      <option value="Station3">Station3</option><option value="" ></option>
      </select>
    </td>

    <td>
    <a id="" class="btn btn-outline-danger delete-btn" href="#" role="button">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
    </td>
    </tr>`);
    $('#selects select[name="item_code[]"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`);
    $('#selects select[name="station_id[]"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`);
}
$(document).ready(function(){
    // Item row delete button functionality
    $('body').on('click', '.delete-btn2', function(e){
    e.preventDefault();
    $(this).parents('tr').remove();
    });
    // Making sure that none of the buttons inside the form submit it,
    // only the button outside of the form ("save" button) can submit
    $('#mat-req button').each(function(index){
    $(this).attr('type', 'button');
    });
    $('#mat-req').submit(function(){
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            console.log(data);
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
    return false;
    });
});