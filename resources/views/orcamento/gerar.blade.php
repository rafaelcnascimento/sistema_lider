<script type="text/javascript">
    var fechar = {{$fechar}};
    var url = '/gerar-orcamento/'+{{$orcamento->id}};
    var win = window.open(url, '_blank');
        win.focus();

    if (fechar == 1) {close();}

    location.replace("/pedido-novo")  
</script>

