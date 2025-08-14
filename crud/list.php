<?php include_once 'layout/header.php'; ?>

<?php 
    
    require_once 'database/connection.php';

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $length = (int) isset($_GET['length']) ? $_GET['length'] : 10;

    $params = 'search='.urlencode($search).'&';
    $params .= 'length='.$length.'&';

    $page = (int) (isset($_GET['page']) and $_GET['page'] > 1) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $length;

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
            :length OFFSET :offset
    ');
    $select->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
    $select->bindValue(':length', $length, PDO::PARAM_INT);
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
    $totalPages = ceil($total / $length);

?>

<h2 class="mb-4">Listar Pessoas</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?= $_GET['success']; ?>
    </div>
<?php endif ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?= $_GET['error']; ?>
    </div>
<?php endif ?>

<div class="card mb-4">
    <div class="card-body">
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="search" class="form-label">Pesquisa Livre</label>
                        <input type="text" name="search" id="search" class="form-control" value="<?= $search ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="length" class="form-label">Mostrando</label>
                        <select name="length" id="length" class="form-select">
                            <option value="10" <?= $length == 10 ? 'selected' : '' ?>>10 registros</option>
                            <option value="25" <?= $length == 25 ? 'selected' : '' ?>>25 registros</option>
                            <option value="50" <?= $length == 50 ? 'selected' : '' ?>>50 registros</option>
                            <option value="100" <?= $length == 100 ? 'selected' : '' ?>>100 registros</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="ph ph-magnifying-glass"></i> Pesquisar
            </button>
            <a href="list.php" class="btn btn-secondary">
                <i class="ph ph-eraser"></i> Limpar
            </a>
        </form>
    </div>
    <div class="card-body border-top">
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
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    onclick="document.getElementById('delete-id').value = '<?= $pessoa->id ?>'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-delete"
                                >
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
                <p class="mb-0">Mostrando de <?= $offset+1 ?> a <?= $page*$length < $total ? $page*$length : $total ?> de <?= $total ?> registros</p>
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
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-header" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-delete-header">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="action/delete.php" method="POST">
                <div class="modal-body">
                    <p class="mb-0">
                        Deseja realmente <strong class="text-danger">EXCLUIR</strong> este registro? <br>
                        Esta ação não poderá ser desfeita!
                    </p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'layout/footer.php'; ?>