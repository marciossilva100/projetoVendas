@extends('layout.layout')

@section('estilo')
    <link rel="stylesheet" type="text/css" href="style/style.css" />
@endsection

@section('conteudo')
<?php
use Illuminate\Support\Facades\DB;

$busca = DB::select('SELECT v1.id,v1.email,v1.nome,v2.valor_venda,v2.created_at,v2.comissao,SUM(v2.comissao) as soma FROM vendedores AS v1 INNER JOIN vendas v2 ON(v1.id=v2.id_vendedor) GROUP BY v1.email');
?>
    <div class="row box-btn">
        {{-- <div class="col-md-1"></div> --}}
        <div class="col-md-6  text-center">
            <div class="btn-group">
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-cadastrar">Cadastrar vendedor</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-listar-vendedores">Listar vendedores</button>
            <button type="button" class="btn btn-outline-success btn-sm" id="btn-nova-venda">Nova venda</button>
            </div>                   
        </div>
        <div class="col-md-6 input-group">
            <label for="" class="col-form-label">Listar vendas</label>             
                <select class="custom-select" id="select-vendas" style="margin-left:20px" aria-label="lista de vendas"></select>
                <div class="input-group-append" id="button-addon4">
                  <button class="btn btn-outline-secondary" id="btn-buscar-lista" type="button">Buscar</button>
                  <button class="btn btn-outline-secondary" id="btn-reload" type="button">Atualizar</button>
                </div>  
              </div>

    </div>
    <div class="row justify-content-center" id="box-conteudo"></div>

@endsection

@section('script')

    {{-- PLUGIN JQUERY PARA MASCARAS --}}
        {{-- <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           --}}
        <script src="js/mascara/jquery.mask.min.js"></script>          
    {{-- END --}}
    <script src="js/cadastro.js"></script>
    <script src="js/lista-vendedores.js"></script>
    <script src="js/cadastro-vendas.js"></script>
    <script src="js/vendas.js"></script>
@endsection