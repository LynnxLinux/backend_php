<?php

require_once '../controller/ClienteController.php';

if (isset($_POST['btnsalvar'])) {

    $controller = new ClienteController();

    if ($controller->salvar()) {
?>
        <div class="alert alert-success">
            Cliente cadastrado com sucesso!
        </div>
        <script>
            setTimeout(function() {
                window.location.href = '?p=clientes';
            }, 1500);
        </script>
    <?php
    } else {
    ?>
        <div class="alert alert-danger">
            Erro ao cadastrar cliente.
        </div>
<?php
    }
}
?>

<div class="card">

    <div class="card-header">
        Novo Cliente
    </div>

    <div class="card-body">

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Nome</label>

                <input
                    type="text"
                    name="txtnome"
                    class="form-control"
                    maxlength="100"
                    value=""
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>

                <input
                    type="email"
                    name="txtemail"
                    class="form-control"
                    maxlength="100"
                    value=""
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>

                <input
                    type="text"
                    name="txttelefone"
                    class="form-control"
                    maxlength="20"
                    value="">
            </div>

            <button
                type="submit"
                name="btnsalvar"
                class="btn btn-success">
                Salvar
            </button>

            <a href="?p=clientes" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>

</div>
