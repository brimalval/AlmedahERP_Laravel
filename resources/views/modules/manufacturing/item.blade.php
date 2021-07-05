<script>
    
    function clickView(images){
        images = JSON.parse(images);
        $('#exampleImage').modal('show');
        $('.imageContainer').html('');
        for(i of images){
            $('.imageContainer').append(`<img id="image-view" src="storage/`+i+`" style="width:300px;height:300px;">`);
        }
    }
    // Function for adding attributes
    // Invoked by selecting a material in the selectpicker or when
    // inheriting attributes from a template
    function addAttribute(name, value=null, update=null){
        console.log(name);
        if (attributeList.indexOf(name) !== -1) {
            alert("Value exists!");
        } else {
            if(value == null && $('#product_status').val() != "Variant"){
                $('#attributes_div').append('<span class="badge badge-success m-1 p-1 attb-badge-'+name+'">' + name + '<i class="far fa-times-circle py-1 pl-1"></i><input type="hidden" name="attribute_array[]" value="' + name + '"></span>');
                $('.attb-badge-'+name+' .far').click(function(){
                    $('.attb-badge-'+name).remove();
                    let index = attributeList.indexOf(name);
                    attributeList.splice(index, 1);
                    console.log(attributeList);
                    if(update){
                        deleteAttribute(name);
                    }
                    
                });
                // $('.attb-badge').click(function(){
                // });
                // $('.attb-badge').click(function(){
                //     $(this).remove();
                //     attributeList.
                //     console.log($(this).text());
                // });
            }
            else{
                $('#attributes_div').append(`
                <div class="form-group">
                    <label>${name}</label>
                    <input name="attribute_array[]" value="${name}" class="form-control" type="text" hidden>
                    <input name="attribute_value_array[]" class="form-control" type="text" value="${(value) ? value : ''}">
                </div>                  
                `);
            }
            attributeList.push(name);
            console.log(attributeList);
        }
    }
    // Function for adding materials
    // Invoked by selecting a material in the selectpicker or when
    // inheriting materials from a template
    function addMaterial(id, qty=""){
        console.log($('#raw_' + id).val() + ">" + Number(qty));
        console.log("MATERIADFSLAKL : " + (Number($('#raw_' + id).val()) > Number(qty)));
        console.log(id);
         if (materialList.indexOf(id) !== -1) {
            alert("Value exists!");
        } else {
            if ($('#raw_' + id).val() > 0 && $('#raw_' + id).val() > Number(qty)) {
                $('#materials_div').append('<div class="col-sm-6 material-badge" id="material-badge-'+id+'"><label class="text-truncate badge badge-success m-1 p-2"><span id="material-badge-name-'+id+'">' + $('#mat-option-'+id).text() + '</span> (<span id="material-badge-qty-'+ id + '">' + $('#raw_' + id).val() + '</span> Stocks Available)</label><input type="number" min="0" name="materials_qty[]" class="form-control" placeholder="Qty." value='+qty+'></div>');
            } else {
                $('#materials_div').append('<div class="col-sm-6 material-badge" id="material-badge-'+id+'"><label style="cursor: pointer;" onclick="$(`#create-product-form`).hide(); $(`body`).removeClass(`modal-open`); $(`.modal-backdrop`).remove(); $(`#divMain`).load(`/inventory`);" class="text-truncate badge badge-danger m-1 p-2">' + $('#mat-option-'+id).html() + ' (' + $('#raw_' + id).val() + ' Stocks Left)</label></div>');
            }
            materialList.push(id);
        }
    }

    function addComponent(id, qty=""){
        console.log(id);
         if (componentList.indexOf(id) !== -1) {
            alert("Value exists!");
        } else {
            $('#components_div').append('<div class="col-sm-6 component-badge" id="component-badge-'+id+'"><label class="text-truncate badge badge-success m-1 p-2"><span id="component-badge-name-'+id+'">' + $('#com-option-'+id).text() + '</span></label><input type="number" min="0" name="components_qty[]" class="form-control" placeholder="Qty." value='+qty+'></div>');
            componentList.push(id);
        }
    }
    // Creating a custom reset method since the native reset
    // function also resets the values of the materials in case
    // they've been changed in the inventory tab
    function resetProductForm(){
        $('#product_name').val(null);
        $('#internal_description').val(null);
        // Making the image field required again in case it was set as not required
        // for whatever reason (such as making the create form an update form)
        $('#picture').attr('required','required');
        $('#product_type').val(null);
        $('#product_type').selectpicker('refresh');
        $('#unit').val(null);
        $('#product-form').attr('action', 'create-product');
        $('#img_tmp').attr('src', 'images/thumbnail.png');
        $('#unit').selectpicker('refresh');
        $('#attribute').val(null);
        $('#attribute').selectpicker('refresh');
        $('#materials').val(null);
        $('#materials').selectpicker('refresh');
        $('[name="product_category"]').val("none"); 
        $('[name="procurement_method"]').val("none");
        // Changing the input type to reset the file list
        // $('input[name="picture"]')[0].type='';
        // $('input[name="picture"]')[0].type='file';
        $('#bar_code').val(null);
        $('#sales_price_wt').val(null);
        materialList = [];
        attributeList = [];
        componentList = [];
        $('#attributes_div').html('');        
        // Removing each of the selected material badges
        $('.material-badge').each(function(){
            this.remove();
        });
        $('#components_div').html('');
        $('#components').selectpicker('refresh');
    }
    // Function is called whenever a material is updated
    // Dynamically changes the qty/name on the badge
    function updatedMaterial(id, amount=null, name=null){
        $('#materials option[value="'+id+'"]').html(name);
        $('#materials').selectpicker('refresh');
        $('#raw_'+id).val(amount);
        $('#material-badge-qty-'+id).html(amount);
        $('#material-badge-name-'+id).html(name);
        
    }
    // Populating the materials div with the materials of a particular item
    function populateMaterials(materialsJSON){
        materialList = [];
        if (typeof materialsJSON == "string")
            materialsJSON = JSON.parse(materialsJSON);
        for(let material in materialsJSON){
            var materialId = materialsJSON[material].material_id;
            var materialQty = materialsJSON[material].material_qty;
            addMaterial(materialId, materialQty);
        }
    }
    // Populating the components div with the components of a particular item
    function populateComponents(componentsJSON){
        componentList = [];
        if (typeof componentsJSON == "string")
            componentsJSON = JSON.parse(componentsJSON);
        for(let component in componentsJSON){
            var componentId = componentsJSON[component].component_id;
            var componentQty = componentsJSON[component].component_qty;
            addComponent(componentId);
        }
    }
    // Function that takes a product as a JSON as a parameter
    // Mostly just filling up the form
    function editProduct(product, creatingVariant = false){
        // Clearing the list of materials then populating it with
        // the existing material list of the product
        $('#materials_div').html('');
        attributeList = [];
        populateMaterials(product.materials);
        $('#bar_code').val(product['bar_code']); 
        $('#create-product-form').modal('show');
        $('#img_tmp').attr('src', 'storage/'+product['picture']);
        $('#item_code').show();
        // Picture field isn't required; an empty picture will
        // retain the old picture of a product
        $('#picture').attr('required', false);
        $('#product_code').val(product['product_code']);
        $('#product_name').val(product['product_name']);
        $('#stock_unit').val(product['stock_unit']);
        $('#manufacturing_date').val(product['manufacturing_date']);
        $('#product_pulled_off_market').val(product['product_pulled_off_market']);
        $('#saleSupplyMethod').val(product['sale_supply_method'])
        
        $('#reorderLevel').val(product['reorder_level']);
        $('#reorderQty').val(product['reorder_qty']);
        if(product['prototype'] == 1){
            $('#prototype').prop('checked', true);
        }else{
            $('#prototype').prop('checked', false);
        }
        $('.selectpicker').selectpicker('val', product['product_type']);
        $('#sales_price_wt').val(product['sales_price_wt']);
        $('.selectpicker1').selectpicker('val', product['unit']);
        $('#internal_description').val(product['internal_description']);
        $('#productFormLabel').html('Edit Item');
        $('#attbNotes').show();
        get_attribute(product['id']);
        if(!creatingVariant){
            $('#product-form').attr('action', 'update-product/'+product['id']);
            $('#product_status').val(product['product_status']);
        }else{
            $('#product-form').attr('action', 'create-product');
            $('#product_status').val("Variant");
            $('#product-form .modal-body').append(
                "<input type='hidden' value='"+product['picture']+"' name='template_img' id='template_img'>"
            );
            $('#productFormLabel').html('Adding Variant');
        }
    }
    function deleteAttribute(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'delete-attribute/' + id,
            data: null,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status == "success") {
                    $(document).ready(function() {
                        // sessionStorage.setItem("status", "success");
                        // $('#divMain').load('/item');
                        console.log(data);
                        alert('you have deleted an attribute, replace this with toast component');
                    });
                } else {
                    $(document).ready(function() {
                        flashMessage('error', data.message);
                    });
                }

            },
            error: function(data) {
                console.log("error");
                console.log(data);
                $(document).ready(function() {
                    flashMessage('error', data.message);
                });
            }
        });
    }
    function deleteProduct(id) {
        if (confirm("Are you sure?")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'delete-product/' + id,
                data: null,
                cache: false,
                contentType: false,
                processData: false,
                accept: 'application/json',
                success: function(data) {
                    if (data.status == "success") {
                        // Finding the table row of the delete button
                        let row = $(`#p-row-${id}`);
                        // Deleting the selected row from the table and re-drawing
                        $('#products-table').DataTable().row(row).remove().draw()
                    }
                    flashMessage(data.status, data.message);
                },
                error: function(data) {
                    console.log(data);
                    flashMessage(data.staus, data.message);
                }
            });
            }
            return false;
        }
    </script>
    <div class="container rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">
                <h4 class="font-weight-bold text-black">Product List</h4>
                <div id="alert-message">
                </div>

            <div class="row pb-2">
                
                <div class="col-12 text-right">

                    <p><button type="button" id="addNew" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                    <script>
                        $('#addNew').click(function(){
                            $('#item_code').hide();
                            $('#productFormLabel').html('New Item');
                            $('#create-product-form').modal('show'); 
                            $('#attbNotes').hide();
                            resetProductForm(); 
                        });
                    </script>
                </div>
                <div class="col text-right" style="padding-top:5px;">
                    <p><button type="button" id="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#toReproduceModal" onclick="getLowOnStocks()">To Reproduce</button></p>
                </div>
                
                <table id="products-table" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td>Item Code</td>
                            <td>Item Name</td>
                            <td>Sales Price</td>
                            <td>Sales Supply Method</td>
                            <td>Stock Quantity </td>
                            <td>View</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($man_products as $product)
                            <tr id="p-row-{{ $product->id }}">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                            <td class="font-weight-bold">{{ $product->product_code }}</td>
                            <td class="font-weight-bold">{{ $product->product_name }}</td>
                            <td class="text-black-50">
                                <!-- sales price data -->
                                {{ $product->sales_price_wt }}
                            </td>
                            <td class="text-black-50">
                                <!-- sales supply method -->
                                {{ $product->sale_supply_method }}
                            </td>
                            <td class="text-black-50">
                                <!-- stock quantity data -->
                                {{ $product->stock_unit }}
                            </td>

                            <td class="text-black-50 text-center"><a href='#' onclick="clickView(JSON.stringify({{ $product->picture }}))" id="clickViewTagItem{{ $product->id }}">View</a></td>

                            <td class="align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                        <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">
                                        <li><button onclick="editProduct({{ json_encode($product) }})" style="width:100%" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></li>
                                        <li><button onclick="deleteProduct({{ $product->id }})" style="width:100%" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></li>
                                        @if ($product->product_status == "Template")
                                            <li><button onclick="editProduct({{ json_encode($product) }}, creatingVariant = true)" type="button" class="btn btn-secondary" style="width: 100%;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Variant</button></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#products-table').dataTable({
                        columnDefs: [{
                            orderable: false,
                            targets: 0
                        }],
                        order: [
                            [1, 'asc']
                        ],
                        drawCallback: function(){
                            $('#products-table_wrapper').addClass('col-12');
                        },
                    });
                });
            </script>
        </div>
    </div>
