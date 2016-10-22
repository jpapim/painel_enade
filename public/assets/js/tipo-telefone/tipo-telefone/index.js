$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/tipo-telefone/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#tipo-telefone-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#tipo-telefone-pagination').html(data);
        }
    });
});