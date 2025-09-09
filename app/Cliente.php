<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome'];



    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}



