$(function(){
    $('#p-search').focus();
    $('#p-search').on('keyup paste',function(e){
        if (typeof window['loading'] != "undefined" && window['loading'] == true) return false;
        var field = $(this);
        clearTimeout(field.data('timeout'));
        $(this).data('timeout', setTimeout(function() {
            if (field.val().match(/^[A-Za-z]/)) {
                $.ajax({
                    url: ajax_url + '/' + store_id,
                    dataType: 'json',
                    data: {
                        term: field.val().trim()
                    },
                    beforeSend : function () {
                        window['loading'] = true;
                    },
                    // The success event handler will display "No match found" if no items are returned.
                    success: function (data) {
                        window['loading'] = false;
                        if (typeof data[0] != "undefined") {
                            field.val('');
                            addProduct(
                                data[0].Product.id,
                                data[0].Product.code,
                                data[0].Product.name,
                                data[0].Product.options,
                                data[0].Product.qty,
                                data[0].Product.optionsName,
                                data[0].Product.price,
                                JSON.stringify(data[0].Product)
                            );
                        }
                    }
                });
            }
        }, 200));
    });

    $(":input").inputmask();
    $('input,select').on("keyup keypress", function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });

    $('#OrderAdminAddForm').on('submit',function(e){
        if($('#input-customer-id').val() == 1 && $('#OrderPromoteId').val() != ''){
            alert('Vui nhập thông tin khách hàng khi dùng khuyến mãi.');
            return false;
        }
        var receive = parseNumber($('#OrderReceive').val());
        var amount = parseNumber($('#OrderAmount').val());
        if(receive < amount){
            alert('Số tiền nhận từ khách phải lớn hơn hoặc bằng đơn hàng.');
            return false;
        }
        $('#save').attr('disabled','disabled');
        $('#save').removeClass('btn-success');
        $('#save').html('<img src="/img/select2-spinner.gif">Đang xử lý...');
    });

    $(document).on('keypress', '.qty', function (e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!/\d/.test(charStr)) {
            return false;
        }
    });

    $(document).on('click', '.remove-row', function () {
        if (confirm("Bạn có muốn xoá sản phẩm này không?")) {
            $(this).closest('tr').remove();
            updatePrice();
        }
    });
    $(document).on('click', '.price-down', function () {
        var Qty = $(this).parent().find('.qty');
        if (parseInt(Qty.val()) > 1) {
            Qty.val(parseInt(Qty.val()) - 1);
            Qty.trigger('change');
        }
    });
    $(document).on('click', '.price-up', function () {
        var Qty = $(this).parent().find('.qty');
        Qty.val(parseInt(Qty.val()) + 1);
        Qty.trigger('change');
    });

    $(document).on('keyup change', '#OrderReceive', function (e) {
        var receive = parseNumber($(this).val());
        var amount = parseNumber($('#OrderAmount').val());
        var refund = $('#OrderRefund');

        var result = 0;

        if (receive >= amount) {
            result = receive - amount;
        }
        refund.val(result);
    });
    $(document).on('change', '#OrderPromoteId', function (e) {
        if (typeof promotes[$(this).val()] != 'undefined'){
            var type = promotes[$(this).val()].Promote.type;
            var value = promotes[$(this).val()].Promote.value;
            $('#OrderPromoteValue').val(value);
            $('#OrderPromoteType').val(type);
            $('#summary-total').change();
        }else{
            $('#OrderPromoteValue').val(0);
            $('#OrderPromoteType').val('');
            $('#summary-total').change();
        }
        updatePrice();
    });

    $(document).on('change', '#summary-total', function (e) {
        var amount = $('#OrderAmount');
        var promote_val =  $('#OrderPromoteValue').val();
        var promote_type = $('#OrderPromoteType').val();
        var paid  = parseNumber($('#paid').val());
        var result = 0;
        var total = parseNumber($(this).val());
        var summary = 0;

        if(promote_type == 0){
            $('#OrderTotalPromote').val(promote_val);
        }else
        if(promote_type == 1){
            promote_val = total * (parseNumber(promote_val)/100);
            $('#OrderTotalPromote').val(promote_val);
        }else{
            $('#OrderTotalPromote').val(0);
        }
        var promote = parseNumber($('#OrderTotalPromote').val());

        $('#order-product-list .qty').each(function () {
            var price = $(this).data('price');
            var qty = $(this).val();
            summary += parseInt(price) * parseInt(qty);
        });

        $('#new-order-product-list .qty').each(function () {
            var price = $(this).data('price');
            var qty = $(this).val();
            summary += parseInt(price) * parseInt(qty);
        });
        $('#OrderTotalPromote').val(promote);

        if (total >= promote) {
            result = total - promote;
        }
        if(result >= paid){
            result = result - paid;
        }
        amount.val(result);
    });


    $(document).on('keyup mouseup change', '.qty', function (e) {
        var qty = $(this).val();
        var limit = $(this).data('limit');
        if (qty < 0) {
            $(this).val(0);
            $(this).change();
            return false;
        }
        if (qty > parseInt(limit)) {
            alert('Số lượng nhập quá giới hạn');
            qty = limit;
            $(this).val(qty);
        }
        if (!isNaN(qty) && qty != '') {
            var sPrice = $(this).data('price');
            var total = $(this).val() * sPrice;
            $(this).closest('tr').find('.new-total-price').text(digits(total));
            updatePrice();
        } else {
            e.preventDefault();
            return false;
        }
    });
