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

</style>


<table style="{{$has_width ? 'width:100%' : ''}}">
    <thead>
        <tr>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Wok Order Number</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Planned Start Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Planned End Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Real Start Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Real End Date</th>
            <th style="border:1px solid black;font-weight:bold;text-align:center;vertical-align:center;{{$has_width ? 'width:20px' : ''}}">Status</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($table_data))
            @foreach($table_data as $index => $value)
                <tr>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{$value['id']}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{date('F d, Y',strtotime($value['planned_start_date']))}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{date('F d, Y' , strtotime($value['planned_end_date']))}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{date('F d, Y' , strtotime($value['real_start_date']))}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{date('F d, Y' , strtotime($value['real_end_date']))}}</td>
                    <td style="border:1px solid black;text-align:center;vertical-align:center">{{$value['work_order_status']}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>