</div>
<!-- IMAGE PART MODAL -->
<div class="modal fade" id="exampleImage" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sample Picture</h4>
            </div>
            <div class="viewImages modal-body m-0 p-0">
                <div class="imageContainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#exampleImage').modal('hide');">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<form id="product-form" method="POST" enctype="multipart/form-data" action="/create-product">
    <div class="modal fade" id="create-product-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFormLabel">Item</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <div class="text-right buttons">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#create-product-form').modal('hide'); $('#img_tmp').attr('src', '../images/thumbnail.png');">Close</button>
                        <button type="submit" id="product-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <!-- <div class="col-sm" id="item_code">
                                <div class="form-group">
                                    <label for="">Item Code</label>
                                    <input readonly class="form-control" type="text" id="product_code" name="product_code" placeholder="Ex. EM181204" required>
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> -->
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="product_code">Item Code</label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" placeholder="Ex. EM181204" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input class="form-control" type="text" id="product_name" name="product_name" placeholder="Ex. EM Hopper" required>
                                </div>
                            </div>
                        </div>

                        <input value="Template" class="form-control" type="text" id="product_status" name="product_status" hidden required>

                        <div class="form-group">
                            <label>Item Group</label>
                            <select id="product_type" class="selectpicker form-control" name="product_type" data-container="body" data-live-search="true" title="Select an Option" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($item_groups as $item_group)
                                    <option value="{{ $item_group->item_group }}">{{ $item_group->item_group }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new Item Group
                                </option>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.selectpicker').selectpicker();
                                    $('#product_type').on('change', function() {
                                        if (this.value == "New") {
                                            $('#item-group-modal').modal('toggle');
                                        }
                                    });
                                    $('#item-group-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>
                        <div class="row" id="product_selected" style="display: none;">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Product Subtype</label>
                                    <select class="form-control" name="product_category" required>
                                        <option value="none" selected disabled hidden>
                                            Select an Option
                                        </option>
                                        <option>Finished Product</option>
                                        <option>Semi-finished </option>
                                        <option>Component</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Procurement Method</label>
                                    <select id="procurement_method" class="form-control" name="procurement_method" required>
                                        <option value="none" selected disabled hidden>
                                            Select an Option
                                        </option>
                                        <option value="buy">Buy</option>
                                        <option value="produce">Produce</option>
                                        <option value="buy and produce">Buy & Produce</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="made-to-selected" style="display: none;">
                            <label for="">Made to ?</label>
                            <select class="form-control" name="procurement_method" required>
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                <option value="Made-to-Stock">Made-to-Stock</option>
                                <option value="Made-to-Order">Made-to-Order</option>
                            </select>
                        </div>

                        <script>
                            $("#product_type").change(function() {
                                if ($(this).val() == "Product") {
                                    $("#product_selected").show();
                                } else {
                                    $("#product_selected").hide();
                                }
                            });

                            $("#procurement_method").change(function() {
                                if ($(this).val() == "produce" || $(this).val() == "buy and produce") {
                                    $("#made-to-selected").show();
                                } else {
                                    $("#made-to-selected").hide();
                                }
                            });
                        </script>

                        <div class="form-group p-2 m-0">
                            <label for="">Image</label>
                            <img id="img_tmp" src="../images/thumbnail.png" style="width:100%;">
                            <input class="form-control" type="file" id="picture" name="picture[]" onchange="readURL1(this);" required multiple>
                        </div>

                        {{-- facebook style uploading, to be continued --}}
                        {{-- <div class="form-group p-2 image-upload d-flex">
                            <div class="fileBoxes d-flex">
                                <div class="d-flex align-items-center text-center mr-2" style="width: 75px; height:75px; background: #f2f2f2;">
                                    <label for="picture">
                                        Add Image
                                    </label>
                                </div>
                                <input type="file" id="picture" name="picture[]" onchange="readURL1(this);" />
                            </div>
                            <div class="d-flex align-items-center justify-content-center mr-2 btn" id="addFileBox" style="width: 75px; height:75px; background: #f2f2f2;">
                                +
                            </div>
                        </div>
                        <scri>
                            $('#addFileBox').click(function() {
                                console.log('worked');
                                $(".fileBoxes").append(`<div class="d-flex align-items-center text-center mr-2" style="width: 75px; height:75px; background: #f2f2f2;">
                                    <label for="picture">
                                        Add Image
                                    </label>
                                </div>
                                <input type="file" id="picture" name="picture[]" onchange="readURL1(this);" />`);
                            });
                        </scri> --}}

                        <script>
                            function readURL1(input) {
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
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Sales Supply Method
                            </label>
                            <select class="form-control sellable" id="saleSupplyMethod" required name="saleSupplyMethod" onchange="changeSaleSupplyMethod()">
                                <option selected disabled>Please Select</option>
                                <option value="Made to Stock">Made to Stock</option>
                                <option value="To Produce">To Produce</option>
                            </select>
                        </div>
                        <div class="form-group row" id="madeToStockFields" hidden>
                            <div class="col">
                                <label for="reorderLevel">Minimum Order Quantity</label>
                                <input type="number" name="reorderLevel" id="reorderLevel" class="form-control" placeholder="Ex. 100">
                            </div>
                            <div class="col">
                                <label for="reorderQty">Maximum Order Quantity</label>
                                <input type="number" name="reorderQty" id="reorderQty" class="form-control" placeholder="Ex. 100">
                            </div>
                        </div>
                        <script>
                            function changeSaleSupplyMethod(){
                                var salesSupplyMethod = document.getElementById("saleSupplyMethod").value;
                                if (salesSupplyMethod == "Made to Stock") {
                                    document.getElementById("madeToStockFields").removeAttribute("hidden");
                                    document.getElementById("reorderLevel").setAttribute("required", "");
                                    document.getElementById("reorderQty").setAttribute("required", "");
                                } else {
                                    document.getElementById("madeToStockFields").setAttribute("hidden", "");
                                    
                                    document.getElementById("stock_unit").value = 0;
                                    document.getElementById("reorderLevel").removeAttribute("required");
                                    document.getElementById("reorderQty").removeAttribute("required");
                                }
                            }
                        </script>
                        <div class="form-group">
                            <label for="">Barcode</label>
                            <input class="form-control" type="text" id="bar_code" name="bar_code" required placeholder="Ex. 036000291452">
                        </div>

                        <div class="form-group">
                            <label for="">Sales Price W.T.</label>
                            <input class="form-control" type="number" id="sales_price_wt" name="sales_price_wt" required placeholder="Ex. 1000">
                        </div>

                        <div class="form-group">
                            <label for="">Stock Quantity</label>
                            <input class="form-control" type="number" id="stock_unit" name="stock_unit" required placeholder="Ex. 1000">
                        </div>

                        <div class="form-group">
                            <label>Unit of Measurement</label>
                            <select id="unit" class="selectpicker1 form-control" name="unit" data-container="body" data-live-search="true" title="Select an Option" data-hide-disabled="true" required>
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($product_units as $unit)
                                    <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new UOM
                                </option>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.selectpicker1').selectpicker();
                                    $('#unit').on('change', function() {
                                        if (this.value == "New") {
                                            $('#add-unit-modal').modal('toggle');
                                        }
                                    });
                                    $('#add-unit-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>

                        <div id="attributes_div">
                        </div>

                        <div class="form-group" id="attribute_group">
                            <label>Attributes</label>
                            <select id="attribute" class="selectpicker2 form-control" name="attribute" data-container="body" data-live-search="true" title="Select attribute" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($product_variants as $variant)
                                    <option id="attb_option" value="{{ $variant->attribute }}">{{ $variant->attribute }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new Attribute
                                </option>
                            </select>
                            <small id="attbNotes" class="form-text text-muted font-italic" style="display:none;">Attributes: click to edit attribute</small>
                            <script type="text/javascript">
                                attributeList = ""
                                attributeList = (typeof attributeList != 'undefined' && attributeList instanceof Array) ? attributeList : []

                                $(document).ready(function() {
                                    $('.selectpicker2').selectpicker();
                                    $('#attribute').on('change', function() {
                                        if (this.value == "New") {
                                            $('#add-attribute-modal').modal('toggle');
                                        } else {
                                            addAttribute(this.value);
                                            console.log('chosen');
                                        }
                                    });

                                    $('#add-attribute-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>
                        <div class="form-group" id="attribute_group">
                            <label>Value</label>
                            <select id="value_item_variants" class="selectpicker2 form-control" name="value_item_variants" data-container="body" data-live-search="true" title="Select attribute" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                <option value="New">
                                    &#43; Create a new Attribute
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="manufacturing_date">Manufacturing Date</label>
                                    <input type="date" name="manufacturing_date" id="manufacturing_date" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="product_pulled_off_market">Product Pulled off Market</label>
                                    <input type="date" name="product_pulled_off_market" id="product_pulled_off_market" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="materials-picker">
                            <label>Materials</label>
                            <select id="materials" class="selectpicker3 form-control" name="materials" data-container="body" data-live-search="true" title="Select Materials" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select a Material
                                </option>
                                @foreach ($raw_mats as $raw_mat)
                                <!-- Loading the raw materials into the selectpicker with their ID as the value -->
                                    <option id="mat-option-{{ $raw_mat->id }}" value="{{ $raw_mat->id }}">{{ $raw_mat->item_name }}</option>
                                @endforeach
                            </select>

                            <!-- Loading the raw materials' ids and their available amounts -->
                            @foreach ($raw_mats as $raw_mat)
                                <input id="raw_{{ $raw_mat->id }}" type="text" value="{{ $raw_mat->stock_quantity }}" hidden>
                            @endforeach

                            <script type="text/javascript">
                                materialList = (typeof materialList != 'undefined' && materialList instanceof Array) ? materialList : []
                                $(document).ready(function() {
                                    $('.selectpicker3').selectpicker();
                                    $('#materials').on('change', function(){
                                        addMaterial(this.value);
                                    });
                                });
                            </script>
                            <div class="row" id="materials_div" style="background:#ecf0f1">
                            </div>
                        </div>

                        <div class="form-group" id="components-picker">
                            <label>Components</label>
                            <select id="components" class="selectpicker4 form-control" name="components" data-container="body" data-live-search="true" title="Select components" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select a Component
                                </option>
                                @foreach ($components as $component)
                                <!-- Loading the components into the selectpicker with their ID as the value -->
                                    <option id="com-option-{{ $component->id }}" value="{{ $component->id }}">{{ $component->component_name }}</option>
                                @endforeach
                            </select>

                            {{-- <!-- Loading the components' ids and their available amounts -->
                            @foreach ($components as $component)
                                <input id="raw_{{ $raw_mat->id }}" type="text" value="{{ $raw_mat->total_amount }}" hidden>
                            @endforeach --}}

                            <script type="text/javascript">
                                componentList = (typeof componentList != 'undefined' && componentList instanceof Array) ? componentList : []
                                $(document).ready(function() {
                                    $('.selectpicker4').selectpicker();
                                    $('#components').on('change', function(){
                                        addComponent(this.value);
                                    });
                                });
                            </script>
                            <div class="row" id="components_div" style="background:#ecf0f1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Item Description</label>
                            <textarea class="form-control" type="text" id="internal_description" name="internal_description" required></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="prototype" id="prototype" class="form-check-input" value = 1>
                            <label for="prototype" class="form-check-label">Prototype</label>
                        </div>
                        <div class="modal-footer">

                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    //GET ATTRIBUTE
    function get_attribute(id) {
        $('#attributes_div').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/get-attribute/' + id,
            data: null,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data.status);
                if(data.type == "Variant"){
                    data.status.forEach(function(arrayItem) {
                        console.log(arrayItem);
                        addAttribute(item.attribute, item.value);
                        alert('variant');
                    });
                }else{
                    data.status.forEach(function(item){
                        addAttribute(item.attribute, null, true);
                        console.log(item.attribute);
                        // $(".attb-badge").attr('class', 'badge badge-success m-1 p-1 attb-badge'+item.attribute);
                        // $('.attb-badge'+item.attribute+' .far').click(function(){
                        //     $('.attb-badge'+item.attribute).remove();
                        //     deleteAttribute(item.id);
                        // });
                        // $('.attb-badge'+item.attribute).click(function(){
                        //     $('#edit-attribute-modal').modal('show');
                        //     $('#edit-attribute-id').val(item.id);
                        //     $('#edit-attribute-name').val(item.attribute);
                        //     return false;
                        // });
                    });
                }

            },
            error: function(data) {}
        });
    }
</script>

<!-- ADD ITEM GROUP MODAL -->
<div class="modal fade" id="item-group-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-item-group-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Item Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#item-group-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Item Group Name</label>
                                <input class="form-control" type="text" id="item_group" name="item_group" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#product_type'), $('#item-group-modal'))">Close</button>
                    <button type="submit" id="add-item-group-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-item-group-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-item-group-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-item-group',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#item-group-modal').modal('hide');
                        var item_group = $('#item_group').val();
                        $('#product_type').prepend('<option value="' + item_group + '">' + item_group + '</option>');
                        $('.selectpicker').selectpicker('refresh');
                        $('.selectpicker').selectpicker('val', item_group);
                        $('#item_group').val('');

                        $('#create-product-form').modal('show');

                        $('#create-product-form').on('shown.bs.modal', function() {
                            $('#product_type').focus();
                            $(document).off('focusin.modal');
                            $('.modal').css('overflow-y', 'auto');
                        });


                    } else {
                        $(document).ready(function() {
                            flashMessage('error', data.message);
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        flashMessage('error', data.message);
                    });
                }
            });
            return false; 
        });
    </script>