//    Promoted
    $('#OrderPromoteId').on('click',function(){
        if($('#input-customer-id').val() == 1 || $('#input-customer-id').val() == ''){
            alert('Vui lòng nhập tên khách trước khi giảm giá');
            return false;
        }
        if($('#OrderFlagType').val() == '' || $('#OrderFlagType').val() == '0' || $('#OrderFlagType').val() == '3'){

        }else{
            alert('Hoá đơn thay đổi tiền không được giảm giá.');
            return false;
        }
    });
//    =============================================================
//    BEGIN POPOVER
//    =============================================================
    $('#OrderAdminAddForm, #OrderAdminEditForm').on("keyup keypress", function(e) {
        var code = e.keyCode || e.which;
        if (code  == 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('keydown','.input-box',function(e){
        if (e.which == 13) {
            $('.btn-approve').click();
            e.preventDefault();
            return false;
        }
    });
    $(document).on('click','.pov',function(){
        if($('#OrderPromoteId').val() != ''){
            alert('Hoá đơn giảm giá không được thay đổi tiền.');
            return false;
        }
        var template = '<div class="popover">' +
            '       <div class="arrow"></div>' +
            '            <h3 class="popover-title"></h3>' +
            '            <div class="popover-content"></div>' +
            '            <div class="popover-footer">' +
            '                <button type="button" class="btn btn-success btn-sm">Chấp nhận</button>' +
            '            </div>' +
            '</div>';
        var content = '<div class="input-group input-group-sm">' +
            '<div class="input-group-btn">' +
            '<div class="onoffswitch">' +
            '<input type="checkbox" name="{{name}}" class="onoffswitch-checkbox" id="sw{{id}}">' +
            '<label class="onoffswitch-label" for="sw{{id}}">' +
            '<span class="onoffswitch-inner"></span>' +
            '<span class="onoffswitch-switch"></span>' +
            '</label>' +
            '</div>' +
            '</div>' +
            '<input name="mod-price" class="form-control input-box" value="{{value}}">' +
            '<div class="input-group-btn">' +
            '<button type="button" class="btn btn-success btn-sm btn-approve" data-price="{{price}}" data-key="{{key}}"><i class="icon-checkmark"></i></button>'+
            '</div>' +
            '</div>';
        var i_key = $(this).data('key');
        var i_price = $(this).data('price');
        var mod_price_field = $('#'+i_key+'-mod-price');
        var uid = uniqId();
        content= content.replace(/{{id}}/g,uid);
        content= content.replace('{{name}}',uid);
        content= content.replace('{{value}}',mod_price_field.val());
        content =  content.replace('{{price}}',i_price);
        content =  content.replace('{{key}}',i_key);
        $(this).popover('destroy').popover(
            {
                trigger: 'manual',
                content:content,
                placement: 'left',
//                template: template,
                title: 'Thay đổi giá',
                selector: 'a.pov',
                html: true
            }
        ).popover("show");
    });
    $('body').on('click', function (e) {
        $('.pov').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
    $(document).on('change','.popover-content .onoffswitch-checkbox',function(){
        var s_price = $(this).closest('.popover-content').find('button').data('price');
        if($(this).is(':checked')){
            $(this).closest('.popover-content').find('input[name=mod-price]').val(0).focus();
        }else{
            $(this).closest('.popover-content').find('input[name=mod-price]').val(digits(s_price)).focus();
        }
    });
    $(document).on('click','.popover-content button',function(){

        if($('#input-customer-id').val() == 1){
            alert('Vui nhập thông tin khách hàng khi giảm giá.');
            return false;
        }
        var i_key = $(this).data('key');
        var  s_price = $(this).data('price');
        var tep = s_price;
        var i_price = $(this).closest('.popover-content').find('input[name=mod-price]').val();
        i_price = parseNumber(i_price);
        var type_box = $(this).closest('.popover-content').find('input[type=checkbox]');
        var type = 0;
        if(type_box.is(':checked')){
            type = 1;
        }
        var maxPrice  = parseInt(s_price) + parseInt(s_price)*0.1;
        var minPrice  = parseInt(s_price) - parseInt(s_price)*0.1;
        if(type == 0){
            if(i_price >= minPrice && i_price <= maxPrice){
                $('#OrderFlagType').val('1');
            }else{
                $('#OrderFlagType').val('2');
                //alert('Giá thay đổi không được quá 10% giá gốc');
            }
            var mod_price_field = $('#'+i_key+'-mod-price');
            var price_field = $('#'+i_key+'-price-text');
            mod_price_field.val(digits(i_price));
            $('#'+i_key+'-cur-price').data('price',i_price).change();
            price_field.text(digits(i_price*1));
            $('.pov').each(function () {
                $(this).popover('destroy');
            });
        }else{
            if(i_price >= -10 && i_price <= 10){
                $('#OrderFlagType').val('1');
            }else{
                $('#OrderFlagType').val('2');
                //alert('Giá thay đổi không được quá 10% giá gốc');
            }
            var mod_price_field = $('#'+i_key+'-mod-price');
            var price_field = $('#'+i_key+'-price-text');

            i_price = s_price + s_price * (i_price/100);

            mod_price_field.val(digits(i_price));
            $('#'+i_key+'-cur-price').data('price',i_price).change();
            price_field.text(digits(i_price*1));
            $('.pov').each(function () {
                $(this).popover('destroy');
            });
        }
        if(parseInt(tep) == i_price){
            console.log('equal');
            console.log($('#OrderPromoteId').val() == '');
            if($('#OrderPromoteId').val() == ''){
                $('#OrderFlagType').val('0');
            }else{
                $('#OrderFlagType').val('3');
            }
            saveCart();
        }

    });
    $('#refresh').on('click',function(){
        updatePrice();
    })
//    =============================================================
//    END POPOVER
//    =============================================================



});

function addProduct(pId, pSku, pName, pOptions, limit, optionNames, pPrice, pData) {
    var duplicated = false;
    $('#new-order-product-list tr').each(function () {
        var listId = $(this).data('id'),
            listOptions = $(this).data('options');
        if (pId == listId && pOptions == listOptions) {
            duplicated = true;
            var hiddenQty = $(this).find('.qty');
            var to = parseInt(hiddenQty.val()) + 1;
            if (to > parseInt(limit)) {
                alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
                to = limit;
                return false;
            }
            hiddenQty.val(to);
            var newPrice = hiddenQty.val();
            newPrice = newPrice * pPrice;
            $(this).find('.new-total-price').text(digits(newPrice));
            return false;
        }
    });
    if (!duplicated) {
        if (parseInt(limit) < 1) {
            alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
            return false;
        }
        var uuid = uniqId();
        pPrice = pPrice * 1;
        var template = '<tr class="row' + uuid + '" data-id="' + pId + '" data-options="' + pOptions + '">' +
            '<td>' +
            '<a href="javascript:;" class="remove-row" data-needremove=".row' + uuid + '">' +
            '<i class="glyphicon glyphicon-trash"></i>' +
            '</a>' +
            '</td>' +
            '<td class="text-left">' +
            '<span>' + pSku + '</span>' +
            '</td>' +
            '<td class="text-left">' +
            '<span>' + pName + '</span>' +
            '<br><span class="opt">' + optionNames + '</span>' +
            '</td>' +
            '<td class="text-right">' +
            ' <span class="price-text">'+ digits(pPrice) +'</span>'+
            '</td>'+
            '<td class="text-right">' +
            '<span class="price-text" id="' + uuid + '-price-text">' + digits(pPrice) + '</span>' +
            '</td>' +
            '<td class="text-right">' +
            '<a href="javascript:;" class="price-down"><i class="glyphicon glyphicon-minus-sign"></i></a>' +
            '<input class="qty"  id="'+uuid+'-cur-price"  name="data[NewOrderDetail][' + uuid + '][qty]" data-limit="' + limit + '" data-price="' + pPrice + '" value="1">' +
            '<a href="javascript:;"  class="price-up"><i class="glyphicon glyphicon-plus-sign"></i></a>' +
            '</td>' +
            '<td class="text-right">' +
            '<span class="new-total-price price-text">' + digits(pPrice) + '</span>' +
            '<textarea type="hidden" style="display: none" name="data[NewOrderDetail][' + uuid + '][data]">' + pData + '</textarea>' +
            '</td>' +
            '</tr>';
        $('#new-order-product-list').append(template);
    }
    updatePrice();
}
function removeRow(row) {
    $(row).remove();
    updatePrice();
}


function updatePrice() {
    var summary = 0;
    $('#order-product-list .qty').each(function () {
        var price = $(this).data('price');
        var qty = $(this).val();
        summary += parseInt(price) * parseInt(qty);
    });
    $('#new-order-product-list .qty').each(function () {
        var price = $(this).data('price');
        var qty = $(this).val();
        summary += parseInt(price) * parseInt(qty);
    });
    $('#summary-total').val(summary);
    $('#summary-total').change();
    $('#OrderReceive').change();
    saveCart();
}

function uniqId() {
    return Math.round(new Date().getTime() + (Math.random() * 100));
}

function parseNumber(number) {
    number = number.replace(/\..+/g, '');
    number = number.replace(/,/g, '');
    number = parseInt(number);
    if (isNaN(number)) number = 0;
    return number;
}

function digits(number) {
    return number.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}
function saveCart(){
    //$.ajax({
    //    url: saveUrl,
    //    type: 'post',
    //    data: $('#OrderAdminAddForm').serialize(),
    //    success: function (data){
    //
    //    }
    //});
}