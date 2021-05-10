<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New Routing</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown li-bom">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Option 1</a></li>
            <li><a class="dropdown-item" href="#">Option 2</a></li>
          </ul>
        </li>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadnewworkcenter();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<form action="#" method="post" id="BOM" class="create">
<br>
<div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">
            <div class="col-6">
                  <div class="form-group">
                    <label for="Routing_Name">Routing Name</label>

                    <input type="text" name="Routing_Name" id="Routing_Name" class="form-control">
                  </div>
                </div>


            </div>
            <label>BOM Operation</label>
            <table class="table border-bottom table-hover table-bordered" id="operations">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Seq. ID</td>
                    <td class="text-center">Operation</td>
                    <td class="text-center">WorkCenter</td>
                    <td class="text-center">Description</td>
                    <td class="text-center">Operation Time</td>
                    <td class="text-center">Operating Cost</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="newrouting-input-rows">
                <tr data-id="${nextID}">
        <td class="text-center">
        
        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value=""  name="seq_id" id="seq_id" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value=""  name="operation" id="operation" class="form-control">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#operation_modal">
            New Operation
        </button></td>
        <td class="mr-unit-input"><input type="text" value=""  name="workcenter" id="workcenter" class="form-control">        
        <button type="button" class="btn btn-primary" type="submit" onclick="loadnewworkcenter();">
            New WorkCenter
        </button></td></td>
        <td class="mr-unit-input"><input type="text" value=""  name="description" id="description" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value=""  name="operation_time" id="operation_time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value=""  name="operating_cost" id="operating_cost" class="form-control"></td>   
        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#edit_routing" href="#" role="button">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addRowbomOperation()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
        <!--end contents-->
      </div>
    </div>
            </div>         
          {{-- </form> --}}

        </div>
        <br>
@csrf
<script src="{{ asset('js/newrouting.js') }}"></script>

<!-- Modal -->
<div class="modal fade" id="operation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Operation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
        <div class="col-12">
                  <div class="form-group">
                    <label for="Operation_Name">Operation Name</label>
                    <input type="text" name="Operation_Name" id="Operation_Name" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="Default_WorkCenter">Default WorkCenter</label>
                    <input type="text" name="Default_WorkCenter" id="Default_WorkCenter" class="form-control">
                  </div>
                </div>

                
                <div class="form-group col-md-12">
                                <label for="Description">Description</label>
                                <textarea id="Description" class="summernote" name="Description"></textarea>
                            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit_routing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Routing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
        <div class="row">
        <div class="col-12">
        <table class="table border-bottom table-hover table-bordered" id="operations">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Seq. ID</td>
                    <td class="text-center">Operation</td>
                    <td class="text-center">WorkCenter</td>
                    <td class="text-center">Description</td>
                    <td class="text-center">Operation Time</td>
                    <td class="text-center">Operating Cost</td>
                    <td class="text-center">Hour Rate</td>
                  </tr>
                </thead>
                <tbody class="" id="newrouting-input-rows">
                <tr data-id="${nextID}">
        <td class="text-center">
        
        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value=""  name="seq_id" id="seq_id" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value=""  name="operation" id="operation" class="form-control">

        <td class="mr-unit-input"><input type="text" value=""  name="workcenter" id="workcenter" class="form-control">        
        
        <td class="mr-unit-input"><input type="text" value=""  name="description" id="description" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value=""  name="operation_time" id="operation_time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value=""  name="operating_cost" id="operating_cost" class="form-control"></td>   
        <td class="mr-unit-input"><input type="text" value=""  name="hour_rate" id="hour_rate" class="form-control"></td>   
    </tr>
                </tbody>
              </table>
        </div>
        </div>
        

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>