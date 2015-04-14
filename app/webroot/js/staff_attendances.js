//Users time
var localTime = new Date();
var millDiff = localTime - serverTime;

window.onload=function(){
    //set the interval so clock ticks
    var timeClock=setInterval("TimeTick()",10);
}
function TimeTick(){
    //grab updated time
    var timeLocal = new Date();
    //add time difference
    timeLocal.setMilliseconds(timeLocal.getMilliseconds() - millDiff);
    var dateString = timeLocal.getHours() + ":" + timeLocal.getMinutes()+ ":" + timeLocal.getSeconds();
    //display the value
    document.getElementById("timer").innerHTML = dateString;
}
$(function () {
    var template =
        '<div class="widget" id="action_{id}">' +
            '<form method="post" action="'+submitLink+'">'+
            '<div class="widget-header">' +
            '<h4>{name} ({begin} - {end}) - Được phép trể {delay} phút</h4>' +
            '</div>' +
            '<div class="widget-body">' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<div class="col-lg-6">' +
            '<label class="radio-inline col-lg-6"><input type="radio" {d1} name="type" value="1">Vào làm</label>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<label class="radio-inline"><input type="radio" name="type" {d2} value="2">Ra về</label>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<p></p>' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<textarea class="col-lg-12" name="note"></textarea>' +
            '<input type="hidden" name="staff_id" value="{staffId}">'+
            '<input type="hidden" name="staff_work_session_id" value="{staffWorkSession}">'+
            '<input type="hidden" name="delay" value="{delay}">'+
            '<input type="hidden" name="begin" value="{begin}">'+
            '<input type="hidden" name="end" value="{end}">'+
            '</div>' +
            '</div>' +
            '<p></p>' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<a href="javascript:;" class="btn btn-success col-lg-12 submit" {disabled} onclick="submitForm(this)" data-target="#action_{id}">Xác nhận</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</form>' +
            '</div>';
    $("#p-search").autocomplete({
        source: linkUsers,
        minLength: 10,
        autoFocus: true,
        focus: function (event, ui) {
            event.preventDefault();
            $(".ui-menu-item:first a").click();
        },
        select: function (event, ui) {
            var html = '';
            $.each(ui.item.work_session, function (index, item) {
                var content = template;
                content= content.replace(/{id}/g,item.id);
                content= content.replace('{name}',item.name);
                content= content.replace(/{begin}/g,item.begin);
                content= content.replace(/{end}/g,item.end);
                content= content.replace(/{delay}/g,item.delay);
                content= content.replace(/{staffId}/g,ui.item.id);
                content= content.replace(/{staffWorkSession}/g,item.id);
                var d1 = '';
                var d2 = '';
                $.each(item.attended,function(i,it){
                    if(it.begin_time !='0000-00-00 00:00:00') d1 = 'disabled';
                    if(it.end_time !='0000-00-00 00:00:00') d2 = 'disabled';
                });
                var disabled = '';
                if(d1 == 'disabled' && d2 == 'disabled'){
                    disabled = 'disabled';
                }
                content= content.replace(/{d1}/g,d1);
                content= content.replace(/{d2}/g,d2);
                content= content.replace(/{disabled}/g,disabled);
                html+= content;
            });
            $('#select-session').html(html);
        }
    });
});
function submitForm(obj){
    var target = $(obj).data('target');
    var isCheck = $(target + ' input[type=radio]').is(':checked');
    if(isCheck){
        $(target + ' form').submit();
    }else{
        alert('Vui lòng chọn trạng thái làm việc.');
    }
}

//1833161723