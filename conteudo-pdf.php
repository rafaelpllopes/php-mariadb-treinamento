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
      </tr>
    ";
  }
}
?>
<html>

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
  <h2>Lista de Produtos</h2>

  <section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
        </tr>
      </thead>
      <tbody>
        <?php listaProdutos($produtos); ?>
      </tbody>
    </table>
  </section>
</main>
</body>
</html>