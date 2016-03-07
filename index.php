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
<style type="text/css">
<!--
body {
	background-image: url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="pomaresCSS.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: none;
	color: #999999;
}
a:active {
	text-decoration: none;
	color: #999999;
}
-->
</style></head>

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
          <param name="movie" value="botonera.swf" />
          <param name="quality" value="high" />
          <embed src="botonera.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="280" height="413"></embed>
        </object></td>
        </tr>
    </table></td>
    <td height="302" colspan="5" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="715" height="302" valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="715" height="302">
          <param name="movie" value="bannerbig.swf" />
          <param name="quality" value="high" />
          <embed src="bannerbig.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="715" height="302"></embed>
        </object></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="15" height="19">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="474">&nbsp;</td>
    <td width="105">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td height="21"></td>
    <td></td>
    <td valign="top" class="titulos">Bienvenidos a Pomares, Negocios Inmobiliarios</td>
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
    <td height="58"></td>
    <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="f1f1f1">
      <!--DWLayoutTable-->
      <tr>
        <td width="18" height="17"></td>
          <td width="3"></td>
          <td width="270"></td>
          <td width="15"></td>
          <td width="273"></td>
          <td width="21"></td>
        </tr>
      <tr>
        <td height="109"></td>
          <td></td>
          <td colspan="3" valign="top" class="contenido"><p>Somos una empresa joven, din&aacute;mica y decidida, con presencia en Mar del Plata<strong>, </strong>gracias a la calidad de nuestros servicios y de nuestro equipo humano.<br />
            <br />
  Basamos nuestro trabajo en el valor de la innovaci&oacute;n e iniciativa y en el  esfuerzo personal. Avanzamos hacia un futuro sin fronteras y sin limitaciones,  intercomunicado y activo, ayud&aacute;ndonos a todos a conseguir nuestros objetivos. <br />
  <br />
  El Sector Inmobiliario es una de las &aacute;reas comerciales que m&aacute;s puede  beneficiarse del uso de nuevas herramientas y soluciones que hacen posible la  desaparici&oacute;n de barreras f&iacute;sicas e idiom&aacute;ticas, acercando a millones de  clientes hacia su empresa, negocio, despacho u oficina, hasta sus ofertas,  promociones y productos, que hacen posible un mayor volumen de negocio. </p>          </td>
          <td></td>
        </tr>
      <tr>
        <td height="31"></td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
 
      
        <tr>
          <td height="45"></td>
          <td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr>
              <td width="273" height="45" valign="top"><img src="images/ventas.jpg" alt="Ventas" width="273" height="45" /></td>
              </tr>
          
          
          </table></td>
          <td>&nbsp;</td>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr>
              <td width="273" height="45" valign="top"><img src="images/alquileres.jpg" alt="Alquileres" width="273" height="45" /></td>
              </tr>
          </table></td>
          <td></td>
        </tr>
      <tr>
        <td height="235"></td>
          <td colspan="2" valign="top">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr>
              <td width="273" height="235" valign="top">
              
              
              <!-- AQUI COMIENZA LA TABLA QUE ME MUESTRA LAS VENTAS DESTACADAS-->
              <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <?php
              $consulta = mysql_query("select distinct tp.tpr_descripcion_s as tipoprop, tp.tpr_id_i as idtipoprop from tb_ptg_tipos_propiedades tp, tb_ptg_propiedades p where tp.tpr_id_i = p.tpr_id_i and p.tcm_id_i = 1 order by tp.tpr_orden_lista_i");
			  while ($listaventa = mysql_fetch_array($consulta)){
			  ?>
                <tr>
                  <td class="lista_tipo_prop"><?php echo "<a href='operaciones.php?tcm=1&tprop=".$listaventa['idtipoprop']."'>".$listaventa['tipoprop']."</a>"; ?></td>
                </tr>
                <?php
                }
				?>
              </table>
              <!-- FIN DE LA TABLA QUE ME MUESTRA LAS VENTAS SDESTACADAS-->
              
              
              </td>
            </tr>
          </table>          </td>
          <td></td>
          <td valign="top">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr>
              <td width="273" height="235" valign="top">
              
              
              <!-- AQUI COMIENZA LA TABLA QUE ME MUESTRA LOS ALQUILERES DESTACADOS-->
              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <?php
              $consultalqui = mysql_query("select distinct tp.tpr_descripcion_s as tipoprop from tb_ptg_tipos_propiedades tp, tb_ptg_propiedades p where tp.tpr_id_i = p.tpr_id_i and p.tcm_id_i = 2 order by tp.tpr_orden_lista_i");
			  while ($listaalquiler = mysql_fetch_array($consultalqui)){
			  ?>
                <tr>
                  <td class="lista_tipo_prop"><?php echo $listaalquiler['tipoprop']; ?></td>
                </tr>
                <?php
                }
				?>
              </table>
              <!-- FIN DE LA TABLA QUE ME MUESTRA LOS ALQUILERES DESTACADOS-->
              
              
              </td>
            </tr>
          </table>
          </td>
          <td></td>
        </tr>
      

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    </table></td>
    <td>&nbsp;</td>
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td height="379">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
          <td rowspan="2" valign="top" class="pie"><a href="mailto:info@andreapomares.com">info@andreapomares.com</a></td>
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
