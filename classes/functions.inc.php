<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../classes/simple_html_dom.php';
//include 'genPasswd.inc.php';

include 'checkmail.inc.php';

function getImgs($str,$outside=false) {
  $pattern = '/<img[^>]+?src=[\'"]+(http:\/\/[^\'"]*)[\'"][^>]*>/i';
  preg_match_all($pattern,$str,$matches);
  if(empty($matches[0])) return false;
  else {
    $imgs = array();
    foreach($matches[1] as $match)
      if ($outside)
        $imgs[] = html_entity_decode($match,null,"UTF-8");
      else
        $imgs[] = html_entity_decode(substr($match,strpos($match,'_')+1),null,"UTF-8");
    return $imgs;
  }
}

function setVideo(&$rows,$i) {
  # Para sacar el Video
  #$img_pos = strpos($rows[$i]['texto'],"<img ");
  $img_pos = strpos($rows[$i]['texto'],"<img ");
  if($img_pos===false) $img_pos = 99999999999;
  #$video_pos = strpos($rows[$i]['texto'],"flowplayer");
  #$video_pos = strpos($rows[$i]['texto'],"flowplayer.swf");
  $video_pos = strpos($rows[$i]['texto'],"flowplayer");
  if ( $video_pos === false )
    $video_pos = strpos($rows[$i]['texto'],"flowplayer.swf");
  $video_pos2 = strpos($rows[$i]['texto'],"youtube.com/v/");
  if($video_pos === false && $video_pos2 !== false) {
    $video_pos = $video_pos2;
    $video_pos2 = false;
    $rows[$i]['video'] = 2;
  } elseif($video_pos !== false && $video_pos2 !== false) {
    if( $video_pos2 < $video_pos) {
      $video_pos = $video_pos2;
      $rows[$i]['video'] = 2;
    } else {
      $rows[$i]['video'] = 1;
    }
  }
  if($video_pos !== false && $video_pos < $img_pos) {
    # Video 1=>flowplayer, 2=>Youtube
    if($rows[$i]['video']==2) {
      # Youtube
      #preg_match('/youtube\.com\/v\/([^&]+)/ie', $rows[$i]['texto'], $matches);
      preg_match('/youtube\.com\/v\/([\w\-]+)/', $rows[$i]['texto'], $matches);
      $rows[$i]['idvideo'] = $matches[1];
      #if(strpos($rows[$i]['idvideo'],'"')!==false) $rows[$i]['idvideo'] = substr($rows[$i]['idvideo'],0,strpos($rows[$i]['idvideo'],'"')+1);
    } else {
      # Flowplayer
      preg_match('/' . preg_quote(CLIPSURL,'/') . '\/(.*)\'/', $rows[$i]['texto'], $matches);
      if (empty($matches[1]) ) {
        #preg_match('/' . preg_quote(CLIPSURL,'/') . '\/(.*)\)/', $rows[$i]['texto'], $matches);
        preg_match('/<a\s+.*?href=[\"\']' . preg_quote(CLIPSURL,'/') . '\/(.*)[\"\']>/', $rows[$i]['texto'], $matches);
      }
      $rows[$i]['idvideo'] = $matches[1];
      if (!empty($matches[1])) {
        $rows[$i]['video'] = 1;
        global $fvideo;
        if ( !isset($fvideo) ) $fvideo = new Table('video');
        $rows[$i]['cdn'] = $fvideo->getVar("SELECT cdn FROM video WHERE archivo = '" . $fvideo->database->escape($rows[$i]['idvideo']) . "'");
      }
      // Verifying if video is inside CDN

      //if ( $_SERVER['REMOTE_ADDR'] == '165.98.184.18' || $_SERVER['REMOTE_ADDR'] == '190.184.22.23' )
      //  print_r($rows[$i]);
    }
  } else {
    unset($rows[$i]['video']);
  }
}

