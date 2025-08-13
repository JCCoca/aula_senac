<?php 

require_once '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;
    $id = $_POST['id'] ?? null;

    if (
        !empty($nome) and 
        !empty($cpf) and
        !empty($email) and
        !empty($senha) and
        !empty($telefone) and
        !empty($sexo) and
        !empty($data_nascimento) and
        !empty($id)
    ) {
        try {
            // Verifica se o e-mail já está cadastrado
            $consulta = $connection->prepare("SELECT * FROM pessoa WHERE email = :email AND id <> :id");
            $consulta->bindValue(':email', $email);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                header('Location: ../edit.php?id='.$id.'&error='.urlencode('Este e-mail já foi cadastrado!'));
                exit;
            }

            // Verifica se o cpf já está cadastrado
            $consulta = $connection->prepare("SELECT * FROM pessoa WHERE cpf = :cpf AND id <> :id");
            $consulta->bindValue(':cpf', $cpf);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                header('Location: ../edit.php?id='.$id.'&error='.urlencode('Este CPF já foi cadastrado!'));
                exit;
            }

            // Atualizar os dados da pessoa no banco de dados
            $update = $connection->prepare('
                UPDATE 
                    pessoa 
                SET 
                    nome = :nome, 
                    cpf = :cpf, 
                    email = :email, 
                    senha = :senha, 
                    telefone = :telefone, 
                    sexo = :sexo, 
                    data_nascimento = :data_nascimento 
                WHERE
                    id = :id
            ');

            $update->bindValue(':nome', $nome);
            $update->bindValue(':cpf', $cpf);
            $update->bindValue(':email', $email);
            $update->bindValue(':senha', $senha);
            $update->bindValue(':telefone', $telefone);
            $update->bindValue(':sexo', $sexo);
            $update->bindValue(':data_nascimento', $data_nascimento);
            $update->bindValue(':id', $id, PDO::PARAM_INT);

            $result = $update->execute();

            // Verifica se a atualização dos dados foi realizada com sucesso
            if ($result) {
                header('Location: ../edit.php?id='.$id.'&success='.urlencode('Dados atualizados com sucesso!'));
            } else {
                header('Location: ../edit.php?id='.$id.'&error='.urlencode('Ocorreu um erro ao tentar atualizar os dados!'));
            }
        } catch (PDOException $e) {
            header('Location: ../edit.php?id='.$id.'&error='.urlencode('Ocorreu um erro ao tentar atualizar os dados !'));
        }
    } else {
        header('Location: ../edit.php?id='.$id.'&error='.urlencode('Preencha todos os campos obrigatórios!'));
    }
}