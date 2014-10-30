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
    var dialog, form,
        qty = $("#qty"),
        optionsList = $("#options-list"),
        allFields = $([]).add(qty),
        tips = $(".validateTips");

    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Thêm": addProduct,
            Cancel: function () {
                dialog.dialog("close");
            }
        },
        close: function () {
            form[0].reset();
            allFields.removeClass("ui-state-error");
            optionsList.html('');
        }
    });
    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();
        addProduct();
    });
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
//            this.value = (ui.item ? ui.item.Product.name : '');
            buildOptions(ui.item.ProductOption);
            dialog.dialog("open");
            return false;
        },

        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        source: function (request, response) {
            $.ajax({
                url: ajax_url + '/index',
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
    });
    function addProduct() {

    }

    function buildOptions(itemOptions) {
        var html = '';
        console.log(optionData);
        console.log(itemOptions);

        Object.keys(optionData).forEach(function (key, index) {
            var OptionGroup = this[key]['OptionGroup'];
            var Option = this[key]['Option'];
            var item = '', renderIt = false;
            item += '<legend>' + OptionGroup['name'] + '</legend><ul style="display: inline; margin-bottom: 5px">';
            Object.keys(Option).forEach(function (key, index) {
                var radio = '<li style="display: inline; padding: 5px"><input type="radio" name="radio' + this[key]['option_group_id'] + '" value="' + this[key]['id'] + '"';
                var compare_id = this[key]['id'];
                Object.keys(itemOptions).forEach(function (key, index) {
                    if (compare_id == this[key]['option_id']) {
                        radio += ' checked="checked"';
                        renderIt = true;
                    }
                }, itemOptions);
                radio += '><span style="margin-left: 3px">' + this[key]['name']+'</span></li>';
                item += radio;
            }, Option);
            item += '</ul>';
            if (renderIt)
                html += item;
        }, optionData);
        optionsList.html(html);
    }

//    $("#p-search").on('keypress',function(event){
//            if (e.which == 13 && $('ul.ui-autocomplete').is(':visible')){
//                var li = $('li.ui-menu-item:first')[0];
//                var item = $(li).data("item.autocomplete");
//                console.log(item);
//                console.log($(this).data("mcautocomplete").options);
//            $(this).data("mcautocomplete").options.select(event, {item: item});
//            }
//    });
});