</div>


<!-- ADD UNIT  MODAL -->
<div class="modal fade" id="add-unit-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-unit-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        New UOM</h4>
                    <button type="button" class="close" aria-label="Close" onclick="$('#add-unit-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">
                                    UOM Name</label>
                                <input class="form-control" type="text" id="unit_name" name="unit_name" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#unit'), $('#add-unit-modal'))">Close</button>
                    <button type="submit" id="add-unit-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-unit-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-unit-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-product-unit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#add-unit-modal').modal('hide');
                        var unit_name = $('#unit_name').val();
                        $('#unit').prepend('<option value="' + unit_name + '">' + unit_name + '</option>');
                        $('.selectpicker1').selectpicker('refresh');
                        $('.selectpicker1').selectpicker('val', unit_name);
                        $('#unit_name').val('');


                        $('#create-product-form').modal('show');
                        $('#create-product-form').on('shown.bs.modal', function() {
                            $(document).off('focusin.modal');
                            $('#unit').focus();
                            $('.modal').css('overflow-y', 'auto');
                        });



                    } else {
                        $(document).ready(function() {
                            flashMessage('error', data.message);
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        flashMessage('error', data.message);
                    });
                }
            });
            return false;
        });
    </script>
</div>
<!-- to Reproduce Modal -->
<div class="modal fade" id="toReproduceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Product To Reproduce</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table id="toReproduceTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity to Reproduce</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            <script>
                var reproduceTable;
                $(document).ready(function() {
                    reproduceTable = $('#toReproduceTable').DataTable();
                } );

            </script>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="reorderAll" data-ids="" class="btn btn-primary" onclick="deleteRow(this, true)">Reorder All</button>
        </div>
        </div>
    </div>
