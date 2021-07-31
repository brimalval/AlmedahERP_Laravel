<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

@if(!empty($blogs)) <h1>hello</h1> @endif

<div class="container-fluid h-50">
<h2 class="navbar-brand tab-list-title">
                              <span>Purchase and Sales Report</span>
                        </h2>
          <section class="py-5">
            <div class="row">
         
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text">
                      <h6 class="mb-0">Annual Purchase</h6><span class="text-gray">₱ {!!  number_format($annual_purchase, 2)!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-green"></div>
                    <div class="text">
                      <h6 class="mb-0">Purchase Order to Receive</h6><span class="text-gray"> {!! $po_to_bill!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded  p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-blue"></div>
                    <div class="text">
                      <h6 class="mb-0">Purchase Order to Pay</h6><span class="text-gray"> {!! $po_to_receive!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded  p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-red"></div>
                    <div class="text">
                      <h6 class="mb-0">Active Supplier</h6><span class="text-gray">{!! $active_supplier!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                </div>
              </div>
            </div>
          </section>  
  
        <div class="row mt-2 mb-3 h-100">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="col-lg-12">
                    <div class="row">
                  <div align="center" class="col-md-12" id="chart-pie-div"></div>
                  </div>
</div> 
</div>  

<div class="row mt-2 mb-3 h-100">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="col-lg-12">

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('ColumnChart', 'column-chart', 'chart-pie-div') !!}