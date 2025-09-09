<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos () {
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');
        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'quantidade', 'created_at', 'updated_at');

        /*Parametros
          
        1 - Modelo do relacionamento NxN em relacao ao Modelo que estamos implementando
        2 - tabela auxiliar que armazena os registros de relacionamento
        3 - Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
        4 - Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando.
        */
     }

     public function cliente()
     {
         return $this->belongsTo(Cliente::class);
     }



   
}
           