function videoMN(&$rows,$i){
  # Para sacar el Video
  $img_pos = strpos($rows[$i]['texto'],"<img ");
  if($img_pos===false) $img_pos = 99999999999;
   $video_pos = strpos($rows[$i]['texto'],"flowplayer");
  if ( $video_pos === false )
    $video_pos = strpos($rows[$i]['texto'],"flowplayer.swf");
    $video_pos2 = strpos($rows[$i]['texto'],"youtube.com/v/");
  if($video_pos === false && $video_pos2 !== false) {
    $video_pos = $video_pos2;
    $video_pos2 = false;
    $rows[$i]['video'] = 2;
  } elseif($video_pos !== false && $video_pos2 !== false) {
    if( $video_pos2 < $video_pos) {
      $video_pos = $video_pos2;
      $rows[$i]['video'] = 2;
    } else {
      $rows[$i]['video'] = 1;
    }
  }

  if($video_pos !== false && $video_pos < $img_pos) {
    # Video 1=>flowplayer, 2=>Youtube
    if($rows[$i]['video']==2) {
      # Youtube
      preg_match('/youtube\.com\/v\/([\w\-]+)/', $rows[$i]['texto'], $matches);
      $rows[$i]['idvideo'] = $matches[1];
   } else {
      # Flowplayer
      preg_match('/' . preg_quote(CLIPSMN,'/') . '\/(.*)\'/', $rows[$i]['texto'], $matches);
      if (empty($matches[1]) ) {
        preg_match('/<a\s+.*?href=[\"\']' . preg_quote(CLIPSMN,'/') . '\/(.*)[\"\']>/', $rows[$i]['texto'], $matches);
      }
      if (!empty($matches[1]))
        $rows[$i]['video'] = 1;
      $rows[$i]['idvideo'] = $matches[1];
      $rows[$i]['preview'] = $matches[1];
    }
  } else {
    unset($rows[$i]['video']);
 }
}

function setGallery(&$rows,$i) {
  $pattern = '/<div class=".*?gallery-(\d{1,})?">&nbsp;<\/div>/';
  preg_match_all($pattern,$rows[$i]['texto'],$matches);
  if(!empty($matches[1])) {
    $coleccion = new coleccionTable();
    $coleccion->limit = 1;
    $_REQUEST['idgaleria'] = $matches[1][0];
    $coleccion->readEnv();
    if(!empty($coleccion->request['idgaleria']))
      list($rows[$i]['fotogaleria']) = $coleccion->readDataFilter("coleccion.idgaleria = " . $coleccion->request['idgaleria']);
  }
}

function counter($id) {
  $sql = "SELECT hitreading($id);\n";
  if(file_exists(SQL_TRANS) && is_writable(SQL_TRANS)) {
    $handle = fopen(SQL_TRANS, 'a');
    fwrite($handle, $sql);
    fclose($handle);
  } else {
    error_log('File: ' . SQL_TRANS . ' does not exist or is not writable');
  }
}

function meterAggressiveness($str,&$founds=array()) {
  include_once dirname(__FILE__) . '/../classes/badword.class.php';
  $agresion = 0;
  # bad Words Array $words
  foreach ($words as $badWord => $peso) {
    if(empty($badWord)) continue;
    else {
      $regexp = "/\b".$badWord."\b/iu";
      $times = preg_match_all($regexp,$str,$matches);
      if($times > 0) {
        $agresion += $peso;
        if($times > 1) $agresion += $times;
        $founds[] = $badWord;
      }
    }
  }
  error_log('Agresividad ' . $agresion);
  return $agresion;
}

