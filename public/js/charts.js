$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var chart = new function () {
    this.initial_load = function () {
        chart.report_builder_button_functions();
        chart.generate_sample_chart();
    }

    // sample of creating a chart
    this.generate_sample_chart = function () {

        var filter_type = $('#date-filter-option option:selected').val();
        var date_from       = '';
        var date_to         = '';
        var temp_date_from  = '';
        var temp_date_to    = '';
        var temp_date       = new Date();


        if (filter_type == 'yearly') {
            date_from = $('#date-from').val();
            if (date_from == '') {
                date_from = temp_date.getFullYear();
            }

            date_to     = '12/31/' + date_from;
            date_from   = '01/01/' + date_from;
        }
        else if (filter_type == 'monthly'){
            date_from   = $('#date-from').val();

            if (date_from == '') {
                date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
            }

            temp_date_from  = date_from.split('/');
            date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
            temp_date       = new Date(date_from);
            date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
            date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
        }

        $.ajax({
            url     : '/generate_sample_chart',
            type    : 'POST',
            data    : {
                date_from   : date_from,
                date_to     : date_to,
                filter_type : filter_type
            }
        })
        .done(function(response){
            $('#chart-sample').html(response);

            $('#work_order_table').DataTable();
        })
        .fail(function(){

        });
    }

    this.report_builder_button_functions = function (){ 
        $('#report_type').on('change',function(){
            if ($(this).val() == 1) {
                // $('#date-filter-div').prop('hidden',true);
                chart.generate_sample_chart();
            }
            else if ($(this).val() == 2){
                // $('#date-filter-div').prop('hidden',false);
                chart.generate_reports_sales();
            }
            else if ($(this).val() == 3){
                // $('#date-filter-div').prop('hidden',false);
                chart.generate_report_trends();
            }
            else if ($(this).val() == 4){
                chart.generate_reports_materials_purchased();
            }
            else if ($(this).val() == 5){
                chart.generate_reports_purchase_and_sales();
            }
            else if ($(this).val() == 6){
                chart.generate_reports_stock_monitoring();
            }
            else if ($(this).val() == 7){
                chart.generate_reports_delivery();
            }
            else if ($(this).val() == 8){
                chart.generate_reports_fast_move();
            }
            
        });  
        

        // initialize datepicker
        $('#date-from').datepicker('destroy');
        $('#date-from').datepicker({
            format      : "yyyy",
            viewMode    : "years", 
            minViewMode : "years",
            autoclose   : true
        });

        // if filter type change
        $('#date-filter-option').on('change',function(){
            $('#date-from').val('');
            $('#date-to').val('');
            if ($(this).val() == 'yearly') {
                $('#date-from').datepicker('destroy');
                $('#date-from').datepicker({
                    format      : "yyyy",
                    viewMode    : "years", 
                    minViewMode : "years",
                    autoclose   : true
                });
                // $('#date-to').datepicker('destroy');
                $('#date-to').prop('hidden',true);
            }
            else if ($(this).val() == 'monthly') {
                $('#date-from').datepicker('destroy');
                $('#date-from').datepicker({
                    format      : "mm/yyyy",
                    viewMode    : "months", 
                    minViewMode : "months",
                    autoclose   : true
                });
                // $('#date-to').datepicker('destroy');
                $('#date-to').prop('hidden',true);
            }
            else if ($(this).val() == 'weekly') {
                
                // $('#date-to').datepicker('destroy');
                $('#date-from').datepicker('destroy');
                $('#date-to').prop('hidden',false);
                $('#date-to').prop('disabled',true);

                $('#date-from').datepicker({
                    autoclose   : true,
                    format      : "mm/dd/yyyy",
                }).on('change',function(){
                    var temp_date = new Date($('#date-from').val());
                    temp_date.setDate(temp_date.getDate()+7);
                    $('#date-to').datepicker('update',temp_date);
                });
            }
            else if ($(this).val() == 'daily') {

                $('#date-from').datepicker('destroy');
                $('#date-to').prop('hidden',false);
                $('#date-to').prop('disabled',true);

                $('#date-from').datepicker({
                    autoclose   : true,
                    format      : "mm/dd/yyyy",
                }).on('change',function(){
                    var temp_date = new Date($('#date-from').val());
                    // temp_date.setDate(temp_date.getDate()+7);
                    $('#date-to').datepicker('update',temp_date);
                });
            }
            else if ($(this).val() == 'custom') {
                
                $('#date-to').datepicker('destroy');
                $('#date-to').prop('hidden',false);
                $('#date-to').prop('disabled',false);

                $('#date-from').datepicker('destroy');
                $('#date-from').datepicker({
                    autoclose   : true,
                    format      : "mm/dd/yyyy",
                }).on('change',function(date){
                    $('#date-to').datepicker('destroy');
                    $('#date-to').datepicker({
                        autoclose   : true,
                        startDate   : new Date($('#date-from').val())
                    });
                });

                $('#date-to').datepicker({
                    autoclose   : true,
                    format      : "mm/dd/yyyy",
                }).on('change',function(date){
                    $('#date-from').datepicker('destroy');
                    $('#date-from').datepicker({
                        autoclose   : true,
                        endDate     : new Date($('#date-to').val())
                    });
                });
            }
        });

        $('#btn-filter').on('click',function(event){
            event.preventDefault();
            var report_type =  $('#report_type option:selected').val();
            if (report_type == 1) {
                chart.generate_sample_chart();
            }
            else if (report_type == 2){
                chart.generate_reports_sales();
            }
            else if (report_type == 3){
                chart.generate_report_trends();
            }
            else if (report_type == 4){
                chart.generate_reports_materials_purchased();
            }
            else if (report_type == 5){
                chart.generate_reports_purchase_and_sales();
            }
            else if (report_type == 6){
                chart.generate_reports_stock_monitoring();
            }
            else if (report_type == 7){
                chart.generate_reports_delivery();
            }
            else if (report_type == 8){
                chart.generate_reports_fast_move();
            }
        });
    }

    this.generate_reports_sales = function () {
        
        var filter_type = $('#date-filter-option option:selected').val();
        var date_from       = '';
        var date_to         = '';
        var temp_date_from  = '';
        var temp_date_to    = '';
        var temp_date       = new Date();


        if (filter_type == 'yearly') {
            date_from = $('#date-from').val();
            if (date_from == '') {
                date_from = temp_date.getFullYear();
            }

            date_to     = '12/31/' + date_from;
            date_from   = '01/01/' + date_from;
        }
        else if (filter_type == 'monthly'){
            date_from   = $('#date-from').val();

            if (date_from == '') {
                date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
            }

            temp_date_from  = date_from.split('/');
            date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
            temp_date       = new Date(date_from);
            date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
            date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
        }
        // else{
        //     date_from   = $('#date-from').val();
        //     date_to     = $('#date-to').val();
            
        //     if (date_from == '') {
        //         date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getDate() + '/' + temp_date.getFullYear();
        //     }
        //     if (date_to == '') {
        //         temp_date = (temp_date.getMonth() + 1) + '/' + temp_date.getDate() + '/' + temp_date.getFullYear();
        //         if (new Date(date_from) > new Date(temp_date)) {
        //             date_to = date_from;
        //         }
        //         else{
        //             date_to = temp_date;
        //         }
        //     }
        // }

        $.ajax({
            url     : '/generate_reports_sales',
            type    : 'POST',
            data    : {
                date_from   : date_from,
                date_to     : date_to,
                filter_type : filter_type
            }
        })
        .done(function(response){
            $('#chart-sample').html(response);

            $('#sales_order_table').DataTable();
        })
        .fail(function(){

        });
    }

    this.generate_report_trends = function () {
        var filter_type = $('#date-filter-option option:selected').val();
        var date_from       = '';
        var date_to         = '';
        var temp_date_from  = '';
        var temp_date_to    = '';
        var temp_date       = new Date();


        if (filter_type == 'yearly') {
            date_from = $('#date-from').val();
            if (date_from == '') {
                date_from = temp_date.getFullYear();
            }

            date_to     = '12/31/' + date_from;
            date_from   = '01/01/' + date_from;
        }
        else if (filter_type == 'monthly'){
            date_from   = $('#date-from').val();

            if (date_from == '') {
                date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
            }

            temp_date_from  = date_from.split('/');
            date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
            temp_date       = new Date(date_from);
            date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
            date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
        }

        $.ajax({
            url     : '/generate_report_trends',
            type    : 'POST',
            data    : {
                date_from   : date_from,
                date_to     : date_to,
                filter_type : filter_type
            }
        })
        .done(function(response){
            $('#chart-sample').html(response);

            $('#sales_trends_table').DataTable();
        })
        .fail(function(){

        });
    }

//material purchase
    this.generate_reports_materials_purchased = function (date_to) {
    var filter_type = $('#date-filter-option option:selected').val();
    var date_from = '';
    var date_to= '';
    var temp_date_from = '';
    var temp_date_to = '';
    var temp_date = new Date;

    if (filter_type == 'yearly'){
        date_from = $('#date-from').val();
        if (date_from == ''){
            date_from == temp_date.getFullYear();
        }

        date_to = '12/31/' + date_from;
        date_from = '01/01/' + date_from;
    }
    else if (filter_type == 'monthly'){
        date_from = $('#date-from').val();
        if (date_from == '') {
            date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
        }

        temp_date_from  = date_from.split('/');
        date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
        temp_date       = new Date(date_from);
        date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
        date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
    }


    $.ajax({
        url         : '/generate_reports_materials_purchased',
        type        : 'POST',
        data        : { date_from : date_from, 
                        filter_type : filter_type,
                        date_to : date_to},
    })
    .done(function(response){
        $('#chart-sample').html(response);

        var table = $('#mp_charts_table').DataTable();
        $('#mp_status').on('change',function(){
            table
            .search(this.value)
            .draw();
        });
    })
    .fail(function(){

    });
}

   //purchase and sales
   this.generate_reports_purchase_and_sales = function (date_to) {
    var filter_type = $('#date-filter-option option:selected').val();
    var date_from = '';
    var date_to= '';
    var temp_date_from = '';
    var temp_date_to = '';
    var temp_date = new Date;

    if (filter_type == 'yearly'){
        date_from = $('#date-from').val();
        if (date_from == ''){
            date_from == temp_date.getFullYear();
        }

        date_to = '12/31/' + date_from;
        date_from = '01/01/' + date_from;
    }
    else if (filter_type == 'monthly'){
        date_from = $('#date-from').val();

        if (date_from == ''){
            date_from = (temp_date.getMonth() + 1) + '/01/' + temp_date.getFullYear();
        }

        temp_date_from = date_from.split('/');
        date_from      = temp_date_from[0] + '/01/' + temp_date_from[1];
        temp_date      = new Date(date_from);
        //date_to        = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
        date_to        = temp_date_from[0] + '/01/' + temp_date_from[1];
    }


    $.ajax({
        url         : '/generate_reports_purchase_and_sales',
        type        : 'POST',
        data        : { date_from : date_from, 
                        filter_type : filter_type,
                        date_to : date_to},
    })
    .done(function(response){
        $('#chart-sample').html(response);

        $('#mp_charts_table').DataTable();
    })
    .fail(function(){

    });
    
}

    this.generate_reports_delivery = function () {

        var filter_type = $('#date-filter-option option:selected').val();
        var date_from       = '';
        var date_to         = '';
        var temp_date_from  = '';
        var temp_date_to    = '';
        var temp_date       = new Date();


        if (filter_type == 'yearly') {
            date_from = $('#date-from').val();
            if (date_from == '') {
                date_from = temp_date.getFullYear();
            }

            date_to     = '12/31/' + date_from;
            date_from   = '01/01/' + date_from;
        }
        else if (filter_type == 'monthly'){
            date_from   = $('#date-from').val();

            if (date_from == '') {
                date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
            }

            temp_date_from  = date_from.split('/');
            date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
            temp_date       = new Date(date_from);
            date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
            date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
        }

        $.ajax({
            url     : '/generate_reports_delivery',
            type    : 'POST',
            data    : {
                date_from   : date_from,
                date_to     : date_to,
                filter_type : filter_type
            }
        })
        .done(function(response){
            $('#chart-sample').html(response);

            $('#delivery_table').DataTable();
        })
        .fail(function(){

        });




    }

    this.generate_reports_fast_move = function () {

        var filter_type = $('#date-filter-option option:selected').val();
        var date_from       = '';
        var date_to         = '';
        var temp_date_from  = '';
        var temp_date_to    = '';
        var temp_date       = new Date();


        if (filter_type == 'yearly') {
            date_from = $('#date-from').val();
            if (date_from == '') {
                date_from = temp_date.getFullYear();
            }

            date_to     = '12/31/' + date_from;
            date_from   = '01/01/' + date_from;
        }
        else if (filter_type == 'monthly'){
            date_from   = $('#date-from').val();

            if (date_from == '') {
                date_from = (temp_date.getMonth() + 1) + '/' + temp_date.getFullYear();
            }

            temp_date_from  = date_from.split('/');
            date_from       = temp_date_from[0] + '/01/' + temp_date_from[1];
            temp_date       = new Date(date_from);
            date_to         = new Date(temp_date.getFullYear(), temp_date.getMonth() + 1, 0);
            date_to         = temp_date_from[0] + '/' + date_to.getDate() + '/' + temp_date_from[1];
        }

        $.ajax({
            url     : '/generate_reports_fast_move',
            type    : 'POST',
            data    : {
                date_from   : date_from,
                date_to     : date_to,
                filter_type : filter_type
            }
        })
        .done(function(response){
            $('#chart-sample').html(response);

            $('#fastMove_table').DataTable();
        })
        .fail(function(){

        });


    }

}//end

chart.initial_load();