$(document).ready(function() {
    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
         $.getJSON('/index/del/id/'+id,
            null,
            function (response) {
                 tr.fadeOut('slow', function () {
                    var numOfVisibleRows = $('tbody>tr').length;

                    if(numOfVisibleRows==1){
                        $('#message_info').html('Объявлений нет в базе');
                        $('#message').removeClass('alert-danger');
                        $('#message').show();
                    }
                    else if(response.status=='success'){
                        $('#message_info').html(response.message);
                        $('#message').removeClass('alert-danger').addClass('alert-success');
                        $('#message').show();
                    }else{
                        $('#message_info').html(response.message);
                        $('#message').removeClass('alert-success').addClass('alert-danger');
                        $('#message').show();
                    }
                    $(this).remove();
                    $(".form-control").each(function() {
                      $( this ).val('');
                    });
                    $( "select" ).each(function() {
                        $( this ).val('null');
                    });
                    $("input[type='checkbox']").each(function() {
                      $( this ).attr('checked',false);
                    });
                    $('input:radio:checked').prop('checked', false);
                    $('input:radio:first').prop('checked', true);

                });
            });
    });
});