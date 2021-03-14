<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function changeRoute(formId, route){
            document.getElementById(formId).action = route;
            return true;
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Back-end Stuff</title>
    <style>
        .invalid{
            outline: 1px solid red;
        }

        .form{
            border: 1px solid black;
        }
        .form-title{
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2em;
            padding: 5px;
            outline: 1px solid black;
            margin-bottom: 20px;
        }
        .form-body{
            text-align: center;
            padding-left: 35%;
            padding-right: 35%;
            padding-top: 10px;
            padding-bottom: 30px;
        }
        .form-field{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
        }
    </style>
</head>
    <body>
        <div class="form">
            <div class="form-title">
                Production Monitoring <h6>(POST submits to {{ _(route('productmonitoring.store')) }})</h6>
            </div>
            <form action="{{ route('productmonitoring.store') }}" method="post" id="monitoring-crud">
                @csrf
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Customer ID</label>
                        <input type="number" min="0" name="customer_id" id="customer_id" value="{{ old('customer_id') }}">
                    </div>
                    <div class="form-field">
                        <label for="product_code">Product Code</label>
                        <input type="text" name="product_code" id="product_code" class="@error('product_code') invalid @enderror" value="{{ old('product_code') }}">
                        @error('product_code')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="station_id">Station ID</label>
                        <input type="number" name="station_id" id="station_id" value="{{ old('customer_id') }}">
                    </div>
                    <div class="form-field">
                        <label for="planned_start_date">Planned Start Date</label>
                        <input type="date" name="planned_start_date" id="planned_start_date" value="{{ old('planned_start_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="planned_end_date">Planned End Date</label>
                        <input type="date" name="planned_end_date" id="planned_end_date" value="{{ old('planned_end_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="real_start_date">Real Start Date</label>
                        <input type="date" name="real_start_date" id="real_start_date" value="{{ old('real_start_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="real_end_date">Real End Date</label>
                        <input type="date" name="real_end_date" id="real_end_date" value="{{ old('real_end_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="pm_status">PM Status</label>
                        <input type="text" name="pm_status" id="pm_status" value="{{ old('pm_status') }}">
                    </div>
                    <div class="form-field">
                        <button type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <div class="form-title">
                Production Monitoring <h6>(PATCH submits to {{ _(route('productmonitoring.update', ['productmonitoring' => 1])) }})</h6>
            </div>
            <form action="{{ route('productmonitoring.update', ['productmonitoring' => 1]) }}" method="post" id="monitoring-crud">
                @csrf
                @method('PATCH')
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Customer ID</label>
                        <input type="number" min="0" name="customer_id" id="customer_id" value="{{ old('customer_id') }}">
                    </div>
                    <div class="form-field">
                        <label for="product_code">Product Code</label>
                        <input type="text" name="product_code" id="product_code" class="@error('product_code') invalid @enderror" value="{{ old('product_code') }}">
                        @error('product_code')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="station_id">Station ID</label>
                        <input type="number" name="station_id" id="station_id" value="{{ old('customer_id') }}">
                    </div>
                    <div class="form-field">
                        <label for="planned_start_date">Planned Start Date</label>
                        <input type="date" name="planned_start_date" id="planned_start_date" value="{{ old('planned_start_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="planned_end_date">Planned End Date</label>
                        <input type="date" name="planned_end_date" id="planned_end_date" value="{{ old('planned_end_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="real_start_date">Real Start Date</label>
                        <input type="date" name="real_start_date" id="real_start_date" value="{{ old('real_start_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="real_end_date">Real End Date</label>
                        <input type="date" name="real_end_date" id="real_end_date" value="{{ old('real_end_date') }}">
                    </div>
                    <div class="form-field">
                        <label for="pm_status">PM Status</label>
                        <input type="text" name="pm_status" id="pm_status" value="{{ old('pm_status') }}">
                    </div>
                    <div class="form-field">
                        <button type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <div class="form-title">
                Job Scheduling - Parts <h6>(POST submits to {{ _(route('part.store')) }})</h6>
            </div>
            <form action="{{ route('part.store') }}" method="post" id="monitoring-crud" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Part Code</label>
                        <input type="text" name="part_code" id="part_code">
                    </div>
                    <div class="form-field">
                        <label for="">Part Name</label>
                        <input type="text" name="part_name" id="part_name">
                    </div>
                    <div class="form-field">
                        <label for="">Part Image</label>
                        <input type="file" name="part_image" id="part_image">
                    </div>
                    <div class="form-field">
                        <label for="">Part Description</label>
                        <input type="text" name="part_description" id="part_code">
                    </div>
                    <div class="form-field">
                        <button type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <div class="form-title">
                Job Scheduling - Parts <h6>(PATCH submits to {{ _(route('part.update', ['part' => 1])) }})</h6>
            </div>
            <form action="{{ route('part.update', ['part' => 1]) }}" method="post" id="monitoring-crud" enctype="multipart/form-data">
                @method('PATCH');
                @csrf
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Part Code</label>
                        <input type="text" name="part_code" id="part_code">
                    </div>
                    <div class="form-field">
                        <label for="">Part Name</label>
                        <input type="text" name="part_name" id="part_name">
                    </div>
                    <div class="form-field">
                        <label for="">Part Image</label>
                        <input type="file" name="part_image" id="part_image">
                    </div>
                    <div class="form-field">
                        <label for="">Part Description</label>
                        <input type="text" name="part_description" id="part_code">
                    </div>
                    <div class="form-field">
                        <button type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <div class="form-title">
                Job Scheduling - Components <h6>(POST submits to {{ _(route('component.store')) }})</h6>
            </div>
            <form action="{{ route('component.store') }}" method="post" id="monitoring-crud" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Component Code</label>
                        <input type="text" name="component_code" id="component_code">
                    </div>
                    <div class="form-field">
                        <label for="">Component Name</label>
                        <input type="text" name="component_name" id="component_name">
                    </div>
                    <div class="form-field">
                        <label for="">Component Image</label>
                        <input type="file" name="component_image" id="component_image">
                    </div>
                    <div class="form-field">
                        <label for="">Component Description</label>
                        <input type="text" name="component_description" id="component_description">
                    </div>
                    <div class="form-field">
                        <label for="">Item Code</label>
                        <input type="text" name="item_code" id="item_code">
                    </div>
                    <div class="form-field">
                        <button type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <div class="form-title">
                Job Scheduling - Components <h6>(PATCH submits to {{ _(route('component.update', ['component' => 1])) }})</h6>
            </div>
            <form action="{{ route('component.update', ['component' => 1]) }}" method="post" id="monitoring-crud" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-body">
                    <div class="form-field">
                        <label for="">Component Code</label>
                        <input type="text" name="component_code" id="component_code">
                    </div>
                    <div class="form-field">
                        <label for="">Component Name</label>
                        <input type="text" name="component_name" id="component_name">
                    </div>
                    <div class="form-field">
                        <label for="">Component Image</label>
                        <input type="file" name="component_image" id="component_image">
                    </div>
                    <div class="form-field">
                        <label for="">Component Description</label>
                        <input type="text" name="component_description" id="component_description">
                    </div>
                    <div class="form-field">
                        <label for="">Item Code</label>
                        <input type="text" name="item_code" id="item_code">
                    </div>
                    <div class="form-field">
                        <button type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>