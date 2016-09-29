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
            case 'Cliente':
                $results = Cliente::where($attribute, 'LIKE', '%' . $term . '%')->get();
                break;
            case 'Pedido':
                $results = Pedido::where($attribute, 'LIKE', '%' . $term . '%')->get();
                break;
            case 'Chamado':
                $results = Chamado::where($attribute, 'LIKE', '%' . $term . '%')->get();
                break;
            default:
                throw new \Exception('Model not found');
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
