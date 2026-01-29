<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function store(Request $request){
    $produto = Produto::find($request->id_produto);  
    
    if(!$produto){
        return response()-> json(['message'=> 'Produto não encontrado']);
    } else {
        $entrada = Entrada::create([
        'id_produto'=> $request-> id_produto,
        'quantidade'=> $request-> quantidade
        ]);

    }

    if(isset($entrada)){
        $produto-> quantidade_estoque += $entrada->quantidade;
    }
    
    $produto-> update();
        return response()-> json($entrada);
        
    }

    public function index(){
        $entrada = Entrada::all();

        return response()-> json($entrada);
    }

    public function delete($id){
        $entrada = Entrada::find($id);

        if($entrada == null){
            return response()-> json(['message'=> 'Produto não encontrado']);
        }

        $produto = $entrada-> id_produto;

        $quantidade= $entrada-> quantidade;

        $produto = Produto::find($produto);

        if(isset($produto)){
            $produto-> quantidade_estoque -= $quantidade;
        }

        $produto-> update();

        $entrada-> delete($id);

        return response()-> json(['Produto deletado']);
    }
}