function &createNewsDesc($idnoticia) {
  global $news;
  $noticia = new Table('noticia');
  list($row) = $noticia->readDataSQL("SELECT idnoticia,noticia,uri,edicion,texto FROM noticia LEFT JOIN edicion USING (idedicion) LEFT JOIN seccion USING (idseccion) WHERE idnoticia = " . $idnoticia);
  if ( !empty($row) )
    $desc = array('idnoticia'=>$row['idnoticia'],'noticia'=>$row['noticia'],'texto'=>substr(preg_replace("/\s+/"," ",str_replace("&nbsp;"," ",preg_replace("/[\r\t\n]/"," ",strip_tags($row['texto'])))),0,800) . "...",'edicion'=>$row['edicion'],'uri'=>$row['uri'],'fecha'=>mktime());
  else $desc = false;
  if ( $desc !== false ) {
    # Saving the array
    $news[$row['idnoticia']] = $desc;
    $strArr = array2string($news,'news');
    $filename = dirname(__FILE__) . '/sendnews.class.php';
    writeFile($filename,$strArr);
    # End
  }
  return $desc;
}

function limitar_palabras($cadena,$longitud){
  $palabras = explode(' ', $cadena);
  if (count($palabras) > $longitud)
     return implode(' ', array_slice($palabras, 0, $longitud));
  else
     return $cadena;
}

function isAllowedExtension($fileName, $allowedExtensions) {
  return in_array(end(explode(".", $fileName)), $allowedExtensions);
}

function setCDNVideo(&$txt) {
  $video = new Table('video');
  if(preg_match_all('/' . preg_quote(CLIPSURL,'/') . '\/(.*)\)(.*)?href=\"' . preg_quote(CLIPSURL,'/') . '\/(.*)\"\>/', $txt, $matches)) {
    $videos = array();
    foreach( $matches[3] as $match ) {
      if ( !array_key_exists($match,$videos) || empty($videos[$match]) ) {
        $videos[$match] = $video->getVar("SELECT cdn FROM video WHERE archivo = '" . $match . "'");
        if ( $videos[$match] == 't' ) {
          $txt = str_replace(CLIPSURL . '/' . substr($match,0,-3),CDN_URL . '/video/' . substr($match,0,-3), $txt);
        }
      }
    }
  }
}

function smarty_block_dynamic($param, $content, &$smarty) {
  return $content;
}
$smarty->register_block('dynamic', 'smarty_block_dynamic', false);


function replaceVideo($html){
    //Reemplaza el video flash por la versión html5
    $dom = new simple_html_dom();
    $dom->load($html);
    foreach($dom->find('div.na-video-normal') as $videoContainer){
        $video = $videoContainer->find('a.flowplayer',0);
        $poster = $video->style;
        $pattern = '/url\(([^\)]+)/i';
        preg_match_all($pattern,$poster,$out);

        $poster_url = $out[1][0];
        $url = $video->href;

        $videoContainer->outertext = "
        <video poster='{$poster_url}' controls >
            <source src='{$url}' type='video/mp4' />
        </video>
        ";
    }
    return $dom->save();
}

function replaceFPVersion($html){
    //Reemplaza el video flash por la versión html5
    $dom = new simple_html_dom();
    $dom->load($html);
    foreach($dom->find('div.na-video-normal') as $videoContainer){
        $video = $videoContainer->find('a.flowplayer',0);
        $poster = $video->style;
        $pattern = '/url\(([^\)]+)/i';
        preg_match_all($pattern,$poster,$out);

        $poster_url = $out[1][0];
        $url = $video->href;

        $videoContainer->outertext = "
        <div class='flowplayer' data-key='#$9c615dc0e5d76458701' data-logo='http://www.laprensa.com.ni/tv/wp-content/themes/laprensatv/images/laprensatv.png'> 
        <video width='100%' height='auto' poster='{$poster_url}' controls >
            <source src='{$url}' type='video/mp4' />
            <source src='{$url}' type='video/flash' />
        </video>
        </div> 
        ";
    }
    return $dom->save();
}

