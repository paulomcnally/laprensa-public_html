<?php
require('../classes/app.class.php');
$smarty->caching = 0;
$tpl = 'lpclub.tpl';
$lpclub = new lpclubTable();

if ( !empty($_POST['captcha_code']) ) $_POST['captcha_code'] = str_replace(' ','',trim($_POST['captcha_code']));
include_once('./securimage/securimage.php');


switch($_REQUEST["opt"]){
  case 'send': 
               /*$securimage = new Securimage();
               if (empty($_POST['captcha_code'])) {
                  error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
                  $smarty->assign("msg","Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
                  $_REQUEST["opt"]="viewform";
               } elseif ($securimage->check($_POST['captcha_code']) == false) {
                  error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
                  $smarty->assign("msg","Error CAPTCHA: Codigo captcha equivocado, los captcha no coinciden.");
                  $_REQUEST["opt"]="viewform";
               } else {*/
                  $lpclub->readEnv();
                  $lpclub->request['otros'] = '<p>Amigo 1: ' . $_POST['amigo1'] . 'Celular: ' . $_POST['correoamigo1'] . '<p><p>&nbsp;</p>' . 
                                              '<p>Amigo 2: ' . $_POST['amigo2'] . 'Celular: ' . $_POST['correoamigo2'] . '<p><p>&nbsp;</p>' . 
                                              '<p>Amigo 3: ' . $_POST['amigo3'] . 'Celular: ' . $_POST['correoamigo3'] . '<p><p>&nbsp;</p>' . 
                                              '<p>Amigo 4: ' . $_POST['amigo4'] . 'Celular: ' . $_POST['correoamigo4'] . '<p><p>&nbsp;</p>' .
                                              '<p>Amigo 5: ' . $_POST['amigo5'] . 'Celular: ' . $_POST['correoamigo5'] . '<p><p>&nbsp;</p>' . 
                                              '<p>Amigo 6: ' . $_POST['amigo6'] . 'Celular: ' . $_POST['correoamigo6'] . '<p><p>&nbsp;</p>';
                                              
                  $lpclub->addRecord();
                  $mensaje = '<table width="1089" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="220"><img src="http://www.laprensa.com.ni/enlaces/lpclublogo.png" width="220" /></td>
    <td colspan="2" align="center">Nueva inscripci&oacute;n promoci&oacute;n LA PRENSA CLUB &amp; PELICAN EYES</td>
    <td width="162">&nbsp;</td>
  </tr>
  <tr>
    <td width="318" colspan="2">&nbsp;</td>
    <td width="389">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">Nombre: :</td>
    <td align="left">&nbsp;' . $_POST['nombre'] . '</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">Correo electr&oacute;nico: </td>
    <td align="left">&nbsp;' . $_POST['correo'] . '</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">Celular: </td>
    <td align="left">&nbsp;' . $_POST['celular'] . '</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">Departamento: </td>
    <td align="left">&nbsp;' . $_POST['departamento']  . '</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">Direcci&oacute;n: </td>
    <td align="left">&nbsp;' . $_POST['direccion'] . ' </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="2">C&eacute;dula: </td>
    <td align="left">&nbsp;' . $_POST['cedula'] . ' </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" colspan="2">Nombre de amigos / Correos electronicos</td>
    <td align="left">
       <p>Amigo 1: ' . $_POST['amigo1'] . '&nbsp;(' . $_POST['correoamigo1'] . ')<br/>' .
       'Amigo 2: ' . $_POST['amigo2'] . '&nbsp;(' . $_POST['correoamigo2'] . ')<br/>' .
       'Amigo 3: ' . $_POST['amigo3'] . '&nbsp;(' . $_POST['correoamigo3'] . ')<br/>' .
       'Amigo 4: ' . $_POST['amigo4'] . '&nbsp;(' . $_POST['correoamigo4'] . ')<br/>' .
       'Amigo 5: ' . $_POST['amigo5'] . '&nbsp;(' . $_POST['correoamigo5'] . ')<br/>' .
       'Amigo 6: ' . $_POST['amigo6'] . '&nbsp;(' . $_POST['correoamigo6'] . ')</p>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';
                  $to = 'velero@laprensa.com.ni, juan.martinez@laprensa.com.ni, nestor.arce@laprensa.com.ni';
                  $subject = 'Promocion LA PRENSA & PELICAN EYES';
                  $subject = preg_replace('/ú/','u',$subject);
                  $subject = preg_replace('/&uacute;/','u',$subject);
                  $headers = 'noreply:velero @laprensa.com.ni' . "\r\n";
                  $headers .= 'MIME-Version: 1.0' . "\r\n";
                  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
                  mail($to, $subject, $mensaje, $headers);
               //}
               break;
}

include('../classes/header.inc.php');

$smarty->display($tpl);
include('../classes/footer.inc.php');
?>
