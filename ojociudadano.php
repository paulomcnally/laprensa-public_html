<?php
require('../classes/app.class.php');
require('../classes/badnews.class.php');
require('../classes/badsect.class.php');
define('OCD',true);
$usuario = new usuarioTable;

$tpl_id = (int)$_REQUEST['idojociudadano'];
include ('comentarmn.php');
include ('../classes/header-minoticia.inc.php');
$tpl = 'minoticia/ojociudadano.tpl';
  
if(!$smarty->is_cached($tpl,$cache_pattern . $tpl_id)) {
    include_once('./ultimasnoticiasuser.inc.php');
    if (!$smarty->get_template_vars('banner_centro_250_208')||!$smarty->get_template_vars('banner_derecho_160_200')) {
      @include_once(ROOTDIR.'/zonas/minoticia.php');
    }

   require ('../classes/paginador.class.php');

    $ojociudadano = new ojociudadanoTable;
    $ojociudadano->readEnv();
    list($row) = $ojociudadano->readDataFilter("ojociudadano.idojociudadano='". $ojociudadano->request['idojociudadano'] ."'");
    
    // Votacion
    if($row) {
      $stars = $ojociudadano->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM ojociudadano WHERE idojociudadano=".$row["idojociudadano"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $ojociudadano->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM ojociudadano WHERE idojociudadano=".$row["idojociudadano"]);
    } else { # No existe
      $avoid[$strEd . '/' . $_REQUEST['uri'] . '/' . $tpl_id] = mktime();
      $strArr = array2string($avoid,'avoid');
      #$filename = dirname(__FILE__) . '/../classes/badnews.class.php';
      #writeFile($filename,$strArr);
      # Does not work because header.inc.php
      #include '../classes/404.inc.php';
      #include './404.php';
      #header('Location: /404.html');
      print "ERROR: 404 P&aacute;gina no encontrada.";
      exit();
    }
    if(is_float($stars)) $stars = round($stars,1);
    elseif(empty($stars)) $stars = 0;
    $row["stars"]=$stars;
    $row["votos"]=$votos;
    
    $smarty->assign('row', $row);
    $comments = new comentarioojociudadanoTable;
    $comments->readEnv();
    $comments->order = 'creacion';
    $comments->readEnv();
    if($comments->request['idojociudadano']) {
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      $comentarios=$paginador->getPageResult("SELECT * FROM comentarioojociudadano WHERE estado='A' AND comentarioojociudadano.idojociudadano = ".$comments->request['idojociudadano']." ORDER BY creacion DESC");
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
    } 
}

$smarty->display($tpl,$cache_pattern . $tpl_id);

$noticia = new minoticiaTable;
$smarty->cache_lifetime = 1800;

if(!$smarty->is_cached('minoticia/right-ojociudadano.tpl',$cache_pattern)){
    $galeria = new galeriaminoticiaTable;
    $coleccion = new galeriafotominoticiaTable;
    $coleccion->readEnv();
    $pagina = new paginaTable;
    $galerias = $galeria->readData();
    $fotos = array();

    for($i=0; $i<count($galerias); $i++){
        list($fotos[$i]['fotogaleria']) = $coleccion->readDataFilter("galeriafotominoticia.idgaleriaminoticia = "
        . $galerias[$i]['idgaleriaminoticia']);
    }

    $smarty->assign("galeria", $fotos);  

    $ojociudadano = new ojociudadanoTable;
    $ojociudadano->readEnv();
    $filas = $ojociudadano->readDataSql("SELECT * FROM ojociudadano WHERE idojociudadano != " . $ojociudadano->request['idojociudadano'] . "AND estado = 'A'");

    for($i=0;$i<count($filas);$i++) {
        $filas[$i]['imgs'] = getImgs($filas[$i]['texto']);
    }
     
    $portada = $noticia->readDataFilter("estado = 'A'");
    $smarty->assign("noticiasportada", $portada); 
    $smarty->assign("enunciadogaleria",$pagina->readRecord(8));
    $smarty->assign("ojociudadano",$filas);
}

$smarty->display('minoticia/right-ojociudadano.tpl', $cache_pattern);
include ('../classes/footer.inc.php');
?>
