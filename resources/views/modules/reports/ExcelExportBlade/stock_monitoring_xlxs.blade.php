
<style>
    td{
        text-align: center;
        font-family: 'PT Sans', sans-serif;
    }
    th, h1{
        text-align: center;
        font-family: 'PT Sans', sans-serif;
    }

</style>

<table style="vertical-align:center; {{$has_width ? 'width:100%' : ''}}">
<thead>
    <tr>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Item Name</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Suppliers Name</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Rate</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Date Created</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($stockMonitoringTable))
        @foreach($stockMonitoringTable as $index => $value)
        <tr>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->item_name}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->company_name}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20' : ''}}">{{number_format($value->rate,2)}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20' : ''}}">{{date('F d, Y',strtotime($value->date_created))}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>