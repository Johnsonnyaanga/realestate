<?php
include("conexion.php");

//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
if (!$link) {
	die('No Conecta: ' . mysql_error());
	}
$labase=mysql_select_db($base);
//------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Andrea Pomares .::. Negocios Inmobiliarios</title>
<link href="pomaresCSS.css" rel="stylesheet" type="text/css" />
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
    <td valign="top" class="titulos">Buscador de Propiedades</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="16"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="235"></td>
    <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="f1f1f1">
      <!--DWLayoutTable-->
      <tr>
        <td width="600" valign="top">
        <?php
        include("formubusqueda.php");
		?>
        
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
