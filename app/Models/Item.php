<?php

namespace App\Models;

class Item 
{
    private string $descricao;
    private float $valor;
  
    public function __construct() {
        $this->descricao = '';
        $this->valor = 0;
    }

    public function getDescricao () {
        return $this->descricao;
    }

    public function getValor () {
        return $this->valor;
    }

    public function setDescricao (string $descricao) {
        $this->descricao = $descricao;
    }

    public function setValor (float $valor ) {
        $this->valor = $valor;
    }
}