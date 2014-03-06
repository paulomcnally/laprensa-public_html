<?php
function selfURL() {
  return selfWww() . $_SERVER['REQUEST_URI'];
}
function selfWww() {
  $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
  $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
  $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
  return $protocol."://".$_SERVER['SERVER_NAME'].$port;
}
function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

//include 'genPasswd.inc.php';

if (!function_exists('json_encode')) {
  function json_encode($a=false) {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

function smarty_block_dynamic($param, $content, &$smarty) {
  return $content;
}

function news_debugger($texto){
error_log("Llamada a la funcion con el contenido " . $texto);
// Buscamos la imagen alineada a la izquierda y tomamos su posicion
$pos_left =  strpos($texto, '<div class="na-media na-image-left');

// Buscamos la imagen centrada (nota con foto amplia)
$pos_normal = strpos($texto, '<div class="na-media na-image-normal');

// Buscamos la posicion del primer salto de linea en el editor
$pos_separation = strpos($texto, '<p>&nbsp;</p>');

// Limpio los saltos de linea (<br>)
$texto = str_replace('<br />','', $texto);

// Empiezo a comparar si encuentra una nota con foto amplia
// el 0 y el 5 indican la posiciones que se tomara en cuenta
// para validar las condiciones internas al if

if ( $pos_normal === 0 || $pos_normal === 5){
    // En caso de ser una nota con foto ampliada se agrega el codigo
    //     <p>&nbsp;</p>
    // Esto permite visualizar la nota en el movil
    if ( $pos_separation !== 0 ){
        $texto = str_replace('<div class="na-media na-image-normal', '<p>&nbsp;</p><div class="na-media na-image-normal', $texto);
        $texto = preg_replace('/<(strong)>\s*(<img[^>]*>)\s*<\/\\1>/', '\\2', $texto);
    }
         
    // Elimina la tag <p> que aparece individual al inicio de la nota 
    /* $para = strpos($texto, '<p><p>&nbsp;</p>');
    if ($para === true){
        $texto = substr($texto, 4, strlen($texto) - 4);
    }*/

// En caso se encuentre una foto alineada a la izquierda se procede
// a evaluar las condiciones internas
} elseif ( $pos_left == true) {

    // Si existe un salto de linea (<p>&nbsp;</p>) en la primera linea lo eliminamos
    // para esto extraemos desde la posicion donde ya no estará este codigo
    if ( $pos_separation === 0){
        $texto = substr($texto, 13, (strlen($texto) - 13) );
        $texto = preg_replace('/<(strong)>\s*(<img[^>]*>)\s*<\/\\1>/', '\\2', $texto);  
    }

}

$texto2 = substr($texto, 400, strlen($texto) - 400);
$texto = preg_replace('@<strong>|</strong>@i', '', substr($texto,0,400)) . $texto2;
// Validamos los <strong></strong> No validos dentro de los primero 400 caracteres

// Elimino los <strong></strong> que se encontrasen entre los atributos <img>
// dentro de toda la nota
// $texto = preg_replace('/<(strong)>\s*(<img[^>]*>)\s*<\/\\1>/', '\\2', $texto);

return $texto;    
}

$smarty->register_block('dynamic', 'smarty_block_dynamic', false);
?>
