<?php

if ($HTTP_POST_FILES["imgdef"]['name']!=""){
	echo "conalgo";
	}else{
		echo "nada";
}

include("resize-cubic.php");
//include("resize.php");
include("resize.image.class.php");
ini_set("memory_limit","128M");
//Agregado DE IMAGEN POR DEFECTO
						$nombre_archivo = $HTTP_POST_FILES["imgdef"]['name'];
						$tipo_archivo   = $HTTP_POST_FILES["imgdef"]['type'];
						//echo "nombre: ".$nombre_archivo." -- tipo: ".$tipo_archivo;
					echo "A nonbre:".$nombre_archivo." tipo: ".$tipo_archivo;
						if (($tipo_archivo == "jpeg") or ($tipo_archivo == "jpg") or ($tipo_archivo == "image/jpeg") or ($tipo_archivo == "image/pjpeg")){
							echo "1";
							if (file_exists("./$nombre_archivo")) $nombre_archivo = createRandomPassword(4).$nombre_archivo;
								echo "2";
								if (move_uploaded_file($HTTP_POST_FILES["imagenpordefecto"]['tmp_name'], "./$nombre_archivo")==1){
									echo "3";
									if (copy("./$nombre_archivo", "./$nombre_archivo")){
									echo "4";
										if (copy("./$nombre_archivo", "./$nombre_archivo")){
											echo "5";
												
											$bigSize = getimagesize(".$nombre_archivo");
											if (($bigSize[0]>600) or ($bigSize[1]>600)){
											echo "6";
												// determinar el path de la imagen
												$thumb=new Thumbnail("./$nombre_archivo");
												$thumb->size_auto(600);	// el tamaño mas grande width o height para el thumb
												$thumb->quality=100;          //calidad del formato JPG
												$thumb->output_format='JPG';  // JPG | PNG
												//$thumb->jpeg_progressive=0; // JPEG progresivo : 0 = no , 1 = si
												$thumb->allow_enlarge=false;  // permitir agrandar el thumbnail
												// Calcular factor de calidad del JPEG 
												$thumb->bicubic_resample=true; // [OPCIONAL] RESAMPLE el algoritmo a cubico
												$thumb->process();   		   // generar imagen
												$thumb->save("./$nombre_archivo");
											}
											
											$thumb=new Thumbnail("./mini/$nombre_archivo");
											$thumb->size_auto(150);		    
											$thumb->quality=100;            
											$thumb->output_format='JPG';    
											$thumb->allow_enlarge=false;    
											$thumb->CalculateQFactor(10000);
											$thumb->bicubic_resample=true;  
											$thumb->process();   			
											$thumb->save("./mini/$nombre_archivo");
											
											$imagenxdefecto = ", pro_imagen_url_s='".$nombre_archivo."'";
										}
									}
								}
									
							}else{
								$mensajeimg = "<p align='center'><font color='#FF0000'><b>La imagen debe ser de tipo JPG<br> Intente con otra o c&aacute;mbiele el formato.</b></font></p>";
						}	
?><form action="aa.php" method="post" enctype="multipart/form-data" name="form1">
  <p>
    <input type="file" name="imgdef" id="imgdef" />
</p>
  <p>&nbsp;</p>
  <p>
    <label>
    <input type="submit" name="button" id="button" value="Enviar">
    </label>
</p>
</form>
