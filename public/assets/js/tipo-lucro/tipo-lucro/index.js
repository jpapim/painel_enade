$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/tipo_lucro/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#tipo-lucro-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#tipo-lucro-pagination').html(data);
        }
    });
});