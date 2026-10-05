<?php

require_once '../controller/ClienteController.php';

$controller = new ClienteController();

// 1) Recebe o id enviado pela URL (?p=editar/cliente&id=1)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// 2) Busca o registro no banco para preencher o formulário
$cliente = $id ? $controller->buscarPorId($id) : null;

if (!$cliente) {
    // id ausente ou inexistente: mostra aviso e volta para a lista
    echo '<div class="alert alert-danger">Cliente não encontrado.</div>';
    echo '<a href="?p=clientes" class="btn btn-secondary">Voltar</a>';
} else {

    // 3) Se o formulário foi enviado, salva as alterações no banco
    if (isset($_POST['btnalterar'])) {

        if ($controller->alterar()) {

            echo '
                <div class="alert alert-success">
                    Cliente alterado com sucesso!
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "?p=clientes";
                    }, 1500);
                </script>
            ';

            // recarrega os dados já atualizados
            $cliente = $controller->buscarPorId($id);
        } else {

            echo '
                <div class="alert alert-danger">
                    Erro ao alterar cliente.
                </div>
            ';
        }
    }
?>

<div class="card">

    <div class="card-header">
        Editar Cliente
    </div>

    <div class="card-body">

        <form method="post">

            <!-- o id vai escondido para o UPDATE saber qual registro alterar -->
            <input
                type="hidden"
                name="txtid"
                value="<?= $cliente->getId(); ?>">

            <div class="mb-3">
                <label class="form-label">Nome</label>

                <input
                    type="text"
                    name="txtnome"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($cliente->getNome()); ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>

                <input
                    type="email"
                    name="txtemail"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($cliente->getEmail()); ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>

                <input
                    type="text"
                    name="txttelefone"
                    class="form-control"
                    maxlength="20"
                    value="<?= htmlspecialchars($cliente->getTelefone()); ?>">
            </div>

            <button
                type="submit"
                name="btnalterar"
                class="btn btn-primary">
                Atualizar
            </button>

            <a href="?p=clientes" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>

</div>

<?php
}
