<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertNewUnidadesInUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::table('unidades')->insert([
            ['unidade' => 'KG', 'descricao' => 'Quilograma', 'created_at' => now(), 'updated_at' => now()],
            ['unidade' => 'L',  'descricao' => 'Litro',      'created_at' => now(), 'updated_at' => now()],
            ['unidade' => 'CM', 'descricao' => 'Centímetro','created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::table('unidades')->whereIn('unidade', ['KG', 'L', 'CM'])->delete();
    }
}
