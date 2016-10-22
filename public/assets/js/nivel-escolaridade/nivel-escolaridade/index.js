$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/nivel_escolaridade/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#nivel-escolaridade-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#nivel-escolaridade-pagination').html(data);
        }
    });
});