$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/conta-bancaria/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#conta-bancaria-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#conta-bancaria-pagination').html(data);
        }
    });
});