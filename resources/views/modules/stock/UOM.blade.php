<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">UOM</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Import</a></li>
                        <li><a class="dropdown-item" href="#">User Permissions</a></li>
                        <li><a class="dropdown-item" href="#">Role Permissions Manager</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">Toggle Sidebar</a></li>
                        <li><a class="dropdown-item" href="#">Share URL</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadUOM();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="" data-toggle="modal"
                        data-target="#myModal">New</button>


                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">New UOM</h4> <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close</button> <button type="submit"
                                        class="btn btn-primary" data-dismiss="modal" id="saveBtn">Save</button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        @csrf
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="UOM Name"><br>
                                        <!--<input type="checkbox" class="form-check-input">
                                    <p>Must be Whole Number</p>-->
                                        <input type="text" class="form-control" id="conv" name="conv"
                                            placeholder="Conversion Value..."><br>
                                        <input type="text" id="price" name="price" placeholder="Price of UOM"
                                            class="form-control">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a class="nav-link menu" href="#" data-parent="stock" data-name="UOMNEW"
                                        data-dismiss="modal">Edit in full page</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
                <div class="float-left">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Add Filter
                    </button>
                </div>
                <div class=" ml-auto float-right">
                    <span class="text-muted ">Last Modified On</span>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-bom border-bottom" id="UOMTable">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>UOM_ID</td>
                    <td>UOM Name</td>
                    <td></td>
                    <td>Conversion Factor</td>
                    <td></td>
                    <td>Price</td>
                    <td>4 of 4</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($uoms as $uom)
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="{{ $uom->uom_id }}" href='javascript:onclick=openUOMEdit()'>{{ $uom->uom_id }}</a></td>
                    <td>{{ $uom->item_uom }}</td>
                    <td class="text-black-50"></td>
                    <td>{{ $uom->conversion_factor }}</td>
                    <td></td>
                    <td>{{ $uom->price }}</td>
                    <td class="text-black-50">9 M</td>
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>1 of 1</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    function clearForm() {
        $("#name").val(null);
        $("#conv").val(null);
        $("#price").val(null);
    }

    $("#saveBtn").click(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData();

        formData.append("name", $("#name").val());
        formData.append("conv", $("#conv").val());
        formData.append("price", $("#price").val());

        $.ajax({
            url: '/create-mat-uom',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                clearForm();
                var uomTbl = $("#UOMTable tbody");
                uomTbl.append(
                    `
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td><a name="` + data.id + `" href='javascript:onclick=openUOMEdit()'>` + data.id + `</a></td>
                        <td>` + data.name + `</td>
                        <td></td>
                        <td>` + data.conversion_factor + `</td>
                        <td class="text-black-50"></td>
                        <td>` + data.price + `</td>
                        <td class="text-black-50">9 M</td>
                        <td><span class="fas fa-comments"></span>0</td>
                    </tr>
                    `
                );
            }

        });

    });

</script>
