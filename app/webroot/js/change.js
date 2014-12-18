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
});
function addProduct(pId, pSku, pName, pOptions, limit, optionNames, pPrice, pData) {

}