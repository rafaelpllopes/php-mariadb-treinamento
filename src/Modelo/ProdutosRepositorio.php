<?php

namespace Alura\Serenatto\Modelo;

interface ProdutosRepositorio
{
    public function criar(Produto $produtos): bool;
    public function exibir(string $tipo): array;
    public function atualizar(Produto $produtos): bool;
    public function remover(Produto $produtos): bool;
}