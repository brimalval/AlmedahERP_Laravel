<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New Coupon Code</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
      <ul class="navbar-nav ml-auto">
        
        
        <li class="nav-item li-bom">
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadCouponCode();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="loadCouponCode();">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>

<form action="#" method="post" id="address" class="create">
@csrf
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Coupon Code Details
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne">
      <div class="card-body">
        <!--dashboard contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">

                <div class="col-6">
                  <div class="form-group">
                    <label for="coupon_name">Coupon Name</label>
                    <input type="text" name="coupon_name" id="coupon_name" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                <div class="form-group">
                  <label for="coupon_type">Coupon Type</label>
                  <select class="form-control" name="address_type" >
                    <option value="Type1">Type1</option>
                    <option value="Type2">Type2</option>
                    <option value="Type3">Type3</option>
                  </select>
                </div>
              </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="pricing_rule">Pricing Rule</label>
                    <input type="text" name="pricing_rule" id="pricing_rule" class="form-control">
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
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
          More Information
        </button>
      </h5>
    </div>
    <div id="Item" class="collapse" aria-labelledby="headingTwo">
      <div class="card-body">
        <!--moreinfo contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}

            <div class="row">

                <div class="col-6">
                  <div class="form-group">
                    <label for="valid_from">Valid from</label>
                    <input type="date" name="valid_from" id="valid_from" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="valid_until">Valid until</label>
                    <input type="date" name="valid_until" id="valid_until" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                <div class="form-group">
                  <label for="max_use">Maximum Use</label>
                  <input type="number" name="max_use" id="max_use" class="form-control">
                </div>
              </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="used">Used</label>
                    <input type="number" name="used" id="used" min="0" value="0" readonly class="form-control">
                  </div>
                </div>
                
                            <div class="form-group col-md-12">
                                <label for="coupon_desc">Coupon Description</label>
                                <textarea id="coupon_desc" class="summernote" name="coupon_desc"></textarea>
                            </div>
                        

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
        $('.summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
    });

</script>