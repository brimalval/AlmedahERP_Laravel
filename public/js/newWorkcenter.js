function showForm() {
    var table = document.getElementById("hm_select").value;
    if (table == 1) {
       document.getElementById("f1").style.display = 'block';
       document.getElementById("f2").style.display = 'none';
       
   } 
    if(table == 2){
       document.getElementById("f1").style.display = 'none';
       document.getElementById("f2").style.display = 'block';
       
    }
    if(table == 3){
       document.getElementById("f1").style.display = 'block';
       document.getElementById("f2").style.display = 'block';
       
    }
    if(table == 0){
       document.getElementById("f1").style.display = 'none';
       document.getElementById("f2").style.display = 'none';
       
    }
 }
 function addRownewEmployee(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#newemployee-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#newemployee-input-rows').append(
    `                <tr class="text-muted">
    <td class="text-center">Employee Name</td>
    <td class="text-center">Duration</td>
    <td></td>
  </tr>
</thead>
<tbody class="" id="newrouting-input-rows">
<tr data-id="${nextID}">
 <td id="mr-code-input" class="mr-code-input"><input type="text" value=""   name="Employee_name" id="Employee_name" class="form-control"></td>
 <td style="width: 10%;" class="mr-qty-input"><input type="text" value=""  name="duration" id="duration" class="form-control">
<td>
<a id="" class="btn delete-btn" href="#" role="button">
<i class="fa fa-trash" aria-hidden="true"></i>
</a>
</td>
</tr>`);
}
