<?php 

echo '<h1>Olá mundo!</h1>';

$nome = 'José Coca'; // string = texto
$idade = 26; // integer = inteiro
$altura = 1.76; // float = ponto flutuante 
$bonito = true; // boolean = boleano ou valor lógico

?>

<h2>Olá submundo</h2>

<p>Nome: <?php echo $nome; ?></p>
<p>Idade: <?= $idade; ?></p>
<p>Altura em mentro: <?= $altura; ?></p>

<?php 

if ($bonito) { // SE: entra se a expressão retornar 'TRUE'
    echo '<p>Você é bonito!</p>';
} else { // SENÃO: entra se a expressão anterior for 'FALSE'
    echo '<p>Você não é bonito!</p>';
}

// If com coparação
$cor = 'azul';

if ($cor === 'preta') {
    echo '<p>Sua cor é preta</p>';
} else {
    echo '<p>Sua cor não é preta</p>';
}

// If com operador 'and'
$altura = 160;
$peso = 40;

if ($altura >= 160 and $peso >= 65) { // TRUE AND TRUE == TRUE | FALSE AND TRUE == FALSE | FALSE AND FALSE == FALSE
    echo '<p>Você não é um anão</p>'; 
} else {
    echo '<p>Você é um anão</p>'; 
}

// If com operador 'or'
$altura = 160;
$peso = 40;

if ($altura >= 160 or $peso >= 65) { // TRUE OR TRUE == TRUE | TRUE OR FALSE == TRUE | FALSE OR FALSE == FALSE
    echo '<p>Você não é um anão</p>'; 
} else {
    echo '<p>Você é um anão</p>'; 
}

// If em cadeia
$altura = 170;
$idade = 18;

if ($altura >= 190) {
    echo '<p>Você é muito alto</p>'; 
} else if ($altura < 190 and $altura >= 170) {
    echo '<p>Você é alto</p>'; 
} else if ($altura < 170 and $altura >= 150) {
    echo '<p>Você é baixo</p>'; 
} else if ($altura < 150 and $idade <= 15) {
    echo '<p>Você é uma criança ainda</p>'; 
} else {
    echo '<p>Você é um anão</p>';
}

// If com operador 'and' e 'or'
$altura = 170;
$idade = 15;
$peso = 80;

if (
    ($idade <= 15 or $idade >= 60) 
    and ($peso >= 140 or $peso <= 50) 
    and ($altura >= 190 or $altura <= 120)
) {
    echo '<p>Você não pode brincar no parque de diversão</p>';
} else {
    echo '<p>Você pode brincar no parque de diversão</p>';
}

?>