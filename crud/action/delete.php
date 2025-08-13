<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../database/connection.php';

    $id = $_POST['id'] ?? null;

    if (!empty($id)) {
        $delete = $connection->prepare('DELETE FROM pessoa WHERE id = :id');
        $delete->bindValue(':id', $id, PDO::PARAM_INT);
        $delete->execute();

        if ($delete->rowCount() == 1) {
            header('Location: ../list.php?success='.urlencode('Dados excluídos com sucesso!'));
        } else {
            header('Location: ../list.php?error='.urlencode('Ocorreu um erro ao tentar excluir!'));
        }
    } else {
        header('Location: ../list.php?error='.urlencode('Por favor informe o ID!'));
    }
}