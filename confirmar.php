<?php
 require("../classes/app.class.php");
 require_once "XML/RSS.php";
 $idedicion=date("Y-m-d");
 include ('../classes/header.inc.php');
 $suscriptor=new suscriptorTable();
 list($row) = $suscriptor->readDataFilter("md5(suscriptor.idsuscriptor::text) = '" . $suscriptor->database->escape($_REQUEST['_c']) ."' AND md5(suscriptor.email) = '" . $suscriptor->database->escape($_REQUEST['_cs']) . "'");
 if($row) {
  $smarty->assign('cliente',$row);
  if($row['activo']=='t') {
   $smarty->assign('verify',true);
  } else {
   $suscriptor->database->query("UPDATE suscriptor SET activo = true WHERE md5(idusuario::text) = '" . $suscriptor->database->escape($_REQUEST['_c']) . "'");
  }
  //header("Location: /suscriptor?opt=auth");
  $tpl="error.tpl";
  $smarty->assign("msg","Su suscripcion ha sido activada.");
 }
 else
 {
  $tpl="error.tpl";
  $smarty->assign("msg","Error : El codigo de activacion es invalido");
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

$smarty->display($tpl);
include ('../classes/footer.inc.php');
?>
