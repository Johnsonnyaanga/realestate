<?php
//VENTA = 1     ALQUILER = 2
if ($_GET['tcm']=='1' || $_GET['tcm']=='2'){
	$tipoop= $_GET['tcm'];
	}else
		{
		header("location:index.php");
}

//tipo de propiedad: campo, casa, depto etc...
$tipopropiedad = $_GET['tprop'];

//propiedad seleccionada para ver el detalle
$lapropiedad = $_GET['prop'];

//cantidad de fotos por fila que se mostrarán en el detalle de la propiedad.
$fotosporfila = 3;

//Separacion Horizontal entre las imagenes extras
$separah = 3;
//Separacion Vertical entre las imagenes extras
$separav = 3;


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
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link href="pomaresCSS.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Andrea Pomares .::. Negocios Inmobiliarios</title>


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
    <td valign="top" class="titulos">Propiedades en 
     <?php
		$consultatipocom = mysql_query("select tc.tcm_descripcion_s as tipoopera from tb_ptg_tipos_comercializacion tc where tc.tcm_id_i =".$tipoop."");
		if ($tipooperacion = mysql_fetch_array($consultatipocom)){
			echo "".$tipooperacion['tipoopera'].""; 
		}
	?>
    </td>
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
    <td colspan="3" rowspan="2" valign="top">
    
     <?php
	 	
		$consultaprop = mysql_query("select pr.pro_id_i as idprop, pr.pro_descripcion_corta_s as descripcorta, pr.pro_descripcion_extendida_s as descripextendida, pr.pro_cant_ambientes_i as ambientes, pr.pro_cantidad_metros_i as metros, pr.pro_hubicacion_s as ubicacion, pr.pro_precio_venta_i as precio, pr.pro_precio_visible_b as verprecio, pr.pro_imagen_url_s as imagen from tb_ptg_propiedades pr, tb_ptg_estados es where es.est_id_i = 1 and pr.pro_id_i = ".$lapropiedad."");
		 if ($propiedades = mysql_fetch_array($consultaprop)){
		 $ubicacion = $propiedades['ubicacion'];
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="f1f1f1">
      <!--DWLayoutTable-->
      <tr>
        <td height="50" colspan="6" valign="top"><img src="images/ampliacion-encabezado.jpg" width="600" height="50" /></td>
        </tr>
      <tr>
        <td width="22" height="210">&nbsp;</td>
        <td colspan="2" rowspan="2" valign="top"><img src="<?php echo "./images/prop/gran/".$propiedades['imagen'].""; ?>" /></td>
        <td colspan="2" valign="top">
		  
		    <?php 
			echo "<div align='left' class='ubiref'><b>&nbsp;&nbsp;&nbsp;&nbsp;".$propiedades['ubicacion']."<br>&nbsp;&nbsp;&nbsp;&nbsp;Ref. ".$propiedades['idprop']."</b></div>"; 
		?>        
		  <p>
          <?php 
			echo "<br><font class='titudesc'><b>&nbsp;&nbsp;&nbsp;&nbsp;Ambientes:</b></font> ".$propiedades['ambientes']."<br><br>";
			echo "<font class='titudesc'><b>&nbsp;&nbsp;&nbsp;&nbsp;Metros Cuadrados:</b></font> ".$propiedades['metros']."<br>";
			if ($propiedades['verprecio'] == 1){
				echo "<br><font class='titudesc'><b>&nbsp;&nbsp;&nbsp;&nbsp;Precio:</b></font> ".$propiedades['precio']."<br>";
			}
			echo "<a href='contacto.php?ref=".$propiedades['idprop']."'><br><font class='titudesc'><b>&nbsp;&nbsp;&nbsp;&nbsp;clic aqu&iacute; para consultar.</b></font></a>";
		?>
          </p>
          </td>
        <td width="17">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="2"><div align="right"><a href="#masdetalles"><img src="images/masdetalles.jpg" alt="Ver m&aacute;s detalles" width="125" height="25" border="0" /></a></div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="27">&nbsp;</td>
        <td colspan="4">
        <p>
          <?php 
			echo $propiedades['descripcorta']; 
		?>
          </p>        </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4" valign="top">
        <p align="left">
        	<?php
	 	
		$consultaimg = mysql_query("select im.img_id_i as idimg, pr.pro_id_i as idprop, im.img_descripcion_s as descripcion, im.img_url_s as ruta from tb_ptg_propiedades pr, tb_ptg_imagenes_propiedad im where pr.pro_id_i = im.pro_id_i and pr.pro_id_i = ".$lapropiedad."");
		$van = 0;
		 while ($imagenes = mysql_fetch_array($consultaimg)){
		 	if (($van % $fotosporfila)==0){
				echo "<br>";
			}
			echo "<a href='images/prop/gran/".$imagenes['ruta']."' rel='lightbox[".$ubicacion."]' title='".$imagenes['descripcion']."'><img align='absmiddle' src='images/prop/mini/".$imagenes['ruta']."' alt='".$imagenes['descripcion']."' border='0' hspace='".$separah."' vspace='".$separav."' /></a>";
			
			$van = $van + 1;
		}
    ?>
        </p>
        <p>
          <?php 
			echo $propiedades['descripextendida']; 
		?>
          </p>
          
          <p><a name="masdetalles" id="masdetalles"></a></p>
          
          <?php
		  
          	$consultadetalles = mysql_query("select pr.pro_id_i as idprop, gtd.gtd_descripcion_s as grupotipodetalle, td.tdt_descripcion_s as tipodetalle, dp.dpr_descripcion_s as detalle from tb_ptg_propiedades pr, tb_ptg_detalles_propiedad dp, tb_ptg_tipos_detalle td, tb_ptg_grupos_tipo_detalle gtd where gtd.gtd_id_i = td.tdt_id_i and td.tdt_id_i = dp.tdt_id_i and dp.pro_id_i = pr.pro_id_i and pr.pro_id_i = ".$lapropiedad." order by gtd.gtd_orden, td.tdt_descripcion_s");
		$van = 0;
		$grupodetalle = mysql_fetch_row($consultadetalles);
		$grupodetalle = $grupodetalle['grupotipodetalle'];
		mysql_data_seek( $consultadetalles, 0 );
		 while ($detalles = mysql_fetch_array($consultadetalles)){
		 	if ($grupodetalle <> $detalles['grupotipodetalle']){
				$grupodetalle = $detalles['grupotipodetalle'];
		 		echo "<br><br><div class='titudesc'><b>".$detalles['grupotipodetalle']."</b></div><br>";
				}
				echo "<b>".$detalles['tipodetalle'].":</b> ".$detalles['detalle']."<br>";
		}
		  ?>
          
          
          
          </td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td height="29">&nbsp;</td>
        <td width="127">&nbsp;</td>
        <td width="199">&nbsp;</td>
        <td width="113">&nbsp;</td>
        <td width="122" valign="top">
		<?php 
			echo "<a style='text-decoration:none;' href='".$_SERVER['HTTP_REFERER']."'><img src='images/volveralistado.jpg' width='124' height='26' border='0' /></a>"; 
		?>        </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php
    }else{
		echo "No se encuentra la Propiedad seelccionada.";
	}
	?>
    
    </td>
    <td>&nbsp;</td>
  </tr>
  
  
  
  
  

  
  
  
  
  
  
  
  <tr>
    <td></td>
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
