

<style>
    td{
        text-align: center;
        font-family: 'PT Sans', sans-serif;
    }
    th, h1{
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
<h1><b>DELIVERY REPORTS </h1></b>

<table style="vertical-align:center; {{$has_width ? 'width:100%' : ''}}">
    <thead>
        <tr>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Customer ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Sales ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Real End Date</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Due Date</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:35px' : ''}}">Sales Status</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:15px' : ''}}">Date Received</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:15px' : ''}}">Delivery Status</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($table_data))
        @foreach($table_data as $index => $value)
                <tr>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value['id']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value['sales_id']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:100px' : ''}}">{{date('F d, Y',strtotime($value['real_end_date']))}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:100px' : ''}}">{{!empty($value['due_date']) ? date('F d, Y',strtotime($value['due_date'])) : ''}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:50px' : ''}}">{{$value['sales_status']}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:100px' : ''}}">{{!empty($value['date_received']) ? date('F d, Y', strtotime($value['date_received'])) : ''}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:40px' : ''}}">{{$value['delivery_status']}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>