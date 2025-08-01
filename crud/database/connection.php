<?php 

try {
    $connection = new PDO('mysql:host=localhost;dbname=senac;charset=utf8', 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}