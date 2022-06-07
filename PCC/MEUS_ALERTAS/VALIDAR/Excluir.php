<?php
include_once("../../CONEXAO/conexao.php");
$idalerta = $_GET['id_alerta'];
$query = "SELECT * FROM alerta";
if(!empty($query)){
    $query = mysqli_query($conex, "DELETE FROM alerta WHERE ID = '$idalerta'");
    header('location: ../index.php');
}

?>