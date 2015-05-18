/**
 * Created by user on 5/18/15.
 */
var isSubmit = false;
$(document).ready(function () {
    $('#code').val('').focus();
    $('input,select').on("keyup keypress", function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });
    $('#WarehouseCheckAdminCheckForm').submit(function(e){
        e.preventDefault();
        return false;
    });
    $('#submit').on('click',function(){
        submitAjax('#WarehouseCheckAdminCheckForm');
        $('#code').val('').focus();
    });
    $('#code').on('keypress',function(e){
        var code = e.keyCode || e.which;
        if (code == 13) {
            submitAjax('#WarehouseCheckAdminCheckForm');
            $('#code').val('').focus();

        }
    });
    $('.delete').on('click',function(){
        var url = $(this).data('href');
        var d = {
            store_id: $('#WarehouseCheckStoreId').val()
        };
        $.ajax({
            url : url,
            data: d,
            type: 'post',
            beforeSend: function(){
                isSubmit = true;
            },
            success: function(data){
                $("#check-body").html(data);
                isSubmit = false;
            }
        });
    });
});

function submitAjax(form){
    if(!isSubmit){
        var d = $(form).serializeArray();
        d.push({name: 'store_name',value:  $("#WarehouseCheckStoreId option:selected").text()})
        $.ajax({
            url : $(form).attr('action'),
            data: d,
            type: 'post',
            beforeSend: function(){
                isSubmit = true;
            },
            success: function(data){
                $("#check-body").html(data);
                isSubmit = false;
            }
        });
    }

}