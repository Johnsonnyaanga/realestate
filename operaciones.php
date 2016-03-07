<?php
//VENTA = 1     ALQUILER = 2
if (isset($_GET['tcm'])){
	$tipoop= $_GET['tcm']; //tipo de comercializacion (venta, alquiler, ...)
	$tipopropiedad = $_GET['tprop'];
	}else
		{
		if  (isset($_GET['buscar'])){
			$tipoop = $_GET['tipocomercializacion'];
			$zona = $_GET['zonapropiedad'];
			$tipopropiedad = $_GET['tipopropiedad'];
			$cantambientes = $_GET['cantidadambientes'];
			}else{
				$tipoop= 1; //tipo de comercializacion (venta, alquiler, ...)
				$tipopropiedad = "";
				//header("location:index.php");
				}
}


include("conexion.php");

//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
if (!$link) {
	die('No Conecta: ' . mysql_error());
	}
$labase=mysql_select_db($base);


$almenosuna = 0;
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
    <td valign="top" class="titulos">
     <?php
	 	if (isset($_GET['buscar'])){
			echo "Resultados de la B&uacute;squeda ";
			}else{
				echo     "Propiedades en ";
				$consultatipocom = mysql_query("select tc.tcm_descripcion_s as tipoopera from tb_ptg_tipos_comercializacion tc where tc.tcm_id_i =".$tipoop."");
				if ($tipooperacion = mysql_fetch_array($consultatipocom)){
					echo "".$tipooperacion['tipoopera'].""; 
				}
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
    <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="f1f1f1">
      <!--DWLayoutTable-->
      <tr>
        <td width="600" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          
       <?php
		  
		if ($cantambientes==0){
			$filtrocantamb = "";
			}else{
				$filtrocantamb = " and pr.pro_cant_ambientes_i = ".$cantambientes;
		} 
		
		if ($zona==0){
			$filtrozona = "";
			}else{
				$filtrozona = " and pr.zon_id_i = ".$zona;
		} 
		  
	 	if ($tipopropiedad=="" || $tipopropiedad==0){
			$filtrotipoprop = "";
			}else{
				$filtrotipoprop = " and pr.tpr_id_i = ".$tipopropiedad;
		}
		$consultaprop = mysql_query("select pr.pro_id_i as idprop, pr.pro_descripcion_corta_s as descripcion, pr.pro_hubicacion_s as ubicacion, pr.pro_imagen_url_s as imagen from tb_ptg_propiedades pr, tb_ptg_tipos_propiedades tp, tb_ptg_tipos_comercializacion tc, tb_ptg_estados es where es.est_id_i = 1 and tp.tpr_id_i = pr.tpr_id_i and tc.tcm_id_i = pr.tcm_id_i and pr.tcm_id_i = ".$tipoop.$filtrocantamb.$filtrozona.$filtrotipoprop." order by pr.pro_destacada_b, pr.pro_id_i desc");
		 while ($propiedades = mysql_fetch_array($consultaprop)){
		 	$almenosuna = 1;
	?>
          <tr>
            <td width="600" height="78">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div align="right">
                  <table width="583" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="180" align="left" valign="top"><a href="detalle.php?tcm=<?php echo $tipoop; ?>&prop=<?php echo $propiedades['idprop']; ?>"><img src="<?php echo "./images/prop/mini/".$propiedades['imagen'].""; ?>" alt="Clic para ver mas detalles" hspace="10" vspace="10" border="0"></a></td>
                        <td valign="top">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td> <?php echo "<br><div align='left' class='ubiref'><b>".$propiedades['ubicacion']."</b>"; ?></td>
                            <td><?php echo "<br><div align='right' class='ubiref'><b>Ref. ".$propiedades['idprop']."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>"; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2"><?php echo "<p align='left'>".$propiedades['descripcion']."</p>"; ?></td>
                          </tr>
                        </table></td>
                      </tr>
                                  </table>
                </div></td>
              </tr>
              <tr>
                <td>
                <img src="images/mini_fondobase.jpg" width="600" height="59" border="0" usemap="#Map<?php echo $propiedades['idprop']; ?>" />            
                <map name="Map<?php echo $propiedades['idprop']; ?>" id="Map<?php echo $propiedades['idprop']; ?>"><area shape="rect" coords="472,1,581,29" href="detalle.php?tcm=<?php echo $tipoop; ?>&prop=<?php echo $propiedades['idprop']; ?>" alt="Ver detalles" /></map>
                </td>
              </tr>
            </table>
            </td>
            </tr>
           
          <?php
      }
	  if ($almenosuna == 0){
	  	echo "<p align='center'><b>No se encontraron propiedades con esas caracter&iacute;sticas.<br>Intente una nueva b&uacute;squeda:</p></b><br><br>";
		
		include("formubusqueda.php");
		
	  }
	  
	  ?>    
        </table></td>
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
