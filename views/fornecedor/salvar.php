<?php

require_once '../controller/FornecedorController.php';

if (isset($_POST['btnsalvar'])) {

    $controller = new FornecedorController();

    if ($controller->salvar()) {
?>
        <div class="alert alert-success">
            Fornecedor cadastrado com sucesso!
        </div>
        <script>
            setTimeout(function() {
                window.location.href = '?p=fornecedores';
            }, 1500);
        </script>
    <?php
    } else {
    ?>
        <div class="alert alert-danger">
            Erro ao cadastrar fornecedor.
        </div>
<?php
    }
}
?>

<div class="card">

    <div class="card-header">
        Novo Fornecedor
    </div>

    <div class="card-body">

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Razão Social</label>

                <input
                    type="text"
                    name="txtrazaosocial"
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

            <a href="?p=fornecedores" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>

</div>
