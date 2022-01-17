<?php

namespace App\Services;

class EmailService {
    private string $de;
    private string $para;
    private string $assunto;
    private string $conteudo;

    public function __construct(
        string $de = 'contato@email.com',
        string $para = '',
        string $assunto = '',
        string $conteudo = ''
    ) {
        $this->de = $de;
        $this->para = $para;
        $this->assunto = $assunto;
        $this->conteudo = $conteudo;
    }

    public static function dispararEmail() {
        return "---Envia Email---";
    }
}