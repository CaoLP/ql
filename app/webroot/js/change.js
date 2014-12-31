///product-p
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

$(function(){
    setupAutocomplete();

    $(document).on('click','.add-more',function(){
       var template = '<tr style="background-color: rgba(229, 255, 202, 0.33)">'+
        '   <td  style="width: 10px; padding: 0">'+
        '   <a href="javascript:;" class="btn add-more" data-key="{key}"><i class="icon icon-plus"></i></a>'+
        '   </td>'+
        '    <td style="width: 150px"><input class="form-control input-sm product-p"></td>'+
        '    <td style="width: 250px"><div class="p-name"></div></td>'+
        '    <td><div class="p-price price-text text-right"></div></td>'+
        '    <td><div class="p-qty text-right"></div></td>'+
        '    <td><div class="p-total price-text text-right"></div></td>'+
        '</tr>';

        var id = $(this).data('key');

        var total = $(id).data('total');
        if(countTr(id) < total && countQty(id) < total){
            $(id).append(template.replace('{key}',id));
            $(this).html('<i class="icon icon-remove-2"></i>').removeClass('add-more').addClass('remove-item');
            setupAutocomplete();
        }
    });
    $(document).on('click','.remove-item',function(){
        $(this).closest('tr').remove();
    });
});
function addProduct(tr,pId, pSku, pName, pOptions, limit, optionNames, pPrice, pData) {
    var name = tr.find('.p-name'),
        price = tr.find('.p-price'),
        qty = tr.find('.p-qty'),
        total = tr.find('.p-total');
    name.html('<span>'+pName+'</span>');
    price.html('<span>'+digits(pPrice)+'</span>');
    qty.html('<input value="'+1+'" type="number" class="form-control input-sm pull-right" min="1" max="'+limit+'" style="width: 60px;">');
    total.html('<span>'+digits(pPrice)+'</span>');
}
function countQty(table){
    var total = 0;
    $(table + ' .p-qty input').each(function(){
        total+= ($(this).val()*1);
    });
    return total;
}
function countTr(table){
    var total = 0;
    $(table + ' tr').each(function(){
        total+= 1;
    });
    return total;
}
function setupAutocomplete(){
    $(".product-p").mcautocomplete({
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
                $(this).closest('tr'),
                ui.item.Product.id,
                ui.item.Product.code,
                ui.item.Product.name,
                ui.item.Product.options,
                ui.item.Product.qty,
                ui.item.Product.optionsName,
                ui.item.Product.price,
                JSON.stringify(ui.item.Product)
            )
            $("#p-search").val('');
            return false;
        },
//pId,pSku,pName,pOptions,limit,optionNames,pPrice,pData
        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        open:function(){
            $('.ui-autocomplete').css('width','270px');
        },
        focus: function (event, ui) {
            event.preventDefault();
//            $(".ui-menu-item:first a").click();
        },
        source: function (request, response) {
            $.ajax({
                url: ajax_url + '/' + store_id,
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
}
function digits(number) {
    return number.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}