<?php

namespace App\Http\Controllers;

use App\Chamado;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChamadosController extends Controller
{
    public function index()
    {
        $chamados = Chamado::latest('updated_at')->get();

        return 'Lista dos chamados';

//        return view('chamados.index', compact('chamados'));
    }

    public function show(Chamado $chamado)
    {

    }
}
