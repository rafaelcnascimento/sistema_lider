@extends('master')
@section('corpo')
<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <center>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="busca" id="busca" placeholder="Buscar">
                </div>
            </center>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th class="w-50">Material</th>
                    <th>Unidade</th>
                    <th class="w-25">Preço</th>
                    <th>Qtd</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div style="width: 110%;">
                                <input id="quantidade" type="text" class="form-control" name="quantidade">
                            </div>
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
        <div class="col-7">
            One of three columns
        </div>
    </div>
</div>    
@endsection

@section('js')
    <script type="text/javascript">
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
    </script>
@endsection
