<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vendedor;
use App\Venda;

class testController extends Controller
{
    public function getQuery(){

        $query = DB::table('vendedores as v1')
                    ->join('vendas as v2','v1.id','=','v2.id_vendedor')
                    ->select(DB::raw("SUM(v2.valor_venda) as total"))
                    ->get();

                    foreach($query as $value){
                        $total = $value;
                    }

                    return response()->json([
                        'total'=>$total
                    ]);
    }
}
