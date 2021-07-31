<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="row">
    <div align="center" class="col-md-12" id="chart-pie-div"></div>
</div>
<br>

<div class="row">
    <div id="fixed" class="col-md-12">
        <table class="table table-bordered" id="fastMove_table">
            <thead>
                <th>Product Name</th>
                <th>Sales Price with Tax</th>
                <th>Quantity Purchased</th>
                <th>Total Sales</th>
            </thead>
            <tbody>
            @if(!empty($table_data))
                    @foreach($table_data as $index => $value)
                        <tr>
                            <td>{{$value['product_name']}}</td>
                            <td>{{number_format($value['sales_price_wt'],2)}}</td>
                            <td>{{$value['quantity_purchased']}}</td>
                            <td>{{number_format($value['total_sales'],2)}}</td>
                          
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('BarChart', 'pie-chart', 'chart-pie-div') !!}