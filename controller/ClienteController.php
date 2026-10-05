<?php

declare(strict_types=1);

require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    private ClienteDAO $dao;

    public function __construct()
    {
        $this->dao = new ClienteDAO();
    }

    // Lê os campos do formulário e monta o objeto
    private function montar(): Cliente
    {
        $cliente = new Cliente();

        $cliente->setNome(
            filter_input(INPUT_POST, 'txtnome') ?? ''
        );

        $cliente->setEmail(
            filter_input(INPUT_POST, 'txtemail') ?? ''
        );

        $cliente->setTelefone(
            filter_input(INPUT_POST, 'txttelefone') ?? ''
        );

        return $cliente;
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

        $cliente = $this->montar();
        $cliente->setId($id);

        return $this->dao->salvar($cliente);
    }

    public function excluir(int $id): bool
    {
        return $this->dao->excluir($id);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscarPorId(int $id): ?Cliente
    {
        return $this->dao->buscarPorId($id);
    }
}
