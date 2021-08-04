<link rel="stylesheet" href="{{ asset('css/reports.css') }}">



<div class="container-fluid h-50">
        <div class="row mt-2 mb-3 h-100">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="col-lg-12">
                        <h2 class="navbar-brand tab-list-title">
                              <span>Stock Price Comparison Report</span> 
                        </h2>
            <section class="py-5">
            <div class="row">

              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text">
                    <h6 class="mb-0">Total No. of Raw Material</h6><span class="text-gray">{!! $total_raw_material!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
                </div>
              </div>
              
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="card-header bg-white rounded p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text">
                    <h6 class="mb-0">Active Supplier</h6><span class="text-gray">{!! $active_supplier!!}</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
                </div>
              </div>
             </section>
             </div> 

             <div class="col-12">
                <select class="selectpicker form-control" data-width="auto" style="width: 200px" data-live-search="true" name="item-filter-option" id="item-filter-option">
                <option value="" selected> Raw Materials</option>
                   @foreach($total_raw_material_ids as $rm_data)
                   <option value="{{$rm_data->item_code}}">{{$rm_data->item_name}}</option>
                    @endforeach
                </select>
                <div align="left" id="chart-pie-div"></div>
            </div>

            <table class="table table-bordered" id="mp_charts_table" width="100%" cellspacing="0">
                    <thead>
                        <th>Raw Material</th>
                        <th>SupplierName</th>
                        <th>Rate</th>
                        <th>Date Created</th>
                    </thead>
                    <tbody>

                            @foreach($stockMonitoringTable as $value)
                                <tr>
                                    <td>{{$value->item_name}}</td>
                                    <td>{{$value->company_name}}</td>
                                    <td>₱{{number_format($value->rate,2)}}</td>
                                    <td>{{date('F d, Y',strtotime($value->date_created))}}</td>

                                </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


 

{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('ColumnChart', 'column-chart', 'chart-pie-div') !!}

<script>
$('#item-filter-option').on('change',function(event){
            event.preventDefault();
            // alert( this.value );
            chart.generate_reports_stock_monitoring();
            
        }); 
       
</script>
