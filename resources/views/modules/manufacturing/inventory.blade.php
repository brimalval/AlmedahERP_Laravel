<script src="{{ asset('js/inventory_backend.js') }}"></script>
<script>
    function clickView(images){
        if(typeof images == 'string')
            images = JSON.parse(images);
        $('#exampleImage').modal('show');
        $('.imageContainer').html('');
        for(i of images){
            $('.imageContainer').append(`<img id="image-view" src="storage/`+i+`" style="width:300px;height:300px;">`);
        }
        $('.viewImages').html($('.imagesContainer')[0]);
    }
    function resetForm(){
        $('#material-form')[0].reset();
        $('#img_tmp').attr('src', 'images/thumbnail.png');
        // Clearing out error messages
        $('#material-form .input-error').each(function(){
            this.innerHTML = '';
        });
        // Clearing out error input borders
        $('#material-form input').each(function(){
            this.classList.remove('border-danger');
        });
    }
    function errorThrown(errors){
        if(errors.total_amount){
            $('#create_total_amount').addClass('border-danger');
            $('#create-qty-error').html(errors.total_amount[0]);
        }if(errors.material_name){
            $('#create_material_name').addClass('border-danger');
            $('#create-name-error').html(errors.material_name[0]);
        }if(errors.unit_price){
            $('#create_unit_price').addClass('border-danger');
            $('#create-price-error').html(errors.unit_price[0]);
        }
    }
</script>
<div class="container rounded">
    <div class="row d-flex justify-content-center">

        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Inventory List</h4>
            <div id="alert-message">
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm"
                            onclick="$('#create-material-form').modal('show'); resetForm();"><i class="fas fa-plus"
                                aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>


            <table id="inventoryTable" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                    <tr>
                        {{-- <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td> --}}
                        <td>Item Code</td>
                        <td>Item Name</td>
                        <td>Category</td>
                        <td>Stock Qty.</td>
                        <td>RM Status</td>
                        <td>View</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($raw_materials as $row)
                    <tr id="row-{{ $row->id }}">
                        {{-- <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td> --}}
                            <td>{{ $row->item_code }}</td>
                            <td>{{ $row->item_name }}</td>
                            <td>{{ $row->category->category_title }}</td>
                            <td id="item-qty-{{ $row->id }}" class="text-black-50">{{ $row->stock_quantity }}</td>
                            <td class="text-black-50">{{ $row->rm_status }}</td>

                            <td class="text-black-50 text-center"><a href='#' onclick="clickView(JSON.stringify({{ $row->item_image }}))" class="row-img-view-btn" id="clickViewTagInv{{ $row->id }}">View</a></td>

                            <td class="">
                                <!--<ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <button data-id="{{ $row->id }}" data-toggle="modal"
                                            data-target="#update-item-form"
                                            class="edit-btn btn btn-success btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit"><i class="fa fa-edit"></i></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button data-id="{{ $row->id }}"
                                            class="delete-btn btn btn-danger btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                </ul> -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">

                                        <li><button data-id="{{ $row->id }}" data-toggle="modal"
                                            data-target="#update-item-form"
                                            class="edit-btn btn btn-warning btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit"><i class="fa fa-edit"></i> Edit</button>
                                        </li>
                                        
                                        <li><button data-id="{{ $row->id }}"
                                            class="delete-btn btn btn-danger btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"><i class="fa fa-trash"></i> Delete</button>
                                        </li>
                                        
                                        <li>
                                            <button id='add-stock-btn-{{ $row->id }}' data-id="{{ $row->id }}" type="button" class="add-stock-btn btn btn-success btn-sm rounded-0">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Add Stock
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <script>
                $(document).ready(function() {
                    // Added an if statement here in case it becomes necessary to turn
                    // the datatable into a component and selectively render it based on
                    // whether there are entries or not
                    if ($('#inventoryTable').length) {
                        $('#inventoryTable').dataTable({
                            columnDefs: [{
                                orderable: false,
                                targets: 0
                            }],
                            order: [
                                [1, 'asc']
                            ]
                        });
                    }
                });

            </script>
        </div>
    </div>
</div>
<!-- IMAGE PART MODAL -->
<div class="modal fade" id="exampleImage" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sample Picture</h4>
                <button type="button" class="close" onclick="$('#exampleImage').modal('hide')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="viewImages modal-body m-0 p-0">
                <div class="imageContainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#exampleImage').modal('hide')">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Material Modal-->
