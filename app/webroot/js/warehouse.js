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
// Sets up the multicolumn autocomplete widget.
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
                width: '70%',
                Group: 'Product',
                Key: 'name'
            }
        ],

        // Event handler for when a list item is selected.
        select: function (event, ui) {
            this.value = (ui.item ? ui.item.Product.name : '');
            return false;
        },

        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: ajax_url + '/index',
                dataType: 'json',
                data: {
                    term: request.term
                },
                // The success event handler will display "No match found" if no items are returned.
                success: function (data) {
                    response(data) ;
                }
            });
        }
    });
});