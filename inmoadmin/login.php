<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener una dirección de email\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe contener un número.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' debe contener un número entre '+min+' y '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es obligatorio.\n'; }
    } if (errors) alert('Aun no se puede loguear:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<form action="procesalogin.php" method="post" name="form1" onSubmit="MM_validateForm('nombre','','R','password','','R');return document.MM_returnValue">
  <p align="center">
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F1F1F1">
    <tr>
      <td colspan="3"><img src="../images/ampliacion-encabezado.jpg" width="600" height="50"></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#C0C0C0"><div align="center"><strong>Ingreso al área de administración</strong></div></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="234"><div align="right">Nombre de usuario</div></td>
      <td width="39">&nbsp;</td>
      <td width="227"><div align="left">
        <label>
        <input name="nombre" type="text" id="nombre" size="15">
        </label>
      </div></td>
    </tr>
    <tr>
      <td><div align="right">Contraseña</div></td>
      <td>&nbsp;</td>
      <td><div align="left">
        <input name="password" type="password" id="password" size="15">
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><label>
        <div align="center">
          <input type="submit" name="button" id="button" value="Ingresar">
        </div>
      </label></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
  </p>
</form>
