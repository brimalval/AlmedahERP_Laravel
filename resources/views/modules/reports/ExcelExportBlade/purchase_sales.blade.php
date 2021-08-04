
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
<h1><b>PURCHASE & SALES REPORTS </h1></b>

<table style="vertical-align:center; {{$has_width ? 'width:100%' : ''}}">
    <thead>
    <tr>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Raw Material</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Purchase Date</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Total Cost</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($table_data))
        @foreach($table_data as $index => $value)
        <tr>
              <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->item_name}}</td>
              <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->rm_date}}</td>
              <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{number_format($value->sums,2)}}</td> 
            </tr>
            @endforeach
        @endif
    </tbody>
</table>