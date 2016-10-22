$(document).ready(function() {
    var wait;
    $("#buscaGenerica").off().on('keyup', function () {
        clearTimeout(wait);
        wait = setTimeout(function() {
            var data = {
                filtroGenerico: $("#buscaGenerica").val()
            };
            console.log(data);
            carregarListaContatos(data);
        }, 1000);
        $(this).data('timer', wait);
    });

    carregarTodosContatos();
});

function carregarListaContatos(data) {
    $.ajax({
        type: "post",
        dataType: "text",
        cache: false,
        url: '/escritorio/contatos-pagination',
        async: true,
        data: data,
        beforeSend: function () {
            $('#contatos-pagination').html(
                '<div class="row"><div class="col-md-12 text-center"><p><img src="/assets/img/carregando.gif"><p></div></div>'
            );
        },
        success: function (data) {
            $('#contatos-pagination').html(data);
        }
    });
}

function carregarTodosContatos() {
    return carregarListaContatos({});
}

function carregarContatosIncompletos() {
    return carregarListaContatos({
        filtroIncompletos: true
    });
}

function carregarFornecedores() {
    return carregarListaContatos({
        filtroFornecedores: true
    });
}

function carregarClientes() {
    return carregarListaContatos({
        filtroClientes: true
    });
}