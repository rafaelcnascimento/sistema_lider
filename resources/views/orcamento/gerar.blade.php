<script type="text/javascript">
    var url = '/gerar-orcamento/'+{{$orcamento->id}};
    var win = window.open(url, '_blank');
        win.focus();

    location.replace("/pedido-novo")  
</script>

