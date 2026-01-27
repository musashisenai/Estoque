<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function store(Request $request)
    {
        $entrada = Entrada::Create([
            'id_produto' => $request-> id_produto,
            'quantidade' => $request-> quantidade

        ]);

        return response()->json($entrada);
    }

    public function index() {
        $entrada = Entrada::all();

        return response()->json($entrada);
    }

    public function delete($id)
    {
        $entrada = Entrada::find($id);

        if(!$entrada) {
            return response()-> json(['message'=>'Produto não encontrado']);
        }

        $entrada -> delete($id);

        return response()->json(['message'=>'Produto deletado com sucesso']);
    }
}
