$(function() {
    $( "#product_name" ).autocomplete({
        minLength: 1,
        autoFocus: true,
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
            event.preventDefault();
            $(".ui-menu-item:first a").click();
        },
        select: function( event, ui ) {
            $('#product_id').val(ui.item.value);
            $('#pro-name').text(ui.item.name);
            $('.drop-area .media-object').attr('src',ui.item.image);
            $('.ui-helper-hidden-accessible').text('');
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
    });
//    $('#filelist .item').draggable({
//        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
//        revert: "invalid", // when not dropped, the item will revert back to its initial position
//        containment: "document",
//        helper: "clone",
//        cursor: "move"
//    });
//
//    $('#drop-area').droppable({
//        accept: ".item",
//        activeClass: "ui-state-highlight",
//        drop: function( event, ui ) {
//            insertItem(ui.draggable );
//        }
//    });

    $(document).on('click','#drop-area .item',function(e, ui){
        var $item = $( this );
        recycleImage( $item );
    });
    $(document).on('click','#filelist .import',function(e, ui){
        var $item = $(this).closest('.item');
        insertItem( $item );
    });
    $(document).on('click','.save-media',function(){
        var data = {
            id : $('#product_id').val(),
            media_id : []
        };
        $('#drop-area .item input').each(function(i,u){
            data.media_id.push($(u).val());
        });
        if(data.id == -1 || data.media_id.length == 0){
            return false;
        }
        $.ajax({
            url: ajax_media_url,
            data : data,
            type : 'post',
            beforeSend: function(){
                $('.save_media').attr('disabled','disabled');
            },
            success: function(data){
                if(data){
                    $('#product_id').val(-1);
                    $('#pro-name').text('Tên sản phẩm');
                    $('.drop-area .media-object').attr('src','http://placehold.it/150x200');
                    $('#drop-area').html('');
                }else{
                     alert('lỗi thêm hình !');
                }
                $('.save_media').removeAttr('disabled');
            }
        });
    });
});
function insertItem( $item ) {
    $item.fadeOut(function() {
        var $list = $('#drop-area');
        $item.find('.actions').hide();
        $item.appendTo( $list ).fadeIn();
    });
}
function recycleImage( $item ) {
    $item.fadeOut(function() {
        $item.find('.actions').show();
        $item
            .appendTo( $('#filelist') )
            .fadeIn();
    });
}