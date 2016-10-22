$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/produto_pessoa/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#produto-pessoa-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#produto-pessoa-pagination').html(data);
        }
    });
});