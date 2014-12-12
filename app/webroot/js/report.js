/**
 * Created by user on 12/12/14.
 */
$(function () {
//    =============================================================
//    BEGIN POPOVER
//    =============================================================

    $(document).on('click', '.pov', function () {
        var request = $(this).data('request');
        var id = $(this).data('id');
        var store_id = $(this).data('store_id');
        var atag = $(this);
        $.ajax({
            url: '/admin/orders/list_orders',
            data: {request:request,id:id,store_id:store_id},
            type:'post',
            success: function (response) {
                var template = '<div class="popover">' +
                    '       <div class="arrow"></div>' +
                    '            <h3 class="popover-title"></h3>' +
                    '            <div class="popover-content"></div>' +
                    '            <div class="popover-footer">' +
                    '                <button type="button" class="btn btn-success btn-sm">Chấp nhận</button>' +
                    '            </div>' +
                    '</div>';
                var content = response;
                atag.popover('destroy').popover(
                    {
                        trigger: 'manual',
                        content: content,
                        placement: 'right',
                        title: 'Các đơn hàng có sản phẩm',
                        selector: 'a.pov',
                        html: true
                    }
                ).popover("show");
            }
        });

    });
    $('body').on('click', function (e) {
        $('.pov').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

//    =============================================================
//    END POPOVER
//    =============================================================
});