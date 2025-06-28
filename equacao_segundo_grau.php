<?php 

$a = 4;
$b = -4;
$c = 16;

$delta = ($b**2) + (-4*$a*$c);

if ($delta < 0) {
    echo 'Delta é negativo, esse equação não possui uma resposta reais.';
} else if ($delta == 0) { 
    $x = (-1 * $b) / (2 * $a);

    echo "X = {$x}";
} else {
    $x1 = ((-1 * $b) + ($delta**(1/2))) / (2 * $a);
    $x2 = ((-1 * $b) - ($delta**(1/2))) / (2 * $a);

    echo "X1 = {$x1}<br>X2 = {$x2}";
}

?>