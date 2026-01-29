<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function store(Request $request)
    {

        $cliente = Cliente::find($request->id_cliente);
        $produto = Produto::find($request->id_produto);

        if ($cliente->idade < $produto->faixa_etaria_minima) {
            return response()->json(["message" => "Idade insuficiente"]);
        }

        $saida = Saida::Create([
            'id_cliente' => $request->id_cliente,
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade
        ]);

        $produto->quantidade_estoque -= $saida->quantidade;

        $produto->update();
        return response()->json($saida);

    }

    public function index()
    {
        $saida = Saida::all();

        return response()->json($saida);
    }

    public function delete($id)
    {
        $saida = Saida::find($id);

        if (!$saida) {
            return response()->json(['message' => 'Produto não encontrado']);
        }

        $saida->delete($id);

        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
