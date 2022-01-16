<?php

namespace App\Models;

use App\Models\Carrinho;
class Pedido 
{
    private string $status;
    private Carrinho $carrinho;
    private float $valorPedido;
    
    public function __construct() {
        $this->status = 'aberto';
        $this->carrinho = new Carrinho();
        $this->valorPedido = 0;
    }

    public function getCarrinho() {
        return $this->carrinho;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function getValor() {
        return $this->valorPedido;
    }

    public function confirmar() {
        if($this->carrinho->validarCarrinho()) {
            $this->setStatus('confirmado');
            return true;
        }
        return false;
    }
}