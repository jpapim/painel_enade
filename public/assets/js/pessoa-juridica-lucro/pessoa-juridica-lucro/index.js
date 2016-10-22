$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/pessoa_juridica_lucro/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#pessoa-juridica-lucro-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#pessoa-juridica-lucro-pagination').html(data);
        }
    });
});