<div class="modal fade" id="update-material-form-modal" tabindex="-1" aria-labelledby="updateModalForm"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-inline">Edit Material</h5>
                <button type="button" class="close" onclick="$('#update-material-form-modal').modal('hide')"
                    aria-label="close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="update-material-form" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Code</label>
                                <input class="form-control" type="text" id="material_code" name="material_code"
                                    placeholder="Ex. MT181204" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Name</label>
                                <input class="form-control" type="text" id="material_name" name="material_name"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Material Categories</label>
                                <select class="form-control" id="material_category" name="material_category"
                                    onchange="openCategory(value)" required>
                                    <option value="" selected disabled hidden>
                                        Select an Option
                                    </option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row['id'] }}" name="category">
                                            {{ $row['category_title'] }}</option>
                                    @endforeach
                                    <option id="newCategoryButton">
                                        + Add new Category
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group p-2">
                        <label for="">Image</label>
                        <img id="img_tmp_edit" src="../images/thumbnail.png" style="width:100%;">
                        <input class="form-control" type="file" name="material_image[]" onchange="readURL2(this);" multiple>
                    </div>

                    <script>
                        function readURL2(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#img_tmp_edit')
                                        .attr('src', e.target.result);
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label for="">Unit Price</label>
                        <input class="form-control" type="text" id="unit_price" name="unit_price" required
                            placeholder="Ex. 100">
                    </div>


                    <div class="form-group">
                        <label for="">Total Quantity</label>
                        <input class="form-control" type="text" id="total_amount" name="total_amount" required
                            placeholder="Ex. 500">
                    </div>


                    <div class="form-group">
                        <label for="">RM Status</label>
                        <select class="form-control" id="rm_status" name="rm_status" required>
                            <option value="" selected disabled hidden>
                                Select an Option
                            </option>
                            <option value="To Purchase">To Purchase</option>
                            <option value="Available">Available</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#update-material-form-modal').modal('hide')">Close</button>
                        <button id="update-material-form-modal-btn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Material Modal -->
<div class="modal fade" id="create-material-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Material</h5>
                <button type="button" class="close" onclick="$('#create-material-form').modal('hide')"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="material-form" method="post" enctype="multipart/form-data" action="/create-material">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Code</label>
                                <input class="form-control" id="create_material_code" type="text" name="material_code" placeholder="Ex. MT181204"
                                    required>
                                <span id="create-code-error" class="input-error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Name</label>
                                <input class="form-control" id="create_material_name" type="text" name="material_name" required>
                                <span id="create-name-error" class="input-error text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Material Categories</label>
                                <select class="form-control" id="material_category1" name="material_category" onchange="openCategory(value)"
                                    required>
                                    <option value="" selected disabled hidden>
                                        Select an Option
                                    </option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row['id'] }}" name="category">
                                            {{ $row['category_title'] }}</option>
                                    @endforeach
                                    <option id="newCategoryButton">
                                       + Add new Category
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group p-2">
                        <label for="">Image</label>
                        <img id="img_tmp" src="../images/thumbnail.png" style="width:100%;">
                        <input class="form-control" type="file" name="material_image" onchange="readURL3(this);"
                            required>
                    </div> --}}

                    <div class="form-group pb-2 m-0">
                        <label for="">Image</label>
                        <img id="img_tmp" src="../images/thumbnail.png" style="width:100%;">
                        <input class="form-control" type="file" name="material_image[]" onchange="readURL3(this);" required multiple>
                    </div>

                    <script>
                        function readURL3(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#img_tmp')
                                        .attr('src', e.target.result)
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                    </script>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="">Quantity</label>
                            <input class="form-control" type="number" id="create_total_amount" name="rm_quantity" required placeholder="Ex. 500">
                            <span id="create-qty-error" class="input-error text-danger"></span>
                        </div>

                        <div class="form-group col-6">
                        <label for="">Unit of Measurement</label>
                        <select class="form-control selectpicker" data-live-search="true" name="uom_id" id="uom_id">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->uom_id }}" data-subtext="({{ $unit->conversion_factor }} nos.)" data-cf="{{ $unit->conversion_factor }}">{{ $unit->item_uom }}</option>   
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-6">
                          <label for="">Conversion Factor</label>
                          <input type="text" value="0" readonly id="conversion_factor" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-6">
                          <label for="">Stock Quantity</label>
                          <input type="text" value="0" readonly id="stock_quantity" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">RM Status</label>
                        <select class="form-control" name="rm_status" required>
                            <option value="" selected disabled hidden>
                                Select an Option
                            </option>
                            <option value="To Purchase">To Purchase</option>
                            <option value="Available">Available</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#create-material-form').modal('hide')">Close</button>
                        <button id="material-form-btn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="add-Category-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                <button type="button" class="close" onclick="closeCategory()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-form" method="post" enctype="multipart/form-data" action="/create-categories"
                    onsubmit="return false">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Category Code</label>
                                <input class="form-control" type="text" name="category_title"
                                    placeholder="Ex. Stone, Gold" required>
                                @error('category_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Category Description</label>
                                <textarea class="form-control" type="text" name="category_description" required
                                    placeholder="Ex. Gold Category"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button onclick="closeCategory()" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button id="category-form-btn" class="btn btn-primary" data-dismiss="modal">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Stock Modal -->
<div class="modal fade" id="add-stock-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="add-stock-form" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Stock</h5>
                        <button type="button" class="close" onclick="$('#add-stock-modal').modal('hide');" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="add-stock-qty"></label>
                      <input type="number" min="0" name="add_stock_qty" id="add_stock_qty" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#add-stock-modal').modal('hide');">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End of add stock modal -->

<script>
    $('#create-material-form').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#update-material-form-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#add-Category-form').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>
<script>
    $(document).ready(function(e) {
        // Since we're dynamically loading more .edit-btn elements
        // we need to bind the function to body clicks instead of .edit-btn clicks
        // since functions bound to .edit-btn will only be bound to the elements
        // that loaded first

        //When clicking edit button
        $('body').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var element = this;
            var id = element.dataset.id;
            // Adding the ID to a variable accessible to the ajax call
            sessionStorage.setItem('material-edit-id', id);
            var form = $('#update-material-form');
            var modal = $('#update-material-form-modal');
            form.attr('action', '/update-material/' + id);

            // Finding the element being edited and returning the details
            $.get('/inventory/' + sessionStorage.getItem('material-edit-id'), function(data, status) {
                let images = JSON.parse(data.item_image);
                $('#material_name').val(data.item_name);
                $('#material_code').val(data.item_code);
                $('#material_category').val(data.category_id);
                $('#img_tmp_edit').attr('src', 'storage/' + images[0]);
                sessionStorage.setItem('old_image', 'storage/' + images[0]);
                $('#rm_status').val(data.rm_status);
                $('#unit_price').val(data.unit_price);
                $('#total_amount').val(data.total_amount);
            });

            modal.modal('show');
        });
        // When clicking delete button
        $('body').on('click', '.delete-btn', function(e) {
            var id = this.dataset.id;
            var row = $(this).parents('tr');
            if (confirm("Are you sure?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'delete-material/' + id,
                    data: null,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == "success") {
                            $(document).ready(function() {
                                sessionStorage.setItem("status", "success");
                                // Removing a row from the data table
                                var table = $('#inventoryTable');
                                table.DataTable()
                                    .row(row)
                                    .remove()
                                    .draw();
                            });
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/inventory');
                        });
                    }
                });
            }
            return false;
        });

        // When clicking an add stock button
        $('body').on('click', '.add-stock-btn', function(e){
            e.preventDefault();
            let id = this.dataset.id;
            $('#add-stock-modal').modal('show');
            $('#add-stock-form').attr('action', `/add-stock/${id}`);
        });

        // Add stock form function
        $('#add-stock-form').submit(function(){
            console.log(`Trying to submit to ${this.action}`);
            let url = this.action;
            let fd = new FormData(this);
            $.ajax({
                type: 'POST',
                data: fd,
                url: url,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data){
                    $('#add-stock-modal').modal('hide');
                    $(`#item-qty-${data.id}`).html(data.new_amount);
                },
                error: function(data){
                    alert(`Error: ${data.message}`);
                },
            })
            this.action = '';
            return false;
        });

        // Update form function
        // When the form is submitted (save button is pressed and all the required fields are filled in)
        // it deletes the row of the element being edited and adds a row with the updated values
        $('#update-material-form').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $('#update-material-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log("success");
                    if (data.status == "success") {
                        // If a new image was set, use it as the value. Otherwise, use the old image
                        var image = (data.image) ? data.image : sessionStorage.getItem(
                            'old_image');
                        sessionStorage.removeItem('old_image');
                        // Hide the modal create form
                        $('#update-material-form-modal').modal('hide');
                        // Reset the preview image
                        $('#img_tmp_edit').attr('src', '../images/thumbnail.png');
                        // Reset the form fields
                        $('#update-material-form')[0].reset();
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            // Removing the old row
                            $('#inventoryTable').DataTable()
                                .row($('#row-' + sessionStorage.getItem(
                                    'material-edit-id')))
                                .remove()
                                .draw();
                            // Adding the updated row
                            $('#inventoryTable').DataTable()
                                .row
                                .add([
                                    formData.get('material_code'),
                                    formData.get('material_name'),
                                    data.category_title,
                                    '<span class="text-black-50">' + formData
                                    .get('total_amount') + '</span>',
                                    '<span class="text-black-50">' + formData
                                    .get('rm_status') + '</span>',
                                    `<span class='text-black-50 text-center w-100' style='display: inline-block'> 
                                    <a href='#' onclick='clickView(${JSON.stringify(data.material.item_image)})' id='clickViewTagInv${data.material.id}'>View</a> 
                                    </span>`,
                                `<div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">

                                        <li><button data-id="${data.id}" data-toggle="modal"
                                            data-target="#update-item-form"
                                            class="edit-btn btn btn-warning btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit"><i class="fa fa-edit"></i> Edit</button>
                                        </li>
                                        
                                        <li><button data-id="${data.id}"
                                            class="delete-btn btn btn-danger btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"><i class="fa fa-trash"></i> Delete</button>
                                        </li>
                                        
                                        <li>
                                            <button id='add-stock-btn-${data.id}' data-id="${data.id}" type="button" class="add-stock-btn btn btn-success btn-sm rounded-0">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Add Stock
                                            </button>
                                        </li>
                                    </ul>
                                </div>`
                                ])
                                .node()
                                .id = 'row-' + data.id;
                            $('#inventoryTable').DataTable().draw();
                            console.log('this is the data.image '+data.image);
                            var id = data.id;
                            $('#clickViewTagInv').attr('id', "clickViewTagInv"+id);
                            images = [];
                            for(i of data.image){
                                images.push(i);
                            }
                            $('#clickViewTagInv'+id).attr('onclick', 'clickView('+JSON.stringify(images)+')');

                            if($('#materials-picker').length){
                                updatedMaterial(data.id, 
                                    formData.get('total_amount'),
                                    formData.get('material_name')
                                    );
                            }
                        });
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    // If validation failed, show the message and make the
                    // input have a red border
                    errorThrown(errors);
                }
            });
            return false;
        })

        $('#material-form').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData(this);
            //Gets material category id idk why its not getting inside the form data
            $.ajax({
                type: 'POST',
                url: $('#material-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                // "Data" is a JSON that contains the status of the save, the ID of the new record
                // and the path of the uploaded image
                success: function(data) {
                    //console.log("success");
                    if (data.status == "success") {
                        if(data.message){
                            alert(data.message);
                        }
                        if(data.already_exists){
                            $(`#item-qty-${data.id}`).html(data.new_amount);
                            $('#create-material-form').modal('hide');
                            return;
                        }
                        // Hide the modal create form
                        $('#create-material-form').modal('hide');
                        // Reset the form fields
                        $('#material-form')[0].reset();
                        // Remove the preview image
                        $('#image-view').attr('src', 'images/thumbnail.png');
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            // TODO: Dynamically adding data to the DataTable; consider transforming the entire TR data into a
                            // component instead to prevent having to write HTML here in the future

                            // NOTE: This is exactly the same as the markup for the <tr> tags above in string form.
                            // Due to not being able to import templates in JavaScript, this is currently the best solution
                            $('#inventoryTable').DataTable()
                                .row
                                .add([
                                    formData.get('material_code'),
                                    formData.get('material_name'),
                                    data.category_title,
                                    '<span class="text-black-50">' + formData
                                    .get('stock_quantity') + '</span>',
                                    '<span class="text-black-50">' + formData
                                    .get('rm_status') + '</span>',
                                    `<span class='text-black-50 text-center w-100' style='display: inline-block'> 
                                        <a href='#' onclick='clickView(${JSON.stringify(data.material.item_image)})' id='clickViewTagInv${data.material.id}'>View</a>" 
                                    </span>`,
                                `<div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">

                                        <li><button data-id="${data.id}" data-toggle="modal"
                                            data-target="#update-item-form"
                                            class="edit-btn btn btn-warning btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit"><i class="fa fa-edit"></i> Edit</button>
                                        </li>
                                        
                                        <li><button data-id="${data.id}"
                                            class="delete-btn btn btn-danger btn-sm rounded-0" type="button"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"><i class="fa fa-trash"></i> Delete</button>
                                        </li>
                                        
                                        <li>
                                            <button id='add-stock-btn-${data.id}' data-id="${data.id}" type="button" class="add-stock-btn btn btn-success btn-sm rounded-0">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Add Stock
                                            </button>
                                        </li>
                                    </ul>
                                </div>`
                                ])
                                .node()
                                .id = 'row-' + data.id;

                            $('#inventoryTable').DataTable().draw();

                            var id = data.id;
                            $('#clickViewTagInv').attr('id', "clickViewTagInv"+id);
                            images = [];
                            for(i of data.image){
                                images.push(i);
                            }
                            console.log('result of for loop '+images);
                            $('#clickViewTagInv'+id).attr('onclick', 'clickView('+JSON.stringify(images)+')');

                            // If the materials picker exists, append the new option
                            // Note: must find a better way to let item.blade.php know that
                            //       a new item has been added to prevent having mark-ups mixed
                            //       together
                            if($('#materials-picker').length){
                                $('#materials').append(
                                    "<option value=\""+data.id+"\">"+formData.get('material_name')+"</option>"
                                );
                                $('#materials').selectpicker('refresh');
                                $('#materials-picker').append(
                                    "<input id='raw_"+data.id+"' type='text' value='"+formData.get('total_amount')+"' hidden>"
                                );
                            }
                        });
                    }else{
                        console.log('error');
                        console.log(data);
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    // If validation failed, show the message and make the
                    // input have a red border
                    errorThrown(errors);
                }
            });
        });

        //Add Categories AJAX
        $('#category-form').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $('#category-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                // "Data" is a JSON that contains the status of the save, the ID of the new record
                // and the path of the uploaded image
                success: function(data) {
                    // Hide the modal create form
                    $('#add-Category-form').modal('hide');
                    
                    // Add it to the categories

                    $('#material_category').prepend($('<option>', {
                        value: data.id,
                        text: data.category_title
                    }));

                    $('#material_category1').prepend($('<option>', {
                        value: data.id,
                        text: data.category_title
                    }));

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        });

        // /*Update Record AJAX*/
        // $('#update-product-form-btn').on('click', (function(e) {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     e.preventDefault();
        //     var formData = new FormData($('#edit-product-form')[0]);
        //     $.ajax({
        //         type: 'POST',
        //         url: $('#edit-product-form').attr('action'),
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(data) {
        //             if (data.status == "success") {
        //                 $(document).ready(function() {
        //                     sessionStorage.setItem("status", "success");
        //                     $('#divMain').load('/item');
        //                 });
        //             } else {
        //                 $(document).ready(function() {
        //                     sessionStorage.setItem("status", "error");
        //                     $('#divMain').load('/item');
        //                 });
        //             }

        //         },
        //         error: function(data) {
        //             console.log("error");
        //             console.log(data);
        //             $(document).ready(function() {
        //                 sessionStorage.setItem("status", "error");
        //                 $('#divMain').load('/item');
        //             });
        //         }
        //     });
        // }));
        /*Delete Product*/
    });

    $(document).ready(function() {
        var status = sessionStorage.getItem("status");
        if (status == "success") {
            $('#alert-message').html(`
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Success!
            </div>            
            `);
        } else if (status == "error") {
            $('#alert-message').html(`
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Error!
            </div>            
            `);
        }
        sessionStorage.removeItem("status");
    });

</script>

<script>
    function openCategory(value) {
        if (value == "+ Add new Category") {
            $('#create-material-form').modal('hide');
            $('#add-Category-form').modal('show');
        }
    }

    function closeCategory() {
        $('#add-Category-form').modal('hide');
    }

</script>
