<?php
 require("../classes/app.class.php");
 require_once "XML/RSS.php";
 $idedicion=date("Y-m-d");
 if (empty($_SESSION["idusuario"])) {
  header("Location: /entrar?opt=auth&refer=suscriptor");
  die();
 }
 include ('../classes/header.inc.php');
 include_once('./securimage/securimage.php');
 $tpl="suscriptor.tpl";
 $smarty->caching=0;
 #preparando formulario
 $suscriptor=new suscriptorTable();
 $suspais=new suspaisTable();
 $smarty->assign("rowssuspais",$suspais->selectMenu("SELECT idsuspais,suspais FROM suspais")); 
 $escolaridad=new escolaridadTable();
 $smarty->assign("rowsescolaridad",$escolaridad->selectMenu("SELECT idescolaridad,escolaridad FROM escolaridad"));
 $rowsuscriptor=$suscriptor->readDataFilter("suscriptor.idusuario=".$_SESSION["idusuario"]."");
 if(count($rowsuscriptor)>0){
  $rowsuscriptor=$rowsuscriptor[0];
  $smarty->assign($rowsuscriptor);
  $smarty->assign("mode","edit");
 }
 else
 {
  $smarty->assign("mode","add");
 }

  # Encuestas 
  $encuesta = new encuestaTable();
  $encuesta->limit = 1;
  $idedicion=date("Y-m-d");
  $surveys = $encuesta->readDataFilter("'$idedicion' BETWEEN fecha_ini::date AND fecha_fin::date");
  $smarty->assign('encuestas',$surveys);


 # Blogs Columna derecha - wordpress LP
 $rss =& new XML_RSS("http://www.laprensa.com.ni/blog/feed");
 $rss->parse();
 $i = 0;
 foreach ($rss->getItems() as $item) {
  $i++;
  $der_blogs[] =  array('link'=>$item['link'], 'title'=>$item['title'], 'description'=>$item['description'], 'url'=>getImgs($item['content:encoded'],true),'autor'=>$item['dc:creator'],'fecha'=>$item['pubdate']);
  if ($i>=3) break;
 }
 $smarty->assign('der_blogs', $der_blogs);

 switch($_REQUEST["opt"]){
  case "check":
   /*$usuario=new usuarioTable();
   $usuario->readEnv();
   list($row) = $usuario->readDataFilter("usuario.usuario = '" . $usuario->request['usuario'] . "' AND usuario.clave = '".$usuario->request['clave']."' AND usuario.activo");
   if($row)
   {
    $_SESSION["idusuario"]=$row["idusuario"];
    $_SESSION["usuario"]=$row["usuario"];
    $_SESSION["nombre"]=$row["nombre"];
    $_SESSION["apellido"]=$row["apellido"];
    $_SESSION["correo"]=$row["correo"];
    header("Location: /");
   }
   else
   {
    $smarty->assign("msg","Datos de acceso invalidos");
    $_REQUEST["opt"]="auth";
   }*/
  break;
  case "add":
  $securimage = new Securimage();
  if (empty($_POST['captcha_code'])) {
    error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    $smarty->assign("msg","Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
  } elseif ($securimage->check($_POST['captcha_code']) == false) {
    error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
    $smarty->assign("msg","Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
    $_REQUEST["opt"]="viewform";
  } else {
    $suscriptor->readEnv();
    if($_REQUEST["mode"]=="add")
    {
     $suscriptor->addRecord();
     list($row)=$suscriptor->readDataFilter("suscriptor.idusuario=".$suscriptor->request["idusuario"]."");
     $to = $_REQUEST['email'];
     $strHTML = '
      <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
      <br />
      <br />
      <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Activacion de Suscripcion</h1>
      <br />
      Estimado Sr./Sra.' . $row['suscriptor'] . ' ' . $row['apellido'] . ',
      <br />
      <br />
       Su suscripcion asociada a la direccion *' . $row['email'] . '* ha sido creada, Para confirmar esta informacion y activar su suscripcion haga clic en el siguiente enlace:
       <br/>
       <a href="' . URL . '/confirmar?_c=' . md5($row['idsuscriptor']) . '&_cs=' . md5($row['email']) . '&_l=' . urlencode($row['email']) . '">' . URL . '/confirmar?_c=' . md5($row['idsuscriptor']) . '&_cs=' . md5($row['email']) . '&_l=' . urlencode($row['email']) . '</a>
       <br />
       <br />
        Tu codigo de activacion es: ' . md5($row['idsuscriptor']) . '
       <br />
       <br />
       Una vez que active su suscripcion, usted recibira nuestro boletin de noticia en su correo. El código de confirmacion vence ' . date("d/m/Y H:i",(strtotime($row['creacion']) + (7 * 24 * 60 * 60))) . ', despues de vencerse, se eliminara la suscripcion.
       <br />
       <br />
       Saludos,
      <br />
      ' . URL . ' - 
      info@laprensa.com.ni
     </div>
     </body>
     </html>';
     $subject = 'Confirmacion de suscripcion';
     $subject = preg_replace('/ú/','u',$subject);
     $subject = preg_replace('/&uacute;/','u',$subject);
     $headers = 'From: info@laprensa.com.ni' . "\r\n";
     $headers .= 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
     mail($to, $subject, $strHTML, $headers);
     $smarty->assign("msg","Sus Datos han sido agregados. Se ha enviado un email a su cuenta de correo para confirmacion de su suscripcion / LA PRENSA .com.ni");
     $tpl="error.tpl";
    }
    else
    {
     $suscriptor->readEnv();
     list($row)=$suscriptor->readDataFilter("suscriptor.idusuario=".$suscriptor->request["idusuario"]."");
     $_REQUEST["idsuscriptor"]=$row['idsuscriptor'];
     $suscriptor->readEnv();
     $suscriptor->updateRecord();
     $smarty->assign("msg","Sus Datos han sido actualizados.");
     $tpl="error.tpl";
    }
    unset($usuario);
  }
  break;
 } 


 $smarty->display($tpl);
 include ('../classes/footer.inc.php');
?>
