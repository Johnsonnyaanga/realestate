<?php
session_start();
//echo $_POST['enviaform'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../pomaresCSS.css" rel="stylesheet" type="text/css" />
<title>Area de administracion de Andrea Pomares</title>
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es obligatorio.\n'; }
    } if (errors) alert('No puede continuar porque:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
function confirmar ( mensaje ) {
return confirm( mensaje );
}
</script>
</head>

<body>

  <?php
if ($_SESSION['logueado']!=1){
	include("login.php");
}else{

include("../conexion.php");

//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
if (!$link) {
	die('No Conecta: ' . mysql_error());
	}
$labase=mysql_select_db($base);
//------------------------------------

if (isset($_GET['do'])){
	if ($_GET['iduser'] !=""){
		if ($_GET['do']=="3"){
			$eliminauser = mysql_query("delete from tb_ptg_usuarios where usu_id_i = ".$_GET['iduser']."");
			$mensaje="<p align='center'><font color='#006600'><b>El usuario se ha eliminado correctamente.</b></font></p>";	
		}else{
			if ($_GET['do']=="2"){
			$modificauser = mysql_query("select usu_id_i as iduser, usu_apellido_s as apellido, usu_nombres_s as nombre, usu_login_s as login from tb_ptg_usuarios where usu_id_i = ".$_GET['iduser']."");
			if (!($tusuario= mysql_fetch_array($modificauser))){
				$mensaje= "<p align='center'><font color='#FF0000'><b>No se encontr&oacute; el usuario seleccionado.<br> Intente con otro.</b></font></p>";
				}
			}	
		}
	}
}


if (($_POST['useredit'])!=""){
	if (trim($_POST['password']) == trim($_POST['repetirpass'])){ //chequeo que las passwords sean iguales (almenos vacias)
		if (strlen($_POST['password'])>5){ //chequeo que tenga al menos 6 caracteres para grabarla
			$masupdate = " , usu_password_s = '".md5(trim($_POST['password']))."'";
		}else{
			if (strlen($_POST['password'])>0){ //si tiene mas de 0 y menos de 6 entonces lo alerto para que ponga una pass mas larga
				$mensaje2 = "<p align='center'><font color='#FF0000'><b>Pero no se pudo modificar la password.<br> Intente nuevamente (el tamaño debe ser m&iacute;nimo 6 caracteres).</b></font></p>";
				}else{ //si no modificó las password entonces no se produciran cambios.
					$masupdate = "";
					}
		}
	}else{ //si no son iguales las passwords tipeadas
		$masupdate = "";
		$mensaje2 = "<p align='center'><font color='#FF0000'><b>Pero no se pudo modificar la password.<br> Intente nuevamente (Las passwords deben ser iguales).</b></font></p>";
	}
	if ($editaruser = mysql_query("update tb_ptg_usuarios set usu_nombres_s = '".$_POST['nombre']."', usu_apellido_s = '".$_POST['apellido']."', usu_login_s = '".$_POST['login']."' ".$masupdate." where usu_id_i=".$_POST['useredit']."")){
		$mensaje="<p align='center'><font color='#006600'><b>El usuario se ha modificado correctamente.</b></font></p>";
		if ($mensaje2!=""){
			$mensaje = $mensaje."<br>".$mensaje2;
		}
	}else{
		$mensaje= "<p align='center'><font color='#FF0000'><b>El usuario seleccionado no se pudo modificar.<br> Intente nuevamente.</b></font></p>";
	}
}

if (($_POST['usernew'])!=""){
	if ($newusuario = mysql_query("insert into tb_ptg_usuarios (usu_nombres_s, usu_apellido_s, usu_login_s, usu_password_s, est_id_i) values ('".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['login']."', '".md5(trim($_POST['password']))."',1)")){
		$mensaje="<p align='center'><font color='#006600'><b>El usuario ha sido ingresado correctamente.</b></font></p>";
	}else{
		$mensaje= "<p align='center'><font color='#FF0000'><b>El usuario no se pudo ingresar.<br> Intente nuevamente.</b></font></p>";
	}
}

?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="16%" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#BD0801" class="Estilo1"><div align="center">Administrar</div></td>
        </tr>
        <tr>
          <td bgcolor="#F1F1F1">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right"><a href="adminprop.php">Propiedades</a></div></td>
        </tr>
        <tr>
          <td><div align="right"><a href="adminzonas.php">Zonas</a></div></td>
        </tr>
        <tr>
          <td><div align="right"><strong>Usuarios</strong></div></td>
        </tr>
      </table>
      </td>
      <td width="600" valign="top"><form action="adminusers.php" method="post" name="usuarios" id="usuarios" onsubmit="MM_validateForm('nombre','','R','apellido','','R','login','','R');return document.MM_returnValue">
        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="50" colspan="3" valign="top" background="../images/ampliacion-encabezado.jpg"><div align="right" class="Estilo1">Usuario conectado: <?php echo $_SESSION['nombrelogin']?> - <a href="chausesion.php">cerrar sesión</a></div></td>
          </tr>
          <tr>
            <td colspan="3"><div align="center"><strong>Administración de USUARIOS</strong></div>
            <?php 
					if ($mensaje != ""){
						echo '<table width="100%" border="0"><tr><td bgcolor="#FF9900">';
						echo $mensaje;
						echo "</td></tr></table>";
					}
					?>   
			 </td>
          </tr>
          <tr>
            <td width="47%">&nbsp;</td>
            <td width="7%">&nbsp;</td>
            <td width="46%">&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">Nombre del Usuario:</div></td>
            <td>&nbsp;</td>
            <td valign="bottom"><label>
              <div align="left">
                <input name="nombre" type="text" id="nombre" maxlength="100" value="<?php echo $tusuario['nombre']; ?>" />
              </div>
            </label></td>
          </tr>
          <tr>
            <td><div align="right">Apellido del Usuario:</div></td>
            <td>&nbsp;</td>
            <td valign="bottom"><label>
              <div align="left">
                <input name="apellido" type="text" id="apellido" maxlength="50" value="<?php echo $tusuario['apellido']; ?>" />
              </div>
            </label></td>
          </tr>
          <tr>
            <td><div align="right">Login:</div></td>
            <td>&nbsp;</td>
            <td valign="bottom"><label>
              <div align="left">
                <input name="login" type="text" id="login" maxlength="100" value="<?php echo $tusuario['login']; ?>" />
              </div>
            </label></td>
          </tr>
          <tr>
            <td><div align="right">Password</div></td>
            <td>&nbsp;</td>
            <td valign="bottom"><label>
              <div align="left">
                <input name="password" type="password" id="password" maxlength="100" />
              </div>
            </label></td>
          </tr>
          <tr>
            <td><div align="right">Repetir Password:</div></td>
            <td><input type="hidden" name="useredit" id="useredit" value="<?php echo $_GET['iduser']; ?>" /></td>
            <td valign="bottom"><label>
              <div align="left">
                <input name="repetirpass" type="password" id="repetirpass" maxlength="255" />
              </div>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td valign="top">
             <?php
                if ($_GET['do']=="2"){
					?>
			  <p align="left"><em>Solo modifique las password si desea cambiarla.<br />
            De lo contrario deje ambos campos vacíos.<br />
            La password debe tener un mínimo de 6 caracteres.</em></p>				
					<?php
					}
				?>
            </td>
          </tr>
          <tr>
            <td colspan="3"><label>
              <div align="center">
                <?php
                if ($_GET['do']=="2"){
					echo "<input type='submit' name='enviaform' id='enviaform' value='Editar Usuario' />";
					}else{
						echo "<input type='hidden' name='usernew' id='usernew' value='1' />";
						echo "<input type='submit' name='enviaform' id='enviaform' value='Grabar nuevo Usuario' />";
					}
				?>
              </div>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
            </form>
      </td>
      <td width="230" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" bgcolor="#CE5700"><div align="center"><span class="Estilo1">Listado de Usuarios</span></div></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#F1F1F1"><a href="adminusers.php?do=1"><img src="../images/edit_add.png" alt="Agregar Zona" width="20" height="20" border="0" align="absmiddle" />Agregar Usuario</a></td>
        </tr>
        
        <?php
        $usuariosmysql = mysql_query("select usu_id_i as iduser, usu_nombres_s as nombre, usu_apellido_s as apellido, usu_login_s as login from tb_ptg_usuarios");
		while ($usuario = mysql_fetch_array($usuariosmysql)){
		?>
        <tr>
          <td width="174"><a href="adminusers.php?do=2&iduser=<?php echo $usuario['iduser']; ?>"><?php echo $usuario['nombre']." ".$usuario['apellido']." (".$usuario['login'].")"; ?></a></td>
          <td width="20"><a href="adminusers.php?do=2&iduser=<?php echo $usuario['iduser']; ?>"><img src="../images/edit.png" alt="Editar Usuario <?php echo $usuario['nombre']." ".$usuario['apellido']; ?>" width="20" height="20" border="0" /></a></td>
          <td width="20"><a href="adminusers.php?do=3&iduser=<?php echo $usuario['iduser']; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el usuario <?php echo $usuario['nombre']." ".$usuario['apellido']; ?>?');"><img src="../images/edit_remove.png" alt="Eliminar Usuario <?php echo $usuario['nombre']." ".$usuario['apellido']; ?>" width="20" height="20" hspace="5" border="0" /></a></td>
        </tr>
        <?php
        }
		?>
        
      </table></td>
    </tr>
  </table>

<?php
}
?>
</body>
</html>