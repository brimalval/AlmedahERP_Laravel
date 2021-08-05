
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
<h1><b>PURCHASE ORDER REPORTS </h1></b>

<table style="vertical-align:center; {{$has_width ? 'width:100%' : ''}}">
    <thead>
    <tr>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px;{{$has_width ? 'width:15px' : ''}}">Purchase ID</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Supplier</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">Purchase Date</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:35px' : ''}}">Total Cost</th>
            <th style="border:1px solid black;font-weight:bold;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:15px' : ''}}">Status</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($materials_purchasedDataTable))
        @foreach($materials_purchasedDataTable as $index => $value)
        <tr>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->id}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->purchase_id}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{$value->supp_quotation_id}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20px' : ''}}">{{date('F d, Y',strtotime($value->purchase_date))}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20' : ''}}">{{number_format($value->total_cost,2)}}</td>
                    <td style="border:1px solid black;align:center;vertical-align:center; font-size: 12px; {{$has_width ? 'width:20' : ''}}">{{($value->mp_status)}}</td>   
                </tr>
            @endforeach
        @endif
    </tbody>
</table>