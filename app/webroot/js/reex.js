$(function(){
    $(":input").inputmask();
    $('#ReexCause').on('change',function(){
       if($(this).val() == 'other'){
           $(this).attr('name','temp');
           $('#temp_div').show();
           $('#temp').attr('name','data[Reex][cause]');
           $('#temp').focus();
       }else{
           $(this).attr('name','data[Reex][cause]');
           $('#temp_div').hide();
           $('#temp').attr('name','temp');
       }
    });
});
