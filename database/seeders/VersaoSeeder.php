<?php

namespace Database\Seeders;

use App\Models\Versao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VersaoSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        Versao::create( [ 'nome' => 'Nova versão Internacional',
        'abreviacao' => 'NVI', 'idioma_id' => 1 ] );
    }
}
