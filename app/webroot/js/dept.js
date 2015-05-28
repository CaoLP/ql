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
var custName = '';
$(function(){
    $(":input").inputmask();
    $( "#input-customer" ).mcautocomplete({
        // These next two options are what this plugin adds to the autocomplete widget.
        showHeader: true,
        columns: [
            {
                name: 'Tên',
                width: '100%',
                Group : 'Customer',
                Key: 'name'
            }
        ],

        // Event handler for when a list item is selected.
        select: function (event, ui) {
            $("#input-customer").val(ui.item.Customer.name);
            $("#input-customer-id").val(ui.item.Customer.id);
            return false;
        },
        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        source: function (request, response) {
            var data = {
                term: request.term
            };
            $.ajax({
                url: linkCustomer,
                dataType: 'json',
                data: data,
                // The success event handler will display "No match found" if no items are returned.
                success: function (data) {
                    response(data);
                }
            });
        }
    }).click(function () {
            $(this).mcautocomplete("search");
        });

    $("#p-search").mcautocomplete({
        // These next two options are what this plugin adds to the autocomplete widget.
        showHeader: true,
        columns: [
            {
                name: 'Mã số',
                width: '50%',
                Group: 'Order',
                Key: 'code'
            },
            {
                name: 'Tên',
                width: '30%',
                Group: 'Order',
                Key: 'customer'
            }
        ],

        // Event handler for when a list item is selected.
        select: function (event, ui) {
            $("#p-search").val(ui.item.Order.code);
            $("#p-search-hide").val(ui.item.Order.id);
            return false;
        },
        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        source: function (request, response) {
            var cus_id =    $( "#input-customer-id" ).val();
            var data = {
                term: request.term
            };
            if(typeof cus_id != 'undefined' && cus_id){
                data['customer_id'] = cus_id;
            }
            $.ajax({
                url: linkOrder,
                dataType: 'json',
                data: data,
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