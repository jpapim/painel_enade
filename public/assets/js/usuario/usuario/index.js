$(function () {

    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/s_pessoa/index-pagination',
        async: true,
        data: {
        },
        beforeSend: function () {

            $('#s_pessoa-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {

            $('#s_pessoa-pagination').html(data);
        }
    });
});