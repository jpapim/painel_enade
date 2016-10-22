$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/departamento/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#departamento-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#departamento-pagination').html(data);
        }
    });
});