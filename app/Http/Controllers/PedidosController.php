<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

use App\Http\Requests;

class PedidosController extends Controller
{
    public function search()
    {
        return view('pedidos.search');
    }

    public function find(Request $request)
    {
        $pedidoId = $request->get('pedido');

        $pedido = Pedido::find($pedidoId);

        if( !$pedido ) {
            //TODO: flash message

            return redirect()->route('pedidos_buscar');
        }

        return redirect()->route('chamados_create', ['pedido' => $pedido->id]);
    }
}
