$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/subcategoria_produto/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#subcategoria-produto-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#subcategoria-produto-pagination').html(data);
        }
    });
});