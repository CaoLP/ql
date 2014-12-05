/**
 * Created by user on 12/4/14.
 */
$(document).ready(function(){
    $('.btn-fill-all').on('click',function(){
        var input = $(this).parent().parent().find('.hidden-qty');
        var limit = input.data('limit');
        input.val(limit).change();
    });
    $('.btn-expand').on('click',function(){
        var position = $('#panel-from-left').css('left');
        if(position=='0px')$('#panel-from-left').css('left','-600px');
        else $('#panel-from-left').css('left','0px');
    });
});