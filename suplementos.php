<?php
require('../classes/app.class.php');
define('ZONA_SUPLEMENTO', true);

$usermagazine = new usuarioperiodoTable;

if(!empty($_SESSION['idusuario'])){
    $mag = $usermagazine->readDataFilter("usuarioperiodo.idusuario = " . $_SESSION['idusuario'] . " AND aprobado IS TRUE");
}

if(($_REQUEST['uri'] === 'magazine')){
   if(empty($_SESSION['idusuario'])){
       header("Location: /entrar");
   }elseif(!$mag){
       header("Location: /magaccess.php?opt=view"); 
   }
}

$is_mobile = is_mobile();

if($is_mobile){
    $uri = $_SERVER["REQUEST_URI"];
    if(!isset($_GET["movil"])){
        header('Location: ' . $uri . '?movil');
    }
}

// && ($_REQUEST['uri'] === 'magazine'
include_once(ROOTDIR.'/zonas/suplemento.php');

$tpl = 'suplementos/index_suplementos.tpl';
if($_REQUEST['idarticulo']) {
  define ('ARTICULO',true);
  include ('../classes/header.inc.php');

  include ('comentar.php');
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    require('../classes/paginador.class.php');
    # Edicion del suplemento
    $edicionsup = new edicionsuplementoTable();
    $edicionsup->readEnv();
    list($row) = $edicionsup->readDataFilter("edicionsuplemento = '$idedicion'");
    $smarty->assign('edicion',$row);
    unset($row);
    $suplementos = new suplementoTable;
    $suplementos->readEnv();
    #leer ultimos suplementos
    $listsuplementos = $suplementos->readDataSQL("SELECT suplemento,uri,ultima FROM suplemento, (SELECT idsuplemento,MAX(edicionsuplemento) AS ultima FROM edicionsuplemento GROUP BY idsuplemento) AS ultimaedicion WHERE suplemento.idsuplemento=ultimaedicion.idsuplemento AND ultima < CURRENT_DATE ORDER BY ultima DESC");
    $smarty->assign('suplementos',$listsuplementos);
    
/*    if(($_REQUEST['uri'] == 'magazine') && (empty($_SESSION['idusuario']))){
       header("Location: /entrar");
    }*/

    //lee informacion del suplemento
    if ($suplementos->request['uri']) {
      $infosup = $suplementos->readDataFilter("suplemento.uri='". $suplementos->request['uri'] ."'");
      $smarty->assign('infosup',$infosup[0]);
      $smarty->assign("cambioestilo", false);
    }

    $articulos = new articuloTable;
    $articulos->readEnv();
    if ($articulos->request['idarticulo']) {
      $smarty->assign("cambioestilo", true);
      $row = $articulos->readRecord();
      if (!$row['idarticulo']) {
        # FIXME: no puedo escribir header si ya ha habido salida (por smarty->display en header.inc.php)
        #header('Location: /404.html');
        print "ERROR: 404 P&aacute;gina no encontrada.";
        exit();
      }
      # Votacion
      $stars = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$row["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $row['raiting_1']+$row['raiting_2']+$row['raiting_3']+$row['raiting_4']+$row['raiting_5'];
      if($is_mobile){
        $row['texto'] = replaceVideo($row['texto']);
      }
      if(is_float($stars)) $stars = round($stars,1);
      elseif(empty($stars)) $stars = 0;
      $row["stars"]=$stars;
      $row["votos"]=$votos;
      
      # Fin_Votacion
      if(!empty($row['intro']))
        $row['intro'] = explode("\n",$row['intro']);
      # Relacionadas
      if(!empty($row['idarticulo'])) {
        $rel = $articulos->readDataSql("SELECT relacionadoart,enlace,tipo FROM relacionadoart WHERE idarticulo = " . $row['idarticulo']);
        # Si hay sidebar
        $sidebar = $articulos->readDataSql("SELECT aclart,intro,texto FROM aclart WHERE idarticulo = " . $row['idarticulo']);
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
            #$pos = strpos($row['texto'],$pattern) + $patlen;
            # Buscar un h2 o un p despues del numero y poner el que tenga menor pos
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
            else $pos = strpos($row['texto'],'</p>',strlen($str));
          }
          $strAcl = '<ul id="SIDEBAR">';
          foreach($sidebar as $bar) {
            $strAcl .= '<li>';
            if(!empty($bar['aclart'])) $strAcl .= '<h1>' . $bar['aclart'] . '</h1>';
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
        # Galerias
        $pattern = '/<div class=".*?gallery-(\d{1,})?">&nbsp;<\/div>/';
        preg_match_all($pattern,$row['texto'],$matches);
        if(!empty($matches[1])) {
          $coleccion = new coleccionTable();
          $ix = 0;
          foreach($matches[1] as &$str) {
            $align = '';
            $first = true;
            $_REQUEST['idgaleria'] = $str;
            $coleccion->readEnv();
            if(strpos($matches[0][$ix],'na-gallery-left')!==false) $align = "na-gallery-left ";
            elseif(strpos($matches[0][$ix],'na-gallery-right')!==false) $align = "na-gallery-right";
            if(!empty($align)) {
              $coleccion->limit = 1;
              list($foto) = $coleccion->readDataFilter("coleccion.idgaleria = " . $coleccion->request['idgaleria']);
              list($w,$h) = getimagesize(PIXDIR . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) . '/288x318_' . $foto['imagen']);
              $str = '<div class="na-media na-gallery ' . $align . ' gallery-' . $str . '" style="width:'.$w.'px;"><div class="headline"><span>Galeria</span><a href="#" onclick="openwindow(\'/gallery.php?id=' . $foto['idgaleria'] . '\',640,460);">Ver Fotos</a><br clear="all"/></div>';
              $str .= '<a href="#" onclick="openwindow(\'/gallery.php?id=' . $foto['idgaleria'] . '\',640,460);" style="background-image:url(\'' . PIXURL . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) . '/288x318_' . rawurlencode($foto['imagen']) . '\');width:' . $w . 'px;height:' . $h . 'px;" class="picture"></a>';
              $str .= '</div>';
            } else {
              $str = '<div class="na-media na-gallery ' . $align . ' gallery-' . $str . '">';
              $fotos = $coleccion->readDataFilter("coleccion.idgaleria = " . $coleccion->request['idgaleria']);
              if(!empty($fotos)) {
                $index = 1;
                foreach($fotos as $foto) {
                  $str .= '<div class="imagen"' . (!$first?' style="display:none"':'') . '><img src="' . PIXURL . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) .  '/600x400_' . $foto['imagen'] . '" />' . (!empty($foto['texto'])||count($fotos)>1?'<blockquote>' . (count($fotos)>1?'<span class="pg">' . ($index++) . '/<b>' . count($fotos) . '</b></span>':'') . (!empty($foto['texto'])?' - ':'') . nl2br($foto['texto']) . '</blockquote>':'') . '</div>' . PHP_EOL;
                  $first = false;
                }
                $str .= '<div class="menu"><input type="button" class="begin" value="inicio"/><input type="button" class="prev" value="anterior"/><input type="button" class="next" value="siguiente" /><input type="button" class="end" value="fin" /></div></div>';
              }
            }
          }
          $row['texto'] = str_replace($matches[0],$matches[1],$row['texto']);
          $ix++;
        }
      }
      $smarty->assign('rel',$rel);
      $smarty->assign('row', $row);
      # Comentarios
      $comments = new comentarioarticuloTable;
      $comments->readEnv();
      $comments->order = 'creacion';
      $comments->readEnv();
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      // Utiliza el readDataSql pero con LIMIT y OFFSET
      $comentarios=$paginador->getPageResult("SELECT * FROM comentarioarticulo WHERE  comentarioarticulo.estado='A' AND comentarioarticulo.idarticulo = ".$articulos->request['idarticulo']." ORDER BY creacion DESC");
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
      unset($comentario);
      # Fin_comentarios
      # articulos columna derecha
      $otrosart = $articulos->readDataFilter("articulo.idseccionsuplemento='". $row['idseccionsuplemento'] ."' AND edicionsuplemento='".$idedicion."'");
      $smarty->assign('otrosart', $otrosart);
      # $tpl = 'suplementos/entrada.tpl';
      $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.estado='A'");
      $smarty->assign('todos', $rows);
    }
  }
} elseif ($_REQUEST['uri']) {
  define ('SUPLEMENTO',true);
  include ('../classes/header.inc.php');
  
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    # Edicion del suplemento
    $edicionsup = new edicionsuplementoTable();
    $edicionsup->readEnv();
    list($row) = $edicionsup->readDataFilter("edicionsuplemento = '$idedicion'");
    $smarty->assign('edicion',$row);
    unset($row);
    $suplementos = new suplementoTable;
    $suplementos->readEnv();
    #leer ultimos suplementos
    $listsuplementos = $suplementos->readDataSQL("SELECT suplemento,uri,ultima FROM suplemento, (SELECT idsuplemento,MAX(edicionsuplemento) AS ultima FROM edicionsuplemento GROUP BY idsuplemento) AS ultimaedicion WHERE suplemento.idsuplemento=ultimaedicion.idsuplemento AND ultima < CURRENT_DATE ORDER BY ultima DESC");
    $smarty->assign('suplementos',$listsuplementos);
    //lee informacion del suplemento
    if ($suplementos->request['uri']) {
      $infosup = $suplementos->readDataFilter("suplemento.uri='". $suplementos->request['uri'] ."'");
      $smarty->assign('infosup',$infosup[0]);
    }
    $articulos = new articuloTable;
    $articulos->readEnv();

    # lee articulos del suplemento
    $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.resumen,articulo.presentar,articulo.raiting_1,articulo.raiting_2,articulo.raiting_3,articulo.raiting_4,articulo.raiting_5,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='D' AND estado='A' ORDER BY articulo.orden DESC");
    for($i=0;$i<count($rows);$i++) {
      $rows[$i]['stars'] = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$rows[$i]["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
      setGallery($rows,$i); 
      if (empty($rows[$i]['fotogaleria']))
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    }
    $smarty->assign('derecha', $rows);
    unset($rows);
    $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.presentar, articulo.resumen,articulo.raiting_1,articulo.raiting_2,articulo.raiting_3,articulo.raiting_4,articulo.raiting_5,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='I' AND estado='A' ORDER BY articulo.orden DESC");
    for($i=0;$i<count($rows);$i++) {
      setGallery($rows,$i);
      if (empty($rows[$i]['fotogaleria']))
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
      $rows[$i]['stars'] = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$rows[$i]["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    }
    $smarty->assign('izquierda', $rows);
    unset($rows);
    $todos = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."'  AND articulo.estado='A'");
    $smarty->assign('todos', $todos);
  }
}

$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
?>
