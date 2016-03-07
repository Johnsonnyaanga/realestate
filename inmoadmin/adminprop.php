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
<script type="text/javascript" src="../js/prototype.js"></script>
<script type="text/javascript" src="../js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="../js/lightbox.js"></script>
<link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
<script src="/js/prototype.js" type="text/javascript"></script>
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
		include("resize-cubic.php");
		//include("resize.php");
		include("resize.image.class.php");
		function createRandomPassword($len = 6) {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
		
			while ($i <= $len) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
		
		//CHEQUEO LA CONEXION A LA BASE DE DATOS Y LA SELECCIONO.
		if (!$link) {
			die('No Conecta: ' . mysql_error());
			}
		$labase=mysql_select_db($base);
		//------------------------------------
		
		/*
		
		El  $_GET['do'] puede contener:
		1 = Agregar Propiedad;
		2 = Edita	r Propiedad;
		3 = Eliminar Propiedad
		4 = Guardar Cambios de una propiedad que se pretendio modificar (UPDATE ...)
		5 = Guardar Detalles de una Propiedad;
		6 = Editar un Detalle de la Propiedad;
		7 = Eliminar un Detalle de la Propiedad;
		8 = Agregar una Imagen;
		9 = Guardar Info de una imagen (DESCRIPCION Y/O ORDEN);
		10 = Eliminar un Imagen
		
		
		*/
		
		$mensajeimg = "";
		if (isset($_GET['do'])){
		
			//INICIO tratamiento de la imagen por defecto
			if ($HTTP_POST_FILES["imagenpordefecto"]['name']!=""){						
				$nombre_archivo = $HTTP_POST_FILES["imagenpordefecto"]['name'];
				$tipo_archivo   = $HTTP_POST_FILES["imagenpordefecto"]['type'];
				//echo "nombre: ".$nombre_archivo." -- tipo: ".$tipo_archivo;
			
				if (($tipo_archivo == "jpeg") or ($tipo_archivo == "jpg") or ($tipo_archivo == "image/jpeg") or ($tipo_archivo == "image/pjpeg")){
					if (file_exists("../images/prop/org/$nombre_archivo")) $nombre_archivo = createRandomPassword(4).$nombre_archivo;
						if (move_uploaded_file($HTTP_POST_FILES["imagenpordefecto"]['tmp_name'], "../images/prop/org/$nombre_archivo")==1){
							if (copy("../images/prop/org/$nombre_archivo", "../images/prop/mini/$nombre_archivo")){
								if (copy("../images/prop/org/$nombre_archivo", "../images/prop/gran/$nombre_archivo")){
										
									$bigSize = getimagesize("../images/prop/gran/$nombre_archivo");
									if (($bigSize[0]>450) or ($bigSize[1]>450)){
										// determinar el path de la imagen
										$thumb=new Thumbnail("../images/prop/gran/$nombre_archivo");
										$thumb->size_auto(450);	// el tamaño mas grande width o height para el thumb
										$thumb->quality=100;          //calidad del formato JPG
										$thumb->output_format='JPG';  // JPG | PNG
										//$thumb->jpeg_progressive=0; // JPEG progresivo : 0 = no , 1 = si
										$thumb->allow_enlarge=false;  // permitir agrandar el thumbnail
										// Calcular factor de calidad del JPEG 
										$thumb->bicubic_resample=true; // [OPCIONAL] RESAMPLE el algoritmo a cubico
										$thumb->process();   		   // generar imagen
										$thumb->save("../images/prop/gran/$nombre_archivo");
									}
									
									$thumb=new Thumbnail("../images/prop/mini/$nombre_archivo");
									$thumb->size_auto(150);		    
									$thumb->quality=100;            
									$thumb->output_format='JPG';    
									$thumb->allow_enlarge=false;    
									$thumb->CalculateQFactor(10000);
									$thumb->bicubic_resample=true;  
									$thumb->process();   			
									$thumb->save("../images/prop/mini/$nombre_archivo");
									
									$imagenxdefecto = ", pro_imagen_url_s='".$nombre_archivo."'";
									
								}
							}
						}
							
					}else{
						$mensajeimg = "<p align='center'><font color='#FF0000'><b>La imagen debe ser de tipo JPG<br> Intente con otra o c&aacute;mbiele el formato.</b></font></p>";
				}	// FINAL pretende guardar una imagen por defecto
				}else{
					if ($_POST['eliminaimg']==1){ //INICIO pretende eliminar la imagen por defecto
						$imagenxdefecto = ", pro_imagen_url_s=''";
						//FINAL pretende eliminar la imagen por defecto
						}else{
								$imagenxdefecto = "";
					}
			} 
			//FINAL tratamiento de la imagen por defecto
			
			
			//INICIA detalles variables con checks
			if ($_POST['estadoprop']==1){
					$locestado=1;
				}else{
					$locestado=2;
			}
					
			if ($_POST['mostrarprecio']==1){
				$locmostrarprecio=1;
				}else{
					$locmostrarprecio=0;
			}
				
			if ($_POST['propiedaddestacada']==1){
				$locdestacada=1;
				}else{
					$locdestacada=0;
			}
			//FINAL detalles variables con checks
			
			if ($_GET['idprop'] !=""){
			
				//INICIA eliminar la propiedad seleccionada
				if ($_GET['do']=="3"){
					$eliminaprop = mysql_query("delete from tb_ptg_propiedades where pro_id_i = ".$_GET['idprop']."");
					$eliminadetalles = mysql_query("delete from tb_ptg_detalles_propiedad where pro_id_i = ".$_GET['idprop']."");
					$eliminadetalles = mysql_query("delete from tb_ptg_imagenes_propiedad where pro_id_i = ".$_GET['idprop']."");
					$mensaje="<p align='center'><font color='#006600'><b>La propiedad se ha eliminado correctamente.</b></font></p>";	
				}
				//FINAL eliminar la propiedad seleccionada
				
				
				//INICIO  de actualizacion de la propiedad seleccionada
				if ($_GET['do']=="4"){
							
						$guardarcambiosprop = mysql_query("update tb_ptg_propiedades set tcm_id_i=".$_POST['tcm'].", tpr_id_i=".$_POST['tprop'].", zon_id_i=".$_POST['zona'].", est_id_i=".$locestado.", pro_descripcion_corta_s='".utf8_decode($_POST['descripcioncorta'])."', pro_descripcion_extendida_s='".utf8_decode($_POST['descripcionlarga'])."', pro_cant_ambientes_i=".$_POST['ambientes'].", pro_cantidad_metros_i=".$_POST['cantidadmetros'].", pro_hubicacion_s='".utf8_decode($_POST['ubicacion'])."', pro_domicilio_real_s='".$_POST['domicilioreal']."', pro_precio_venta_i=".$_POST['precioventa'].", pro_precio_visible_b=".$locmostrarprecio.$imagenxdefecto.", pro_destacada_b=".$locdestacada.", pro_texto_destacada_s='".$_POST['textodestacada']."' where pro_id_i = ".$_GET['idprop']);


						$mensaje="<p align='center'><font color='#006600'><b>La propiedad se ha modificado correctamente.</b></font></p>";
				}
				//FINAL  de actualizacion de la propiedad seleccionada
				
				
				
				//INICIO administracion de los detalles de la propiedad.
				if ($_GET['do']=="5"){ 
					if ($_POST['idd']!=""){ //INICIO editar un detalle en particular
						if ($editdetalle = mysql_query("update tb_ptg_detalles_propiedad set pro_id_i=".$_GET['idprop'].", tdt_id_i=".$_POST['tipodetalle'].", dpr_descripcion_s='".utf8_decode($_POST['descripciondetalle'])."' where dpr_id_i=".$_POST['idd']."")){
						$mensaje="<p align='center'><font color='#006600'><b>El detalle se ha modificado correctamente.</b></font></p>";	
							}else{
							$mensaje= "<p align='center'><font color='#FF0000'><b>No se pudo modificar el detalle de la propiedad seleccionada.<br> Intente nuevamente o con otra.</b></font></p>";
						}//FINAL de editar el detalle
					}else{ //INICIO agregar un detalle para la propiedad seleccionada
						if ($agregadetalle = mysql_query("insert into tb_ptg_detalles_propiedad (pro_id_i, tdt_id_i, dpr_descripcion_s) values (".$_GET['idprop'].", ".$_POST['tipodetalle'].", '".utf8_decode($_POST['descripciondetalle'])."')")){
						$mensaje="<p align='center'><font color='#006600'><b>El detalle se ha creado correctamente.</b></font></p>";	
							}else{
							echo "insert into tb_ptg_detalles_propiedad (pro_id_i, tdt_id_i, dpr_descripcion_s) values (".$_GET['idprop'].", ".$_POST['tipodetalle'].", '".$_POST['descripciondetalle']."')";
							$mensaje= "<p align='center'><font color='#FF0000'><b>No se pudo crear el detalle de la propiedad seleccionada.<br> Intente nuevamente o con otra.</b></font></p>";
						}//FINAL de agregar el detalle
					}//FINAL de agregar el detalle
				}
				//FINAL de administrar detalles de la propiedad
				
				
				//INICIO eliminar un detalle en particular
				if($_GET['do']=="7"){
					if($eliminardetalle= mysql_query("delete from tb_ptg_detalles_propiedad where dpr_id_i = ".$_GET['idd']."")){
						$mensaje="<p align='center'><font color='#006600'><b>El detalle se ha eliminado correctamente.</b></font></p>";	
					}else{
						$mensaje= "<p align='center'><font color='#FF0000'><b>No se pudo eliminar el detalle de la propiedad seleccionada.<br> Intente nuevamente o con otra.</b></font></p>";
					}
				}
				//FINAL  eliminar un detalle en particular
				
				
				//INICIA pretende agregar una nueva imagen para la propiedad seleccionada
				if ($_GET['do']=="8"){
					if (($mensajeimg=="") && ($agregarimagen=mysql_query("insert into tb_ptg_imagenes_propiedad (pro_id_i, img_descripcion_s, img_url_s, img_orden_lista_i) values(".$_GET['idprop'].", '".$_POST['descripcionimagen']."', '".$nombre_archivo."', ".$_POST['ordenimagen'].")"))){
					$mensaje="<p align='center'><font color='#006600'><b>La IMAGEN se ha creado correctamente.</b></font></p>";
					}else{
						$mensaje = "<p align='center'><font color='#FF0000'><b>La imagen no se pudo agregar.<br> Intente nuevamente o con otra.</b></font></p>";
					}
				}
				//FINAL pretende agregar una nueva imagen para la propiedad seleccionada
					

				//INICIA eliminar una imagen 
				if ($_GET['do']=="10"){
					if ($eliminaimg = mysql_query("delete from tb_ptg_imagenes_propiedad where img_id_i=".$_GET['idimg']."")){
						$mensaje="<p align='center'><font color='#006600'><b>La IMAGEN se ha eliminado correctamente.</b></font></p>";
						}else{
							$mensaje = "<p align='center'><font color='#FF0000'><b>La imagen no se pudo eliminar.<br> Intente nuevamente o con otra.</b></font></p>";
					}
				}
				//FINAL eliminar una imagen
				
				
				//INICIA modificar una imagen
				if ($_GET['do']=="9"){
					if ($eliminaimg = mysql_query("update tb_ptg_imagenes_propiedad set img_descripcion_s = '".$_POST['descripcionimagen']."', img_orden_lista_i=".$_POST['ordenimagen']." where img_id_i=".$_POST['idimg']."")){
						$mensaje="<p align='center'><font color='#006600'><b>La IMAGEN se ha modificado correctamente.</b></font></p>";
						}else{
							$mensaje = "<p align='center'><font color='#FF0000'><b>La imagen no se pudo modificar.<br> Intente nuevamente o con otra.</b></font></p>";
					}
				}
				//FINAL modificar una imagen
				
				
				//INICIO select que muestra los detalles de la propiedad seleccionada
				if ($_GET['idprop']!=""){
					$modificaprop = mysql_query("select p.pro_id_i as idprop, est_id_i as estado, p.tcm_id_i as idtcm, p.tpr_id_i as idtpr, p.zon_id_i as idzon, p.pro_descripcion_corta_s as descorta, p.pro_descripcion_extendida_s as descextendida, p.pro_cant_ambientes_i as ambientes, p.pro_cantidad_metros_i as metros, p.pro_hubicacion_s as ubicacion, p.pro_domicilio_real_s as domicilio, p.pro_precio_venta_i as precio, p.pro_precio_visible_b as verprecio, p.pro_imagen_url_s as imagen, p.pro_destacada_b as destacada, p.pro_texto_destacada_s as txtdestacada, z.zon_descripcion_s as zona, tc.tcm_descripcion_s as tipocomercial, tp.tpr_descripcion_s as tipoprop from tb_ptg_propiedades p, tb_ptg_zonas z, tb_ptg_tipos_propiedades tp, tb_ptg_tipos_comercializacion tc where p.pro_id_i = ".$_GET['idprop']." and z.zon_id_i = p.zon_id_i and p.tcm_id_i = tc.tcm_id_i and p.tpr_id_i = tp.tpr_id_i");
		
					if (!($tupropiedad = mysql_fetch_array($modificaprop))) {
						$mensaje= "<p align='center'><font color='#FF0000'><b>No se encontr&oacute; la propiedad seleccionada.<br> Intente con otra.</b></font></p>";
					}
				} 
				//FINAL select que muestra los detalles de la propiedad seleccionada

			//*************  FINAL TIENE IDPROP = $_GET['idprop']
			
			
			
			//INICIO pretende agregar una nueva propiedad
			}else{
				if ($nombre_archivo!=""){
					$laimagen=$nombre_archivo;
				}else{
					$laimagen="";
				}
				$guardarcambiosprop = mysql_query("insert into tb_ptg_propiedades (tcm_id_i, tpr_id_i, zon_id_i, est_id_i, pro_descripcion_corta_s, pro_descripcion_extendida_s, pro_cant_ambientes_i, pro_cantidad_metros_i, pro_hubicacion_s, pro_domicilio_real_s, pro_precio_venta_i, pro_precio_visible_b, pro_destacada_b, pro_imagen_url_s, pro_texto_destacada_s) values (".$_POST['tcm'].", ".$_POST['tprop'].", ".$_POST['zona'].", ".$locestado.", '".utf8_decode($_POST['descripcioncorta'])."', '".utf8_decode($_POST['descripcionlarga'])."', ".$_POST['ambientes'].", ".$_POST['cantidadmetros'].", '".utf8_decode($_POST['ubicacion'])."', '".utf8_decode($_POST['domicilioreal'])."', ".$_POST['precioventa'].", ".$locmostrarprecio.", ".$locdestacada.", '".$laimagen."', '".utf8_decode($_POST['textodestacada'])."')");
				
				//echo "insert into tb_ptg_propiedades (tcm_id_i, tpr_id_i, zon_id_i, est_id_i, pro_descripcion_corta_s, pro_descripcion_extendida_s, pro_cant_ambientes_i, pro_cantidad_metros_i, pro_hubicacion_s, pro_domicilio_real_s, pro_precio_venta_i, pro_precio_visible_b, pro_destacada_b, pro_imagen_url_s, pro_texto_destacada_s) values (".$_POST['tcm'].", ".$_POST['tprop'].", ".$_POST['zona'].", ".$locestado.", '".utf8_decode($_POST['descripcioncorta'])."', '".utf8_decode($_POST['descripcionlarga'])."', ".$_POST['ambientes'].", ".$_POST['cantidadmetros'].", '".utf8_decode($_POST['ubicacion'])."', '".$_POST['domicilioreal']."', ".$_POST['precioventa'].", ".$locmostrarprecio.", ".$locdestacada.", '".$laimagen."', '".$_POST['textodestacada']."')";
				
			}
			//FINAL pretende agregar una nueva propiedad
			
		}
		//*************  FINAL EXISTE $_GET['do']
		
		?>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="254" valign="top"><table width="75%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td bgcolor="#BD0801" class="Estilo1"><div align="center">Administrar</div></td>
				</tr>
				<tr>
				  <td bgcolor="#F1F1F1">&nbsp;</td>
				</tr>
				<tr>
				  <td><div align="right"><strong>Propiedades</strong></div></td>
				</tr>
				<tr>
				  <td><div align="right"><a href="adminzonas.php">Zonas</a></div></td>
				</tr>
				<tr>
				  <td><div align="right"><a href="adminusers.php">Usuarios</a></div></td>
				</tr>
			  </table>
				<p>&nbsp;</p>
			   <?php 
			   if ($_GET['idprop']!=""){
			   ?>
				<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" bgcolor="#CE5700"><div align="center"><span class="Estilo1">Administrar los Detalles</span></div></td>
				  </tr>
				  <tr>
					<td colspan="3" bgcolor="#F1F1F1"><a href="adminprop.php?do=11&idprop=<?php echo $_GET['idprop']; ?>#detalles"><img src="../images/edit_add.png" alt="Agregar Zona" width="20" height="20" border="0" align="absmiddle" />Agregar Detalle</a>
					</td>
				  </tr>
				  <?php
				$modificapropdetalle = mysql_query("select pr.pro_id_i as idprop, dp.dpr_id_i as iddp, gtd.gtd_descripcion_s as grupotipodetalle, gtd.gtd_id_i as idgtd, dp.tdt_id_i as idtipodetalle, td.tdt_descripcion_s as tipodetalle, dp.dpr_descripcion_s as detalle from tb_ptg_propiedades pr, tb_ptg_detalles_propiedad dp, tb_ptg_tipos_detalle td, tb_ptg_grupos_tipo_detalle gtd where gtd.gtd_id_i = td.gtd_id_i and td.tdt_id_i = dp.tdt_id_i and dp.pro_id_i = pr.pro_id_i and pr.pro_id_i = ".$_GET['idprop']." order by gtd.gtd_orden, td.tdt_descripcion_s");
				while ($propdetalle = mysql_fetch_array($modificapropdetalle)){
				?>
				  <tr>
					<td width="174"><div align="left"><a href="adminprop.php?do=6&amp;idd=<?php echo $propdetalle['iddp'];?>&amp;idprop=<?php echo $propdetalle['idprop']; ?>#detalles"><?php echo utf8_encode("(".$propdetalle['tipodetalle'].") ".$propdetalle['detalle']); ?></a></div></td>
					<td width="20"><a href="adminprop.php?do=6&amp;idd=<?php echo $propdetalle['iddp'];?>&amp;idprop=<?php echo $propdetalle['idprop']; ?>#detalles"><img src="../images/edit.png" alt="Editar Propiedad <?php echo utf8_encode("(".$propdetalle['tipodetalle'].") ".$propdetalle['detalle']); ?>" width="20" height="20" border="0" /></a></td>
					<td width="20"><a href="adminprop.php?do=7&amp;idd=<?php echo $propdetalle['iddp'];?>&amp;idprop=<?php echo $propdetalle['idprop']; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el detalle <?php echo utf8_encode("(".$propdetalle['tipodetalle'].") ".$propdetalle['detalle']); ?>?');"><img src="../images/edit_remove.png" alt="Eliminar Detalle <?php echo utf8_encode("(".$propdetalle['tipodetalle'].") ".$propdetalle['detalle']); ?>" width="20" height="20" hspace="5" border="0" /></a></td>
				  </tr> 
				  <?php
				}
				?>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				 
				</table>        
				<p>&nbsp;</p>
				<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td colspan="3" bgcolor="#CE5700"><div align="center"><span class="Estilo1">Administrar las Imágenes</span></div></td>
				  </tr>
				  <tr>
					<td colspan="3" bgcolor="#F1F1F1">
					<form action="adminprop.php?do=8&idprop=<?php echo $_GET['idprop']; ?>" method="post" enctype="multipart/form-data" name="Imagenes" id="Imagenes" onsubmit="MM_validateForm('imagenpordefecto','','R');return document.MM_returnValue">
					<img src="../images/edit_add.png" alt="Agregar Zona" width="20" height="20" border="0" align="absmiddle" />Agregar nueva Imagen:<br />
					  <div align="left">
						<input name="imagenpordefecto" type="file" id="imagenpordefecto" size="20" />
						<br />
					  </div>
					  <label>
					  <div align="left">
						Descripción:
						  <input name="descripcionimagen" type="text" id="descripcionimagen" size="20" maxlength="150" />
						<br />
						Orden:
						<input name="ordenimagen" type="text" id="ordenimagen" size="2" maxlength="2" />
					  </div>
					  </label>
					  <div align="left"><br />
					  </div>
					  <label>
					  <div align="left">
						<input type="submit" name="agregarimagen" id="agregarimagen" value="Agregar Imagen" />
					  </div>
					  </label>
					</form>            </td>
				  </tr>
				  <tr>
					<td width="174" bgcolor="#F1F1F1" align="center">&nbsp;</td>
					<td width="20" bgcolor="#F1F1F1" align="center">&nbsp;</td>
					<td width="20" bgcolor="#F1F1F1" align="center">&nbsp;</td>
				  </tr> 
				  <tr>
					<td width="174" bgcolor="#666666" align="center"><strong class="Estilo1">Imágenes de la Propiedad</strong></td>
					<td width="20" align="center" bgcolor="#666666" class="Estilo1">&nbsp;</td>
					<td width="20" align="center" bgcolor="#666666" class="Estilo1">&nbsp;</td>
				  </tr> 
				  <tr>
					<td colspan="3">
					<?php
				  $modificapropimagenes = mysql_query("select img_id_i as idimagen, pro_id_i as idprop, img_descripcion_s as descripcionimagen, img_url_s as ruta, img_orden_lista_i as orden from tb_ptg_imagenes_propiedad where pro_id_i = ".$_GET['idprop']." order by img_orden_lista_i");
				while ($propimgs = mysql_fetch_array($modificapropimagenes)){
				?>
					<form name="img<?php echo $propimgs['idimagen'];?>" id="img<?php echo $propimgs['idimagen'];?>" method="post" action="adminprop.php?do=9&amp;idprop=<?php echo $_GET['idprop']; ?>">
					<input type="hidden" name="idimg" id="idimg" value="<?php echo $propimgs['idimagen'];?>" />
					<table width="100%" border="0">
					<tr>
					<td>
					<?php 
					echo "<a href='../images/prop/gran/".$propimgs['ruta']."' rel='lightbox[".$_GET['idprop']."]' title='".$propimgs['descripcionimagen']."'><img align='absmiddle' src='../images/prop/mini/".$propimgs['ruta']."' alt='".$propimgs['descripcionimagen']."' border='0' hspace='2' vspace='1' /></a>";
					?><br />
					<input name="descripcionimagen" type="text" id="descripcionimagen" value="<?php 
						if ($propimgs['descripcionimagen']==""){
							echo "Ingrese descripci&oacute;n";
							}else{
								echo utf8_encode($propimgs['descripcionimagen']); 
								}
					?>" size="20" maxlength="150" />
				   <br />
					Orden: <input name="ordenimagen" type="text" id="ordenimagen" value="<?php echo $propimgs['orden']; ?>" size="2" maxlength="2" />
					<br />
					<input type="submit" name="guardarimg" id="guardarimg" value="Guardar Imagen" /></td>
					<td width="25"><a href="adminprop.php?do=10&amp;idprop=<?php echo $propimgs['idprop']; ?>&amp;idimg=<?php echo $propimgs['idimagen'];?>" onclick="return confirmar('¿Está seguro que desea eliminar la imagen <?php echo $propimgs['ruta']." "; ?>?');"><img src="../images/edit_remove.png" alt="Eliminar Imagen <?php echo $propimgs['ruta']." "; ?>" width="20" height="20" hspace="5" border="0" /></a></td>
				  </tr>
				  </table>
					<p>&nbsp;</p>
				  </form>
				  <?php
				}
				?>        </td></tr>
				</table>
				
				<?php 
			   }
			   ?> 
			  <p>&nbsp;</p></td>
			  
			  
			  
			  
			  
			  <td width="647" valign="top"><form action="adminprop.php?do=4&idprop=<?php echo $_GET['idprop']; ?>" method="post" enctype="multipart/form-data" name="propiedades" id="propiedades">
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="50" colspan="3" valign="top" background="../images/ampliacion-encabezado.jpg"><div align="right" class="Estilo1">Propiedad conectado: <?php echo $_SESSION['nombrelogin']?> - <a href="chausesion.php">cerrar sesión</a></div></td>
				  </tr>
				  <tr>
					<td colspan="3"><div align="center"><strong>Administración de PROPIEDADES</strong></div>

					<?php 
					if ($mensaje != ""){
						echo '<table width="100%" border="0"><tr><td bgcolor="#FF9900">';
						echo $mensaje;
						echo $mensajeimg;
						echo "</td></tr></table>";
					}
					?>   
                    
                    </td>
				  </tr>
				  <tr>
					<td colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Estado:</div></td>
					<td width="23"><label></label></td>
					<td><div align="left">
					  <input name="estadoprop" type="checkbox" id="estadoprop" value="1" <?php 
					  if (($tupropiedad['estado']==1) || ($tupropiedad['estado']=="")){
					  ?>checked="checked" <?php
					  }?>/>
					  con el tilde está disponible.
					</div></td>
				  </tr>
				  <tr>
					<td><div align="right">Tipo Comercialización:</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					 <?php 
							$selectgrupo = mysql_query("select t.tcm_id_i as idtipocom, t.tcm_descripcion_s as nombrecomer from tb_ptg_tipos_comercializacion t");
							echo ' <select name="tcm" id="tcm">';
							while ($tcm = mysql_fetch_array($selectgrupo)){
								if ($tcm['idtipocom'] == $tupropiedad['idtcm']){
									$selected="selected='selected'";
								}else{
									$selected="";
								}
								echo "<option value='".$tcm['idtipocom']."' ".$selected."> ".utf8_encode($tcm['nombrecomer'])."</option>";
							}
							echo "</select>";
							//if (($_GET['do']==11) || ($_GET['do']==2) || ($_GET['do']==6) || ($_GET['do']==4)){
							if ($_GET['idprop']!=""){
						  ?> 
						  
						  <b>La actual es <?php echo "(".$tupropiedad['idtcm'].") - ".utf8_encode($tupropiedad['tipocomercial']); ?></b>
						  <?php 
						  }
						  ?>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Tipo de Propiedad:</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <?php 
							$selectgrupo = mysql_query("select t.tpr_id_i as idtipoprop, t.tpr_descripcion_s as nombretipo from tb_ptg_tipos_propiedades t");
							echo ' <select name="tprop" id="tprop">';
							while ($tprop = mysql_fetch_array($selectgrupo)){
								if ($tprop['idtipoprop'] == $tupropiedad['idtpr']){
									$selected="selected='selected'";
								}else{
									$selected="";
								}
								echo "<option value='".$tprop['idtipoprop']."' ".$selected."> ".utf8_encode($tprop['nombretipo'])."</option>";
							}
							echo "</select>";
							//if (($_GET['do']==2) || ($_GET['do']==6) || ($_GET['do']==4)){
							if ($_GET['idprop']!=""){
						  ?> 
						  
						  <b>La actual es <?php echo "(".$tupropiedad['idtpr'].") - ".utf8_encode($tupropiedad['tipoprop']); ?></b>
						  <?php 
						  }
						  ?>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Zona::</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <?php 
							$selectgrupo = mysql_query("select zon_id_i as idzona, zon_descripcion_s as nombrezona from tb_ptg_zonas");
							echo ' <select name="zona" id="zona">';
							while ($zones = mysql_fetch_array($selectgrupo)){
								if ($zones['idzona'] == $tupropiedad['idzon']){
									$selected="selected='selected'";
								}else{
									$selected="";
								}
								echo "<option value='".$zones['idzona']."' ".$selected."> ".utf8_encode($zones['nombrezona'])."</option>";
							}
							echo "</select>";
							//if (($_GET['do']==11) || ($_GET['do']==2) || ($_GET['do']==6) || ($_GET['do']==4)){
							if ($_GET['idprop']!=""){
						  ?> 
						  
						  <b>La actual es <?php echo "(".$tupropiedad['idzon'].") - ".utf8_encode($tupropiedad['zona']); ?></b>
						  <?php 
						  }
						  ?>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Descripción Corta:</div></td>
					<td width="23"><label></label></td>
					<td><div align="left">
					  <input name="descripcioncorta" type="text" id="descripcioncorta" value="<?php echo utf8_encode($tupropiedad['descorta']); ?>" maxlength="100" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Descripción Larga:</div></td>
					<td width="23"><label></label></td>
					<td><div align="left">
					  <textarea name="descripcionlarga" id="descripcionlarga" cols="30" rows="5"><?php echo utf8_encode($tupropiedad['descextendida']); ?></textarea>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">
					Ambientes: </div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="ambientes" type="text" id="ambientes" value="<?php echo $tupropiedad['ambientes']; ?>" size="3" maxlength="2" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><label>
					  <div align="right">Cantidad Metros:              
						
						</label>
					</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="cantidadmetros" type="text" id="cantidadmetros" value="<?php echo ($tupropiedad['metros']); ?>" size="10" maxlength="10" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Ubicación: </div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="ubicacion" type="text" id="ubicacion" value="<?php echo $tupropiedad['ubicacion']; ?>" size="20" maxlength="100" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Domicilio Real: </div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="domicilioreal" type="text" id="domicilioreal" value="<?php echo $tupropiedad['domicilio']; ?>" size="20" maxlength="150" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Precio de Venta:</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="precioventa" type="text" id="precioventa" value="<?php echo $tupropiedad['precio']; ?>" size="20" maxlength="100" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Mostrar Precio?</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					<input name="mostrarprecio" type="checkbox" id="mostrarprecio" value="1" <?php 
					  if ($tupropiedad['verprecio']==1){
					  ?>checked="checked" <?php
					  }
					  ?>/>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Destacada?</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="propiedaddestacada" type="checkbox" id="propiedaddestacada" value="1" <?php 
					  if ($tupropiedad['destacada']==1){
					  ?>checked="checked" <?php
					  }
					  ?>/>
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Descripción Destacada:</div></td>
					<td width="23">&nbsp;</td>
					<td><div align="left">
					  <input name="textodestacada" type="text" id="textodestacada" value="<?php echo $tupropiedad['txtdestacada']; ?>" size="20" maxlength="100" />
					</div></td>
				  </tr>
				  <tr>
					<td width="275"><div align="right">Imagen por defecto</div></td>
					<td width="23">&nbsp;</td>
					<td><label>
					  <input type="file" name="imagenpordefecto" id="imagenpordefecto" />
					</label></td>
				  </tr>
				  <tr>
					<td width="284"><input type="hidden" name="propedit" id="propedit" value="<?php echo $_GET['idprop']; ?>" /></td>
					<td width="23">&nbsp;</td>
					<td>
					<p>
					<?php
					if ($tupropiedad['imagen']!=""){
					echo "<a href='../images/prop/gran/".$tupropiedad['imagen']."' rel='lightbox[".$_GET['idprop']."]' title='".$tupropiedad['ubicacion']."'><img align='absmiddle' src='../images/prop/mini/".$tupropiedad['imagen']."' alt='".$tupropiedad['ubicacion']."' border='0' hspace='2' vspace='1' /></a>";
					?>
					<br />
					<input name="eliminaimg" type="checkbox" id="eliminaimg" value="1" />
					Tildar para eliminar esta imagen.
                    <?php 
					}
					?>
					</p>
					<p>&nbsp;</p></td>
				  </tr>
				  <tr>
					<td colspan="3">
					  <div align="center">
						<?php
						//if (($_GET['do']=="2") || ($_GET['do']=="4")){
						if ($_GET['idprop']!=""){
							echo "<input type='submit' name='enviaform' id='enviaform' value='Editar Propiedad' />";
							}else{
								echo "<input type='hidden' name='propnew' id='propnew' value='1' />";
								echo "<input type='submit' name='enviaform' id='enviaform' value='Grabar nueva Propiedad' />";
							}
						?>
					  </div></td>
				  </tr>
				  <tr>
					<td colspan="3">&nbsp;</td>
				  </tr>
				</table>
					</form>
				<?php 
				$filtrodeta = "";
				if ($_GET['do']=="6"){
					$filtrodeta = " and dp.dpr_id_i=".$_GET['idd'];
				}
				
				
			   if ($_GET['idprop']!=""){
				//if (($_GET['do']=="6") || ($_GET['do']=="11")){
				if ($_GET['do']=="6"){
					$editpropdetalle = mysql_query("select pr.pro_id_i as idprop, dp.dpr_id_i as iddp, gtd.gtd_descripcion_s as grupotipodetalle, gtd.gtd_id_i as idgtd, dp.tdt_id_i as idtipodetalle, td.tdt_descripcion_s as tipodetalle, dp.dpr_descripcion_s as detalle from tb_ptg_propiedades pr, tb_ptg_detalles_propiedad dp, tb_ptg_tipos_detalle td, tb_ptg_grupos_tipo_detalle gtd where gtd.gtd_id_i = td.tdt_id_i and td.tdt_id_i = dp.tdt_id_i and dp.pro_id_i = pr.pro_id_i and pr.pro_id_i = ".$_GET['idprop'].$filtrodeta." order by gtd.gtd_orden, td.tdt_descripcion_s");
					
					//echo "select pr.pro_id_i as idprop, dp.dpr_id_i as iddp, gtd.gtd_descripcion_s as grupotipodetalle, gtd.gtd_id_i as idgtd, dp.tdt_id_i as idtipodetalle, td.tdt_descripcion_s as tipodetalle, dp.dpr_descripcion_s as detalle from tb_ptg_propiedades pr, tb_ptg_detalles_propiedad dp, tb_ptg_tipos_detalle td, tb_ptg_grupos_tipo_detalle gtd where gtd.gtd_id_i = td.tdt_id_i and td.tdt_id_i = dp.tdt_id_i and dp.pro_id_i = pr.pro_id_i and pr.pro_id_i = ".$_GET['idprop'].$filtrodeta." order by gtd.gtd_orden, td.tdt_descripcion_s";
					if (!($editdetalle = mysql_fetch_array($editpropdetalle))){
						$mensajedetalle = "<p align='center'><font color='#FF0000'><b>No se encontró el detalle de la propiedad.<br> Intente con otra.</b></font></p>";
					}
				}
			   ?>
				<br />
		<form action="adminprop.php?do=5&idprop=<?php echo $_GET['idprop']; ?>" method="post" name="detallespropiedades" id="detallespropiedades" onsubmit="MM_validateForm('descripciondetalle','','R');return document.MM_returnValue">
					  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td width="193"><a name="detalles" id="detalles"></a></td>
						  <td width="26">&nbsp;</td>
						  <td width="381">&nbsp;</td>
						</tr>
						<tr>
						  <td height="50" colspan="3" align="center" valign="top" background="../images/ampliacion-encabezado.jpg" class="Estilo1">Detalles de la Propiedad</td>
						</tr>
						
						<tr>
						  <td width="193">&nbsp;</td>
						  <td width="26">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<?php
						if ($mensajedetalle!=""){
							?>
						<tr>
						  <td colspan="3"><?php echo $mensajedetalle; ?></td>
						</tr>
						<?php
						}
						?>
						<tr>
						  <td width="193"><div align="right">Grupo y Tipo de Detalle:</div></td>
						  <td width="26">&nbsp;</td>
						  <td>
						  <?php 
							$selectgrupo = mysql_query("select t.tdt_id_i as idtdt, t.tdt_descripcion_s as nombretipodetalle, t.gtd_id_i as idgrupo, g.gtd_descripcion_s as nombregrupo from tb_ptg_tipos_detalle t, tb_ptg_grupos_tipo_detalle g where t.gtd_id_i = g.gtd_id_i");
							echo ' <select name="tipodetalle" id="tipodetalle">';
							while ($tds = mysql_fetch_array($selectgrupo)){
								if ($tds['idtdt'] == $editdetalle['idtipodetalle']){
									$selected="selected='selected'";
								}else{
									$selected="";
								}
								echo "<option value='".$tds['idtdt']."' ".$selected.">(".utf8_encode($tds['nombregrupo']).") - ".utf8_encode($tds['nombretipodetalle'])."</option>";
							}
							echo "</select>";
							if ($_GET['do']==6){
						  ?> 
						  
						  <br><b>La actual es <?php echo "(".$editdetalle['idtipodetalle'].") - ".utf8_encode($editdetalle['tipodetalle']); ?></b>
						  <?php 
						  }
						  ?>
						  
						  </td>
						</tr>
						<tr>
						  <td width="193"><div align="right">Descripcion</div></td>
						  <td width="26">&nbsp;</td>
						  <td><input name="descripciondetalle" type="text" id="descripciondetalle" value="<?php 
						  if ($_GET['do']==6){
						  	echo utf8_encode($editdetalle['detalle']);
							}else{
							echo "";
							}
							 ?>" size="20" maxlength="100" /></td>
						</tr>
						<tr>
						  <td width="193">&nbsp;</td>
						  <td width="26">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td colspan="3"><div align="center">
							  <?php
						if ($_GET['do']=="6"){
							echo "<input type='hidden' name='idd' id='idd' value='".$_GET['idd']."' />";
							echo "<input type='submit' name='enviaform' id='enviaform' value='Editar Detalle' />";
							}else{
								echo "<input type='submit' name='enviaform' id='enviaform' value='Grabar nuevo Detalle' />";
							}
						?>
						  </div></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
					  </table>
				</form>
					<?php
					}
					?>
			  </td>
			  <td width="334" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="3" bgcolor="#CE5700"><div align="center"><span class="Estilo1">Listado de Propiedades</span></div></td>
				</tr>
				<tr>
				  <td colspan="3" bgcolor="#F1F1F1"><a href="adminprop.php?do=1"><img src="../images/edit_add.png" alt="Agregar Zona" width="20" height="20" border="0" align="absmiddle" />Agregar Propiedad</a></td>
				</tr>
				
				<?php
				$propmysql = mysql_query("select pro_id_i as idprop, est_id_i as estado, pro_hubicacion_s as ubicacion from tb_ptg_propiedades");
				while ($listprop = mysql_fetch_array($propmysql)){
				?>
				<tr>
				  <td width="174">
					<a href="adminprop.php?do=2&idprop=<?php echo $listprop['idprop']; ?>">
						<?php 
							if ($listprop['estado']!=1){
								echo "<font style='text-decoration:line-through;'>";
								echo "(".$listprop['idprop'].") ".$listprop['ubicacion'];
								echo "</font>";
							}else{
								echo "(".$listprop['idprop'].") ".$listprop['ubicacion'];
							}
						   
						?>
					</a>
				  </td>
				  
				  <td width="20"><a href="adminprop.php?do=2&idprop=<?php echo $listprop['idprop']; ?>"><img src="../images/edit.png" alt="Editar Propiedad <?php echo $listprop['ubicacion']; ?>" width="20" height="20" border="0" /></a></td>
				  <td width="20"><a href="adminprop.php?do=3&idprop=<?php echo $listprop['idprop']; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la propiedad <?php echo "(".$listprop['idprop'].") ".$listprop['ubicacion']; ?>? \n Se eliminaran también todas las imágenes y detalles asociados.');"><img src="../images/edit_remove.png" alt="Eliminar Propiedad <?php echo $listprop['ubicacion']; ?>" width="20" height="20" hspace="5" border="0" /></a></td>
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