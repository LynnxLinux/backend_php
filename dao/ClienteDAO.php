<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Cliente.php';


class ClienteDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new Conn();
    }

    private function texto(string $texto): string
    {
        return mb_strtoupper(trim($texto));
    }

    // Salva: se o id é nulo faz INSERT, se tem id faz UPDATE (edição)
    public function salvar(Cliente $cliente): bool
    {
        if ($cliente->getId() == null) {

            $sql = "INSERT INTO cliente
                    (nome,email,telefone)
                    VALUES
                    (?,?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, mb_strtolower($cliente->getEmail()));
            $stmt->bindValue(3, $cliente->getTelefone());
        } else {

            $sql = "UPDATE cliente
                       SET nome=?,
                           email=?,
                           telefone=?
                     WHERE id=?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, mb_strtolower($cliente->getEmail()));
            $stmt->bindValue(3, $cliente->getTelefone());
            $stmt->bindValue(4, $cliente->getId(), PDO::PARAM_INT);
        }

        return $stmt->execute();
    }

    public function listar(): array
    {
        $stmt = $this->conn->query(
            "SELECT *
               FROM cliente
           ORDER BY nome"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Usado para preencher o formulário de edição
    public function buscarPorId(int $id): ?Cliente
    {
        $stmt = $this->conn->prepare(
            "SELECT *
               FROM cliente
              WHERE id=?"
        );

        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $cliente = new Cliente();

        $cliente->setId((int)$dados['id']);
        $cliente->setNome($dados["nome"]);
        $cliente->setEmail($dados["email"]);
        $cliente->setTelefone($dados["telefone"]);

        return $cliente;
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM cliente
             WHERE id=?"
        );

        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
