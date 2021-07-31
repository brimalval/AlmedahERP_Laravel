<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="row">
    <div align="center" class="col-lg-12" id="chart-line-div" style=""></div>
</div>


<div class="row">
    <div id="fixed" class="col-md-12">
        <table class="table table-bordered" id="sales_trends_table">
            <thead>
                <th>Sales ID</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Customer_ID</th>
                <th>Transaction Date</th>
                <th>Cost Price</th>
            </thead>
            <tbody>
                @if(!empty($table_data1))
                    @foreach($table_data1 as $index => $value)
                        <tr>
                            <td>{{$value['sales_id']}}</td>
                            <td>{{$value['product_code']}}</td>
                            <td>{{$value['quantity_purchased']}}</td>
                            <td>{{$value['customer_id']}}</td>
                            <td>{{date('F d, Y',strtotime($value['transaction_date']))}}</td>
                            <td>{{number_format($value['cost_price'],2)}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>




{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('LineChart', 'line-chart', 'chart-line-div') !!}