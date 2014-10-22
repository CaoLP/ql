var admin = {
    toggle: function (url, id) {
        if (confirm('Bạn có muốn thức hiện thao tác này không?')) {
            $.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    $('#toggle-' + id).html(response);
                }
            });
        }else{
            return false;
        }
    }
}
$(document).ready(function(){
   $(document).on('click','.table-toggle-expand td',function(){
       var tag = $(this).parent().next('.table-expandable');
       if(tag.hasClass('tb-expanded')) tag.removeClass('tb-expanded');
       else tag.addClass('tb-expanded');
   })
});