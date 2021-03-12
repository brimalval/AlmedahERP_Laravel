<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Back-end Stuff</title>
    <style>
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
                Production Monitoring
            </div>
                <form action="/create-monitor-entry" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="form-field">
                            <label for="">Customer ID</label>
                            <input type="number" min="0" name="customer_id" id="customer_id">
                        </div>
                        <div class="form-field">
                            <label for="product_code">Product Code</label>
                            <input type="text" name="product_code" id="product_code">
                        </div>
                        <div class="form-field">
                            <label for="station_id">Station ID</label>
                            <input type="number" name="station_id" id="station_id">
                        </div>
                        <div class="form-field">
                            <label for="planned_start_date">Planned Start Date</label>
                            <input type="date" name="planned_start_date" id="planned_start_date">
                        </div>
                        <div class="form-field">
                            <label for="planned_end_date">Planned End Date</label>
                            <input type="date" name="planned_end_date" id="planned_end_date">
                        </div>
                        <div class="form-field">
                            <label for="real_start_date">Real Start Date</label>
                            <input type="date" name="real_start_date" id="real_start_date">
                        </div>
                        <div class="form-field">
                            <label for="real_end_date">Real End Date</label>
                            <input type="date" name="real_end_date" id="real_end_date">
                        </div>
                        <div class="form-field">
                            <label for="pm_status">PM Status</label>
                            <input type="text" name="pm_status" id="pm_status">
                        </div>
                        <div class="form-field">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
    </body>
</html>