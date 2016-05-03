// отправляем форму
$(document).ready(function() {

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

});

// функция ответа
function showResponse(response)  {
    clearForm();//очистка формы
    console.dir(response); //консоль

    if(response.ads && response.status=='insert'){
        $(response.ads).appendTo( "#ads>tbody" );
    }
    if(response.ads && response.status=='update'){
            $('td:contains('+response.id+')').parent().replaceWith(response.ads);
    }

    if(response.status=='update' || response.status=='insert'){
        $('#message_info').html(response.message);
        $('#message').removeClass('alert-danger').addClass('alert-success');
        $('#message').show();
    }else{
        $('#message_info').html(response.message);
        $('#message').removeClass('alert-success').addClass('alert-danger');
        $('#message').show();
    }

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
    $.ajax({
        type: "POST",
        data: id,
        url: "/index/get/id/"+id,
        dataType: "json",
        success: function (resp) {
            console.log(resp);
            $("#id").val(resp.id);
            $("#first_name").val(resp.name);
            $("#email").val(resp.email);
            $("#fld_phone").val(resp.phone);
            $("#title_ad").val(resp.title_ad);
            $("#description").val(resp.description);
            $("#price").val(resp.price);
            $("#city [value='"+resp.city+"']").prop("selected", "selected");
            $("#cat [value='"+resp.cat+"']").prop("selected", "selected");
            if(resp.allow_mails==1){
                $("#allow_mails").prop('checked', 'checked');
            }else {
                $("#allow_mails").prop('checked', false);
            }
            if(resp.private==1){
                $('input[name=private][value=1]').prop('checked', 'checked');
                //$('#colorForm').show();
            }else if(resp.private==2) {
                $('input[name=private][value=2]').prop('checked', 'checked');
                //$('#colorForm').hide();
            }
        }
    });
});
