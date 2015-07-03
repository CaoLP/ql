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
    $( ".datepicker4" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        buttonText: 'Chọn ngày',
        dateFormat : 'yy-mm-dd',
        showOn: "button",
        buttonImage: "/img/dateIcon.png",
        buttonImageOnly: true
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
    $(document).on('keydown', '*[data-type=number]', function (e) {
        var min = $(this).attr('min');
        var max = $(this).attr('max');
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
            // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }else{
            if(typeof min != "undefined" && typeof min != "undefined"){
                if($(this).val().length == max) {
                    e.preventDefault();
                    return;
                }
            }
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});