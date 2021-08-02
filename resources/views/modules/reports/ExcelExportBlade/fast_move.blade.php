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
</style>

<img src="images/loggo.jpg" alt="">
<hr></hr>
<h1><b>FAST MOVING PRODUCT REPORT </h1></b>

<table style="vertical-align:center; {{$has_width ? 'width:100%' : ''}}">
    <thead>
        <tr>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Product Name</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Sales Price with Tax</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Quantity Purchased</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Total Sales</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($table_data))
            @foreach($table_data as $index => $value)
                <tr>
                    <td style="border:1px solid black;text-align:center;vertical-align:center; ">{{$value['product_name']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center; {{$has_width ? 'width:100px' : ''}}">{{number_format($value['sales_price_wt'],2)}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center; {{$has_width ? 'width:100px' : ''}}">{{$value['quantity_purchased']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center; {{$has_width ? 'width:100px' : ''}}">{{number_format($value['total_sales'],2)}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
