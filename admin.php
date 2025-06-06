<?php

use Alura\Serenatto\Infraestrutura\ConexaoDB;
use Alura\Serenatto\Repositorio\PdoProdutos;

require_once 'vendor/autoload.php';

$pdo = ConexaoDB::criarConexao();
$bancoDeDados = new PdoProdutos($pdo);
$produtos = $bancoDeDados->exibirAdmin();

function listaProdutos(array $produtos): void
{
  foreach ($produtos as $produto) {
    echo "
      <tr>
        <td>{$produto->nome()}</td>
        <td>{$produto->tipo()}</td>
        <td>{$produto->descricao()}</td>
        <td>R$ {$produto->precoFormatado()}</td>
        <td><a class='botao-editar' href='editar-produto.php?id={$produto->id()}'>Editar</a></td>
        <td>
          <form action='excluir-produto.php' method='POST'>
            <input type='hidden' name='id' value='{$produto->id()}'>
            <input type='submit' class='botao-excluir' value='Excluir'>
          </form>
        </td>
      </tr>
    ";
  }
}

?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Admin</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Admistração Serenatto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <h2>Lista de Produtos</h2>

  <section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php listaProdutos($produtos); ?>
      </tbody>
    </table>
  <a class="botao-cadastrar" href="cadastrar-produto.php">Cadastrar produto</a>
  <a class="botao-cadastrar" href="./index.php">Página Incial</a>
  <form action="gerador-pdf.php" method="post">
    <input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>
  </form>
  </section>
</main>
</body>
</html>