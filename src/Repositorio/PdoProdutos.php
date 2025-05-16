<?php

namespace Alura\Serenatto\Repositorio;

use Alura\Serenatto\Modelo\Produto;
use Alura\Serenatto\Modelo\ProdutosRepositorio;
use PDO;
use PDOStatement;

class PdoProdutos implements ProdutosRepositorio
{
    public function __construct(private PDO $conexao)
    {}

    #[\Override]
    public function criar(Produto $produto): bool
    {
        return true;
    }

    #[\Override]
    public function exibir(string $tipo): array
    {
        $sqlQuery = "SELECT * FROM produtos WHERE tipo = :tipo ORDER BY preco;";
        $stmt = $this->conexao->prepare($sqlQuery);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->execute();

        return $this->organizarDados($stmt);
    }

    private function organizarDados(PDOStatement $stmt): array
    {
        $produtos = $stmt->fetchAll();

        $listaProdutos = array_map(function ($produto) {
            return new Produto(
                $produto['id'],
                $produto['tipo'],
                $produto['nome'],
                $produto['descricao'],
                $produto['preco'],
                $produto['imagem']
            );
        }, $produtos);

        return $listaProdutos;
    }

    #[\Override]
    public function atualizar(Produto $produtos): bool
    {
        return true;
    }

    #[\Override]
    public function remover(Produto $produtos): bool
    {
        return true;
    }

 }