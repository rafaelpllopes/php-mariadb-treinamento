<?php

use Alura\Serenatto\Infraestrutura\ConexaoDB;
use Alura\Serenatto\Repositorio\PdoProdutos;

require 'vendor/autoload.php';

$pdo = ConexaoDB::criarConexao();
$bancoDeDados = new PdoProdutos($pdo);

$id = $_POST['id'];
$produto = $bancoDeDados->pegarUmProduto($id);
$bancoDeDados->remover($produto);

header("Location: admin.php");
