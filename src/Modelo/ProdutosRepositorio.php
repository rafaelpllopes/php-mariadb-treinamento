<?php

namespace Alura\Serenatto\Modelo;

interface ProdutosRepositorio
{
    public function criar(Produto $produto): bool;
    public function exibir(string $tipo): array;
    public function exibirAdmin(): array;
    public function pegarUmProduto(int $id) : Produto;
    public function atualizar(Produto $produto): bool;
    public function remover(Produto $produto): bool;
}