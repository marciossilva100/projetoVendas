<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendedor;
use App\Venda;
use Illuminate\Support\Facades\DB;

class vendasController extends Controller
{
    // CALCULA A COMISSAO DO VENDEDOR
    public function calculoComissao($valor){
        $comissao = 8.5 * $valor;
        $comissao = $comissao / 100;

        return $comissao;
    }

    public function index(Request $request)
    {
    //    $busca = DB::select('SELECT v1.id,v1.email,v1.nome,v2.valor_venda,v2.created_at,v2.comissao,SUM(v2.comissao) as soma FROM vendedores AS v1 INNER JOIN vendas v2 ON(v1.id=v2.id_vendedor) GROUP BY v1.email');
            $busca = DB::table('vendedores as v1')
                    ->leftjoin('vendas as v2','v1.id','=','v2.id_vendedor')
                    ->select('v1.id','v1.email','v1.nome','v2.comissao','v2.valor_venda','v2.created_at',DB::raw("SUM(v2.comissao) as soma"))
                    ->groupBy('v1.email')
                    ->get();

            $count = $busca->count();
            foreach($busca as $value){

                $id[] = $value->id;
                $nome[] = $value->nome;
                $email[] = $value->email;
                $valor_venda[] = $value->valor_venda;
                $data[] = $value->created_at;
                if($value->comissao == null):
                    $comissao[] = 0;
                    $soma[] = 0;
                else: 
                    $comissao[] = $value->comissao;
                    $soma[] = $value->soma;
                endif;
                    
            }
            return response()->json([
                'id'=>$id, 
                'nome'=>$nome,
                'email'=>$email,
                'valor_venda'=>$valor_venda,
                'data'=>$data,
                'comissao'=>$comissao,
                'soma'=>$soma,
                'count'=>$count
            ]);
        
            return Vendedor::all();
        
    }

 
    public function store(Request $request)
    {
            // cod == 1: Classe Vendedor
            // cod == 2: Classe Venda
            if($request->cod == 1):
                $unique = Vendedor::select('email')->where('email',$request->email);
                $count = $unique->count();
                if($count): 
                    $response = false;
                    $msg = 'Email ja existe, escolha outro';    
                else:
                    $response = true;
                    $msg = 'Cadastro realizado com sucesso!';
                    $vendedor = new Vendedor;
                    $vendedor->nome = $request->nome;
                    $vendedor->email = $request->email;

                    $vendedor->save();
                endif;
            elseif($request->cod == 2):  
                    // $valor_venda = str_replace(".","",$request->valor_venda);
                    $valor_venda = number_format($request->valor_venda, 2, '.', '');
                    // $valor_venda = str_replace(",","",$valor_venda);

                    $comissao = vendasController::calculoComissao($request->valor_venda);
                    $venda = new Venda;
                    $venda->id_vendedor = $request->id_vendedor;
                    $venda->valor_venda = $valor_venda;
                    $venda->comissao = $comissao;
                    $venda->save();

                    $response = true;
                    $msg = 'Venda realizada com sucesso!';
            endif;
        

        return response()->json([
            'success'=>$response, 
            'message'=>$msg
        ]);
    }

 
    public function show($id)
    {
        $busca = DB::table('vendedores as v1')
                    ->leftjoin('vendas as v2','v1.id','=','v2.id_vendedor')
                    ->select('v1.id','v1.email','v1.nome','v2.comissao','v2.valor_venda','v2.created_at')
                    ->where('v1.id',$id)
                    ->get();
                    $count = $busca->count();
        foreach($busca as $value){

            $id_vendedor[] = $value->id;
            $nome[] = $value->nome;
            $email[] = $value->email;
            $valor_venda[] = $value->valor_venda;
            $data[] = $value->created_at;
            if($value->comissao == null):
                $comissao[] = 0;
            else: 
                $comissao[] = $value->comissao;
            endif;
                    
        }
        return response()->json([
            'id'=>$id_vendedor, 
            'nome'=>$nome,
            'email'=>$email,
            'valor_venda'=>$valor_venda,
            'data'=>$data,
            'comissao'=>$comissao,
            'count'=>$count
        ]);

    }


    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
