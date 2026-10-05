<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Fornecedor.php';


class FornecedorDAO
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
    public function salvar(Fornecedor $fornecedor): bool
    {
        if ($fornecedor->getId() == null) {

            $sql = "INSERT INTO fornecedor
                    (razao_social,email,telefone)
                    VALUES
                    (?,?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($fornecedor->getRazaoSocial()));
            $stmt->bindValue(2, mb_strtolower($fornecedor->getEmail()));
            $stmt->bindValue(3, $fornecedor->getTelefone());
        } else {

            $sql = "UPDATE fornecedor
                       SET razao_social=?,
                           email=?,
                           telefone=?
                     WHERE id=?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($fornecedor->getRazaoSocial()));
            $stmt->bindValue(2, mb_strtolower($fornecedor->getEmail()));
            $stmt->bindValue(3, $fornecedor->getTelefone());
            $stmt->bindValue(4, $fornecedor->getId(), PDO::PARAM_INT);
        }

        return $stmt->execute();
    }

    public function listar(): array
    {
        $stmt = $this->conn->query(
            "SELECT *
               FROM fornecedor
           ORDER BY razao_social"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Usado para preencher o formulário de edição
    public function buscarPorId(int $id): ?Fornecedor
    {
        $stmt = $this->conn->prepare(
            "SELECT *
               FROM fornecedor
              WHERE id=?"
        );

        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $fornecedor = new Fornecedor();

        $fornecedor->setId((int)$dados['id']);
        $fornecedor->setRazaoSocial($dados["razao_social"]);
        $fornecedor->setEmail($dados["email"]);
        $fornecedor->setTelefone($dados["telefone"]);

        return $fornecedor;
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM fornecedor
             WHERE id=?"
        );

        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
