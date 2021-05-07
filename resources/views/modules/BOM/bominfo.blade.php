<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New BOM</h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadBOMtable();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="loadAddress();">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card">
  <div class="card-body ml-auto">


    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Links
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <a class="dropdown-item" href="#">Link1</a>
      <a class="dropdown-item" href="#">Link2</a>
      <a class="dropdown-item" href="#">Link3</a>
    </div>

  </div>
</div>

<form action="#" method="post" id="BOM" class="create">
<br>
<div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="Type">Item</label>
                  <select class="form-control" id="hm_select1" onchange = "showForm1();">
                     <option value="0"></option>
                     <option value="1">Item 1</option>
                  </select>
                </div>   
             </div>

            <div class="col-6"></div>

            <div class="col-6">
            <div id="item_content" style = "display:none"> 
                
                  <div class="form-group">
                    <label for="Item_name">Item name</label>

                    <input type="text" readonly name="Item_name" id="Item_name" class="form-control">
                  </div>
                

                
                  <div class="form-group">
                    <label for="Item_UOM">Item UOM</label>
                    <input type="text" readonly name="Item_UOM" id="Item_UOM" class="form-control">
                  </div>
               

                </div>
                </div>

            <div class="col-6"></div>
             <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="Is_active">
                        <label class="form-check-label" for="Is_active">
                        Is Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="default">
                        <label class="form-check-label" for="default">
                        Default
                        </label>
                    </div>
                </div>

            </div>
      

              
          {{-- </form> --}}

        </div>
        <br>
@csrf
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
      <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#item" aria-expanded="false" aria-controls="Item">
        OPERATIONS
        </a>
      </h5>
    </div>
    <div id="item" class="collapse" aria-labelledby="headingOne">
      <div class="card-body">
        <!--operation contents-->
        <div class="col-6">
                <div class="form-group">
                  <label for="routing">Routing</label>
                  <select class="form-control" name="routing" >
                    <option value=""></option>
                    <option value="Type1">Create New Routing</option>
         
                  </select>
                </div>
              </div>
              <label>Operations</label>
              <table class="table border-bottom table-hover table-bordered" id="operations">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Operation Name</td>
                    <td class="text-center">Work Center</td>
                    <td class="text-center">Description</td>
                    <td class="text-center">Operation Time</td>
                    <td class="text-center">Operation Cost</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="operations-input-rows">
                <tr data-id="${nextID}">
        <td class="text-center">
        
        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="Operation_name" id="Operation_name" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="D_workcenter" id="D_workcenter" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Desc" id="Desc" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_Time" id="Operation_Time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_cost" id="Operation_cost" class="form-control"></td>

        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
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
                <button type="button" onclick="addRowoperations()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
        <!--end contents-->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
      <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#materials" aria-expanded="false" aria-controls="Item">
        MATERIALS
        </a>
      </h5>
    </div>
    <div id="materials" class="collapse" aria-labelledby="headingOne">
      <div class="card-body">
        <!--Materials contents-->
              <table class="table border-bottom table-hover table-bordered" id="operations">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">No.</td>
                    <td class="text-center">Item Code</td>
                    <td class="text-center">Quantity</td>
                    <td class="text-center">UOM</td>
                    <td class="text-center">Rate</td>
                    <td class="text-center">Amount</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="materials-input-rows">
                <tr data-id="${nextID}">
        <td class="text-center">
        
        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="No" id="No" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="ItemCode" id="ItemCode" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Quantity" id="Quantity" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="UOM" id="UOM" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Rate" id="Rate" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Amount" id="Amount" class="form-control"></td>   
        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>`
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addRowmaterials()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
        <!--end contents-->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
      <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#costing" aria-expanded="false" aria-controls="Item">
        COSTING
        </a>
      </h5>
    </div>
    <div id="costing" class="collapse" aria-labelledby="headingOne">
      <div class="card-body">
        <!--costing contents-->
          <div class ="row">
          <div class="col-6">
                  <div class="form-group">
                    <label for="Operationg_Cost">Operationg Cost</label>
                    <input type="text" readonly name="Operationg_Cost Cost" id="Operationg_Cost" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Material_Cost">Raw Material Cost</label>
                    <input type="text" readonly name="Material_Cost Cost" id="Material_Cost" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="total_Cost">Total Cost</label>
                    <input type="text" readonly name="total_Cost Cost" id="total_Cost" class="form-control">
                  </div>
                </div>
          </div>
              
        <!--end contents-->
      </div>
    </div>
  </div>
      </div>
    </div>
  </div>

</div>
</form>
</div>
<script src="{{ asset('js/bominfo.js') }}"></script>