</div>

<!-- to reproduce Sub Modal -->
    <div class="modal fade bd-example-modal-lg" id="test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Materials of Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table border-bottom table-hover table-bordered">
                <thead class="border-top border-bottom bg-light">
                    <tr class="text-muted">
                        <td>
                            <!-- must contain check box -->
                        </td>
                        <td>Component Name</td>
                        <td>Category</td>
                        <td>Qty. Available</td>
                        <td>Qty. Needed</td>
                    </tr>
                </thead>
                <tbody class="components" id="checkingOfMaterialsTable">
                    <!--Components Body -->
                    
                </tbody>
                
            </table>
        </div>
        
        </div>
    </div>
</div>
<!-- ADD ATTRIBUTE  MODAL -->
<div class="modal fade" id="add-attribute-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-attribute-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        New Attribute</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#add-attribute-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">
                                    Attribute Name</label>
                                <input class="form-control" type="text" id="attribute_name" name="attribute_name" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#attribute'), $('#add-attribute-modal'))">Close</button>
                    <button type="submit" id="add-attribute-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-attribute-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-attribute-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-attribute',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#add-attribute-modal').modal('hide');
                        var attribute_name = $('#attribute_name').val();
                        $('#attribute').prepend('<option value="' + attribute_name + '">' + attribute_name + '</option>');
                        $('.selectpicker2').selectpicker('refresh');
                        $('.selectpicker2').selectpicker('val', attribute_name);
                        $('#attribute').selectpicker('refresh');

                        $('#create-product-form').modal('show');
                        $('#create-product-form').on('shown.bs.modal', function() {
                            $(document).off('focusin.modal');
                            $('#attribute').focus();
                            $('.modal').css('overflow-y', 'auto');
                        });

                        if (attributeList.indexOf(attribute_name) !== -1) {
                            alert("Value exists!");
                        } else {
                            attributeList.push(attribute_name);
                            $('#attributes_div').append('<span class="attb-badge-'+attribute_name+' badge badge-success m-1 p-1">' + attribute_name + '<i class="far fa-times-circle py-1 pl-1"></i></span><input type="hidden" name="attribute_array[]" value="' + attribute_name + '">');
                            $('.modal').css('overflow-y', 'auto');
                        }


                    } else {
                        $(document).ready(function() {
                            flashMessage('error', data.message);
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        flashMessage('error', data.message);
                    });
                }
            });
            return false;
        });
    </script>
