<?php include_once 'layout/header.php'; ?>

<?php 
    
    require_once 'database/connection.php';

    $lenghtPage = 15;
    $page = (int) (isset($_GET['page']) and $_GET['page'] > 1) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $lenghtPage;

    $select = $connection->prepare('SELECT * FROM pessoa LIMIT :lenght OFFSET :offset');
    $select->bindValue(':lenght', $lenghtPage, PDO::PARAM_INT);
    $select->bindValue(':offset', $offset, PDO::PARAM_INT);
    $select->execute();

    $total = (int) $connection->query('SELECT COUNT(*) AS total FROM pessoa')->fetch()->total;
    $totalPages = ceil($total / $lenghtPage);

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

<div class="row align-items-center justify-content-between">
    <div class="col-md-6">
        <p class="mb-0">Mostrando <?= $offset+1 ?> a <?= $page*$lenghtPage ?> de <?= $total ?> registros</p>
    </div>
    <div class="col-md-6">
        <ul class="pagination justify-content-end">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="<?= '?page='.$page-1 ?>">Anterior</a></li>
            <?php endif ?>

            <?php for ($i=1; $i <= $totalPages; $i++): ?>
                <?php if ($page == $i): ?>
                    <li class="page-item active"><span class="page-link"><?= $i ?></span></li>
                <?php else: ?>
                    <?php if ($i == $page+1 or $i == $page+2 or $i == $page-1 or $i == $page-2): ?>
                        <li class="page-item"><a class="page-link" href="<?= '?page='.$i ?>"><?= $i ?></a></li>
                    <?php elseif ($i == 1): ?>
                        <li class="page-item"><a class="page-link" href="<?= '?page='.$i ?>"><?= $i ?></a></li>
                        <?php if ($page-3 > 1): ?>
                            <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif ?>
                    <?php elseif ($i == $totalPages): ?>
                        <?php if ($page+3 < $totalPages): ?>
                            <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif ?>
                        <li class="page-item"><a class="page-link" href="<?= '?page='.$i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endif ?>
            <?php endfor ?>
            
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="<?= '?page='.$page+1 ?>">Próximo</a></li>
            <?php endif ?>
        </ul>
    </div>
</div>

<?php include_once 'layout/footer.php'; ?>