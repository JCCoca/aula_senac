<?php 

// var_dump($_GET, $_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegamos os dados enviado pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];

    $conteudo = "
    NOME: {$nome}
    EMAIL: {$email}
    TELEFONE: {$telefone}
    SEXO: {$sexo}
    DATA NASCIMENTO: {$data_nascimento}
    ";

    // Abre um arquivo, primeiro paramentro o caminho do arquvio e segundo é o modo
    $arquivo = fopen('dados.txt', 'a+'); 

    // realiza inserção no arquivo, primeiro paramentro é o arquivo e o segundo é o conteúdo
    fwrite($arquivo, $conteudo); 

    // fecha o arquivo, o único paramentro é o arquivo
    fclose($arquivo); 

    // Redireciona para o arquivo ou url infomado
    header('Location: formulario.php');
}

?>