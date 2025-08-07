$(document).ready(function () {
    $('#campo').keyup(function () {
        $('#busca').submit(function () {
            var dados = $(this).serialize();
            $.ajax({
                url: 'filtroLider.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function (data) {
                    $('#resultado').empty().html(data);
                }
            });
            return false;
        });
        $('#busca').trigger('submit');
    });
});

$(document).ready(function () {
    $('#campoPart').keyup(function () {
        $('#buscaPart').submit(function () {
            var dados = $(this).serialize();
            $.ajax({
                url: 'filtroPart.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function (data) {
                    $('#resultadoPart').empty().html(data);
                }
            });
            return false;
        });
        $('#buscaPart').trigger('submit');
    });
});

$(document).ready(function () {
    $('#filtro').keyup(function () {
        $('#buscaRelatorio').submit(function () {
            var dados = $(this).serialize();
            $.ajax({
                url: 'filtroRelatorio.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function (data) {
                    $('#resultadoFiltro').empty().html(data);
                }
            });
            return false;
        });
        $('#buscaRelatorio').trigger('submit');
    });
});