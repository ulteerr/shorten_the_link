function deleteLink(id) {
    $.ajax({
        url: '/',
        type: 'POST',
        cache: false,
        data: {'id' : id},
        dataType: 'html',
        success: function(data) {
            $('#' + id).remove();
        }
    });
}