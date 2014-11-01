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
        pId = $("#p-id"),
        pSku = $("#p-sku"),
        pName = $("#p-name"),
        pPrice = $("#p-price"),
        pData = $("#p-data"),
        optionsList = $("#options-list"),
        allFields = $([]).add(qty).add(pId).add(pData).add(pPrice).add(pSku).add(pName),
        tips = $(".validateTips");

    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width: 400,
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
            pId.val(ui.item.Product.id);
            pSku.val(ui.item.Product.sku);
            pName.val(ui.item.Product.name);
            pPrice.val(ui.item.Product.price);
            pData.val(JSON.stringify(ui.item.Product));
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
    }).click(function () {
            $(this).mcautocomplete("search");
        });
    $(document).on('click', '.remove-row', function () {
        if (confirm("Bạn có muốn xoá sản phẩm này không?")) {
            var id = $(this).data('needremove');
            $(id).remove();
            updatePrice();
        }
    });
    $(document).on('keyup mouseup change', '#product-list tr .hidden-qty', function (e) {
        var qty = $(this).val();
        if (qty < 1) {
            $(this).val(1);
            $(this).change();
            return false;
        }
        if (!isNaN(qty) && qty != '') {
            var sPrice = $(this).data('price');
            var total = $(this).val() * sPrice;
            $(this).closest('tr').find('.total-price').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            updatePrice();
        } else {
            e.preventDefault();
            return false;
        }
    });
    $(document).on('click', '.price-down', function () {
        var Qty = $(this).parent().find('.hidden-qty');
        if (parseInt(Qty.val()) > 1){
            Qty.val(parseInt(Qty.val()) - 1);
            Qty.trigger('change');
        }
    });
    $(document).on('click', '.price-up', function () {
        var Qty = $(this).parent().find('.hidden-qty');
        Qty.val(parseInt(Qty.val()) + 1);
        Qty.trigger('change');
    });
    function addProduct() {
        var valid = true;
        allFields.removeClass("ui-state-error");
        valid = valid && checkRegexp(qty, /^[0-9]+$/i, "Số lượng chỉ có thể là số");
        if (valid) {
            var qtyVal, optionNames = [], optionIds = [], price, subPrice;
            qtyVal = qty.val();
            subPrice = pPrice.val() * 1;
            price = qtyVal * subPrice;
            $('.radio-op').each(function () {
                if ($(this).is(':checked')) {
                    optionNames.push($(this).data('name'));
                    optionIds.push($(this).val());
                }
            });
            var duplicated = false;

            $('#product-list tr').each(function () {
                var listId = $(this).data('id'),
                    listOptions = $(this).data('options');
                if (pId.val() == listId && JSON.stringify(optionIds) == JSON.stringify(listOptions)) {
                    duplicated = true;
                    var hiddenQty = $(this).find('.hidden-qty');
                    hiddenQty.val(parseInt(hiddenQty.val()) + parseInt(qtyVal));
                    //$(this).find('.hidden-qty-text').text(hiddenQty.val());
                    var newPrice = hiddenQty.val();
                    newPrice = newPrice * pPrice.val();
                    $(this).find('.total-price').text(newPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    return false;
                }
            });
            if (!duplicated) {
                var uuid = uniqId();
                var template = '<tr class="first-tr row' + uuid + '" data-id="' + pId.val() + '" data-options=\'' + JSON.stringify(optionIds) + '\'>' +
                    '<td>' + pSku.val() + '</td>' +
                    '<td>' + pName.val() + '</td>' +
                    '<td><span class="price-text">' + subPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></td>' +
                    '<td class="hidden-qty-text">' +
                    '<a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a><input type="text" class="hidden-qty" data-price="' + subPrice + '" name="data[ProductList][' + uuid + '][Product][qty]" value="' + qtyVal + '"><a href="javascript:;"  class="price-up"><i class="icon icon-arrow-up"></i></a>' +
                    '</td>' +
                    '<td><span class="price-text total-price">' + price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></td>' +
                    '</tr>' +
                    '<tr class="last-tr row' + uuid + '">' +
                    '<td class="text-left"><a href="javascript:;" class="remove-row" data-needremove=".row' + uuid + '"><i class="icon icon-close"></i></a></td>' +
                    '<td colspan="3" class="text-right">' +
                    '<span>Thuộc tính : </span>' +
                    '<span class="options">' + optionNames + '</span>' +
                    '</td>' +
                    '<td>' +
                    '<textarea style="display: none" name="data[ProductList][' + uuid + '][Product][data]">' + pData.val() + '</textarea>' +
                    '<textarea style="display: none" name="data[ProductList][' + uuid + '][Product][option]">' + JSON.stringify(optionIds) + '</textarea>' +
                    '<textarea style="display: none" name="data[ProductList][' + uuid + '][Product][optionName]">' + JSON.stringify(optionNames) + '</textarea>' +
                    '</td>' +
                    '</tr>';
                $('#product-list').append(template);
            }
            updatePrice();
            dialog.dialog("close");
        }
        return valid;
    }

    function buildOptions(itemOptions) {
        var html = '';
        Object.keys(optionData).forEach(function (key, index) {
            var OptionGroup = this[key]['OptionGroup'];
            var Option = this[key]['Option'];
            var item = '', renderIt = false;
            item += '<legend>' + OptionGroup['name'] + '</legend><ul style="display: inline; margin-bottom: 5px">';
            var check = true;
            Object.keys(Option).forEach(function (key, index) {
                var radio = '';
                var compare_id = this[key]['id'];
                var name = this[key]['name'];
                var group_id = this[key]['option_group_id'];
                Object.keys(itemOptions).forEach(function (key, index) {
                    if (compare_id == this[key]['option_id']) {
                        if (check)
                            check = 'checked="checked"';
                        radio += '<li style="display: inline; padding: 5px">' +
                            '<input class="radio-op" data-name="' + name + '" type="radio" name="radio' + group_id + '" value="' + this[key]['option_id'] + '" ' + check + '>' +
                            '<span style="margin-left: 3px">' + name + '</span>' +
                            '</li>';
                        renderIt = true;
                        check = false;
                    }
                }, itemOptions);
                item += radio;
            }, Option);
            check = true;
            item += '</ul>';
            if (renderIt)
                html += item;
        }, optionData);
        optionsList.html(html);
    }

    function updateTips(t) {
        tips
            .text(t)
            .addClass("ui-state-highlight");
        setTimeout(function () {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }

    function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateTips("Length of " + n + " must be between " +
                min + " and " + max + ".");
            return false;
        } else {
            return true;
        }
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

    function removeRow(row) {
        $(row).remove();
        updatePrice();
    }

    function updatePrice() {
        var summary = 0;
        $('#product-list .hidden-qty').each(function () {
            var price = $(this).data('price');
            var qty = $(this).val();
            summary += parseInt(price)* parseInt(qty);
        });
        $('#summary-total').val(summary.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    }

    function uniqId() {
        return Math.round(new Date().getTime() + (Math.random() * 100));
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