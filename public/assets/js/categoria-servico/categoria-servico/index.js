$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/categoria-servico/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#categoria-servico-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#categoria-servico-pagination').html(data);
        }
    });
});