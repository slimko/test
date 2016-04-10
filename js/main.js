//$(document).ready(function() {
//
//    $('a.delete').on('click', function () {
//        var tr = $(this).closest('tr');
//        var id = tr.children('td:first').html();
//         $.getJSON('https://xaver.loc/index/del/id/'+id,
//            null,
//            function (response) {
//                 tr.fadeOut('slow', function () {
//                    var numOfVisibleRows = $('tbody>tr').length;
//
//                    if(numOfVisibleRows==1){
//                        $('#message_info').html('Объявлений нет в базе');
//                        $('#message').removeClass('alert-danger');
//                        $('#message').show();
//                    }
//                    else if(response.status=='success'){
//                        $('#message_info').html(response.message);
//                        $('#message').removeClass('alert-danger').addClass('alert-success');
//                        $('#message').show();
//                    }else{
//                        $('#message_info').html(response.message);
//                        $('#message').removeClass('alert-success').addClass('alert-danger');
//                        $('#message').show();
//                    }
//                    $(this).remove();
//                });
//            });
//    });
//});

// prepare the form when the DOM is ready
$(document).ready(function() {
    var options = {
        target:        '#output1',   // target element(s) to be updated with server response
        beforeSubmit:  showRequest,  // pre-submit callback
        success:       showResponse  // post-submit callback

        // other available options:
        //url:       url         // override for form's 'action' attribute
        //type:      type        // 'get' or 'post', override for form's 'method' attribute
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit

        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

    // bind form using 'ajaxForm'
    $('#myform').ajaxForm(options);
});
