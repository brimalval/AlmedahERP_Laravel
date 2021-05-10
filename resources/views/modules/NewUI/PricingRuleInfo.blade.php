
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand tab-list-title">
      <h2 class="navbar-brand" style="font-size: 35px;">New Pricing Rule</h2>
    </h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadPricingRule();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn"  style=" float: left;">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div id="accordion">
  <div class="card">
  <br>
  <div class="container">
          <form id="purchasetaxes" name="purchasetaxes" role="form">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" name="Title" class="form-control">
                </div>
                    <div class="form-check">               
                         <input id="disabled" type="checkbox" class="form-check-input">
                         <label for="">Disabled</label>
                    </div>

                    <div class="form-group">
                     <label for="Apply_On">Apply On</label>
                      <select class="form-control" required="true" name="Apply_On" id="Apply_On">
                      <option value="">Item Code</option>
                      </select>
                    </div>
                    <div class="form-group">
                     <label for="price_productdisc">Price or Product Discount</label>
                      <select class="form-control" required="true" name="price_productdisc" id="price_productdisc">
                      <option value="">Price</option>
                      <option value="">Product Discount</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="Title">Warehouse</label>
                        <input type="text" name="Title" class="form-control">
                    </div>
              </div>
              <div class="col-6">
              <label>Purchase Taxes and Charges</label>
              <table class="table border-bottom table-hover table-bordered" id="pricing-table">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">

                    <td>Item Code</td>
                    <td>UOM</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="material-request-input-rows">
                  <tr>
                    <td id="no-data" colspan="7" style="text-align: center;">
                      NO DATA
                    </td>
                  </tr>
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addnewRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
        
              <div class="col-6">
              <br>
              <div class="form-check">               
                         <input id="Mixed" type="checkbox" class="form-check-input">
                         <label for="">Mixed Conditions</label>
                         
              </div>
              <br>
              <div class="form-check">               
                         <input id="Is" type="checkbox" class="form-check-input">
                         <label for="">Is Cumalative</label>
              </div>
              <br>
              <div class="form-check">               
                         <input id="Coupon" type="checkbox" class="form-check-input">
                         <label for="">Coupon Code Based</label>
              </div>
              </div>
              </div>
              <div class="col-12">
                <hr>
              </div>

              <br>
             
          </form>
        </div>
<!--DISCOUNT ON OTHER ITEM-->
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#DISCOUNT" aria-expanded="true" aria-controls="Dashboard">
          DISCOUNT ON OTHER ITEM
        </button>
      </h5>
    </div>
    <div id="DISCOUNT" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!--DISCOUNT ON OTHER ITEM-->
        <div class="container">
        <div class="row">
        <div class="col-6">
                    <div class="form-group">
                      <label for="Apply_rule_other">Apply Rule On Other</label>
                      <select class="form-control" required="true" name="Apply_rule_other" id="Apply_rule_other">
                      <option value="">Option 1</option>
                      <option value="">Option 2</option>
                      </select>
                    </div>
        </div>
        </div>
        <!--end-->
      </div>
        
      
    </div>

  </div>
<!--END DISCOUNT ON OTHER ITEM-->
<!--PARTY INFORMATION-->
  <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#PARTY_INFORMATION" aria-expanded="true" aria-controls="Dashboard">
          PARTY INFORMATION
        </button>
      </h5>
    </div>
    <div id="PARTY_INFORMATION" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!--PARTY INFORMATION-->
        <div class="container">
        <div class="row">
        <div class="col-6">
              <br>
              <div class="form-check">
          <input id="Selling" type="checkbox" class="form-check-input" onchange="javascript:openField1()">
          <label for="">Selling</label>
          </div>
              <br>
              <div class="form-check">               
                         <input id="Buying" type="checkbox" class="form-check-input" onchange="javascript:openField2()"> 
                         <label for="">Buying</label>
              </div>
              <br>
        </div>
<div class="col-6">
    <div class="container" id="cont" style="display:none;">
      <div class="row">
      <div class="col-12">
                    <div class="form-group">
                      <label for="Applicable_For">Applicable For</label>
                      <select class="form-control" required="true" name="Applicable_For" id="Applicable_For">
                      <option value="">Option 1</option>
                      <option value="">Option 2</option>
                      </select>
                    </div>
        </div>
      </div>
    </div>
        
 </div>
        <!--end-->

