$('a.delete').on('click',function() {
    var tr = $(this).closest('tr');
    var id = tr.children('td:first').html();
    $('#message').load('http://xaver.loc/index/del/id/' + id,
        function () {
            tr.fadeOut('slow', function () {
                $(this).remove();
            });
        });
});
