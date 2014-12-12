/**
 * Created by user on 12/5/14.
 */
$(document).ready(function () {
    var dialog, form,
        qty = $("#p-qty"),
        pId = $("#p-id"),
        hQty = $("#hd-qty"),
        hPrice = $("#hd-price"),
        hRetailPrice = $("#hd-retail_price"),
        hStore = $("#hd-store"),
        pSku = $("#p-sku"),
        pName = $("#p-name"),
        pPrice = $("#p-price"),
        pRetailPrice = $("#p-retail_price"),
        allFields = $([]).add(qty).add(pId).add(pPrice).add(pRetailPrice).add(pSku).add(pName).add(hQty).add(hPrice).add(hRetailPrice).add(hStore),
        tips = $(".validateTips");



    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width: 400,
        modal: true,
        buttons: {
            "Lưu": changeInfo,
            Cancel: function () {
                dialog.dialog("close");
            }
        },
        close: function () {
            form[0].reset();
            allFields.removeClass("ui-state-error");
        }
    });
    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();
        changeInfo();
    });
    $('.edit-btn').on('click',function(){
        qty.val($(this).data('qty'));
        hQty.val($(this).data('qty'));
        pPrice.val($(this).data('price'));
        pRetailPrice.val($(this).data('retail_price'));
        hPrice.val($(this).data('price'));
        hRetailPrice.val($(this).data('retail_price'));
        hStore.val($(this).data('store'));
        pId.val($(this).data('id'));
        pSku.val($(this).data('sku'));
        pName.val($(this).data('name'));
        tips.hide();
        dialog.dialog("open");
    });
    function changeInfo(){
        var valid = true;
        allFields.removeClass("ui-state-error");
        valid = valid && checkRegexp(pPrice, /^[0-9]+$/i, "Gía tiền chỉ có thể là số");
        valid = valid && checkRegexp(pRetailPrice, /^[0-9]+$/i, "Gía tiền chỉ có thể là số");
        valid = valid && checkRegexp(qty, /^[0-9]+$/i, "Số lượng chỉ có thể là số");
        if (valid) {
            $.ajax({
                url: updateLink + '/' + pId.val(),
                data: form.serialize(),
                type: 'post',
                success: function(){
                   location.reload();
                }
            });
        }
    }
    function updateTips(t) {
        tips.show();
        tips
            .text(t)
            .addClass("ui-state-highlight");
        setTimeout(function () {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    function checkRegexp(o, regexp, n) {
        if (!( regexp.test(o.val()) )) {
            o.addClass("ui-state-error");
            updateTips(n);
            return false;
        } else {
            return true;
        }
    }
});