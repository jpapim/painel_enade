$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/pessoa_juridica/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#pessoa-juridica-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#pessoa-juridica-pagination').html(data);
        }
    });
});