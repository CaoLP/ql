$(function() {
    $( "#product_name" ).autocomplete({
        minLength: 0,
        source: function(request, response){
            $.ajax({
                url: ajax_product_url,
                dataType: 'json',
                data: {
                    q: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        focus: function( event, ui ) {
            $( "#product_name" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
            $('#product_id').val(ui.item.value);
            $('.ui-helper-hidden-accessible').text(ui.item.sku);
            return false;
        }
    });
    $(document).on('click','*[data-event=modal]', function (e) {
        var target = $(this).data('target');
        var id = $(this).data('id');
        $('#product_name').val('');
        $('#product_id').val('');
        $('#media_id').val(id);
        $('#use_as_thumb').attr('checked',false);
        $('#product-modal .icheckbox_flat').removeClass('checked');
    })
});