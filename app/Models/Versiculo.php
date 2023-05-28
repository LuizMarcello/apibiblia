<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versiculo extends Model
 {
    use HasFactory;

    protected $fillable = [ 'capitulo', 'versiculo', 'texto', 'livro_id' ];

    /* Criando "Scope Filters": Aqui e no SiteController,
       no método "ler_a_biblia" */
    //public function scopeCapitulo( $query, $capitulo ) {
    public function scopeFilters( $query, array  $filters ) {
        if ( $filters[ 'capitulo' ] ) {
            $query->where( 'capitulo', $filters[ 'capitulo' ] );
        }

        if ( $filters[ 'versiculo' ] ) {
            $query->where( 'versiculo', $filters[ 'versiculo' ] );
        }

        return $query;
        // return $query->where( 'capitulo', $capitulo );
        // $query->where( 'versiculo', $versiculo );
    }

    /**
    *  Pega o livro
    */

    public function livro()
 {
        return $this->belongsTo( Livro::class );
    }
}
