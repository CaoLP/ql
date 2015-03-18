$(function () {

    var template =
        '<div class="widget" id="action_{id}">' +
            '<div class="widget-header">' +
            '<h4>{name} ({begin} - {end}) - Đã trể {late} phút/ {delay} phút</h4>' +
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
            '</div>' +
            '</div>' +
            '<p></p>' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<button class="btn btn-success col-lg-12 submit" data-target="action_{id}">Xác nhận</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
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
                content= content.replace('{begin}',item.begin);
                content= content.replace('{end}',item.end);
                content= content.replace('{delay}',item.delay);
                html+= content;
                console.log(item);
            });
            $('#select-session').html(html);
        }
    });
});
//1833161723