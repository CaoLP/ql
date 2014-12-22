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
    $('#attendance form input').on('keyup keypress',function(e){
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });
    $('#attendance #attendance-btn').on('click',function(e){
        $('#attendance-msg').html('');
        var msgTemplate = '' +
            '<div class="alert alert-error alert-dismissible" role="alert">'+
            '   <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
            '{msg}' +
            '</div>';
        var msgTemplateSuccess = '' +
            '<div class="alert alert-success alert-dismissible" role="alert">'+
            '   <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
            '{msg}' +
            '</div>';
        if($('#attendance #Code').val()==''){
            $('#attendance-msg').html(msgTemplate.replace('{msg}','Vui lòng điền mã nhân viên'));
            return false;
        }
        if ($("input[type=radio]:checked").length <= 0){
            $('#attendance-msg').html(msgTemplate.replace('{msg}','Vui lòng chọn loại điểm danh'));
            return false;
        }
        $.ajax({
            url: attendancelink,
            data: $('#attendance form').serialize(),
            type: 'post',
            dataType: "json",
            success: function(response){
                if(response.code !='undefined'){
                    if(response.code == 0)
                        $('#attendance-msg').html(msgTemplate.replace('{msg}',response.msg));
                    else if(response.code == 1){
                        $('#attendance-msg').html(msgTemplateSuccess.replace('{msg}',response.msg));
                        $('#attendance').modal('hide');
                    }
                }
            }
        });
    });
    $( ".datepicker2" ).datepicker({
        showOn: "button",
        buttonImage: "/img/dateIcon.png",
        buttonImageOnly: true,
        buttonText: 'Chọn ngày',
        dateFormat : 'yy-mm-dd'
    });
    $( ".datepicker3" ).datepicker({
        buttonText: 'Chọn ngày',
        dateFormat : 'yy-mm-dd'
    });
    $('#real-log-btn').on('click',function(){
        $('#real-log-btn').hide();
        $('#real-log').css('right','0px');
        $.ajax({
            url : '/admin/action_logs',
            beforeSend: function(){
                $('#realtime-log').html('<img src="/img/select2-spinner.gif">');
            },
            success: function(response){
                $('#realtime-log').html(response);
            }
        });
    });
    $('#real-log-close').on('click',function(){
        $('#real-log').css('right','-350px');
        $('#real-log-btn').show();
    });
});