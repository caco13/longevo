<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use App\Pedido;
use Illuminate\Http\Request;

use App\Http\Requests;

class AutocompleteController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->get('term', '');
        $model = $request->get('model');
        $attribute = $request->get('attribute');

        switch ($model) {
            case 'cliente':
                $results = Cliente::where($attribute, 'LIKE', '%' . $term . '%')->get();
                break;
            case 'pedido':
                $results = Pedido::where($attribute, 'LIKE', '%' . $term . '%')->get();
                break;
            case 'chamado':
                $results = Chamado::where($attribute, 'LIKE', '%' . $term . '%')->get();
            default:
                //TODO: gera exceção
        }

        $data = [];

        foreach ($results as $result) {
            $data[] = ['value' => $result->{$attribute}, 'id' => $result->id];
        }

        if (count($data)) {
            return $data;
        } else {
            return (['value' => 'Sem resultados', 'id' => '']);
        }

    }
}
