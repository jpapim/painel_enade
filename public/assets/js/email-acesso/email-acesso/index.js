$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/email-acesso/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#email-acesso-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#email-acesso-pagination').html(data);
        }
    });
});