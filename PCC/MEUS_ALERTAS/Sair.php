<?php
session_start();
unset($_SESSION['ID'], $_SESSION['usuario'], $_SESSION['email'], $_SESSION['senha']);
setcookie('continuar_logado','1',time()-(60*60*24),'/');
header("Location: ../MEUS_ALERTAS/index.php");

?>