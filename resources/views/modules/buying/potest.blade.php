<script src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha384-/LjQZzcpTzaYn7qWqRIWYC5l8FWEZ2bIHIz0D73Uzba4pShEcdLdZyZkI4Kv676E" crossorigin="anonymous">
</script>

<table border="1">
    <thead>
        <tr>
            <th></th>
            <th>Purchase Order</th>
            <th>Item Code</th>
            <th>Quantity</th>
            <th>Supplier</th>
            <th>Required Date</th>
            <th>Rate</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody id="items"></tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        var body = $("#items");
        var index = 1;
        var idArray = [];
        var items;
        $.ajax({
            type: "GET",
            url: "/get-all",
            success: function(response) {
                console.log(response);
                let poItems = response.items;
                for (let i = 0; i < poItems.length; i++) {
                    let id = poItems[i].id;
                    idArray.push(id);
                    console.log('hello');
                }
            },
            complete: function() {
                for (let i = 0; i < idArray.length; i++) {
                    let id = idArray[i];
                    $.ajax({
                        type: "GET",
                        url: `/view-po-items/${id}`,
                        success: function(response) {
                            let items = response.items;
                            console.log(items);
                            for (let j = 0; j < items.length; j++) {
                                body.append(
                                    `<tr>
                                    <td>${index}</td>
                                    <td>${items[j].purchase_id}</td>
                                    <td>${items[j].item.item_code}</td>
                                    <td>${items[j].qty}</td>
                                    <td>${items[j].supplier}</td>
                                    <td>${items[j].req_date}</td>   
                                    <td>${items[j].rate}</td>
                                    <td>${items[j].subtotal}</td>
                                </tr>`
                                );
                                ++index;
                            }
                        }
                    });
                }
            }
        });
    });

</script>
