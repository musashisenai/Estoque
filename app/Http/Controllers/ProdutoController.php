<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(Request $request)
    {
        $produto = Produto::Create([
            'marca' => $request->marca,
            'descricao' => $request->descricao,
            'valor_unitario' => $request->valor_unitario,
            'quantidade_estoque' => $request->quantidade_estoque,
            'faixa_etaria_minima' => $request->faixa_etaria_minima
        ]);
        
         return response()->json($produto);
    }
    public function index()
    {
        $produto = Produto::all();
        return response()->json($produto);
    }


    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {

            return response()->json(['mensagem' => 'atualizado com sucesso']);
            $produto->update();
        }

        if (isset($request->id)) {
            $produto->$id = $request->id;
        }
        if (isset($request->marca)) {
            $produto->marca = $request->marca;
        }
        if (isset($request->id)) {
            $produto->descricao = $request->id;
        }
        if (isset($request->id)) {
            $produto->valor_unitario = $request->id;
        }
        if (isset($request->id)) {
            $produto->quantidade_estoque = $request->id;
        }
        if (isset($request->id)) {
            $produto->faixa_etaria_minima = $request->id;
        }

        $produto->update();

         return response()->json([$produto]);
    }

    public function delete($id)
    {
        $produto = Produto::find($id);

          if (!$produto) {

            return response()->json(['mensagem' => 'produto não encontrado']);

          }
        $produto->delete($id);

        return response()->json(["mensagem" => 'produto deletado com sucesso']);
    }
}
