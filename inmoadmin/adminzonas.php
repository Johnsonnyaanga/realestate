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
	if ($_GET['idzona'] !=""){
		if ($_GET['do']=="3"){
			$eliminarzona = mysql_query("delete from tb_ptg_zonas where zon_id_i = ".$_GET['idzona']."");
			$mensaje="<p align='center'><font color='#006600'><b>La zona se ha eliminado correctamente.</b></font></p>";	
		}else{
			if ($_GET['do']=="2"){
			$modificazona = mysql_query("select zon_id_i as idzona, zon_descripcion_s as nombrezona from tb_ptg_zonas where zon_id_i = ".$_GET['idzona']."");
			if (!($zona= mysql_fetch_array($modificazona))){
				$mensaje= "<p align='center'><font color='#FF0000'><b>No se encontr&oacute; la zona seleccionada.<br> Intente con otra.</b></font></p>";
				}
			}	
		}
	}
}


if (($_POST['zonaedit'])!=""){
	if ($editarzona = mysql_query("update tb_ptg_zonas set zon_descripcion_s = '".$_POST['nombrezona']."' where zon_id_i=".$_POST['zonaedit']."")){
		$mensaje="<p align='center'><font color='#006600'><b>La zona se ha modificado correctamente.</b></font></p>";
	}else{
		$mensaje= "<p align='center'><font color='#FF0000'><b>La zona seleccionada no se pudo modificar.<br> Intente nuevamente.</b></font></p>";
	}
}

if (($_POST['zonanew'])!=""){
	if ($newzona = mysql_query("insert into tb_ptg_zonas (zon_descripcion_s) values ('".$_POST['nombrezona']."')")){
		$mensaje="<p align='center'><font color='#006600'><b>La zona ha sido ingresada correctamente.</b></font></p>";
	}else{
		$mensaje= "<p align='center'><font color='#FF0000'><b>La zona no se pudo ingresar.<br> Intente nuevamente.</b></font></p>";
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
          <td><div align="right"><strong>Zonas</strong></div></td>
        </tr>
        <tr>
          <td><div align="right"><a href="adminusers.php">Usuarios</a></div></td>
        </tr>
      </table>
      </td>
      <td width="600" valign="top"><form action="adminzonas.php" method="post" name="zonas" id="zonas" onsubmit="MM_validateForm('nombrezona','','R');return document.MM_returnValue">
        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="50" colspan="3" valign="top" background="../images/ampliacion-encabezado.jpg"><div align="right" class="Estilo1">Usuario conectado: <?php echo $_SESSION['nombrelogin']?> - <a href="chausesion.php">cerrar sesión</a></div></td>
          </tr>
          <tr>
            <td colspan="3"><div align="center"><strong>Administración de ZONAS</strong></div>
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
            <td width="43%">&nbsp;</td>
            <td width="11%">&nbsp;</td>
            <td width="46%">&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">Nombre de la Zona:</div></td>
            <td><input type="hidden" name="zonaedit" id="zonaedit" value="<?php echo $_GET['idzona']; ?>" /></td>
            <td><label>
              <input name="nombrezona" type="text" id="nombrezona" maxlength="100" value="<?php echo $zona['nombrezona']; ?>" />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><label>
              <div align="center">
                <?php
                if ($_GET['do']=="2"){
					echo "<input type='submit' name='enviaform' id='enviaform' value='Editar Zona' />";
					}else{
						echo "<input type='hidden' name='zonanew' id='zonanew' value='1' />";
						echo "<input type='submit' name='enviaform' id='enviaform' value='Grabar nueva Zona' />";
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
      <td width="230" valign="top"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" bgcolor="#CE5700"><div align="center"><span class="Estilo1">Listado de zonas</span></div></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#F1F1F1"><a href="adminzonas.php?do=1"><img src="../images/edit_add.png" alt="Agregar Zona" width="20" height="20" border="0" align="absmiddle" />Agregar Zona</a></td>
        </tr>
        
        <?php
        $zonasmysql = mysql_query("select zon_id_i as idzona, zon_descripcion_s as nombre from tb_ptg_zonas");
		while ($zonas = mysql_fetch_array($zonasmysql)){
		?>
        <tr>
          <td width="174"><a href="adminzonas.php?do=2&idzona=<?php echo $zonas['idzona']; ?>"><?php echo $zonas['nombre']; ?></a></td>
          <td width="20"><a href="adminzonas.php?do=2&idzona=<?php echo $zonas['idzona']; ?>"><img src="../images/edit.png" alt="Editar Zona <?php echo $zonas['nombre']; ?>" width="20" height="20" border="0" /></a></td>
          <td width="20"><a href="adminzonas.php?do=3&idzona=<?php echo $zonas['idzona']; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la zona <?php echo $zonas['nombre']; ?>?');"><img src="../images/edit_remove.png" alt="Eliminar Zona <?php echo $zonas['nombre']; ?>" width="20" height="20" hspace="5" border="0" /></a></td>
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