</div>
</div>
</div>
</div>
<!--END PARTY INFORMATION-->
<!--QUANTITY AND AMOUNT-->
<div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#QUANTITY_AMOUNT" aria-expanded="true" aria-controls="Dashboard">
         QUANTITY AND AMOUNT
        </button>
      </h5>
</div>
    <div id="QUANTITY_AMOUNT" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
        <div class="container">
        <div class="row">
              <div class="col-6">
                <div class="form-group">
                    <label for="Min_Quantity">Min Quantity</label>
                    <input type="text" name="Min_Quantity" class="form-control">
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Min_Amount">Min Amount</label>
                    <input type="text" name="Min_Amount" class="form-control" placeholder="0.00">
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Max_Quantity">Max Quantity</label>
                    <input type="text" name="Max_Quantity" class="form-control">
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Max_Amount">Max Amount</label>
                    <input type="text" name="Max_Amount" class="form-control" placeholder="0.00">
                </div>
               </div>
        </div>
        </div>
        </div>
        </div>

 <!--END QUANTITY AND AMOUNT-->
 <!--PERIOD SETTINGS-->
<div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#PERIOD_SETTINGS" aria-expanded="true" aria-controls="Dashboard">
         PERIOD SETTINGS
        </button>
      </h5>
</div>
    <div id="PERIOD_SETTINGS" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
        <div class="container">
        <div class="row">
              <div class="col-6">
                <div class="form-group">
                    <label for="Valid_From">Valid From</label>
                    <input type="date" name="Valid_From" class="form-control">
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Valid_Upto">Valid Upto</label>
                    <input type="date" name="Valid_Upto" class="form-control">
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Currency">Currency</label>
                    <input type="text" name="Currency" class="form-control" placeholder="PHP">
                </div>
               </div>

        </div>
        </div>
        </div>
        </div>

 <!--END PERIOD SETTINGS-->
 <!--PRICE DISCOUNT SCHEME-->
<div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#PRICE_DISCOUNT" aria-expanded="true" aria-controls="Dashboard">
         PRICE DISCOUNT SCHEME
        </button>
      </h5>
</div>
    <div id="PRICE_DISCOUNT" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
        <div class="container">
        <div class="row">
        <div class="col-6">
                    <div class="form-group">
                      <label for="Rate_Discount">Rate or Discount</label>
                      <select class="form-control" required="true" name="Rate_Discount" id="Rate_Discount">
                      <option value="">Option 1</option>
                      <option value="">Option 2</option>
                      </select>
                    </div>
        </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="Discount_Percentage">Discount Percentage</label>
                    <input type="text" name="Discount_Percentage" class="form-control">
                </div>
               </div>
               <div class="col-6">

               </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="For_Price_List">For Price List</label>
                    <input type="text" name="For_Price_List" class="form-control" >
                </div>
               </div>

        </div>
        </div>
        </div>
        </div>

 <!--END PRICE DISCOUNT SCHEME-->
 <!--ADVANCED SETTINGS-->
 <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#ADVANCED_SETTINGS" aria-expanded="true" aria-controls="Dashboard">
        ADVANCED SETTINGS
        </button>
      </h5>
</div>
    <div id="ADVANCED_SETTINGS" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
        <div class="container">
            <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="Threshold">Threshold for Suggestion</label>
                    <input type="text" name="Threshold" class="form-control">
                </div>
            </div>
            <div class="col-6">
            <div class="form-check">               
                         <input id="Apply_Multiple" type="checkbox" class="form-check-input" onchange="javascript:openField4()">
                         <label for="">Apply Multiple Pricing Rules</label>      
            </div>
            <div class="form-check">               
                         <input id="Appliead_Discoun" type="checkbox" class="form-check-input">
                         <label for="">Appliead Discount on Rate</label> 
            </div>
            <div class="form-check" id="include1" style="display:none;">                
                         <input id="Validate_Applied" type="checkbox" class="form-check-input" onchange="javascript:openField3()">
                         <label for="">Validate Applied Rule</label>      
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                      <label for="Priority">Priority</label>
                      <select class="form-control" required="true" name="Priority" id="Priority">
                      <option value="">Option 1</option>
                      <option value="">Option 2</option>
                      </select>
            </div>
            </div>
            <div class="col-6" id="include2" style="display:none;">
            <div class="form-group">
                <label for="Rule_Description">Rule Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            </div>
            </div> 
           
      </div>
    </div>
        
 </div>
</div>      
</div>
</div>

 <!--END ADVANCED SETTINGS-->


<script src="{{ asset('js/Pricingruletable.js') }}"></script>
