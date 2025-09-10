<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateProdutosUnidade extends Migration
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $unId = DB::table('unidades')->where('unidade', 'UN')->value('id');
        $kgId = DB::table('unidades')->where('unidade', 'KG')->value('id');
        
        DB::table('produtos')->where('unidade_id', $kgId)->update(['unidade_id' => $unId]);
    }
}
