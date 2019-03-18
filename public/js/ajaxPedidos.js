if (pago != 3) {$("#pago").val(pago).change();}

//Pagar
$(document).on('click','.fa-check' ,function(event)
{
    var id = $(this).attr("id").replace('pagar','');

    $.ajax({
        type: 'get',
        url: '/pagarAjax',
        data: {
        'id': id,
    },
    success: function(data) {
        $('#npago'+id).html(data);
        $('#npago'+id).toggleClass('table-danger table-success');
    }});
});        

//Despagar
$(document).on('click','.fa-times' ,function(event)
{
    var id = $(this).attr("id").replace('despagar','');

    $.ajax({
        type: 'get',
        url: '/despagarAjax',
        data: {
        'id': id,
    },
    success: function(data) {
        $('#pago'+id).html(data);
        $('#pago'+id).toggleClass('table-success table-danger');
    }});
});      

//Parcela+
$(document).on('click','.fa-plus' ,function(event)
{
    var id = $(this).attr("id").replace('pmais','');

    $.ajax({
        type: 'get',
        url: '/pmaisAjax',
        data: {
        'id': id,
    },
    success: function(data) {
        $('#parcela'+id).html(data);
    }});
});      

//Parcela
$(document).on('click','.fa-minus' ,function(event)
{
    var id = $(this).attr("id").replace('pmenos','');

    $.ajax({
        type: 'get',
        url: '/pmenosAjax',
        data: {
        'id': id,
    },
    success: function(data) {
        $('#parcela'+id).html(data);
    }});
});      
