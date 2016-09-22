<?php

namespace App\Http\Controllers;

use App\Chamado;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChamadosController extends Controller
{
    /**
     * Retorna view com todos os chamados.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $chamados = Chamado::latest('updated_at')->get();

        return view('chamados.index', compact('chamados'));
    }

    /**
     * Retorna view com os dados de um chamado.
     *
     * @param Chamado $chamado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Chamado $chamado)
    {
        return view('chamados.chamado', compact($chamado));
    }

    /**
     * Filtra chamados por pedido ou email.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse |
     * \Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $pedido = $request->get('pedido');
        $email = $request->get('email');
        $chamado = new Chamado;

        if ( !is_null($pedido) ) {
            $chamado = $chamado->where('pedido', $pedido->id);
        }
        if ( !is_null($email) ) {
            $chamado = $chamado->where('email', $pedido->cliente->id);
        }
        if (isEmpty($chamado)) {
            //flash message
            return redirect('chamados');
        }

        return view('chamados.index', compact('chamados'));
    }
}
