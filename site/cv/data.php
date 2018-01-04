<?php

error_reporting(E_ALL);

echo "a";

ob_start();

//header('Cache-Control: no-cache, no-store, must-revalidate'); header('Pragma: no-cache'); header('Expires: 0');

include("pdo.php");


$resultado = pdo_consulta(
    "SELECT registro, nome, curriculo_nome, data_nascimento, sexo, cidade, vaga, rg, cpf FROM curriculos WHERE 1 = :um order by nome", 
    array(':um' => 1));

echo(json_encode($resultado));

ob_end_flush();

flush();

?>

