<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBuyingRequestForQuotation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Request for Quotation Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Send SMS</a>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Email</a>
                        <a class="dropdown-item" href="#">Jump to field <span
                                class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Request for Quotation <span
                                class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Save</button>
            </div>
        </div>
    </div>
    <br>
    
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">

<script src="{{ asset('js/requestforquotation.js') }}"></script>
<script src="{{ asset('js/requestforquotationItems.js') }}"></script>
<form  id="req-forquotation" class="update" action="">
@csrf
@method('PATCH')
<div id="accordion">
<br>
  <div class="card">
  <div class="float-right" id="headingOne">
      <div class="float-right">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Supplier Quotation
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Create</a>
                                    <a class="dropdown-item" href="#">View</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm ml-1">Send Supplier Emails</button>
                        </div>
                    </div>
    </div>
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Dashboard
        </a>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!--dashboard contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="date_created">Date</label>
                  <input type="date" name="date_created" id="date_created" class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="req_status">Status</label>
                  <select class="form-control" name="req_status" id="req_status">
                    <option value="UOM1">status1</option>
                    <option value="UOM2">status2</option>
                    <option value="UOM3">status3</option>
                  </select>
                </div>
               </div>
            </div>
            </div>
          {{-- </form> --}}

        </div>
        <!--end contents-->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#suppDetail" aria-expanded="false" aria-controls="suppDetail">
          Supplier Detail
        </a>
      </h5>
    </div>
    <div id="suppDetail" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--supplier detail contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            
         
              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td>Supplier</td>
                    <td>Contact</td>
                    <td>Email ID</td>
                    
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="material-request-input-rows">
                   
                      <tr>
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

                          <td style="width: 30%;"><input required value="" class="form-control"  type="number" name="quantity" id="quantity"></td>
                          
                          <td id="" class="mr-target-input">
                            <input required value="" class="form-control"  type="text" name="email_id" id="email_id">
                          </td>
                          
                          <td>
                          <a id="" class="btn btn-outline-danger delete-btn" href="#" role="button">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                          </td>
                      </tr>
                    
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                
              </td>

              
          {{-- </form> --}}
        </div>
        <!--end contents-->
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#item" aria-expanded="false" aria-controls="item">
          Items
        </a>
      </h5>
    </div>
    <div id="item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--supplier detail contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            
         
              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td>Item Code</td>
                    <td>UOM</td>
                    <td>Quantity</td>
                    <td>Required Date</td>
                    <td>Station</td>
                    
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="items-input-rows">
                   
                      <tr>
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
                          
                          <td id="" class="mr-target-input" style="width: 10%;">
                            <input required value=""  class="form-control"  type="date" name="required_date" id="required_date">
                          </td>
                          
                          <td id="" class="mr-code-input">
                            <select required="true" name="" class="form-control">
                            <option value="Station1">Station1</option>
                            <option value="Station2">Station2</option>
                            <option value="Station3">Station3</option><option value="" ></option>
                            </select>
                          </td>

                          <td>
                          <a id="" class="btn btn-outline-danger delete-btn2" href="#" role="button">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                          </td>
                      </tr>
                    
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addRow2()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                
              </td>

              
          {{-- </form> --}}
        </div>
        <!--end contents-->
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#msg" aria-expanded="false" aria-controls="msg">
          Message for Supplier
        </a>
      </h5>
    </div>
    <div id="msg" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--supplier detail contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
          <div id="summernote">
          
          </div>
          {{-- </form> --}}
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
    });

</script>
