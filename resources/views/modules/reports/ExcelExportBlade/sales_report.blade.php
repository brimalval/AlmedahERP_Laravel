
<style>
 td,th{
        text-align: center;
        font-family: 'PT Sans', sans-serif;
        font-size: 12px;
    }
    h1{
        text-align: center;
        font-family: 'PT Sans', sans-serif;
    }
    img{
        width: 690px;
    }
    .chart-pie-div1{
        align: center;
        width: 60px;
    }

</style>
<img src="images/loggo.jpg" alt="">
<hr></hr>
<h1><b>SALES ORDER REPORT </h1></b>

<div align="center" class="col-lg-12" id="pie-chart1"></div>


<table style="{{$has_width ? 'width:100%' : ''}}">
    <thead>
        <tr>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Transaction Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Sales ID</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Customer ID</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Cost Price</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Balance</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Installment Type</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Due Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:30px' : ''}}">Status</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($table_data))
            @foreach($table_data as $index => $value)
                @if(!empty($value['due_date']) && $value['due_date'] <= now() && $value['sales_status'] == 'With Outstanding Balance')
                    <tr class="bg-danger">
                @else
                    <tr>
                @endif
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{date('F d, Y',strtotime($value['transaction_date']))}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{$value['id']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{$value['customer_id']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{number_format($value['cost_price'],2)}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{number_format($value['payment_balance'],2)}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{$value['installment_type']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{!empty($value['due_date']) ? date('F d, Y',strtotime($value['due_date'])) : ''}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center;" >{{$value['sales_status']}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

