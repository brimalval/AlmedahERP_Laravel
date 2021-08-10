<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <span>Reports</span>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Dropdown link</a>
                        <a class="dropdown-item" href="#">Dropdown link</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Refresh</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid h-50" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3 h-100">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="col-lg-12">
                        <form action="/export" method="POST" target="_blank">
                            @csrf
                            <div class="row" id="date-filter-div">
                                <div class="col-md-2">
                                    <select class="form-control" id="date-filter-option" name="date-filter-option">
                                        <option value="yearly" selected>YEARLY</option>
                                        <option value="monthly">MONTHLY</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control datepicker" id="date-from" name="date-from" value="{{date('Y')}}">
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn btn-success" id="btn-filter">GO</button>
                                    <button class="btn btn-primary" id="btn-excel" name="button-export" value="excel" type="submit">EXCEL</button>
                                    <button class="btn btn-primary" id="btn-excel" name="button-export" value="pdf" type="submit">PDF</button>
                                </div>



                                <div class="col-md-2">
                                    <input type="text" class="form-control datepicker" id="date-to" hidden>
                                </div>
                                
                                <div class="col-md-4 text-right">
                                    <select class="form-control" id="report_type" name="report-name">
                                        <option value="1">Work Order Report</option>
                                        <option value="2"> Sales Order Status</option>
                                        <option value="3"> Sales Order Trends</option>
                                        <option value="4"> Purchase Order Report</option>
                                        <option value="5"> Purchase order and Sales Order Report</option>
                                        <option value="6"> Stock & Suppliers Report</option>
                                        <option value="7"> Delivery Reports</option>
                                        <option value="8"> Fast Moving Products</option>
                                    </select>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-header">
                    <form>
                        <!-- <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Almedah Food Equipements">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Finance Book">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Start Year">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="End Year">
                            </div>
                        </div> -->
                        
                        <div class="row body-dashboard">
                            
                            <div class="col-lg-12" id="chart-sample">
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
        function getImageCallback (event, chart) {
            console.log(chart.getImageURI());
            document.getElementById("exportPDF").value = chart.getImageURI();
        }
</script>

<script src="{{ asset('js/charts.js') }}"></script>

