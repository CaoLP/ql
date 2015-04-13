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
            '<label class="radio-inline col-lg-6"><input type="radio" name="type" value="1">Vào làm</label>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<label class="radio-inline"><input type="radio" name="type" value="0">Ra về</label>' +
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
            '<a href="javascript:;" class="btn btn-success col-lg-12 submit" onclick="submitForm(this)" data-target="#action_{id}">Xác nhận</a>' +
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
            console.log(ui.item);
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