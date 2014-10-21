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