<?php

    require "src/ConexaoDB.php";

    $sqlCafe = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco;";
    $pdo = ConexaoDB::criarConexao();

    $stmt = $pdo->query($sqlCafe);
    $produtosCafe = $stmt->fetchAll();

    $sqlAlmoco = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco;";
    $produtosAlmoco = $pdo->query($sqlAlmoco)->fetchAll();
?>

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/index.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <title>Serenatto - Cardápio</title>
    </head>
    <body>
        <main>
            <section class="container-banner">
                <div class="container-texto-banner">
                    <img
                        src="img/logo-serenatto.png"
                        class="logo"
                        alt="logo-serenatto"
                    />
                </div>
            </section>
            <h2>Cardápio Digital</h2>
            <section class="container-cafe-manha">
                <div class="container-cafe-manha-titulo">
                    <h3>Opções para o Café</h3>
                    <img
                        class="ornaments"
                        src="img/ornaments-coffee.png"
                        alt="ornaments"
                    />
                </div>
                <div class="container-cafe-manha-produtos">
                    <?php
                        // foreach ($produtosCafe as $produto) {
                        //     echo "<div class='container-produto'>
                        //         <div class='container-foto'>
                        //             <img src='{$produto['imagem']}' />
                        //         </div>
                        //         <p>{$produto['nome']}</p>
                        //         <p>
                        //             {$produto['descricao']}
                        //         </p>
                        //         <p>R$ {$produto['preco']}</p>
                        //     </div>";
                        // };
                    ?>
                    <?php foreach ($produtosCafe as $cafe): ?>
                        <div class="container-produto">
                            <div class="container-foto">
                                <img src="<?= './img/' . $cafe['imagem'] ?>">
                            </div>
                            <p><?= $cafe['nome'] ?></p>
                            <p><?= $cafe['descricao'] ?></p>
                            <p><?= "R$ " . $cafe['preco'] ?></p>
                        </div>
                    <?php endforeach; ?>

        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php foreach ($produtosAlmoco as $almoco):?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= './img/' . $almoco['imagem'] ?>">
                        </div>
                        <p><?= $almoco['nome'] ?></p>
                        <p><?= $almoco['descricao'] ?></p>
                        <p><?= "R$ " . $almoco['preco'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>            
        </section>
        </main>
    </body>
</html>
