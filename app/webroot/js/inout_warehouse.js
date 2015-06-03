$(".info").popover();

$('body').on('click', function (e) {
    $('.info').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});
Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});
$(function () {
    $(".datepicker").datepicker({
        showOn: "button",
        buttonImage: "/img/dateIcon.png",
        buttonImageOnly: true,
        buttonText: 'Chọn ngày',
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        maxDate: "+1M +10D"
    });
});
function exportFile(key){
    $('#clickInoutWarehouse'+key).closest('form').submit();
}