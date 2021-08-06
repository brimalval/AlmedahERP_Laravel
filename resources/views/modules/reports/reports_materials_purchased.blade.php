<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="container-fluid h-50">
    <div class="row mt-2 mb-3 h-100">
        <div class="col-12">
            <div class="card h-100">
                    <div class="card-header">
                        <div class="col-lg-12">
                        <h2 class="navbar-brand tab-list-title">
                              <span>Purchase Order Report</span>
                        </h2>
                        <div align="center" class="col-md-12" id="chart-pie-div"></div>  
            </div>
        </div>
    </div>
</div>
 

<div class="col-12">
    <div class="card h-100">
         <div class="card-header">
               <div class="col-lg-12">
                    <div class="row">
                        <div id="fixed" class="col-md-12">
                             <div class="d-flex flex-row-reverse">
                                 <select data-column="0" id='mp_status' class="form-control flex-row-reverse"style="width: 200px" method="POST">
                                    <option value="">By Status</option>
                                    @foreach($mp_status as $mp_status)
                                    <option value="{{$mp_status}}">{{$mp_status}}</option>
                                    @endforeach
                                </select>
                             </div>    
                             <br>
         <table class="table table-bordered" id="mp_charts_table">
            <thead>
                <th>ID</th>
                <th>Purchase ID</th>
                <th>Supplier Quotation ID</th>
                <th>Purchase Date</th>
                <th>Total Cost</th>
                <th>Status</th>
            </thead>
            <tbody>
         
                    @foreach($materials_purchasedDataTable as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->purchase_id}}</td>
                            <td>{{$value->supp_quotation_id}}</td>
                            <td>{{date('F d, Y',strtotime($value->purchase_date))}}</td>
                            <td>₱{{number_format($value->total_cost,2)}}</td>
                            <td>{{($value->mp_status)}}</td>
                        </tr>
                    @endforeach

            </tbody>
        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('PieChart', 'pie-chart', 'chart-pie-div') !!}

