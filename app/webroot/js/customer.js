$(document).ready(function () {

    $( "#input-customer" ).autocomplete({
        minLength: 0,
        source: customers,
        select: function( event, ui ) {
            $( "#input-customer" ).val( ui.item.label );
            $( "#input-customer-id" ).val( ui.item.value );
            return false;
        }
    }).focus(function(){
            //Use the below line instead of triggering keydown
            $(this).data("autocomplete").search($(this).val());
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    }
        ;
    $('#submit-customer').on('click', function () {
        var cus_name = $('#CustomerName').val();
        $.ajax({
            url: '/admin/customers/add',
            type: 'POST',
            data: {
                Customer: {
                    name: cus_name,
                    phone: $('#CustomerPhone').val(),
                    email: $('#CustomerEmail').val(),
                    facebook: $('#CustomerFacebook').val(),
                    address: $('#CustomerAddress').val(),
                    district: $('#CustomerDistrict').val(),
                    city: $('#CustomerCity').val()
                }
            },
            success: function (data) {
                var source = JSON.parse(data);
                var last_item = source.pop();
                $('#input-customer').autocomplete("option", { source: source});
                if(last_item.label.trim() == cus_name.trim()){
                    $('#input-customer').val(last_item.label);
                    $('#input-customer-id').val(last_item.value);
                }
                $('#CustomerName').val('');
                $('#CustomerPhone').val('');
                $('#CustomerEmail').val('');
                $('#CustomerFacebook').val('');
                $('#CustomerAddress').val('');
                $('#CustomerDistrict').val('');
                $('#CustomerCity').val('');
            }
        });
    });
});