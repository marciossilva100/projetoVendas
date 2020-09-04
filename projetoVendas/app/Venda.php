<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = "vendas";
    protected $fillable = [
        'id_vendedor', 'comissao', 'valor_venda',
    ];
}
