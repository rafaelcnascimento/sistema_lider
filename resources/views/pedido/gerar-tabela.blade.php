<script type="text/javascript">
    var flag = {{$flag}};
    var url;
    var win;

    if (flag == 1) {
        url = '/gerar-cliente/'+{{$pedido->id}};
        win = window.open(url, '_blank');
        win.focus();
    }

    else if (flag == 2) {
        url = '/gerar-entrega/'+{{$pedido->id}};
        win = window.open(url, '_blank');
        win.focus();
    }

    else {
        url = '/gerar-entrega/'+{{$pedido->id}};
        win = window.open(url, '_blank');
        win.focus();

        url = '/gerar-cliente/'+{{$pedido->id}};
        win = window.open(url, '_blank');
        win.focus();
    }

    close();
</script>
