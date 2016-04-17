// prepare the form when the DOM is ready
$(document).ready(function() {

    // post-submit callback
    function showResponse(response)  {
        alert(response);
        //clearForm();//очистка формы
        //console.dir(response); //консоль
        //if(response.ads){
        //    $(response.ads).appendTo( "#ads>tbody" );
        //}
        ////$('#ads>tbody').append(response.ads);
        //if(response.status=='success'){
        //    $('#message_info').html(response.message);
        //    $('#message').removeClass('alert-danger').addClass('alert-success');
        //    $('#message').show();
        //}else{
        //    $('#message_info').html(response.message);
        //    $('#message').removeClass('alert-success').addClass('alert-danger');
        //    $('#message').show();
        //}

    }
    //функция очистки формы
    function clearForm(){
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
    }

    var options = {
        target:        '#message_info',   // target element(s) to be updated with server response
        //beforeSubmit:  showRequest,  // pre-submit callback
        success:       showResponse,  // post-submit callback

        // other available options:
        url:'/index/post',        // override for form's 'action' attribute
        type:'post',      // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json'         // 'xml', 'script', or 'json' (expected server response type) данные ответа
        //clearForm: true,        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit

        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

    // bind form using 'ajaxForm'
    $('#myform').ajaxForm(options);



//обрабатываем удаление
$(document).on('click','a.delete',function(){
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
         $.getJSON('/index/del/id/'+id,
            null,
            function (response) {
                 tr.fadeOut('slow', function () {
                    var numOfVisibleRows = $('tbody>tr').length; //количество tr

                    if(numOfVisibleRows==1){
                        $('#message_info').html('Объявлений в базе больше нет');
                        $('#message').removeClass('alert-danger');
                        $('#message').show();
                    }else{
                     showResponse(response); //показываем ответ
                    }
                    $(this).remove();
                     //очистка формы нашей функцией
                     clearForm();
                });
            });
    });

//обрабатываем редактирование
    $(document).on('click','a.edit',function(){
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        $.getJSON('/index/get/id/'+id,
            null,
            function (response) {
                console.dir(response); //консоль
                $('#forma').html(response);
/*                tr.fadeOut('slow', function () {
                    var numOfVisibleRows = $('tbody>tr').length; //количество tr

                    if(numOfVisibleRows==1){
                        $('#message_info').html('Объявлений в базе больше нет');
                        $('#message').removeClass('alert-danger');
                        $('#message').show();
                    }else{
                        showResponse(response); //показываем ответ
                    }
                    $(this).remove();
                    //очистка формы нашей функцией
                    clearForm();
                });*/
            });
    });

});
