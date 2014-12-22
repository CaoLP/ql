$(function(){
    $('.dd').nestable({
        maxDepth:2,
        dropCallback: function(details) {

            var order = new Array();
            $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
                order[index] = $(elem).attr('data-id');
            });
            if (order.length === 0){
                var rootOrder = new Array();
                $("#nestable > ol > li").each(function(index,elem) {
                    rootOrder[index] = $(elem).attr('data-id');
                });
            }
            console.log(order);
            console.log(rootOrder);
            console.log(details.sourceId);
            console.log(details.destId);
        }
    }).on('change',function(){
//            console.log(JSON.stringify($('.dd').nestable('serialize')));
        });
});