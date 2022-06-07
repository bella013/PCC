<?php
session_start();
require_once('../../CONEXAO/conexao.php');

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_UNSAFE_RAW);
$senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);

if ((!empty($usuario)) && (!empty($senha))) {
	//Buscando usuário no Banco de Dados
	$resultado_usuario = "SELECT * FROM usuario WHERE Usuario='$usuario' LIMIT 1";
	$resultado_do_usuario = mysqli_query($conex, $resultado_usuario);

	if ($resultado_do_usuario) {
		$row_usuario = mysqli_fetch_assoc($resultado_do_usuario);
		if (password_verify($senha, $row_usuario['Senha'])) {
			setcookie('continuar_logado', '1', time() + (60 * 60 * 24), '/');
			setcookie("ID", "{$row_usuario['ID']}", time() + (60 * 60 * 24), '/');
			header("Location: ../../MEUS_ALERTAS/index.php");
		}
		else{
			$_SESSION['msg2'] = "<p style='color: red; padding: 6px 20px;'>Usuário ou senha incorreta!</p>";
			header('Location: ../index.php?login=true');
		}
	}
}
