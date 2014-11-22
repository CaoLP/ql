$(document).ready(function () {
    if($('#submit-provider').length > 0)
    $('#submit-provider').on('click', function () {
        if($('#ProviderName').val() == '' || $('#ProviderCode').val() == '') return false;
        $.ajax({
            url: '/admin/providers/add',
            type: 'POST',
            data: {
                Provider: {
                    name: $('#ProviderName').val(),
                    code: $('#ProviderCode').val()
                }
            },
            success: function (data) {
                $('#ProductProviderId').html(data);
                $('#ProviderName').val('');
                $('#ProviderCode').val('');
            }
        });
    });
    if($('#submit-option').length > 0)
    $('#submit-option').on('click', function () {
        var option_id = new Array();
        $('input:checkbox:checked').each(function() {
            option_id.push($(this).val());
        });
        if($('#OptionName').val() == '' || $('#OptionCode').val() == '') return false;
        $.ajax({
            url: '/admin/options/add',
            type: 'POST',
            data: {
                Option: {
                    option_group_id: $('#OptionOptionGroupId').val(),
                    name: $('#OptionName').val(),
                    code: $('#OptionCode').val(),
                    other: $('#OptionOther').val()
                },
                ProductOption: {
                    option_id : option_id
                }
            },
            success: function (data) {
                $('#option-list').html(data);
                $('#OptionName').val('');
                $('#OptionCode').val('');
                $('#OptionOther').val('');
            }
        });
    });

    $('.view-img').on('click',function(){
        var images = $(this).data('imagelist');
        console.log(images);
    });
});