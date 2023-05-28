<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class SiteController extends Controller {
    public function ler_a_biblia( $versao ) {
        /* "whareHas()": Verifica se no model "versiculo"
            existe algum relacionamento com "livro" */
        $versiculos = Versiculo::whereHas( 'livro', function($query) use($versao) {
            /* "whareHas()": Verifica se no model "livro"
            existe algum relacionamento com "versao" */
            $query->whereHas('versao', function($query) use ($versao) {
                /* "abreviacao" é o nome da coluna na tabela "versoes" */
                $query->where('abreviacao', $versao);
            });
        })->get();
        /* Retorna então após o filtro, somente os versiculos com a
           versão inserida na url /site/{versao}, "nvi" no caso.MN= */
        return response($versiculos, 200);
    }
}
