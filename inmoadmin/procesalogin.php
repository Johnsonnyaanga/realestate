<?php
session_start();
include("../conexion.php");

//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
if (!$link) {
	die('No Conecta: ' . mysql_error());
	}
$labase=mysql_select_db($base);
//------------------------------------

if (isset($_POST['nombre']) && isset($_POST['password'])){
	$consultausuario = mysql_query("select u.usu_id_i, u.usu_nombres_s as nombre, u.usu_apellido_s as apellido from tb_ptg_usuarios u where u.usu_login_s = '".$_POST['nombre']."' and usu_password_s = '".md5($_POST['password'])."' and u.est_id_i = 1");

	if ($usuario = mysql_fetch_array($consultausuario)){
		$_SESSION['logueado'] = 1;
		$_SESSION['nombrelogin'] = $usuario['nombre']." ".$usuario['apellido'];
	}
}
header("location: index.php");
?>