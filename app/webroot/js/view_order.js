$(document).ready(function(){
    $('#cancel-order').on('click',function(){
        $('#cancel-form').submit();
    });
    $('#print-bill').on('click',function(){
       printBill();
    });
});
function printBill(){
    $('.main-container').addClass('A6-main-container');
    $('.dashboard-wrapper').addClass('A6-dashboard-wrapper');
    $('hr').addClass('A6-hr');
    window.print();
}