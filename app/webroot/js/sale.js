$.widget('custom.mcautocomplete', $.ui.autocomplete, {
    _renderMenu: function (ul, items) {
        var self = this,
            thead;

        if (this.options.showHeader) {
            table = $('<div class="ui-widget-header" style="width:100%"></div>');
            $.each(this.options.columns, function (index, item) {
                table.append('<span style="padding:0 4px;float:left;width:' + item.width + ';">' + item.name + '</span>');
            });
            table.append('<div style="clear: both;"></div>');
            ul.append(table);
        }
        $.each(items, function (index, item) {
            self._renderItem(ul, item);
        });
    },
    _renderItem: function (ul, item) {
        var t = '',
            result = '';

        $.each(this.options.columns, function (index, column) {
            t += '<span style="padding:0 4px;float:left;width:' + column.width + ';">' + item[column.Group][column.Key] + '</span>'
        });

        result = $('<li></li>').data('item.autocomplete', item).append('<a class="mcacAnchor">' + t + '<div style="clear: both;"></div></a>').appendTo(ul);
        return result;
    }
});

$(document).ready(function () {
    $("#p-search").mcautocomplete({
        // These next two options are what this plugin adds to the autocomplete widget.
        showHeader: true,
        columns: [
            {
                name: 'Mã số',
                width: '30%',
                Group: 'Product',
                Key: 'sku'
            },
            {
                name: 'Tên',
                width: '40%',
                Group: 'Product',
                Key: 'name'
            },
            {
                name: 'Thuộc tính',
                width: '30%',
                Group: 'Product',
                Key: 'optionsName'
            }
        ],

        // Event handler for when a list item is selected.
        select: function (event, ui) {
            addProduct(
                ui.item.Product.id,
                ui.item.Product.sku,
                ui.item.Product.name,
                ui.item.Product.options,
                ui.item.Product.qty,
                ui.item.Product.optionsName,
                ui.item.Product.price,
                JSON.stringify(ui.item.Product)
            )
            return false;
        },
//pId,pSku,pName,pOptions,limit,optionNames,pPrice,pData
        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        source: function (request, response) {
            $.ajax({
                url: ajax_url+'/'+store_id,
                dataType: 'json',
                data: {
                    term: request.term
                },
                // The success event handler will display "No match found" if no items are returned.
                success: function (data) {
                    response(data);
                }
            });
        }
    }).click(function () {
            $(this).mcautocomplete("search");
        });

    $(":input").inputmask();

    $(document).on('keypress','.qty',function(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!/\d/.test(charStr)) {
            return false;
        }
    });
    $(document).on('click', '.remove-row', function () {
        if (confirm("Bạn có muốn xoá sản phẩm này không?")) {
            var id = $(this).data('needremove');
            $(id).remove();
            updatePrice();
        }
    });
    $(document).on('click', '.price-down', function () {
        var Qty = $(this).parent().find('.qty');
        if (parseInt(Qty.val()) > 1){
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
        var receive =  parseNumber($(this).val());
        var amount =  parseNumber($('#OrderAmount').val());
        var refund = $('#OrderRefund');

        var result = 0;

        if(receive >= amount){
            result = receive - amount;
        }
        refund.val(result);
    });
    $(document).on('change', '#OrderPromoteId', function (e) {
        var promote = $('#OrderTotalPromote');
    });

    $(document).on('change', '#summary-total', function (e) {
        var amount = $('#OrderAmount');
        var promote = parseNumber($('#OrderTotalPromote').val());
        var result = 0;
        var total=parseNumber($(this).val());
        if(total >= promote){
            result = total - promote;
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
        if(qty > parseInt(limit)){
            alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
            qty = limit;
            $(this).val(qty);
        }
        if (!isNaN(qty) && qty != '') {
            var sPrice = $(this).data('price');
            var total = $(this).val() * sPrice;
            $(this).closest('tr').find('.new-total-price').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            updatePrice();
        } else {
            e.preventDefault();
            return false;
        }
    });
    function addProduct(pId,pSku,pName,pOptions,limit,optionNames,pPrice,pData) {
        var  duplicated = false;
            $('#order-product-list tr').each(function () {
                var listId = $(this).data('id'),
                    listOptions = $(this).data('options');
                if (pId == listId && pOptions == listOptions) {
                    duplicated = true;
                    var hiddenQty = $(this).find('.qty');
                    var to = parseInt(hiddenQty.val()) + 1;
                    if(to > parseInt(limit)){
                        alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
                        to = limit;
                        return false;
                    }
                    hiddenQty.val(to);
                    var newPrice = hiddenQty.val();
                    newPrice = newPrice * pPrice;
                    $(this).find('.new-total-price').text(newPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    return false;
                }
            });
            if (!duplicated) {
                if(parseInt(limit) < 1){
                    alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
                    return false;
                }
                var uuid = uniqId();
                pPrice = pPrice *1;
                var template = '<tr class="row' + uuid + '" data-id="'+pId+'" data-options="'+pOptions+'">' +
                    '<td>' +
                    '<a href="javascript:;" class="remove-row" data-needremove=".row' + uuid + '">' +
                    '<i class="icon-close"></i>' +
                    '</a>' +
                    '</td>' +
                    '<td>' +
                    '<span>'+pSku+'</span>' +
                    '</td>' +
                    '<td>' +
                    '<span>'+pName+'</span>' +
                    '<br><span class="opt">'+optionNames+'</span>' +
                    '</td>' +
                    '<td class="text-right">' +
                    '<span class="price-text">'+pPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</span>' +
                    '</td>' +
                    '<td class="text-right">' +
                    '<a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a>' +
                    '<input class="qty" name="data[OrderDetails]['+uuid+'][qty]" data-limit="'+limit+'" data-price="'+pPrice+'" value="1">' +
                    '<a href="javascript:;"  class="price-up"><i class="icon icon-arrow-up"></i></a>' +
                    '</td>' +
                    '<td class="text-right">' +
                    '<span class="new-total-price price-text">'+pPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</span>' +
                    '<textarea type="hidden" style="display: none" name="data[OrderDetails]['+uuid+'][data]">'+pData+'</textarea>' +
                    '</td>' +
                    '</tr>';
                $('#order-product-list').append(template);
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
            summary += parseInt(price)* parseInt(qty);
        });
        $('#summary-total').val(summary);
        $('#summary-total').change();

    }
    function uniqId() {
        return Math.round(new Date().getTime() + (Math.random() * 100));
    }
    function parseNumber(number){
        number = number.replace(/\..+/g,'');
        number = number.replace(/,/g,'');
        number = parseInt(number);
        if(isNaN(number)) number = 0;
        return number;
    }

});