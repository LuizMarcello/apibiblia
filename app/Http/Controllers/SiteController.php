<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class SiteController extends Controller {
    /* O parâmetro "livro" não é obrigatório na url */
    /* Se não for colocado, ele recebe "null" e tudo bem  */
    public function ler_a_biblia( $versao, $livro = null, $capitulo = null, $versiculo = null) {
        /* "whareHas()": Verifica se no model "versiculo"
            existe algum relacionamento com "livro" */
            /* "use()" é para não dar o êrro de declarado mas não usado */
        $versiculos = Versiculo::whereHas( 'livro', function($query) use($versao, $livro) {
            /* "whareHas()": Verifica se no model "livro"
            existe algum relacionamento com "versao" */
            $query->whereHas('versao', function($query) use ($versao) {
                /* "abreviacao" é o nome da coluna na tabela "versoes" */
                $query->where('abreviacao', $versao);
            });
            /* "when()": Quando a variável "$livro" tiver algum valor
               ele entra na função, senão tiver valor, não faz o filtro,
               porque ele não é um parâmetro obrigatório na url */
                 $query->when($livro, function($query) use($livro) {
                     $query->where('abreviacao', $livro);
               });
               /* "when()": Quando a variável "$capitulo" tiver algum valor
                   ele entra na função, senão tiver valor, não faz o filtro,
                   porque ele não é um parâmetro obrigatório na url */
            })->when($capitulo, function($query) use($capitulo) {
                $query->where('capitulo', $capitulo);
                /* "when()": Quando a variável "$versículo" tiver algum valor
                   ele entra na função, senão tiver valor, não faz o filtro,
                   porque ele não é um parâmetro obrigatório na url */
            })->when($versiculo, function($query) use ($versiculo) {
                $query->where('versiculo', $versiculo);
            })->get();
        /* Retorna então após o filtro, somente os versiculos com a
           versão(nvi no caso), livro, capitulo e versiculo inseridos
           na url /site/{versao}/{livro?}/{capitulo?}/{versiculo?} */
        return response($versiculos, 200);
    }
}
