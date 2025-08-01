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

    if (
        !empty($nome) and 
        !empty($cpf) and
        !empty($email) and
        !empty($senha) and
        !empty($telefone) and
        !empty($sexo) and
        !empty($data_nascimento)
    ) {
        try {
            // Verifica se o e-mail já está cadastrado
            $consulta = $connection->query("SELECT * FROM pessoa WHERE email = '{$email}'");

            if ($consulta->rowCount() > 0) {
                header('Location: form.php?error='.urlencode('Este e-mail já foi cadastrado!'));
                exit;
            }

            // Registra a pessoa no banco de dados
            $insert = $connection->prepare('
                INSERT INTO pessoa (
                    nome, cpf, email, senha, telefone, sexo, data_nascimento    
                ) VALUE (
                    :nome, :cpf, :email, :senha, :telefone, :sexo, :data_nascimento
                )
            ');

            $insert->bindValue(':nome', $nome);
            $insert->bindValue(':cpf', $cpf);
            $insert->bindValue(':email', $email);
            $insert->bindValue(':senha', $senha);
            $insert->bindValue(':telefone', $telefone);
            $insert->bindValue(':sexo', $sexo);
            $insert->bindValue(':data_nascimento', $data_nascimento);

            $insert->execute();

            // Verifica se o cadastro foi realizado com sucesso
            if ($connection->lastInsertId() > 0) {
                header('Location: ../add.php?success='.urlencode('Cadastro realizado com sucesso!'));
            } else {
                header('Location: ../add.php?error='.urlencode('Ocorreu um erro ao tentar realizar o cadastro!'));
            }
        } catch (PDOException $e) {
            header('Location: ../add.php?error='.urlencode('Ocorreu um erro ao tentar realizar o cadastro!'));
        }
    } else {
        header('Location: ../add.php?error='.urlencode('Preencha todos os campos obrigatórios!'));
    }
}