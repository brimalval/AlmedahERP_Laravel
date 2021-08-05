<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="row">
    <div align="center" class="col-md-12" id="chart-pie-div"></div>
</div>
<br>


<div class="row">
    <div id="fixed" class="col-md-12">
        <table class="table table-bordered" id="delivery_table">
            <thead>
                <th>Customer ID</th>
                <th>Sales ID</th>
                <th>Real End Date</th>
                <th>Due Date</th>
                <th>Sales Status</th>
                <th>Date Received</th>
                <th>Delivery Status</th>
            </thead>
            <tbody>
                @if(!empty($table_data))
                    @foreach($table_data as $index => $value)
                        @if(!empty($value['due_date']) && $value['due_date'] <= now() && $value['delivery_status'] == 'To Ship')
                            <tr class="bg-warning">
                        @elseif(empty($value['date_received']) > now() && ($value['sales_status'] == 'With Outstanding Balance' || $value['delivery_status'] == 'To Ship'))
                            <tr class="bg-warning">
                       
                        @else
                            <tr>
                        @endif
                            
                            <td>{{$value['id']}}</td>
                            <td>{{$value['sales_id']}}</td>
                            <td>{{date('F d, Y',strtotime($value['real_end_date']))}}</td>
                            <td>{{!empty($value['due_date']) ? date('F d, Y',strtotime($value['due_date'])) : ''}}</td>
                            <td>{{$value['sales_status']}}</td>
                            <td>{{!empty($value['date_received']) ? date('F d, Y', strtotime($value['date_received'])) : ''}}</td>
                            <td>{{$value['delivery_status']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>




{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('PieChart', 'pie-chart2', 'chart-pie-div') !!}