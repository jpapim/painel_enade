$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/comunicado-as-contrato/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#comunicado-as-contrato-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#comunicado-as-contrato-pagination').html(data);
        }
    });
});