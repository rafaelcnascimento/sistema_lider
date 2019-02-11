//CSRF token
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

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
$(document).on('keyup','.qtd input' ,function(event)
{
    var tecla = event.which;
    
    if (tecla === 13) {
        event.preventDefault();

        var value = $(this).attr('id');
        var row = $('#row' + value).closest("tr");
        var columns = row.find('td');
        var valores = [];
           
        $.each(columns, function(i, item) {
            valores[i] = item.innerHTML;
        });

        var id = valores[0]; 
        var estoque = +valores[3];
        var preco = converterPreco(valores[4]);

        var quantidade = +$('#'+valores[0]).val();
        
        if (quantidade == '') {
            alert("Informe a quantidade");
            return false;
        }

        if (isNaN(quantidade)) {
            alert("Use apenas numeros");
            return false;
        }

        if (quantidade > estoque) {
            alert("Quantidade maior que o estoque");
        }
        
        $.ajax({
            type: 'get',
            url: '/adicionarProduto',
            data: {
                'item': id,
                'quantidade':quantidade
            },
            success: function(data) {
                $('.carrinho').append(data);
                
                var valor = $('#valor').val();
                valor = +valor;
                valor = valor + (preco * quantidade);
                $('#valor').val(valor);
            }
        });
    }
});

 //Remove



function converterPreco(valor)
{
    var preco = valor.substring(3);

    preco = +preco.replace(/,/g, ".")

    return preco;
}
