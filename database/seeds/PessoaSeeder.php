<?php

use App\Entities\Pessoa;
use App\Entities\User;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::truncate();

        $user1 = User::where('name', 'Luigi Bros')->first();
        $user2 = User::where('name', 'Mario Bros')->first();

        Pessoa::create([
            'usuario_id' => $user1->id,
            'endereco' => null,
            'bairro' => null,
            'cidade' => null,
            'numero' => null,
            'uf' => null,
            'cep' => null,
            'pais' => 'Brasil',
            'complemento' => null,
            'tipo_doc' => null,
            'num_doc' => null,
            'data_nasc' => null,
            'sexo' => null,
            'telefone' => null
        ]);

        Pessoa::create([
            'usuario_id' => $user2->id,
            'endereco' => null,
            'bairro' => null,
            'cidade' => null,
            'numero' => null,
            'uf' => null,
            'cep' => null,
            'pais' => 'Brasil',
            'complemento' => null,
            'tipo_doc' => null,
            'num_doc' => null,
            'data_nasc' => null,
            'sexo' => null,
            'telefone' => null
        ]);
    }
}