</div>

<div class="modal fade" id="edit-attribute-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="edit-attribute-form" method="POST" action="#">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Attribute</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#edit-attribute-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <input type="hidden" id="edit-attribute-id" name="edit-attribute-id" required placeholder="">
                                <label for="">
                                    Attribute Name</label>
                                <input class="form-control" type="text" id="edit-attribute-name" name="edit-attribute-name" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#attribute'), $('#edit-attribute-modal'))">Close</button>
                    <button type="submit" id="edit-attribute-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#edit-attribute-form").on("submit", function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#edit-attribute-form')[0]);
            var id = $("#edit-attribute-id").val();
            var url = $('#edit-attribute-form').attr('action', 'update-attribute/'+id);
            var url = $('#edit-attribute-form').attr('action');
            console.log(url);
            console.log(formData);
            console.log(id);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#edit-attribute-modal').modal('hide');
                        var attribute_name = $('#edit-attribute-name').val();
                        attributeList = [];
                        get_attribute(data.product_id);
                        $('#attribute_name').attr('value', 'none');
                    } else {
                        $(document).ready(function() {
                            alert("Error code:"+data.message);
                        });
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        alert("Error code: " + data.message);
                    });
                }
            });
            return false;
        });
    </script>
</div>

<script>
    $('#create-product-form').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#add-unit-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#add-attribute-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#item-group-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    
