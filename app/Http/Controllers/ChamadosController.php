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
        $pedido = Pedido::find($request->get('pedido'));
        $cliente = Cliente::where('email', $request->get('email'))->first();

        if (is_null($cliente)) {
            if (is_null($pedido)) {
                session()->flash('flash_message', 'Não foram encontrados chamados com os filtros especificados.');
                return redirect()->route('chamados');
            } else {
                $chamados = Chamado::where('pedido_id', $pedido->id)->paginate(5);
            }
        } else {
            $chamados = new Collection;
            if (is_null($pedido)) {
                // Se campo de filtro de pedido está vazio ou não foi encontrado pedido,
                // retorna todos os chamados de todos os pedidos do cliente.
                foreach ($cliente->pedidos as $pedido) {
                    foreach ($pedido->chamados as $chamado) {
                        $chamados->push($chamado);
                    }
                }
            } else {
                // Se foi encontrado pedido retorna chamados
                // referentes ao pedido do cliente.
                $chamados = $cliente->pedidos->where('pedido_id', $pedido->id);
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
