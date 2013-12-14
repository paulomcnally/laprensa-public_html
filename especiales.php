<?php
require('../classes/app.class.php');
require('../classes/paginador.class.php');
require_once "XML/RSS.php";
include ('comentar.php');

include ('../classes/header.inc.php');
$smarty->caching=0;
$nota = new notaTable;
$nota->readEnv();
$especiales = new especialTable;
$especiales->readEnv();

$tpl = 'especiales.tpl';
    if ($nota->request['idnota']) {
      $tpl = 'especial.tpl';
      $row = $nota->readRecord();
      #Votacion
      if($row) {
        $stars = $nota->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM nota WHERE idnota=".$row["idnota"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
        $votos = $nota->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM nota WHERE idnota=".$row["idnota"]);
        # Enlaces relacionados
        $rel = $nota->readDataSql("SELECT relacionadonota,enlace,tipo FROM relacionadonota WHERE idnota = " . $row['idnota']);
        $smarty->assign('rel',$rel);
        # Intro
        if(!empty($row['intro']))
          $row['intro'] = explode("\n",$row['intro']);
        $autores = $nota->readDataSql("SELECT autor,idnota FROM creditonota JOIN autor USING(idautor) WHERE idnota = " . $row['idnota']);
        $smarty->assign('autores',$autores);
        # Si hay sidebar
        $sidebar = $nota->readDataSql("SELECT aclnota,intro,texto FROM aclnota WHERE idnota = " . $row['idnota']);
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
            if(!empty($bar['aclnota'])) $strAcl .= '<h1>' . $bar['aclnota'] . '</h1>';
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
      if(is_float($stars)) $stars = round($stars,1);
      elseif(empty($stars)) $stars = 0;
      $row["stars"]=$stars;
      $row["votos"]=$votos;
      #Fin_Votacion
      #claves = split(',',$row['claves']);
      if ($claves) {
        $notas = array();
        $i = 0;
        foreach ($claves as $clave) {
          #if($row)
            $rows = $nota->readDataSQL("SELECT * FROM (SELECT idnota, nota,uri,lower(trim(regexp_split_to_table(trim(claves),','))) AS clave FROM nota LEFT OUTER JOIN especial ON nota.idespecial=especial.idespecial WHERE trim(claves) IS NOT NULL AND trim(claves) <> '' AND idnota IN (SELECT idnota FROM edicion WHERE edicion = '$idnota')) AS T WHERE T.clave = lower('".$clave."') AND T.idnota <> ". $row['idnota']);
          #else
          #  $rows = $nota->readDataSQL("SELECT * FROM (SELECT idnota, nota,uri,lower(trim(regexp_split_to_table(trim(claves),','))) AS clave FROM nota LEFT OUTER JOIN especial ON nota.idespecial=especial.idespecial WHERE trim(claves) IS NOT NULL AND trim(claves) <> '' AND idnota IN (SELECT idnota FROM edicion WHERE edicion = '$idnota')) AS T WHERE T.clave = lower('".$clave."')");
          if($rows) {
            $notas[$i]['clave'] = $claves[$i];
            $notas[$i]['notas'] = $rows;
            $i++;
          }
        }
        $smarty->assign('note_tags',$notas);
      }
      #Noticias relacionadas al especial
      $der_notas = $nota->readDataFilter("nota.idespecial='".$row['idespecial']."' AND nota.estado='A' AND nota.idnota <> '". $row['idnota'] ."'");
      $smarty->assign('der_notas',$der_notas);
      $smarty->assign('row', $row);
      
      # Comentarios
      $comments = new comentarionotaTable;
      $comments->readEnv();
      $comments->order = 'creacion';
      $comments->readEnv();
      if($comments->request['idnota']) {
       #Comentarios
       $paginador=new paginador($comments,10,$_REQUEST["page"]);
       //Utiliza el readDataSql pero con LIMIT y OFFSET
       $comentarios=$paginador->getPageResult("SELECT * FROM comentarionota WHERE comentarionota.idnota = ".$comments->request['idnota']." AND comentarionota.estado='A' ORDER BY creacion DESC");
       #Fin_comentarios
       $smarty->assign('pg',$paginador->PAGINA);
       $smarty->assign('inicio',$paginador->INICIO);
       $smarty->assign('pgs',$paginador->TOTAL);
       $smarty->assign('comentarios',$comentarios);
       unset($comentarios);
     }
     unset($comentario); 
      
    } else {
      # Noticias Varias - Columna Izquierda
      $rows = $nota->readDataFilter("uri='".$especiales->request['uri']."' AND estado='A'");
      for($i=0;$i<count($rows);$i++)
        $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
      $smarty->assign('rows',$rows);
      $total = count($rows);
      if ($total % 2 == 0)
        $max = ($total/2);
      else
        $max = number_format($total/2);
      $smarty->assign('max',$max);
    }

if ($row || $rows) {
  # Encuestas 
  $encuesta = new encuestaTable();
  $encuesta->limit = 1;
  $surveys = $encuesta->readDataFilter("'$idedicion' BETWEEN fecha_ini::date AND fecha_fin::date");
  $smarty->assign('encuestas',$surveys);
}

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
