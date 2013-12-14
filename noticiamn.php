<?php
require('../classes/app.class.php');
//require('../classes/badnews.class.php');
//require('../classes/badsect.class.php');
define('COMENTAR', true);
define(NOTICIA,true);

$tpl_id = (int)$_REQUEST['idminoticia'];
include ('../classes/header-minoticia.inc.php');
include ('comentarmn.php');
// Template

$pagina = new paginaTable;
$noticia = new minoticiaTable;
$tpl = 'minoticia/noticia.tpl';
$smarty->cache_lifetime = 1800;

// Si no esta cacheada
if(!$smarty->is_cached($tpl,$cache_pattern . $tpl_id)) {
    if (!$smarty->get_template_vars('banner_centro_250_208')||!$smarty->get_template_vars('banner_derecho_160_200')) {
      @include_once(ROOTDIR.'/zonas/minoticia.php');
    }
    require ('../classes/paginador.class.php');

    #filtro de la noticia seleccionada por el usuario
    $noticia->readEnv();
    $tipo = new seccionTable;
    $tipo->readEnv();
    list($row) = $noticia->readDataFilter("minoticia.idminoticia='". $noticia->request['idminoticia'] ."'");
    # Votacion
    if($row) {
      $stars = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM minoticia WHERE idminoticia=".$row["idminoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $noticia->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM minoticia WHERE idminoticia=".$row["idminoticia"]);
    }
    if(is_float($stars)) $stars = round($stars,1);
    elseif(empty($stars)) $stars = 0;
    $row["stars"]=$stars;
    $row["votos"]=$votos;
    
    if (!empty($row['idminoticia'])) {
      if(!empty($row['intro']))
        $row['intro'] = explode("\n",$row['intro']);
      # Si hay sidebar
      $sidebar = $noticia->readDataSql("SELECT sidebar,intro,texto FROM sidebar WHERE idminoticia = " . $row['idminoticia']);
      if(count($sidebar)) {
        $pos = 0;
        $patlen = 24;
        $pattern = '/<img[^>]+?src=[\'"]+(http:\/\/[^\'"]*)[\'"][^>]*>/i';
        # Si hay imagen, tratar de poner despues de ella
        if(preg_match($pattern,$row['texto'])) {
          $str = trim(str_replace("&nbsp;"," ",strip_tags($row['texto'])));
          $str = preg_replace("/(\s){2,}/","$1", $str);
          $paragraphs = explode("\n",$str);
          $np = 5;
          $pattern = substr($paragraphs[$np],-$patlen);
          $pos = strpos($row['texto'],$pattern);
          $oPos[] = stripos($row['texto'],'<p>',$pos);
          $oPos[] = stripos($row['texto'],'<h1>',$pos);
          $oPos[] = stripos($row['texto'],'<h2>',$pos);
          $minPos = 0;
          foreach($oPos as $uPos) 
            if(!empty($uPos)) {
              if( $uPos < $minPos || 
                  $minPos == 0 ) $minPos = $uPos;
            }
          if($minPos) $pos = $minPos;
          elseif($pos < 1500 && strlen($str) > 1500) 
            $pos = 1500;
        }
        $strAcl = '<ul id="SIDEBAR">';
        foreach($sidebar as $bar) {
          $strAcl .= '<li>';
          if(!empty($bar['sidebar'])) $strAcl .= '<h1>' . $bar['sidebar'] . '</h1>';
          if(!empty($bar['intro'])) {
            $bar['intro'] = explode("\n",$bar['intro']);
            $strAcl .= '<ul>';
            foreach($bar['intro'] as $line)
              $strAcl .= '<li>' . $line . '</li>';
            $strAcl .= '</ul>';
          }
          if(!empty($bar['texto'])) $strAcl .= '<div>' . nl2br($bar['texto']) . '</div>';
          $strAcl .= '</li>';
        }
        $strAcl .= '</ul>';
        $str = $row['texto'];
        if($pos > 0)
          $row['texto'] = substr($str,0,$pos) . $strAcl . substr($str,$pos);
        else $row['texto'] = $strAcl . $str;
      }
    }
    $smarty->assign('row', $row);
    $comments = new comentariominoticiaTable;
    $comments->readEnv();
    $comments->order = 'creacion';
    $comments->readEnv();
    if($comments->request['idminoticia']) {
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      $comentarios=$paginador->getPageResult("SELECT * FROM comentariominoticia WHERE estado='A' AND comentariominoticia.idminoticia = ".$comments->request['idminoticia']." ORDER BY creacion DESC");
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
    } 
    unset($comentario);
  }

$smarty->assign("title","noticia");
$smarty->display($tpl,$cache_pattern . $tpl_id);


$ojo = new ojociudadanoTable;
$ojo->order="creacion DESC";

$smarty->cache_lifetime = 1800;

if(!$smarty->is_cached('ultimasnoticiasuser.inc.tpl', $cache_pattern)){
    $galeria = new galeriaminoticiaTable;
    $coleccion = new galeriafotominoticiaTable;
    $coleccion->readEnv();
    $galerias = $galeria->readData();
    $fotos = array();

    for($i=0; $i<count($galerias); $i++){
        list($fotos[$i]['fotogaleria']) = $coleccion->readDataFilter("galeriafotominoticia.idgaleriaminoticia = "
        . $galerias[$i]['idgaleriaminoticia']);
    } 
   
    $smarty->assign("galeria", $fotos); 
     
    $rows = $ojo->readDataFilter("estado = 'A'");
    for($i=0;$i<count($rows);$i++) {
        $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    } 
    
    $portada = $noticia->readDataFilter("ubicacion <> '' AND estado = 'A' AND idminoticia <> " . $tpl_id);
    $smarty->assign("enunciadogaleria",$pagina->readRecord(8));
    $smarty->assign("ojociudadano", $rows);    
    $smarty->assign("noticiasportada", $portada);
}

$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl', $cache_pattern);
include ('../classes/footer.inc.php');