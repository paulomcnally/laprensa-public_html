<?php
require '../classes/app.class.php';

define('ARTICULO', true);
$tpl_id = (int)$_REQUEST['idnoticia'];
$cache_pattern = 'elecciones-2013-venezuela|notas|' . $tpl_id;
$tpl = 'elecciones-venezuela-2013/nota.tpl';

if (!$smarty->is_cached($tpl, $cache_pattern . "|$tpl_id")){
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
    $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
    $smarty->assign('edicion',$row);

    $noticia = new noticiaTable;
    $noticia->readEnv();
    list($row) = $noticia->readDataFilter("noticia.idnoticia = ". $tpl_id);
 
   
    # mas noticias del especial
     $der_noticias = $noticia->readDataFilter("noticia.idseccion = 57 AND noticia.estado='A' AND noticia.idnoticia <> '". $row['idnoticia'] ."'");
      $smarty->assign('der_noticias',$der_noticias);
    $row['texto'] = replaceFPVersion($row['texto']);
    # Galeria
    $pattern = '/<div class=".*?gallery-(\d{1,})?">&nbsp;<\/div>/';
      preg_match_all($pattern,$row['texto'],$matches);
      if(!empty($matches[1])) {
        $coleccion = new coleccionTable();
        $ix = 0;        foreach($matches[1] as &$str) {
          $align = '';
          $first = true;
          $_REQUEST['idgaleria'] = $str;
          $coleccion->readEnv();
          if(strpos($matches[0][$ix],'na-gallery-left')!==false) $align = "na-gallery-left ";
          elseif(strpos($matches[0][$ix],'na-gallery-right')!==false) $align = "na-gallery-right";
          if(!empty($align)) {
            $coleccion->limit = 1;
            list($foto) = $coleccion->readDataFilter("coleccion.idgaleria = " . $coleccion->request['idgaleria']);
            # FIXME: la galeria puede no existir. caso de idnoticia=59360, coleccion.idgaleria=97
            list($w,$h) = @getimagesize(PIXDIR . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) . '/288x318_' . $foto['imagen']);
            $str = '<div class="na-media na-gallery ' . $align . ' gallery-' . $str . '" style="width:'.$w.'px;"><div class="headline"><span>Galeria</span><a href="#" onclick="openwindow(\'/gallery.php?id=' . $foto['idgaleria'] . '\',640,460);">Ver Fotos</a><br clear="all"/></div>';
            $str .= '<a href="#" onclick="openwindow(\'/gallery.php?id=' . $foto['idgaleria'] . '\',640,460);" style="background-image:url(\'' . PIXURL . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) . '/288x318_' . rawurlencode($foto['imagen']) . '\');width:' . $w . 'px;height:' . $h . 'px;" class="picture"></a>';
            $str .= '</div>';
          } else {
            $str = '<div class="na-media na-gallery ' . $align . ' gallery-' . $str . '">';
            $fotos = $coleccion->readDataFilter("coleccion.idgaleria = " . $coleccion->request['idgaleria']);
            if(!empty($fotos)) {
              foreach($fotos as $foto) {
                $str .= '<a rel="prettyPhoto[pp_gal]" href="'.PIXURL.'/'.date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) .  '/600x400_' . $foto['imagen'] . '" class="image" title="'.$foto['texto'].'"><img src="' . PIXURL . '/' . date("Y/m", substr($foto['imagen'],0,strpos($foto['imagen'],'_'))) . '/120x90_' . $foto['imagen'].'" alt="'.$title.'" /></a>' . PHP_EOL;
              }
            }
            $str .= '</div>';
          }
        }
        $row['texto'] = str_replace($matches[0],$matches[1],$row['texto']);
        $ix++;
      }
    # intro
     if(!empty($row['intro']))
        $row['intro'] = explode("\n",$row['intro']);
     
    if(!empty($row['idnoticia']))
      $rel = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $row['idnoticia']);
    $smarty->assign('rel',$rel);
    $sidebar = $noticia->readDataSql("SELECT acl,intro,texto FROM acl WHERE idnoticia = " . $row['idnoticia']);
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
        }
        $strAcl = '<blockquote>';
        foreach($sidebar as $bar) {
          $strAcl .= '<p>';
          if(!empty($bar['acl'])) $strAcl .= '<h3>' . $bar['acl'] . '</h3>';
          if(!empty($bar['intro'])) {
            $bar['intro'] = explode("\n",$bar['intro']);
            $strAcl .= '';
            foreach($bar['intro'] as $line)
              $strAcl .= '<small>' . $line . '</small>';
            $strAcl .= '';
          }
           if(!empty($bar['texto'])) $strAcl .= '<div>' . nl2br($bar['texto']) . '</div>';
          $strAcl .= '</p>';
        }
        $strAcl .= '</blockquote>';
        $str = $row['texto'];
        if($pos > 0)
          $row['texto'] = substr($str,0,$pos) . $strAcl . substr($str,$pos);
        else $row['texto'] = $strAcl . $str;
      }
    $smarty->assign('nota', $row);
    $smarty->assign('title',$row['noticia']);   
 
    #videos
     $video = new videoTable();
     $video->limit=3;
     $video->order = "creacion DESC";
     $videos = $video->readDataFilter("video.claves ILIKE '%elecciones venezuela 2013%'");
     $smarty->assign('clips', $videos);  
}

$smarty->display($tpl, $cache_pattern);
?>
