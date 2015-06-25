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
    $(document).on("keyup keypress",'input,select', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click','.remove-item',function(){
        $(this).closest('tr').remove();
    });

    $(document).on('change','.p-qty input',function(){
        var id = $(this).data('id'),
            price = $(this).data('price'),
            qty = parseInt($(this).val()),
            total = $('#total-'+id),
            pQty = $('#p-qty-data-'+id);
        var min = parseInt($(this).attr('min')),
            max = parseInt($(this).attr('max'));
        if(qty < min){
            $(this).val(min);
            qty = min;
        }
        if(qty > max){
            $(this).val(max);
            qty = max;
        }
        var resTotal = qty * price;
        total.html('<span id="total-'+id+'">'+digits(resTotal)+'</span>');
        total.parent().attr('total',resTotal);
        pQty.val(qty);
        var table = $(this).closest('table');
        var tableId = table.data('id');
        var oldQtyField = $('#old-qty-text-'+tableId);
        var newTotalField = $('#new-total-price-'+tableId);
        var q = 0;
        table.find('.p-qty input').each(function(){
            q += parseInt($(this).val());
        });
        var oldQty = parseInt(oldQtyField.attr('qty'));
        var newOldQty = oldQty - q;
        if(newOldQty < 0) newOldQty =0;
        var oldPrice = parseInt(newTotalField.attr('price'));
        var newTotal = newOldQty * oldPrice;

//        oldQtyField.attr('qty',newOldQty);
        oldQtyField.html(digits(newOldQty));
        newTotalField.attr('total',newTotal);
        newTotalField.html(digits(newTotal));

        //#new-total-price-
        //#old-qty-text-
    });
});
function addProduct( table ,pId, pSku, pName, pOptions, limit, optionNames, pPrice, pData) {
    var id = uniqId();
    //var name = tr.find('.p-name'),
    //    price = tr.find('.p-price'),
    //    qty = tr.find('.p-qty'),
    //    total = tr.find('.p-total'),
    //    hidden = tr.find('.p-hidden-info');
    var exist_item = $(table).find('tr[data-sku='+pSku+']');
    if(exist_item.length > 0){
        var old_qty = exist_item.find('.p-qty input');
        old_qty.val((old_qty.val()*1) + 1);
        old_qty.change();
    }else{
        var name=('<span>' + pName + '</span>');
        var price=('<span>' + digits(pPrice) + '</span>');
        var qty=('<input value="' + 1 + '" type="number" data-id="' + id + '" data-price="' + pPrice + '" class="form-control ' +
        'input-sm pull-right" min="1" max="' + limit + '" style="width: 60px;">');
        var total = ('<span id="total-' + id + '">' + digits(pPrice) + '</span>');
        var total_attr =  pPrice;
        var hidden_template = '<input type="hidden" id="p-qty-data-' + id + '" name="OrderDetail[' + id + '][qty]" value="1">';
        hidden_template += '<textarea style="display: none" name="OrderDetail[' + id + '][data]">' + pData + '</textarea>';
        hidden_template += '<input type="hidden" id="replace-' + id + '" name="OrderDetail[' + id + '][replace]" value="1">';
        var template = '<tr style="background-color: rgba(229, 255, 202, 0.33)" data-sku="'+pSku+'">'+
            '   <td  style="width: 10px; padding: 0">'+
            '   <a href="javascript:;" class="btn remove-item" data-key="{key}"><i class="icon icon-remove-2"></i></a>'+
            '   </td>'+
            '    <td style="width: 150px">'+pSku+'</td>'+
            '    <td style="width: 270px"><div class="p-name">'+name+'</div></td>'+
            '    <td><div class="p-price price-text text-right">'+price+'</div></td>'+
            '    <td><div class="p-qty text-right">'+qty+'</div></td>'+
            '    <td><div class="p-total price-text text-right" total="'+total_attr+'">'+total+'</div><div style="display: none" class="p-hidden-info">'+hidden_template+'</div>' +
            '    </td>'+
            '</tr>';
        //$(table).append(template);
        var replace_total =  $(table).data('total');
        //if(countTr(table) < replace_total && countQty(table) < replace_total){
        $(table).append(template.replace('{key}',table));
        $(table + ' .p-qty input').last().change();
        //}
    }
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
                $(this).data('key'),
                ui.item.Product.id,
                ui.item.Product.code,
                ui.item.Product.name,
                ui.item.Product.options,
                ui.item.Product.qty,
                ui.item.Product.optionsName,
                ui.item.Product.price,
                JSON.stringify(ui.item.Product)
            );
            $(this).val('');
            return false;
        },
//pId,pSku,pName,pOptions,limit,optionNames,pPrice,pData
        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        open:function(){
            //$('.ui-autocomplete').css('width','270px');
        },
        focus: function (event, ui) {
            event.preventDefault();
            $(".ui-menu-item").each(function(i,v){
                //$(".ui-menu-item:first a").click();
                if($(this).is(':visible')){
                    $(this).find('a:first').click();
                }
            });
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
function uniqId() {
    return Math.round(new Date().getTime() + (Math.random() * 100));
}
function updateValue(){

}