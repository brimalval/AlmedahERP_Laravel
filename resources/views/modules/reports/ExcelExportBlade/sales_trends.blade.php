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
}
</style>

<img src="images/loggo.jpg" alt="">
<hr></hr>
<h1><b>SALES TRENDS REPORTS </h1></b>

<table style="vertical-align:center; {{$has_width ? 'width:93%' : ''}}">
    <thead>
        <tr>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Sales ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Product Code</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Quantity</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Customer_ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Transaction Date</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Cost Price</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($table_data1))
        @foreach($table_data1 as $index => $value)
                <tr>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{$value['sales_id']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{$value['product_code']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{$value['quantity_purchased']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{$value['customer_id']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{date('F d, Y',strtotime($value['transaction_date']))}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center">{{number_format($value['cost_price'],2)}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>