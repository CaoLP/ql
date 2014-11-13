$(document).ready(function () {
    $('#submit-provider').on('click', function () {
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
    $('#submit-option').on('click', function () {
        var option_id = new Array();
        $('input:checkbox:checked').each(function() {
            option_id.push($(this).val());
        });
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
});