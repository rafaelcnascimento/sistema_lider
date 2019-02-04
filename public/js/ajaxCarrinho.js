//Busca
$('#busca').on('keyup', function() {
    $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '/checkoutAjax',
        data: {
            'search': $value
        },
        success: function(data) {
            $('.resultado').html(data);
        }
    });
})
//Enter 
$('.qtd').on('keydown', function(e)
{
    var tecla = event.which;
    if (tecla === 13) {
        event.preventDefault();

        var row = jQuery(this).closest('tr');
        var columns = row.find('td');
        var valores = [];
           
        jQuery.each(columns, function(i, item) {
            valores[i] = item.innerHTML;
        });

        var id = valores[0];
        var estoque = +valores[3];
        var quantidade = +$('#qtd' + valores[0]).val();

        //alert(typeof(quantidade));
        
        if (quantidade == '') {
            alert("Informe a quantidade");
            return false;
        }

        if (isNaN(quantidade)) {
            alert("Use apenas numeros");
            return false;
        }

        if (quantidade > estoque) {
            alert(quantidade + ">" + estoque);
        }
        
        // $.ajax({
        //     type: 'get',
        //     url: '/carrinhoAjax',
        //     data: {
        //         'item': value,
        //         'quantidade':qtd
        //     },
        //     success: function(data) {
        //         $('.cart').append(data);
        //     }
        // });
    }
});
