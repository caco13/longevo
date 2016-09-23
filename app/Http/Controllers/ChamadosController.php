<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use App\Pedido;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ChamadosController extends Controller
{
    /**
     * Retorna view com todos os chamados.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $chamados = Chamado::latest('updated_at')->paginate(5);

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
        return view('chamados.chamado', compact('chamado'));
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
        $chamados = new Collection;

        //TODO: que feio, refatorar!
        if ($request->has('pedido')) {
            $chamados = Chamado::where('pedido_id', $request->get('pedido'))->paginate(5);
        }
        if ($request->has('email')) {
            $cliente = Cliente::where('email', $request->get('email'))->first();
            if ( !is_null($cliente) ) {
                $pedidos = $cliente->pedidos;
                foreach ($pedidos as $pedido) {
                    foreach ($pedido->chamados as $chamado) {
                        $chamados->push($chamado);
                    }
                }
            }

            // Faz a paginação da Collection
            $chamados = new LengthAwarePaginator(
                $chamados->slice(5),
                $chamados->count(),
                5,
                null,
                ['path' => url('chamados')]
            );

        }

        if ($chamados->isEmpty()) {
            session()->flash('flash_message', 'Não foram encontrados chamados com os filtros especificados.');
            return redirect()->route('chamados');
        }

        return view('chamados.index', compact('chamados'));
    }

    /**
     * Apresenta o formulário para cadastro de novo chamado.
     *
     * @param $pedidoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($pedidoId)
    {
        //TODO: model bidding?

        $pedido = Pedido::findOrFail($pedidoId);

        return view('chamados.create', compact('pedido'));
    }

    /**
     * Salva dados do chamado.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $pedidoId = $request->get('pedido');

        $pedido = Pedido::findOrFail($pedidoId);

        $chamado = new Chamado;
        $chamado->pedido_id = $pedido->id;
        $chamado->titulo = $request->get('titulo');
        $chamado->observacao = $request->get('observacao');

        $chamado->save();

        $cliente = $pedido->cliente;
        $cliente->nome = $request->get('nome');
        $cliente->email = $request->get('email');

        // O Laravel só irá atualizar a tabela se houver modificações em algum campo
        $cliente->save();

        session()->flash('flash_message', 'Chamado criado com sucesso');

        return redirect()->route('chamados');
    }
}
