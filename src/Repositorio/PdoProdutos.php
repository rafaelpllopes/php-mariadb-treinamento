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
        $sqlQuery = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem)
                    VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sqlQuery);
        $stmt->bindValue(1, $produto->tipo());
        $stmt->bindValue(2, $produto->nome());
        $stmt->bindValue(3, $produto->descricao());
        $stmt->bindValue(4, (float) $produto->preco());
        $stmt->bindValue(5, $produto->imagem());

        return $stmt->execute();
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

    #[\Override]
    public function exibirAdmin(): array
    {
        $sqlQuery = "SELECT * FROM produtos ORDER BY nome;";
        $stmt = $this->conexao->query($sqlQuery);

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
    public function pegarUmProduto(int $id) : Produto {
        $sqlQuery = "SELECT * FROM produtos WHERE id = :id;";
        $stmt = $this->conexao->prepare($sqlQuery);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $resposta = $stmt->fetch();

        return new Produto(
            $resposta['id'],
            $resposta['tipo'],
            $resposta['nome'],
            $resposta['descricao'],
            $resposta['preco'],
            $resposta['imagem']
        );
    }

    #[\Override]
    public function atualizar(Produto $produtos): bool
    {
        return true;
    }

    #[\Override]
    public function remover(Produto $produto): bool
    {
        $sqlQuery = "DELETE FROM produtos WHERE id = :id;";
        $stmt = $this->conexao->prepare($sqlQuery);
        $stmt->bindValue(':id', $produto->id());

        return $stmt->execute();
    }

 }