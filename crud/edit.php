<?php include_once 'layout/header.php'; ?>

<?php 

    if (!isset($_GET['id']) or empty($_GET['id'])) {
        header('Location: list.php');
        exit;
    }

    require_once 'database/connection.php';

    $id = (int) $_GET['id'];

    $query = $connection->prepare('SELECT * FROM pessoa WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT); 
    $query->execute();

    $pessoa = $query->fetch();

?>

<h1 class="mb-4">Editar Pessoa</h1>

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

<form action="action/update.php" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $pessoa->nome ?>" required>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?= $pessoa->cpf ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="<?= $pessoa->telefone ?>" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $pessoa->email ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" value="<?= $pessoa->senha ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sexo" id="sexo-m" class="form-check-input" value="Masculino" <?= $pessoa->sexo == 'Masculino' ? 'checked' : '' ?> required>
                        <label for="sexo-m" class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sexo" id="sexo-f" class="form-check-input" value="Feminino" <?= $pessoa->sexo == 'Feminino' ? 'checked' : '' ?> required>
                        <label for="sexo-f" class="form-check-label">Feminino</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data-nascimento" class="form-control" value="<?= $pessoa->data_nascimento ?>" required>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="ph ph-floppy-disk-back"></i> Salvar
    </button>
    <a href="list.php" class="btn btn-secondary">
        <i class="ph ph-arrow-left"></i> Voltar
    </a>
</form>

<?php include_once 'layout/footer.php'; ?>