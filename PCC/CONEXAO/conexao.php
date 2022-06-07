<?php

$hostname = "localhost";
$user = "root";
$password = "";
$database = "alerte";
$conex = mysqli_connect($hostname, $user, $password, $database);

if (!$conex){
	print("Falha na conexão com banco de dados");
}
?>