function is_mobile() {

    // Get the user agent

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Create an array of known mobile user agents
    // This list is from the 21 October 2010 WURFL File.
    // Most mobile devices send a pretty standard string that can be covered by
    // one of these.  I believe I have found all the agents (as of the date above)
    // that do not and have included them below.  If you use this function, you
    // should periodically check your list against the WURFL file, available at:
    // http://wurfl.sourceforge.net/


    $mobile_agents = Array(


        "240x320",
        "acer",
        "acoon",
        "acs-",
        "abacho",
        "ahong",
        "airness",
        "alcatel",
        "amoi",
        "android",
        "anywhereyougo.com",
        "applewebkit/525",
        "applewebkit/532",
        "asus",
        "audio",
        "au-mic",
        "avantogo",
        "becker",
        "benq",
        "bilbo",
        "bird",
        "blackberry",
        "blazer",
        "bleu",
        "cdm-",
        "compal",
        "coolpad",
        "danger",
        "dbtel",
        "dopod",
        "elaine",
        "eric",
        "etouch",
        "fly " ,
        "fly_",
        "fly-",
        "go.web",
        "goodaccess",
        "gradiente",
        "grundig",
        "haier",
        "hedy",
        "hitachi",
        "htc",
        "huawei",
        "hutchison",
        "inno",
        "ipad",
        "ipaq",
        "ipod",
        "jbrowser",
        "kddi",
        "kgt",
        "kwc",
        "lenovo",
        "lg ",
        "lg2",
        "lg3",
        "lg4",
        "lg5",
        "lg7",
        "lg8",
        "lg9",
        "lg-",
        "lge-",
        "lge9",
        "longcos",
        "maemo",
        "mercator",
        "meridian",
        "micromax",
        "midp",
        "mini",
        "mitsu",
        "mmm",
        "mmp",
        "mobi",
        "mot-",
        "moto",
        "nec-",
        "netfront",
        "newgen",
        "nexian",
        "nf-browser",
        "nintendo",
        "nitro",
        "nokia",
        "nook",
        "novarra",
        "obigo",
        "palm",
        "panasonic",
        "pantech",
        "philips",
        "phone",
        "pg-",
        "playstation",
        "pocket",
        "pt-",
        "qc-",
        "qtek",
        "rover",
        "sagem",
        "sama",
        "samu",
        "sanyo",
        "samsung",
        "sch-",
        "scooter",
        "sec-",
        "sendo",
        "sgh-",
        "sharp",
        "siemens",
        "sie-",
        "softbank",
        "sony",
        "spice",
        "sprint",
        "spv",
        "symbian",
        "tablet",
        "talkabout",
        "tcl-",
        "teleca",
        "telit",
        "tianyu",
        "tim-",
        "toshiba",
        "tsm",
        "up.browser",
        "utec",
        "utstar",
        "verykool",
        "virgin",
        "vk-",
        "voda",
        "voxtel",
        "vx",
        "wap",
        "wellco",
        "wig browser",
        "wii",
        "windows ce",
        "wireless",
        "xda",
        "xde",
        "zte"
    );

    // Pre-set $is_mobile to false.

    $is_mobile = false;

    // Cycle through the list in $mobile_agents to see if any of them
    // appear in $user_agent.

    foreach ($mobile_agents as $device) {

        // Check each element in $mobile_agents to see if it appears in
        // $user_agent.  If it does, set $is_mobile to true.

        if (stristr($user_agent, $device)) {
            error_log($device);

            $is_mobile = true;

            // break out of the foreach, we don't need to test
            // any more once we get a true value.

            break;
        }
    }

    return $is_mobile;
}

function get_smartphone_type(){
  $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
  $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
  if(stripos($ua,'android') !== false) {
     return 'android';
  } elseif ($isiPad == true){
     return 'ipad';
  } elseif(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')){
     return 'iphone';
  } elseif(strstr($_SERVER['HTTP_USER_AGENT'],'BlackBerry')){
     return 'blackberry';
  } else {
     return 'other';
  }
}
?>
