<?php include_once 'layout/header.php'; ?>

<?php 
    
    require_once 'database/connection.php';

    $search = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
    $params = 'pesquisa='.urlencode($search).'&';

    $lenghtPage = 10;
    $page = (int) (isset($_GET['page']) and $_GET['page'] > 1) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $lenghtPage;

    $select = $connection->prepare('
        SELECT * FROM pessoa 
        WHERE 
            nome LIKE :search 
            OR cpf LIKE :search
            OR email LIKE :search
            OR telefone LIKE :search
            OR sexo LIKE :search
            OR data_nascimento LIKE :search
        LIMIT 
            :lenght OFFSET :offset
    ');
    $select->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
    $select->bindValue(':lenght', $lenghtPage, PDO::PARAM_INT);
    $select->bindValue(':offset', $offset, PDO::PARAM_INT);
    $select->execute();

    $pagination = $connection->prepare('
        SELECT 
            COUNT(*) AS total 
        FROM pessoa 
        WHERE 
            nome LIKE :search 
            OR cpf LIKE :search
            OR email LIKE :search
            OR telefone LIKE :search
            OR sexo LIKE :search
            OR data_nascimento LIKE :search
    ');
    $pagination->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
    $pagination->execute();

    $total = $pagination->fetch()->total;
    $totalPages = ceil($total / $lenghtPage);

?>

<h1 class="mb-4">Listar Pessoas</h1>

<form action="">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" name="pesquisa" id="pesquisa" class="form-control" value="<?= $_GET['pesquisa'] ?? '' ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="ph ph-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </div>
</form>

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
                <th></th>
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
                    <td><?= date('d/m/Y', strtotime($pessoa->data_nascimento)); ?></td>
                    <td>
                        <a href="<?= 'edit.php?id='.$pessoa->id ?>" class="btn btn-sm btn-outline-primary">
                            <i class="ph ph-pencil"></i> Editar
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger">
                            <i class="ph ph-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="row align-items-center justify-content-between">
    <div class="col-md-6">
        <p class="mb-0">Mostrando de <?= $offset+1 ?> a <?= $page*$lenghtPage < $total ? $page*$lenghtPage : $total ?> de <?= $total ?> registros</p>
    </div>
    <div class="col-md-6">
        <ul class="pagination justify-content-end">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="<?= '?'.$params.'page='.$page-1 ?>">Anterior</a></li>
            <?php endif ?>

            <?php for ($i=1; $i <= $totalPages; $i++): ?>
                <?php if ($page == $i): ?>
                    <li class="page-item active"><span class="page-link"><?= $i ?></span></li>
                <?php else: ?>
                    <?php if ($i == $page+1 or $i == $page+2 or $i == $page-1 or $i == $page-2): ?>
                        <li class="page-item"><a class="page-link" href="<?= '?'.$params.'page='.$i ?>"><?= $i ?></a></li>
                    <?php elseif ($i == 1): ?>
                        <li class="page-item"><a class="page-link" href="<?= '?'.$params.'page='.$i ?>"><?= $i ?></a></li>
                        <?php if ($page-3 > 1): ?>
                            <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif ?>
                    <?php elseif ($i == $totalPages): ?>
                        <?php if ($page+3 < $totalPages): ?>
                            <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif ?>
                        <li class="page-item"><a class="page-link" href="<?= '?'.$params.'page='.$i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endif ?>
            <?php endfor ?>
            
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="<?= '?'.$params.'page='.$page+1 ?>">Próximo</a></li>
            <?php endif ?>
        </ul>
    </div>
</div>

<?php include_once 'layout/footer.php'; ?>