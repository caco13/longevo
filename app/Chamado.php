<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    /** Relações com outros modelos **/

    /**
     * Um chamado pertence a um pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido()
    {
        return $this->belongsTo('App\Pedido');
    }
}
