<?php

require_once '../controller/ClienteController.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {

    $controller = new ClienteController();

    if ($controller->excluir($id)) {
?>
        <div class="alert alert-primary" role="alert">
            Excluído com sucesso
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
            Erro ao excluir
        </div>
<?php
    }
}
?>

<meta http-equiv="refresh" content="1;URL=?p=clientes">
