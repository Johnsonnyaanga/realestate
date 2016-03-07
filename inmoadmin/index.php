<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../pomaresCSS.css" rel="stylesheet" type="text/css" />
<title>Area de administracion de Andrea Pomares</title>
</head>

<body>

  <?php
if ($_SESSION['logueado']!=1){
	include("login.php");
}else{
	include("adminprop.php");
}
?>
</body>
</html>
