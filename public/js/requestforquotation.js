function addRow(){

    if($('#no-data')[0]){
    $('#no-data').remove();
    }
    let table = $('#material-request-input-rows');
    let lastRow = table[0].rows.length;
    table.append(
    `<tr>
        <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="" class="mr-code-input">
                            <select required="true" name="" class="form-control">
                            <option value="buy">Supplier1</option>
                            <option value="produce">Supplier2</option>
                            <option value="buyproduce">Supplier3</option><option value="" ></option>
                            </select>
                          </td>
        <td style="width: 30%;"><input required class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-${lastRow}"></td>
        <td id="" class="mr-target-input">
                            <input required value="" class="form-control"  type="text" name="email_id" id="email_id">
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
    $('body').on('click', '.delete-btn', function(e){
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