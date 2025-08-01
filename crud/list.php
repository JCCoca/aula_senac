<?php include_once 'layout/header.php'; ?>

<?php 
    
    require_once 'database/connection.php';

    $select = $connection->prepare('SELECT * FROM pessoa');
    $select->execute();

?>

<h1 class="mb-4">Listagem</h1>

<div class="table-responsive">
    <table class="table table-sm table-striped table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Data Nascimento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($select->fetchAll() as $pessoa): ?>
                <tr>
                    <td><?= $pessoa->nome; ?></td>
                    <td><?= $pessoa->cpf; ?></td>
                    <td><?= $pessoa->email; ?></td>
                    <td><?= $pessoa->telefone; ?></td>
                    <td><?= $pessoa->sexo; ?></td>
                    <td><?= $pessoa->data_nascimento; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include_once 'layout/footer.php'; ?>