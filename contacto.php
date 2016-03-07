<?php
include("conexion.php");

//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
if (!$link) {
	die('No Conecta: ' . mysql_error());
	}
$labase=mysql_select_db($base);
//------------------------------------

$mensaje=""; //posible mensaje en respuesta a la consulta que envie un usuario.

if (isset($_GET['do']) && $_GET['do']=="1"){
	$cabeceras = "From: '".$_REQUEST['nombre']."' <".trim($_REQUEST['mail']).">\r\nContent-type: text/html\r\n";
$asunto="Consulta desde AndreaPomares.com.ar";

$Cadena=$_REQUEST['consulta'];
$Reemplazar='"';
$CadenaNueva="'";

$content=ereg_replace($Reemplazar,$CadenaNueva,$Cadena); 

if ($_POST['idprop']!=""){
	$referencia = $_POST['idprop'];
	}else{
		$referencia = "No especificada";
	}

$cuerpo="<html>";
$cuerpo.="<head>";
$cuerpo.="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";
$cuerpo.="<title>Formulario de Consultas de Andrea Pomares</title>";
$cuerpo.="</head>";
$cuerpo.="<body style='margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px;'>";
$cuerpo.="<b>Nombre:</b> ".$_POST['nombre']."<br>";
$cuerpo.="<b>Mail:</b> ".$_POST['mail']."<br>";
$cuerpo.="<b>Tel&eacute;fono:</b> ".$_POST['telefono']."<br>";
$cuerpo.="<b>Referencia:</b> ".$referencia."<br>";
$cuerpo.="<b>Consulta:</b> <p>".$content."</p>";
$cuerpo.="</body></html>";

$cabeceras2 = "From: 'Andrea Pomares' <info@andreapomares.com.ar>\r\nContent-type: text/html\r\n";
$asunto2="Web Andrea Pomares";
$cuerpo2="<html>";
$cuerpo2.="<head>";
$cuerpo2.="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";
$cuerpo2.="<title>Formulario de Consultas de Andrea Pomares</title>";
$cuerpo2.="</head>";
$cuerpo2.="<body style='margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px;'>";
$cuerpo2.="Gracias <b>".$_POST['nombre']."</b><br>";
$cuerpo2.="Usted ha enviado satisfactoriamente una consulta desde <a href='http://www.andreapomares.com.ar' target=_blank>Web AndreaPomares</a><br>";
$cuerpo2.="Su consulta fue la siguiente: <p>".$content."</p>";
$cuerpo2.="<br>Pronto nos pondremos en contacto con usted.</body></html>";

$almail = "info@andreapomares.com.ar";
$almail2 = $_REQUEST['mail'];
	//mando el correo... 
if (mail($almail,$asunto,$cuerpo,$cabeceras)){ //este mail es para Andrea Pomares.
	mail($almail2,$asunto2,$cuerpo2,$cabeceras2); //este mail es para el usuario.
$mensaje="<p align='center'><font color='#006600'><b>Gracias por enviar su consulta. <br> Responderemos a la brevedad.</b></font></p>";	
	}else{
		$mensaje= "<p align='center'><font color='#FF0000'><b>Su consulta no se pudo enviar.<br> Intente nuevamente.</b></font></p>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Andrea Pomares .::. Negocios Inmobiliarios</title>
<link href="pomaresCSS.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener una dirección de e-mail.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es obligatorio.\n'; }
    } if (errors) alert('Ocurrieron errores:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
</head>

<body>
<table width="995" border="0" align="center" cellpadding="0" cellspacing="0" background="images/vertical-con-rojo.jpg">
  <!--DWLayoutTable-->
  <tr>
    <td height="115" colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="995" height="115" valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="995" height="115">
          <param name="movie" value="banner_superior.swf" />
          <param name="quality" value="high" />
          <embed src="banner_superior.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="995" height="115"></embed>
        </object></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="280" rowspan="5" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="280" height="413" valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="280" height="413">
          <param name="movie" value="botonera2.swf" />
          <param name="quality" value="high" />
          <embed src="botonera2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="280" height="413"></embed>
        </object></td>
        </tr>
    </table></td>
    <td height="128" colspan="5" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="715" height="128" valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="715" height="128">
          <param name="movie" value="banner_mini.swf" />
          <param name="quality" value="high" />
          <embed src="banner_mini.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="715" height="128"></embed>
        </object></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="15" height="16"></td>
    <td width="21"></td>
    <td width="474"></td>
    <td width="105"></td>
    <td width="100"></td>
  </tr>
  <tr>
    <td height="21"></td>
    <td></td>
    <td valign="top" class="titulos">Contactos</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="16"></td>
    <td></td>
    <td>
	<?php 
	if ($mensaje<>""){
		echo $mensaje;
	}
	?>
    </td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="235"></td>
    <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="f1f1f1">
      <!--DWLayoutTable-->
      <tr>
        <td width="600" valign="top">
        <form action="contacto.php?do=1" method="post" name="form1" id="form1" onsubmit="MM_validateForm('nombre','','R','mail','','RisEmail','consulta','','R');return document.MM_returnValue">
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
            <tr>
              <td width="40%">&nbsp;</td>
              <td width="10%">&nbsp;</td>
              <td width="50%">                <label></label>              </td>
            </tr>
            <tr>
              <td><div align="right">Nombre:</div></td>
              <td width="10%">&nbsp;</td>
              <td width="50%"><div align="left">
                <input type="text" name="nombre" id="nombre" />
              </div></td>
            </tr>
            <tr>
              <td><div align="right">Mail:</div></td>
              <td>&nbsp;</td>
              <td><div align="left">
                <input type="text" name="mail" id="mail" />
              </div></td>
            </tr>
            <tr>
              <td><div align="right">Tel&eacute;fono:</div></td>
              <td>&nbsp;</td>
              <td><div align="left">
                <input type="text" name="telefono" id="telefono" />
              </div></td>
            </tr>
            <?php
            if (isset($_GET['ref'])){
			?>
            <tr>
              <td><div align="right">Referencia:</div></td>
              <td>&nbsp;</td>
              <td><div align="left"><?php echo "Nro de Propiedad: ".$_GET['ref']."<br>";?></div></td>
            </tr>
            <?php
            }
			?>
            <tr>
              <td><div align="right">Consulta:</div></td>
              <td>&nbsp;</td>
              <td><label>
                <div align="left">
                  <textarea name="consulta" id="consulta" cols="30" rows="5"></textarea>
                  </div>
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="hidden" name="idprop" id="idprop" value="<?php echo $_GET['ref']; ?>" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><label>
                <div align="center">
                  <input type="submit" name="button" id="button" value="Consultar" />
                  </div>
              </label></td>
              </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>
            </form>
        </td>
      </tr>
      <tr>
        <td height="689">&nbsp;</td>
      </tr>
      
    
      
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="626"></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="30" colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="images/pie.jpg">
      <!--DWLayoutTable-->
      <tr>
        <td width="320" height="10"></td>
          <td width="374"></td>
          <td width="77"></td>
          <td width="124"></td>
          <td width="100"></td>
        </tr>
      <tr>
        <td height="13"></td>
          <td valign="top" class="pie">Falucho 2852 . PB 2 . Tel: (0223) 492-1423 . Mar del Plata, Argentina</td>
          <td></td>
          <td rowspan="2" valign="top" class="pie">info@andreapomares.com</td>
          <td></td>
        </tr>
      <tr>
        <td height="6"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      
      
      
      
      
    </table></td>
  </tr>
</table>
</body>
</html>
