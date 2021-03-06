//91010MX27
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
        pRetailPrice = $("#p-retail_price"),
        pData = $("#p-data"),
        pOptions = $("#p-options"),
        pLimit = $("#p-limit"),
        pWarehouse = $("#p-warehouse"),
        pOptionsName = $("#p-optionsName"),
        allFields = $([]).add(qty).add(pId).add(pData).add(pPrice).add(pRetailPrice).add(pSku).add(pName).add(pOptions).add(pOptionsName),
        tips = $(".validateTips");
    updatePrice();
    var store_id = '';
    $('#InoutWarehouseStoreId').on('change',function(){
        store_id = $(this).val();
    });
    $('#InoutWarehouseStoreId').trigger('change');

    $('input,select').on("keyup keypress", function(e) {
        var code = e.keyCode || e.which;
        if (code  == 13) {
            e.preventDefault();
            return false;
        }
    });
    dialog = $("#dialog-form").dialog({
        autoOpen: false,
        height: 200,
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
        }
    });
    form = dialog.find("form").on("submit", function (event) {
        event.preventDefault();
        addProduct();
    });

    qty.on('keyup',function(e){
        var code = e.keyCode || e.which;
        if (code  == 13) {
            form.submit();
        }
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
//            this.value = (ui.item ? ui.item.Product.name : '');
            pId.val(ui.item.Product.id);
            pSku.val(ui.item.Product.code);
            pName.val(ui.item.Product.name);
            pPrice.val(ui.item.Product.price);
            pRetailPrice.val(ui.item.Product.retail_price);
            pData.val(JSON.stringify(ui.item.Product));
            pOptions.val(ui.item.Product.options);
            pLimit.val(ui.item.Product.qty);
            pWarehouse.val(ui.item.Product.warehouse);
            pOptionsName.val(ui.item.Product.optionsName);
            dialog.dialog("open");
            $("#p-search").val('');
            qty.focus();
            return false;
        },

        // The rest of the options are for configuring the ajax webservice call.
        minLength: 1,
        autoFocus: true,
        focus: function( event, ui ) { event.preventDefault();
            $(".ui-menu-item:first a").click();
        },
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
    $(document).on('submit','#InoutWarehouseAdminChangeTransferForm',function(e){
        var canSubmit = true;
        $('.hidden-qty-text input').each(function(){
            if(parseInt($(this).data('limit')) < parseInt($(this).val())){
                canSubmit = false;
                return false;
            }
        });
        if(canSubmit==false){
            alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
            e.preventDefault();
        }
    });
    $(document).on('click', '.remove-row', function () {
        if (confirm("Bạn có muốn xoá sản phẩm này không?")) {
            var id = $(this).data('needremove');
            $(id).remove();
            updatePrice();
        }
    });
    $(document).on('keypress','#product-list tr .hidden-qty',function(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!/\d/.test(charStr)) {
            return false;
        }
    });
    $(document).on('keyup mouseup change', '#product-list tr .hidden-qty', function (e) {
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
            removeError($(this));
        }
        if (!isNaN(qty) && qty != '') {
            var sPrice = $(this).data('price');
            var total = $(this).val() * sPrice;
            $(this).closest('tr').find('.total-price').text(digits(total));
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
    $( ".datepicker" ).datepicker({
        showOn: "button",
        buttonImage: "/img/dateIcon.png",
        buttonImageOnly: true,
        buttonText: 'Chọn ngày',
        dateFormat : 'yy-mm-dd',
        minDate: 0,
        maxDate: "+1M +10D"
    });
    function addProduct() {
        var valid = true;
        allFields.removeClass("ui-state-error");
        valid = valid && checkRegexp(qty, /^[0-9]+$/i, "Số lượng chỉ có thể là số");
        if (valid) {
            var qtyVal, optionNames = '', optionIds = '', price, subPrice;
            qtyVal = qty.val();
            optionIds  = pOptions.val();
            optionNames = pOptionsName.val();
            var duplicated = false;

            $('#product-list tr').each(function () {
                var listId = $(this).data('id');
                var code =  pSku.val();
                if (code == listId) {
                    duplicated = true;
                    var hiddenQty = $(this).find('.hidden-qty');
                    var limit = pLimit.val();
                    var to = parseInt(hiddenQty.val()) + parseInt(qtyVal);
                    if(to > parseInt(limit)){
                        alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
                        to = limit;
                        removeError(hiddenQty);
                       // return false;
                    }
                    hiddenQty.val(to);
                    //$(this).find('.hidden-qty-text').text(hiddenQty.val());
                    var newPrice = hiddenQty.val();
                    newPrice = newPrice * pPrice.val();
                    $(this).find('.total-price').text(digits(newPrice));
                    return false;
                }
            });
            if (!duplicated) {
                var limit = pLimit.val();
                if(qtyVal > parseInt(limit)){
                    alert('Số lượng nhập không được lớn hơn số lượng hàng trong kho');
                    qtyVal = limit;
                    return false;
                }

                subPrice = pPrice.val() * 1;
                price = qtyVal * subPrice;
                var uuid = uniqId();
                var template = '<tr class="first-tr row' + uuid + '" data-id="' + pSku.val() + '">' +
                    '<td>' + pSku.val() + '</td>' +
                    '<td>' + pName.val() + '</td>' +
                    '<td><span class="price-text">' + digits(subPrice) + '</span></td>' +
                    '<td class="hidden-qty-text">' +
                    '<a href="javascript:;" class="price-down"><i class="icon icon-arrow-down"></i></a>' +
                    '<input type="text" class="hidden-qty" data-limit="' + pLimit.val() + '" data-price="' + subPrice + '" ' +
                    'name="data[InoutWarehouseDetail][' + uuid + '][qty]" value="' + qtyVal + '">' +
                    '<a href="javascript:;"  class="price-up"><i class="icon icon-arrow-up"></i></a>' +
                    '<strong> of ('+pLimit.val()+')</strong></td>' +
                    '<td><span class="price-text total-price">' + digits(price) + '</span></td>' +
                    '</tr>' +
                    '<tr class="last-tr row' + uuid + '">' +
                    '<td class="text-left"><a href="javascript:;" class="remove-row" data-needremove=".row' + uuid + '"><i class="icon icon-close"></i></a></td>' +
                    '<td colspan="3" class="text-right">' +
                    '<span>Thuộc tính : </span>' +
                    '<span class="options">' + optionNames + '</span>' +
                    '</td>' +
                    '<td>' +
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][product_id]" value="' + pId.val() + '">'+
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][inout_warehouse_id]" value="' + inout_warehouse_id + '">'+
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][sku]" value="' + pSku.val() + '">'+
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][price]" value="' + subPrice + '">'+
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][retail_price]" value="' + pRetailPrice.val() + '">'+
                    '<input type="hidden" name="data[InoutWarehouseDetail][' + uuid + '][name]" value="' + pName.val() + '">'+
                    '<textarea style="display: none" name="data[InoutWarehouseDetail][' + uuid + '][options]">' +optionIds + '</textarea>' +
                    '<textarea style="display: none" name="data[InoutWarehouseDetail][' + uuid + '][option_names]">' + optionNames + '</textarea>' +
                    '</td>' +
                    '</tr>';
                $('#product-list').append(template);
            }
            updatePrice();
            dialog.dialog("close");
        }
        return valid;
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
        $('#summary-total').val(digits(summary));
    }

    function uniqId() {
        return Math.round(new Date().getTime() + (Math.random() * 100));
    }
    function digits(number){
        return number.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    function removeError(input){
        input.removeClass('error-input');
        input.removeClass('text-error');
        input.parent().removeClass('bg-danger');
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