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
?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="16%" valign="top"><p><b>Administrar:</b></p>
<ul>
  <li><a href="adminprop.php">Propiedades</a></li>
  <li><strong>Imagenes</strong></li>
  <li><a href="adminzonas.php">Zonas</a></li>
  <li><a href="adminusers.php">Usuarios</a></li>
</ul></td>
      <td width="49%">&nbsp;</td>
      <td width="35%">&nbsp;</td>
    </tr>
  </table>

<?php
}
?>
</body>
</html>