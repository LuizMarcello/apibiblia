<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class SiteController extends Controller {
    public function index() {
        /* Relacionamento de "livro" com "versículo" */
        $versiculoDoDia = Versiculo::with(['livro'])->find(rand(1, 31062));

        return response()->json($versiculoDoDia);
    }

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
            //})->capitulo($capitulo)
            /* Usando os "Scope Filters": Aqui e no Model "Versiculos.php" */
            })->filters(['capitulo' => $capitulo, 'versiculo' => $versiculo])
               /* "when()": Quando a variável "$capitulo" tiver algum valor
                   ele entra na função, senão tiver valor, não faz o filtro,
                   porque ele não é um parâmetro obrigatório na url */
                //->when($capitulo, function($query) use($capitulo) {
                //$query->where('capitulo', $capitulo);
                /* "when()": Quando a variável "$versículo" tiver algum valor
                   ele entra na função, senão tiver valor, não faz o filtro,
                   porque ele não é um parâmetro obrigatório na url */
            //})
            ->get();
        /* Retorna então após o filtro, somente os versiculos com a
           versão(nvi no caso), livro, capitulo e versiculo inseridos
           na url /site/{versao}/{livro?}/{capitulo?}/{versiculo?} */
        //return response($versiculos, 200);
        return response()->json($versiculos);
    }
}
