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
    $('#WarehouseCheckAdminCheckForm').submit(function (e) {
        e.preventDefault();
        return false;
    });
    $('#WarehouseCheckStoreId').on('change',function(){
        window.location = window.location.origin + window.location.pathname + '?store_id=' + $(this).val();
    });
    $('#submit').on('click', function () {
        submitAjax('#WarehouseCheckAdminCheckForm');
        $('#code').val('').focus();
    });
    $('#code').on('keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            submitAjax('#WarehouseCheckAdminCheckForm');
            $('#code').val('').focus();

        }
    });
    $(document).on('click', '.delete', function () {
        var url = $(this).data('href');
        var d = {
            store_id: $('#WarehouseCheckStoreId').val()
        };
        if (!isSubmit)
            $.ajax({
                url: url,
                data: d,
                type: 'post',
                beforeSend: function () {
                    isSubmit = true;
                },
                success: function (data) {
                    $("#check-body").html(data);
                    isSubmit = false;
                }
            });
    });
    $(document).on('click', '.change-qty', function () {
        var input = $(this).parent().parent().find('input');
        var d = {
            'data[WarehouseCheck][store_id]': input.data('store'),
            'data[WarehouseCheck][code]': input.data('code'),
            'data[WarehouseCheck][real_qty]': input.val(),
            check: 1
        };
        if (!isSubmit)
            $.ajax({
                url: $('#WarehouseCheckAdminCheckForm').attr('action'),
                data: d,
                type: 'post',
                beforeSend: function () {
                    isSubmit = true;
                },
                success: function (data) {
                    $("#check-body").html(data);
                    isSubmit = false;
                }
            });
    });
    $(document).on('click', '#check-incorrect', function () {
        if (!isSubmit)
            $.ajax({
                url: $(this).data('href'),
                data: {
                    store_id: $('#store_id').val()
                },
                type: 'post',
                beforeSend: function () {
                    isSubmit = true;
                },
                success: function (data) {
                    $("#check-body").html(data);
                    isSubmit = false;
                }
            });
    });
});

function submitAjax(form) {
    if (!isSubmit) {
        var d = $(form).serializeArray();
        d.push({name: 'store_name', value: $("#WarehouseCheckStoreId option:selected").text()})
        $.ajax({
            url: $(form).attr('action'),
            data: d,
            type: 'post',
            beforeSend: function () {
                isSubmit = true;
            },
            success: function (data) {
                $("#check-body").html(data);
                isSubmit = false;
            }
        });
    }

}