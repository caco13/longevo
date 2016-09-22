<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /**
     * Campos para atribuição em massa
     */
    protected $fillable = [
        'cliente_id',
    ];

    /** Relações com outros modelos **/

    /**
     * Um pedido pertence a um cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * Um pedido pode ter vários chamados.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chamados()
    {
        return $this->hasMany('App\Chamado');
    }
}
