//CSRF token
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
//Busca
$('#busca').on('keyup', function(event) {
    if(event.which === 13){
        event.preventDefault();

        $('input[name="quantidade"]').first().focus();
    } else {
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
    } 
})

//Saldo
$("#cliente_id").change(function() 
{ 
    id = $(this).val();
    
    $.ajax({
        type: 'get',
        url: '/saldoAjax',
        data: {
            'id': id
        },
        success: function(data) {
            $('.saldo').html(data);
        }
    });
});

//Jogar saldo no valor
$(document).on('change','#saldo', function(event) {
    var valor_pago = +$('#valor_pago').val();
    var saldo = +$(this).val();

    if(this.checked) {
        valor_pago += saldo;
        $('#valor_pago').val(valor_pago);
    } 
    else
    {
        valor_pago -= saldo;
        $('#valor_pago').val(valor_pago);
    }

    var troco;
    var valor = +$('#valor').val();
    
    if (valor_pago > valor) {troco = valor_pago - valor; }

    $('#troco').val(troco);
})

//Troco
$('#valor_pago').on('keyup', function(event) {
    var troco;
    var pago = +$(this).val();
    var valor = +$('#valor').val();
    
    if (pago > valor) {troco = pago - valor; }

    $('#troco').val(troco);
      
})
//Disable enter
$('.valores').on('keydown', function(event)
{
    if (event.which === 13) {
        event.preventDefault();
    }
 });

//Alterar quantidade
$(document).on('keyup','.qtd_cart input' ,function(event)
{
    var id_completo = $(this).attr('id');
    var id = id_completo.replace('q','');
    var quantidade = +$('#'+id_completo).val();

    // if (event.which === 13) 
    // { 
    // }

    if (isNaN(quantidade)) {
        alert("Use apenas numeros");
        return false;
    }

    $.ajax({
        type: 'get',
        url: '/alterarProduto',
        data: {
            'id': id,
            'quantidade':quantidade
        },
        success: function(data) {
            
        }
    });
});

//Adicionar 
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
$(document).on('click','.fa-minus-circle' ,function(event)
{
    var id = $(this).attr("id");
    var tr = $(this).closest('tr');

    $.ajax({
        type: 'get',
        url: '/removerProduto',
        data: {
            'item': id,
        },
        success: function(data) {
            var valor = $('#valor').val();
            var custo = data;
            var valor = valor - custo;
            $('#valor').val(valor);
            tr.remove();
        }
    });
 });

//Input parcelas
$('#pagamento_id').change(function () { 
    var pagamento = $('#pagamento_id option:selected').val();
    if (pagamento == 7) 
    {
        $('.parcelas').html('<div class="form-group row">'+
            '<label for="parcelas" class="col-md-4 col-form-label text-md-right"><b>*Número de Parcelas</b></label>'+
            '<div class="col-md-1">'+
                '<input id="parcelas" type="text" class="form-control" name="parcelas" required autofocus>'+
            '</div>'+
        '</div>');
    }
    else { $('.parcelas').html('')}
 });

function converterPreco(valor)
{
    var preco = valor.substring(3);

    preco = +preco.replace(/,/g, ".")

    return preco;
}
