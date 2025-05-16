<?php

namespace Alura\Serenatto\Infraestrutura;

use PDO;

class ConexaoDB
{
    public static function criarConexao(): PDO
    {
        $db = 'mysql:host=127.0.0.1;dbname=serenatto';
        $conexao =  new PDO($db, 'root', 'root');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conexao;
    }
}