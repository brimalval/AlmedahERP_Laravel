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
        <td id="mr-code-input-${lastRow}" class="mr-code-input"></td>
        <td style="width: 10%;"><input required class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-${lastRow}"></td>
        <td id="mr-target-input-${lastRow}" class="mr-target-input"></td>
        <td style="width: 20%">
        <select name="procurement_method[]" required class="form-control">
            <option value="buy">Buy</option>
            <option value="produce">Produce</option>
            <option value="buyproduce">Buy & Produce</option>
        </select>
        </td>
        <td>
        <a id="" class="btn btn-primary delete-btn" href="#" role="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        </td>
    </tr>`);
    $('#selects select[name="item_code[]"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`);
    $('#selects select[name="station_id[]"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`);
}
// Delete form submission
$(document).on('submit', 'form.mr-delete-form', function(){
    let row = $(this).parents('tr');
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            console.log(data);
            row.remove();
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
    return false;
});
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
            if(data.status == 'success'){ 
                // If the form's objective is to update, update the row
                if(data.update){
                    let row = $(`#mr-row-${data.materialrequest.id}`);
                    row.children('td.mr-req-date').text(data.materialrequest.required_date);
                    row.children('td.mr-purpose').text(data.materialrequest.purpose);
                    $('#editModal').modal('hide');
                    $('#mat-req').remove();
                }
                // Otherwise, go back
                else{
                    loadMaterialRequest();
                }
             } else{
                 alert('Error! Please ensure that all fields are filled in and valid!');
             }
        },
        error: function(data){
            // REMEMBER TO REPLACE THIS WITH BETTER ERROR INDICATION
            alert(`Error! Make sure all fields are filled in and have valid data!`);
            console.log("error");
            console.log(data);
        }
    });
    return false;
    });
});

// Clicking the edit button for each of the rows invokes this function
function loadEdit(url){
    $('#modal-form').html('<i class="fa fa-spinner fa-5x text-center p-5" aria-hidden="true"></i>');
    $('#modal-form').load(url);
}