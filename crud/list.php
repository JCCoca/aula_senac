<?php include_once 'layout/header.php'; ?>

<?php 
    
    require_once 'database/connection.php';

    $lenghtPage = 15;
    $page = (int) isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $lenghtPage;

    $select = $connection->prepare('SELECT * FROM pessoa LIMIT :lenght OFFSET :offset');
    $select->bindValue(':lenght', $lenghtPage, PDO::PARAM_INT);
    $select->bindValue(':offset', $offset, PDO::PARAM_INT);
    $select->execute();

?>

<h1 class="mb-4">Listagem</h1>

<div class="table-responsive">
    <table class="table table-sm table-striped table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
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
                    <td><?= $pessoa->id; ?></td>
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

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
    </ul>
</nav>

<?php include_once 'layout/footer.php'; ?>