<link rel="stylesheet" href="{{ asset('css/reports.css') }}">

<div class="row">
    <div align="center" class="col-md-12" id="chart-pie-div"></div>
</div>
<br>


                        <div class="d-flex flex-row-reverse">
                                 <select data-column="0" id='work_status' class="form-control flex-row-reverse"style="width: 200px" method="POST">
                                    <option value="">By Status</option>
                                    @foreach($work_status as $work_status)
                                    <option value="{{$work_status}}">{{$work_status}}</option>
                                    @endforeach
                                </select>
                             </div>    
                             <br>
                             
<div class="row">
    <div id="fixed" class="col-md-12">
        <table class="w-100 table table-bom border-bottom" id="work_order_table">
            <thead class="border-top border-bottom bg-light">
                <tr>
                    <th>Wok Order Number</th>
                    <th>Planned Start Date</th>
                    <th>Planned End Date</th>
                    <th>Real Start Date</th>
                    <th>Real End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($table_data))
                    @foreach($table_data as $index => $value)
                        <tr>
                            <td>{{$value['id']}}</td>
                            <td>{{date('F d, Y',strtotime($value['planned_start_date']))}}</td>
                            <td>{{date('F d, Y' , strtotime($value['planned_end_date']))}}</td>
                            <td>{{date('F d, Y' , strtotime($value['real_start_date']))}}</td>
                            <td>{{date('F d, Y' , strtotime($value['real_end_date']))}}</td>
                            <td>{{$value['work_order_status']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

{{--FOR RENDERING OF CHART--}}
{!! \Lava::render('BarChart', 'pie-chart', 'chart-pie-div') !!}