<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArquivoController extends Controller
{
    public function arquivoAjax()
    {
        $output = ' <hr>
                    <div class="form-group row">
                    <label for="arquivo" class="col-md-4 col-form-label text-md-right">Arquivo</label>
                        <div class="col-md-6">
                            <input type="file" id="arquivo" class="form-control" name="arquivo[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vence_em" class="col-md-4 col-form-label text-md-right">Data de vencimento</label>
                        <div class="col-md-6">
                            <input id="vence_em" type="text" class="form-control" name="vence_em[]">
                        </div>
                    </div>';

        return Response($output);
    }
}
