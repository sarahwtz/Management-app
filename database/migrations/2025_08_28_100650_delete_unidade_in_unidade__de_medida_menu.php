<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class DeleteUnidadeInUnidadeDeMedidaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $kgId = DB::table('unidades')->where('unidade', 'KG')->value('id');
        DB::table('produtos')->where('unidade_id', 1)->update(['unidade_id' => $kgId]);
        DB::table('produto_detalhes')->where('unidade_id', 1)->update(['unidade_id' => $kgId]);
        DB::table('unidades')->where('unidade', 'UN')->delete();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('unidades')->insert([
            'unidade' => 'UN',
            'descricao' => 'Unidade',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        $unId = DB::table('unidades')->where('unidade', 'UN')->value('id');
        $kgId = DB::table('unidades')->where('unidade', 'KG')->value('id');
        DB::table('produtos')->where('unidade_id', $kgId)->update(['unidade_id' => $unId]);
        DB::table('produto_detalhes')->where('unidade_id', $kgId)->update(['unidade_id' => $unId]);


    }
}
