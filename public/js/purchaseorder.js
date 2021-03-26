//$(document).ready(function(){
//    let date = Date.now();
//
//    let dateString = formatDate(date, 'yyyy-MM-dd');
//
//    console.log(date.toString);
//
//    $("#transDate").val(dateString);
//});
//
//function formatDate(date, format) {
//
//    date = new Date(date);
//
//    let zero = 0; 
//
//    const map = {
//        MM: date.getMonth() + 1,
//        dd: date.getDate() < 10 ? zero.toString().concat(date.getDate()) : date.getDate(),
//        yy: date.getFullYear().toString().slice(-2),
//        yyyy: date.getFullYear()
//    }
//
//    return format.replace(/MM|dd|yy|yyyy/gi, matched => map[matched])
//}

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
    $('#supplierField').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/search-supplier',
                type: "POST",
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    search: request.term
                },
                success: function(data) {
                    //console.log(data);
                    response(data);
                    //alert(data[0]['product_code']);
                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#supplierField').val(ui.item.company_name); // save selected name to input
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>").data("item.autocomplete", item)
            .append(
                "<a class='form-control'>" +
                "<strong>" + item.company_name + "</strong> - " + item.supplier_id +
                "<br>" +
                "</a>"
            )
            .appendTo(ul);
    }
});
