<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="row">
    <div align="center" class="col-lg-12" id="chart-pie-div1"></div>
    
</div>

<br>
<div class="col-12">
    <div class="card h-100">
         <div class="card-header">
               <div class="col-lg-12">
                    <div class="row">
                        <div id="fixed" class="col-md-12">
                             <div class="d-flex flex-row-reverse">
                                 <select data-column="0" id='mp_status' class="form-control flex-row-reverse"style="width: 200px" method="POST">
                                    <option value="">[ By Status ]</option>
                                    @foreach($sales_status as $sales_status)
                                    <option value="{{$sales_status}}">{{$sales_status}}</option>
                                    @endforeach
                                </select>
                             </div>    
                             <br>
<div class="row">
    <div id="fixed" class="col-md-12">
        <table class="table table-bordered" id="sales_order_table">
            <thead>
                <th>Transaction Date</th>
                <th>Sales ID</th>
                <th>Customer ID</th>
                <th>Cost Price</th>
                <th>Balance</th>
                <th>Installment Type</th>
                <th>Due Date</th>
                <th>Status</th>
            </thead>
            <tbody>
                @if(!empty($table_data))
                    @foreach($table_data as $index => $value)
                        @if(!empty($value['due_date']) && $value['due_date'] <= now() && $value['sales_status'] == 'With Outstanding Balance')
                            <tr class="bg-warning">
                        @else
                            <tr>
                        @endif
                            <td>{{date('F d, Y',strtotime($value['transaction_date']))}}</td>
                            <td>{{$value['id']}}</td>
                            <td>{{$value['customer_id']}}</td>
                            <td>{{number_format($value['cost_price'],2)}}</td>
                            <td>{{number_format($value['payment_balance'],2)}}</td>
                            <td>{{$value['installment_type']}}</td>
                            <td>{{!empty($value['due_date']) ? date('F d, Y',strtotime($value['due_date'])) : ''}}</td>
                            <td>{{$value['sales_status']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('PieChart', 'pie-chart1', 'chart-pie-div1') !!}