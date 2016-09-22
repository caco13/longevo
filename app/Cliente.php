<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * Campos para atribuição em massa
     */
    protected $fillable = [
        'nome', 'email',
    ];

    /** Relações com outros modelos **/

    /**
     * Um cliente pode ter vários pedidos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Pedido');
    }
}
