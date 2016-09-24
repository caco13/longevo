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
        $paginate = true;

        return view('chamados.index', compact('chamados', 'paginate'));
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
     * Apresenta o formulário para cadastro de novo chamado.
     *
     * @param $pedidoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($pedidoId)
    {
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

    /**
     * Edita um chamado.
     *
     * @param Chamado $chamado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Chamado $chamado)
    {
        return view('chamados.edit', compact('chamado'));
    }

    /**
     * Atualiza chamado.
     *
     * @param Request $request
     * @param Chamado $chamado
     */
    public function update(Request $request, Chamado $chamado)
    {

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
        if (is_numeric($request->get('pedido'))) {
            $pedido = Pedido::find($request->get('pedido'));
        } else {
            $pedido = null;
        }
        $cliente = Cliente::where('email', $request->get('email'))->first();

        if (is_null($cliente)) {
            if (is_null($pedido)) {
                session()->flash('flash_message', 'Não foram encontrados chamados com os filtros especificados.');
                return redirect()->route('chamados');
            } else {
                $chamados = Chamado::where('pedido_id', $pedido->id)->latest()->get();
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
                session()->flash('flash_message', 'Retornando chamados do cliente ' . $cliente->email);
            } else {
                // Verifica se o cliente possui o pedido
                $pedido = $cliente->pedidos->find($pedido->id);
                if (is_null($pedido)) {
                    session()->flash('flash_message', 'Não foram encontrados chamados com os filtros especificados.');
                    return redirect()->route('chamados');
                } else {
                    // Se foi encontrado pedido retorna chamados
                    // referentes ao pedido.
                    $chamados = Chamado::where('pedido_id', $pedido->id)->latest()->get();
                }

            }
        }

        // Na tela de resultados filtrados não faz paginação
        $paginate = false;
        return view('chamados.index', compact('chamados', 'paginate'));

    }

}
