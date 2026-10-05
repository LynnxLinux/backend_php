<?php

declare(strict_types=1);

require_once "../model/Fornecedor.php";
require_once "../dao/FornecedorDAO.php";

class FornecedorController
{
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->dao = new FornecedorDAO();
    }

    // Lê os campos do formulário e monta o objeto
    private function montar(): Fornecedor
    {
        $fornecedor = new Fornecedor();

        $fornecedor->setRazaoSocial(
            filter_input(INPUT_POST, 'txtrazaosocial') ?? ''
        );

        $fornecedor->setEmail(
            filter_input(INPUT_POST, 'txtemail') ?? ''
        );

        $fornecedor->setTelefone(
            filter_input(INPUT_POST, 'txttelefone') ?? ''
        );

        return $fornecedor;
    }

    public function salvar(): bool
    {
        return $this->dao->salvar($this->montar());
    }

    // EDIÇÃO: monta o objeto, informa o id e manda o DAO atualizar
    public function alterar(): bool
    {
        $id = filter_input(INPUT_POST, 'txtid', FILTER_VALIDATE_INT);

        // sem id válido não há o que alterar
        if (!$id) {
            return false;
        }

        $fornecedor = $this->montar();
        $fornecedor->setId($id);

        return $this->dao->salvar($fornecedor);
    }

    public function excluir(int $id): bool
    {
        return $this->dao->excluir($id);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscarPorId(int $id): ?Fornecedor
    {
        return $this->dao->buscarPorId($id);
    }
}
