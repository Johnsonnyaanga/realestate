<form id="buscador" name="buscador" method="get" action="operaciones.php">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="39%"><div align="right">Tipo de operaci&oacute;n</div></td>
              <td width="10%">&nbsp;</td>
              <td width="51%">
              <label>
              <select name="tipocomercializacion" id="tipocomercializacion">
              <?php
              $tipoop = mysql_query("select * from tb_ptg_tipos_comercializacion order by tcm_orden_lista_i");
			  while ($to = mysql_fetch_array($tipoop)){
			  ?>
              
                <option value="<?php echo $to['tcm_id_i']; ?>"><?php echo $to['tcm_descripcion_s'];?></option>
                         
              <?php
              }
			  ?>    </select>
              </label>                        </td>
            </tr>
            <tr>
              <td><div align="right">Tipo de Propiedad</div></td>
              <td>&nbsp;</td>
              <td>
              <label>
              <select name="tipopropiedad" id="tipopropiedad">
              <option value="0">Culquiera</option>
              <?php
              $tipopr = mysql_query("select * from tb_ptg_tipos_propiedades order by tpr_orden_lista_i");
			  while ($tp = mysql_fetch_array($tipopr)){
			  ?>
              
                <option value="<?php echo $tp['tpr_id_i']; ?>"><?php echo $tp['tpr_descripcion_s'];?></option>
                         
              <?php
              }
			  ?>    </select>
              </label></td>
            </tr>
            <tr>
              <td><div align="right">Cantidad de Ambientes</div></td>
              <td>&nbsp;</td>
              <td>
              <label>
              <select name="cantidadambientes" id="cantidadambientes">              
               <option value="0">Culquiera</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              </label>              </td>
            </tr>
            <tr>
              <td><div align="right">Zona</div></td>
              <td>&nbsp;</td>
              <td>
              
              <label>
              <select name="zonapropiedad" id="zonapropiedad">
              <option value="0">Culquiera</option>
              <?php
              $zonapr = mysql_query("select * from tb_ptg_zonas order by zon_descripcion_s");
			  while ($zona = mysql_fetch_array($zonapr)){
			  ?>
              
                <option value="<?php echo $zona['zon_id_i']; ?>"><?php echo $zona['zon_descripcion_s'];?></option>
                         
              <?php
              }
			  ?>    </select>
              </label>              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><label>
                <div align="center">
                  <input type="submit" name="buscar" id="buscar" value="Buscar" />
                  </div>
              </label></td>
            </tr>
          </table>
                </form>