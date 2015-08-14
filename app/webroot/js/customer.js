var custName = '';
$(document).ready(function () {
    if($('#input-customer-id').val() == 1){
        $('#OrderPromoteId').attr('readonly','readonly');
    }
    $('#OrderPromoteId').on('change',function(e){
        if($('#OrderPromoteId').attr('readonly') == 'readonly'){
            e.preventDefault();
            $('#OrderPromoteId').val('');
            return false;
        }
    });
    $('[rel=popover]').popover({
        html:true,
        placement:'left',
        content:function(){
            return $($(this).data('contentwrapper')).html();
        }
    });
    $( "#input-customerxxx" ).autocomplete({
        minLength: 0,
        source: customers,
        select: function( event, ui ) {
            if($('#OrderFlagType').val() != '' || $('#OrderFlagType').val() != '0' || $('#OrderPromoteValue').val() !='0'){
                if(ui.item.value == '1'){
                    document.getElementById('input-customer').value = custName;
                    $('#OrderPromoteId').val('').change();
                    $('#OrderPromoteId').attr('readonly','readonly');
                    return false;
                }
            }else{

            }
            $( "#input-customer" ).val( ui.item.label );
            $( "#input-customer-id" ).val( ui.item.value );
            custName =  ui.item.label;
            document.getElementById('input-customer').value = custName;
            document.getElementById('input-customer').setAttribute('value',custName);
            $('#OrderPromoteId').attr('readonly',false);
            saveCart();
//            document.getElementById('input-customer').value =  ui.item.label;
            return false;
        }
    }).focus(function(){
            custName = document.getElementById('input-customer').getAttribute('value');
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
        if(!validate($('#customer'))) return false;
        var cus_name = $('#CustomerName').val();
        $.ajax({
            url: '/admin/customers/add',
            type: 'POST',
            data: {
                Customer: {
                    phone: $('#CustomerPhone').val(),
                    name: $('#CustomerName').val(),
                    code: $('#CustomerCode').val(),
                    email: $('#CustomerEmail').val(),
                    gender: $('#customer *[name="data[Customer][gender]"]').val(),
                    birthday: {
                        'day' : $('#customer *[name="data[Customer][birthday][day]"]').val(),
                        'month' : $('#customer *[name="data[Customer][birthday][month]"]').val(),
                        'year' : $('#customer *[name="data[Customer][birthday][year]"]').val()
                    },
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
function validate(obj){
    var has_error = false;
    obj.find(':input').each(function(i,v){
        if(typeof $(v).attr('required') != "undefined"){
            if($(v).val().trim().length == 0 || $(v).val() == ""){
                $(v).focus();
                has_error = true;
                return false;
            }
        }
        if(typeof $(v).attr('num-max') != "undefined"){
            if($(v).val() > $(v).attr('num-max')){
                $(v).focus();
                has_error = true;
                return false;
            }
        }
    });
    if(!has_error)
        return true;
    else
        return false;
}
