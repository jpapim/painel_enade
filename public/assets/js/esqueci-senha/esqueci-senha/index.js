$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/esqueci-senha/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#esqueci-senha-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#esqueci-senha-pagination').html(data);
        }
    });
});