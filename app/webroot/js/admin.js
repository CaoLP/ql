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
       else {
           $('.table-expandable').each(function(){
               $(this).removeClass('tb-expanded');
           });
           tag.addClass('tb-expanded');
       }
   });
    $( ".datepicker2" ).datepicker({
        showOn: "button",
        buttonImage: "/img/dateIcon.png",
        buttonImageOnly: true,
        buttonText: 'Chọn ngày',
        dateFormat : 'yy-mm-dd'
    });
});