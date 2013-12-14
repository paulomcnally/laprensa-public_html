<?php
require('../classes/app.class.php');

# fecha superior al dia de hoy? solo permitir a IP de LP
if ( (strtotime($idedicion) > strtotime($latestedition)) && ($_SERVER['HTTP_X_FORWARDED_FOR'] != '190.212.136.182') ) {
  $nexturl = preg_replace('/-/', '/', $latestedition);
  error_log("FIXME: Latest edition: $latestedition < $idedicion Location: /$nexturl");
  header("Location: /$nexturl");
}

$strEd = ((int)$_REQUEST['year']) . '/' . ((int)$_REQUEST['month']) . '/' . ((int)$_REQUEST['day']);
$tpl_id = (int)$_REQUEST['idnoticia'];
$page_number = (int)$_REQUEST['page'];
$is_mobile = is_mobile();
$smarty->assign('movil', $is_mobile);

//si es un navegador movil entonces redirigimos, siempre y cuando no se haya hecho ya la redirección
if($is_mobile){
    $uri = $_SERVER["REQUEST_URI"];
    if(!isset($_GET["movil"])){
        header('Location: ' . $uri . '?movil');
    }
}

$var = new paisTable();


#
# Si se epceficó id de la noticia
#
if ($tpl_id) {
  # FIXME: crear is_valid_idnoticia para ver si esta en un rango permitido
  # if (!is_valid_idnoticia($tpl_id)) die('Not a valid id');

  include ('comentar.php');
  include ('../classes/header.inc.php');

  # Template
  $tpl = 'noticia.tpl';
  if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) 
    $smarty->cache_lifetime = 16 * 60 * 60;       # 16 hrs
  # Si no esta cacheada
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    if (!$smarty->get_template_vars('banner_centro_250_208')||!$smarty->get_template_vars('banner_derecho_160_200')) {
      $idseccion = preg_replace('(\.(.*))','',$_REQUEST['uri']);
      @include_once(ROOTDIR.'/zonas/'.$idseccion.'.php');
      $smarty->assign('uri',$tpl_id);
    }
    require ('../classes/paginador.class.php');
    $noticia = new noticiaTable;
    $noticia->readEnv();
    $tipo = new seccionTable;
    $tipo->readEnv();
    #list($row) = $noticia->readDataFilter("noticia.estado='A' AND noticia.idnoticia='". $noticia->request['idnoticia'] ."'");
    list($row) = $noticia->readDataFilter("edicion.edicion = '" . $idedicion . "' AND seccion.uri = '" . $noticia->database->escape($_REQUEST['uri'])  . "' AND noticia.idnoticia='". $noticia->request['idnoticia'] ."'");
    #list($row) = $noticia->readDataFilter("noticia.idnoticia='". $noticia->request['idnoticia'] ."'");
    # Votacion
    if($row) {
      $stars = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$row["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $noticia->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM noticia WHERE idnoticia=".$row["idnoticia"]);
      setCDNVideo($row['texto']);
      $useragent=$_SERVER['HTTP_USER_AGENT'];
      if($is_mobile){
        $row['texto'] = replaceVideo($row['texto']);
      }
      if($row['idseccion']==56) {
        #galeria de fotos de elecciones
        $galelecciones2012 = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '1265' ORDER BY coleccion.creacion DESC;");
        $smarty->assign("galelecciones2012", $galelecciones2012);
        #noticias electorales con videos y a la derecha
        $rows_videosder=$noticia->readDataFilter("noticia.idseccion=56 AND noticia.estado='A' AND noticia.ubicacion='D'");
        for($i=0;$i<count($rows_videosder);$i++)
          setVideo($rows_videosder,$i);
        $smarty->assign('rows_videosder',$rows_videosder);
      } 
    } else { 
      # No existe una noticia con ese idnoticia
      include '../classes/404.inc.php';
      include './404.php';
      die();
    }
    if(is_float($stars)) $stars = round($stars,1);
    elseif(empty($stars)) $stars = 0;
    $row["stars"]=$stars;
    $row["votos"]=$votos;
    # Fin_Votacion
    # Relacionadas
    if(!empty($row['idnoticia']))
      $rel = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $row['idnoticia']);
    $smarty->assign('rel',$rel);
    #
    if(!empty($row['claves'])) $claves = split(', ',$row['claves']);
    else $claves = false;
    if (!empty($claves)) {
      $notas = array();
      $i = 0;
      foreach ($claves as $clave) {
        $rows = $noticia->readDataSQL("SELECT * FROM (SELECT idnoticia, noticia,uri,lower(trim(regexp_split_to_table(trim(claves),','))) AS clave FROM noticia LEFT OUTER JOIN seccion ON noticia.idseccion=seccion.idseccion WHERE trim(claves) IS NOT NULL AND trim(claves) <> '' AND idedicion IN (SELECT idedicion FROM edicion WHERE edicion = '$idedicion')) AS T WHERE T.clave = lower('". $noticia->database->escape($clave) ."') AND T.idnoticia <> ". $row['idnoticia']);
        if($rows) {
          $notas[$i]['clave'] = $claves[$i];
          $notas[$i]['notas'] = $rows;
          $i++;
        }
      }
      $smarty->assign('note_tags',$notas);
    }
    if (!empty($row['idnoticia'])) {
      $smarty->assign('sec_noticia', true);
      # Galerias
      $pattern = '/<div class=".*?gallery-(\d{1,})?">&nbsp;<\/div>/';
      preg_match_all($pattern,$row['texto'],$matches);
      if(!empty($matches[1])) {
        define('GALERIA', true);
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
      #Noticias relacionadas a la seccion
//      if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//        $der_noticias = $noticia->readDataFilter("noticia.idseccion='".$row['idseccion']."' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado='A' AND noticia.idnoticia <> '". $row['idnoticia'] ."'");
//      else
        $der_noticias = $noticia->readDataFilter("noticia.idseccion='".$row['idseccion']."' AND edicion='$idedicion' AND noticia.estado='A' AND noticia.idnoticia <> '". $row['idnoticia'] ."'");
      $smarty->assign('der_noticias',$der_noticias);
      if(!empty($row['intro']))
        $row['intro'] = explode("\n",$row['intro']);
      $autores = $noticia->readDataSql("SELECT autor,idnoticia FROM credito JOIN autor USING(idautor) WHERE idnoticia = " . $row['idnoticia']);
      $smarty->assign('autores',$autores);
      # Si hay sidebar
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
        $strAcl = '<ul id="SIDEBAR">';
        foreach($sidebar as $bar) {
          $strAcl .= '<li>';
          if(!empty($bar['acl'])) $strAcl .= '<h1>' . $bar['acl'] . '</h1>';
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
    if(empty($row['video'])&&empty($row['fotogaleria'])) 
        $row['imgs'] = getImgs($row['texto']);
    $smarty->assign('row', $row);
    # Comentarios
    $comments = new comentarioTable;
    $comments->readEnv();
    $comments->order = 'creacion';
    $comments->readEnv();
    if($comments->request['idnoticia']) {
      #Comentarios
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      //Utiliza el readDataSql pero con LIMIT y OFFSET
      //$comentarios=$paginador->getPageResult("SELECT * FROM comentario WHERE  comentario.estado='A' AND comentario.idnoticia = ".$comments->request['idnoticia']." ORDER BY creacion DESC");
      $comentarios=$paginador->getPageResult("SELECT idcomentario,idnoticia,nombre,email,web,comentario,ip,creacion,idusuario,estado,creacion at time zone 'UTC' at time zone 'America/Managua' as creacion2 FROM comentario WHERE  comentario.estado='A' AND comentario.idnoticia = ".$comments->request['idnoticia']." ORDER BY creacion DESC");
      #Fin_comentarios
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
    } 
    unset($comentario);
    # Encuesta
    include_once ('./encuesta.inc.php');
    # Blogs
    include_once ('./blogs.inc.php');
    # Tags
    include_once ('./tags.inc.php');
  }
  counter($tpl_id);
} else {
#
# Si no se especifico id de noticia, entonces es seccion
#
  $today = date("m-d");
  $cyear = date("Y");

  $tpl = 'noticias.tpl';
  $tpl_id = $_REQUEST['uri'];

  # FIXME: escribir function is_it_funny? para descartar URIs evidentemente errados
  # if (is_it_funny($tpl_id)) die('funny URI');

  define ('SECCION',true);
  list($idseccion, $iddepto) = preg_split('/\//', $tpl_id);
  if ($idseccion == 'elecciones' && !empty($iddepto)) {
    $tpl_id = $_REQUEST['uri'] = $idseccion;
  }

  # es una seccion valida?
  if (!in_array($tpl_id, $secciones_validas)) {
      error_log('404 ' . $_REQUEST['uri'] . " - " . $tpl_id);
      include('./404.php');
      die();
  }
  include ('../classes/header.inc.php');
  if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) 
    $smarty->cache_lifetime = 7 * 24 * 60 * 60;       # 1 semana
  # Si no esta cacheada
  if(!$smarty->is_cached($tpl,$cache_pattern)) {

    # Ahora se revisa si existe la seccion con in_array(..., $secciones_validas)
    #$exist = (bool)$var->getVar("SELECT count(idseccion) FROM seccion WHERE uri = '" .$var->database->escape($tpl_id) . "'");
    #if(!$exist) {
    #  include('./404.php');
    #  die();
    #}

    if (!$smarty->get_template_vars('banner_centro_250_208')||!$smarty->get_template_vars('banner_centro_300_250')) {
      @include_once(ROOTDIR.'/zonas/'.$tpl_id.'.php');
      $smarty->assign('uri',$tpl_id);
    }

    $noticia = new noticiaTable;
    $noticia->readEnv();
    $tipo = new seccionTable;
    $tipo->readEnv();

    #
    # <Elecciones 2011>
    #
    $comentario = new comentarioTable;
    $comentarios_electorales = $comentario->readDataSql("SELECT idcomentario,comentario,nombre,comentario.idnoticia FROM comentario JOIN noticia USING(idnoticia) JOIN seccion USING (idseccion) WHERE comentario.estado='A' AND idseccion = 51 ORDER BY idcomentario LIMIT 5");
    $smarty->assign('comentarios_electorales', $comentarios_electorales);
    unset($comentario);
      $pagina = new paginaTable();
      $pagina->readRecord(12);
      $smarty->assign('titulo_transmision',$pagina->request['pagina']);
    if($tpl_id=='elecciones' && empty($iddepto)) {
      $pagina = new paginaTable();
      $pagina->readEnv();
      $smarty->assign('nota_elecciones',$pagina->readRecord(16));
      $smarty->assign('subnota_elecciones',$pagina->readRecord(17));
      # para slide de candidatos - solo cuando no hay depto
      $candidatos = new ppoliticoTable();
      $candidatos->readEnv();
      $smarty->assign('candidatos',$candidatos->readData());
      #votos
      $candidato_votos = new candidatoTable();
      $votos = $candidato_votos->readDataSQL("SELECT ppolitico.ppolitico, ppolitico.imagen, candidato.candidato, candidato.votos FROM candidato JOIN ppolitico USING (idppolitico) WHERE candidato.iddepto IS NULL OR candidato.iddepto='' ORDER BY ppolitico.orden");
      $smarty->assign('votos',$votos);
      require_once('mapa.php');
      $fotos5 = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '386' ORDER BY coleccion.creacion DESC;");
      $smarty->assign('fotos5', $fotos5);
	/* segunda galeria barra lateral derecha*/
      $todo_elecciones = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '413' ORDER BY substr(imagen,12);");
      $smarty->assign('todo_elecciones', $todo_elecciones);
    }

# FIXME - esto aqui?
  # bambuser

  $smarty->assign('bamb',$pagina->readRecord(12));
  $smarty->assign('bambImg', $pagina->readRecord(15));

    if($tpl_id=='elecciones' && !empty($iddepto)) {
     
      # Para las noticias Electorales por departamento
      require_once('mapa.php');
      $fotos5 = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '386' ORDER BY coleccion.creacion DESC;");
      $smarty->assign('fotos5', $fotos5);
	/* segunda galeria barra lateral derecha*/
      $todo_elecciones = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '413' ORDER BY substr(imagen,12);");
      $smarty->assign('todo_elecciones', $todo_elecciones);

//      if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//        $rows = $noticia->readDataFilter("edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND seccion.uri='" . $tipo->request['uri'] . "' AND noticia.estado='A' AND noticia.iddepto='".$iddepto."'");
//      else
        $rows = $noticia->readDataFilter("edicion='$idedicion' AND seccion.uri='" . $tipo->request['uri'] . "' AND noticia.estado='A' AND noticia.iddepto='" . $iddepto . "'");
      $smarty->assign('depto', $rows[0]['depto']);

      $candidato_votos = new candidatoTable();
      $votos = $candidato_votos->readDataSQL("SELECT ppolitico.ppolitico, ppolitico.imagen, candidato.candidato, candidato.votos FROM candidato JOIN ppolitico USING (idppolitico) WHERE candidato.iddepto='" . $iddepto . "' ORDER BY ppolitico.orden");
      $smarty->assign('votos',$votos);
      
    } else {
    #
    # </Elecciones 2011>
    #
    # Noticias Varias - Columna Izquierda
      # si es reportaje-especial edicion - 7 dias
      if ($idseccion == 'reportajes-especiales' || $idseccion == 'elecciones-municipales-2012' || $idseccion == 'tecnologia')  {
        $noticia->order='creacion DESC';
        $sevendaysago = "date '$idedicion' - integer '7'";
        $edicionFilter = "edicion BETWEEN $sevendaysago AND '$idedicion'";
        #$edicionFilter = "edicion = '$idedicion'";
      } else {
        $edicionFilter = "edicion='$idedicion'";
      }
//      if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )  
//        $rows .= $noticia->readDataFilter("edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND seccion.uri='" . $tipo->request['uri'] . "' AND noticia.estado='A'");
//      else {
        if($tpl_id=='elecciones-municipales-2012') {
        #if ($idseccion=='elecciones-municipales-2012') {
          require ('../classes/paginador.class.php');        
          $paginado = new paginador($noticia,5,$_REQUEST["page"]);
          $newsurl= $_SERVER['REQUEST_URI'];
          $rows=$paginado->getPageResult("SELECT noticia.idnoticia,noticia.noticia,noticia.resumen, noticia.texto,noticia.idseccion,seccion.uri, edicion.edicion FROM noticia JOIN edicion USING(idedicion) JOIN seccion USING (idseccion) WHERE $edicionFilter AND seccion.idseccion=56 AND noticia.estado='A' AND (noticia.ubicacion <> 'D' OR noticia.ubicacion IS NULL) ORDER BY noticia.creacion DESC");
          $smarty->assign('newsurl',$newsurl);
          $smarty->assign('pg',$paginado->PAGINA);
          $smarty->assign('inicio',$paginado->INICIO);
          $smarty->assign('pgs',$paginado->TOTAL);
        } else {
          $rows = $noticia->readDataFilter("$edicionFilter AND seccion.uri='" . $tipo->request['uri'] . "' AND noticia.estado='A'");
        }
      }
//    }
    for($i=0;$i<count($rows);$i++) {
      setVideo($rows,$i);
      if(empty($rows[$i]['video']))
        setGallery($rows,$i);
      if(empty($rows[$i]['video'])&&empty($rows[$i]['fotogaleria']))
        $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
      $rows[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $rows[$i]['idnoticia']);
    }
    #
    # </Elecciones municipales 2012>
    #
    # Noticias Varias - Columna Izquierda
    if($tpl_id=='elecciones-municipales-2012') {
    #if ($idseccion=='elecciones-municipales-2012') {
      #galeria de fotos de elecciones
      $galelecciones2012 = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '1265' ORDER BY coleccion.creacion DESC;");
      $smarty->assign("galelecciones2012", $galelecciones2012);
      #minoticia - noticias ciudadanas electorales 2012 
      $minoticia = new lpminoticia_newsTable;
      #for($i=0;$i<count($rows_minoticia);$i++) {
        #$rows_minoticia[$i]['imgs'] = getImgs($rows_minoticia[$i]['texto']);
        #$rows_minoticia[$i]['imgs'] = getImgs($rows_minoticia[$i]['text']);
      $rows_minoticia = getNews();
      $DSN = '';
      #noticias electorales con videos y a la derecha
      $rows_videosder=$noticia->readDataFilter("noticia.idseccion=56 AND noticia.estado='A' AND noticia.ubicacion='D'");
      for($i=0;$i<count($rows_videosder);$i++) 
        setVideo($rows_videosder,$i);
      $smarty->assign('rows_videosder',$rows_videosder);
      $smarty->assign('rows_minoticia',$rows_minoticia);
    }
    $smarty->assign('rows',$rows);
    $total = count($rows);
    $smarty->assign('total',$total);
    if($tpl_id=='elecciones-municipales-2012')
      #if ($idseccion='elecciones-municipales-2012')
      $max = $total;
    elseif ($total % 2 == 0)
      $max = ($total/2);
    else
      $max = number_format($total/2);
    $smarty->assign('max',$max);
    # Encuesta
    include_once ('./encuesta.inc.php');
    # Blogs
    include_once ('./blogs.inc.php');
    # Tags
    include_once ('./tags.inc.php');
  }
}
$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