</script>
<script>
    // General function for closing modals & resetting the respective select element
    function closeSelectPickerModal(selectPicker, modal){
        if(selectPicker.selectpicker && modal.modal){
            modal.modal('hide');
            selectPicker.val('none');
            selectPicker.selectpicker('refresh');
        }
    }
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
    $(document).ready(function(e) {
        // Prevent form from closing
        $('body').click(function(e){
            console.log(e.target.id == "create-product-form");
        })
        $(".modal-backdrop").remove();
        /*Insert Record AJAX*/
        $('#product-form').on('submit', (function(e) {
            if(materialList.length == 0){
                alert('Select at least one material!');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#product-form')[0]);
            materials_qty = document.getElementsByName('materials_qty[]');
            var materials = {};
            for(var i=0; i<materialList.length; i++){
                materials[i] = {
                    "material_id" : materialList[i],
                    "material_qty" : materials_qty[i].value,
                }
            }
            formData.set('materials', JSON.stringify(materials));
            console.log('materials'+JSON.stringify(materials));
            components_qty = document.getElementsByName('components_qty[]');
            var components = {};
            for(var i=0; i<componentList.length; i++){
                components[i] = {
                    "component_id" : componentList[i],
                    "component_qty" : components_qty[i].value,
                }
            }
            formData.set('components', JSON.stringify(components));
            console.log('components'+components);
            //Add product form
            $.ajax({
                type: 'POST',
                url: $('#product-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.status == "success") {
                        if(data.update){
                            let row = $(`#p-row-${data.product.id}`);
                            $('#products-table').DataTable().row(row).remove().draw();
                        }
                        $('#products-table').DataTable().row.add([
                            `
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            `,
                            `<span class="font-weight-bold">${data.product.product_code}</span>`,
                            `<span class="font-weight-bold">${data.product.product_name}</span>`,
                            `<span class="text-black-50">
                                ${data.product.sales_price_wt}
                            </span>`,
                            `<span class="text-black-50">
                                ${data.product.sale_supply_method}
                            </span>`,
                            `<span class="text-black-50">
                                ${data.product.stock_unit}
                            </span>`,
                            `<div class="text-black-50 text-center"><a href='#' onclick='clickView(${JSON.stringify(data.product.picture)})' data-toggle="modal" data-target="#exampleImage">View</a></div>`,
                            `<span class="align-middle">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">
                                        <li><button onclick='editProduct(${JSON.stringify(data.product)})' style="width:100%" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></li>
                                        <li><button onclick="deleteProduct(${data.product.id})" style="width:100%" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></li>
                                        ${(data.product.product_status == "Template") ? 
                                            `<li><button onclick='editProduct(${JSON.stringify(data.product)}, creatingVariant = true)' type="button" class="btn btn-secondary" style="width: 100%;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Variant</button></li>`
                                            : ''
                                            }
                                    </ul>
                                </div>
                            </span>`
                        ]).node().id = 'p-row-' + data.product.id;
                        $('#products-table').DataTable().draw();
                        $('#create-product-form').modal('hide');
                        flashMessage('success');
                        $('#template_img').remove();
                        $('#attribute').selectpicker('refresh');
                    } else {
                        console.log(data);
                        flashMessage('error', data.message);
                    }
                },
                error: function(data) {
                    console.log(data);
                    flashMessage('error', data.message);
                }
            });
            return false;
        }));
    });

    function flashMessage(status, message=null){
        if(status == 'success'){
            $('#alert-message').html(`
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Success! ${message ?? ""}
            </div>            
            `);
        } else if (status == "error") {
            $('#alert-message').html(`
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Error ${(": " + message) ?? ""}
            </div>            
            `);
        }
        setTimeout(function(){
            $('#alert-message').html('');
        }, 4000);
    }

    function getLowOnStocks(){
        $.ajax({
            type: 'GET',
            url:'/getLowOnStocks',
            success: function(data){
                var idss= [];
                reproduceTable.clear();
                data['data'].forEach((row) => {
                    var quan = row['reorder_qty'] - row['stock_unit'];
                    reproduceTable.row.add([
                        `<tr>
                            <td>
                                <p><button type="button" id="" class="btn" data-toggle="modal" data-target="#test" onclick="getComponent(`+row['id'] + `)">` + row['product_code'] + `</button></p>
                            </td>
                            `,`
                            <td>
                                ` +quan+`
                            </td>
                            `,`
                            <td>
                                <p><button type="button" class="btn btn-primary" onclick="deleteRow(this, [`+row['id'] + `] , false)"> Reorder</button></p>
                            </td>
                        </tr>`
                    ]
                    ).draw(false);
                    idss.push( row['id']);
                });
                document.getElementById('reorderAll').setAttribute('data-ids', idss);
            }
        })
    }

    function getComponent(id){
        var data = {};
        data['id'] = id;
        $.ajax({
            type:'GET',
            url: '/getComponent',
            data: data,
            success: function(data){
                console.log(data);
                var materials = data['data'];
                //@TODO might be buggy if materials/component was not passed or did not enter for loop
                
                $('#checkingOfMaterialsTable tr').remove();
                materials.forEach((row) => {
                $("#checkingOfMaterialsTable").append(
                    `<tr>
                        <td></td>

                        <td>
                            ` +row[2]+ `
                        </td>

                        <td>
                            ` +row[1]+ `
                        </td>

                        <td>
                            ` +row[3]+ `
                        </td>

                        <td>
                            ` +row[0]+ `
                        </td>

                    </tr>`
                );
                });
            }
        })
    }

    function reorder(id){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
        });
        console.log("Checkers");
        console.log(id);
        console.log(typeof id);
        var data = {};
        data['id'] = id;
        $.ajax({
            type:'POST',
            url: '/reorderToStock',
            data: data,
            success: function(data){
                console.log("MATERIALS FOR MATREQ");
                console.log(data);
                var fd = new FormData();
                data["mat_insufficient"].forEach(element => {
                    fd.append('item_code[]', element.item_code);
                    fd.append('quantity_requested[]', element.item_qty);
                    fd.append('procurement_method[]', 'buy');
                });
                for (var pair of fd.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }
                var requiredDate = new Date();
                requiredDate.setDate(requiredDate.getDate() + 7);
                var requiredYear = requiredDate.getFullYear();
                var requiredDay = (requiredDate.getDate() < 10) ? "0" + requiredDate.getDate() : requiredDate.getDate();
                var requiredMonth = (requiredDate.getMonth()+1 < 10) ? "0" + (requiredDate.getMonth() + 1) : requiredDate.getMonth() + 1;
                var formattedDate = requiredYear + "-" + requiredMonth + "-" + requiredDay;
                fd.append('required_date', formattedDate);
                var currProd = "";
                fd.append('purpose', 'Restock materials');
                fd.append('mr_status', 'Draft');
                fd.append('work_order_no', data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "/materialrequest",
                    data: fd, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data.message)
                    }
                });
            }
        });
    }

    function deleteRow(r, id, delA) {
        if(delA === false){
            reorder(id);
            reproduceTable.row( $(r).parents('tr') ).remove().draw();
            getLowOnStocks();
        }else{
            var x = document.getElementById("reorderAll").getAttribute('data-ids');
            var array = JSON.parse("[" + x + "]");
            reorder(array)
            reproduceTable.clear().draw();
            getLowOnStocks();
            //@TODO Prob: Since stocks aren't added as soon as ordered
        }
    }
</script>