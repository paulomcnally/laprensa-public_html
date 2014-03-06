<?php
/*
 * author: christian torres <christian@guegue.net>
 * date  : 08-Jun-2009
 * file  : whereAreWe.inc.php
 * desc  : Set some vars depends we are (in admin or public -web site- side)
 */
include_once ('latestedition.php');
if(ADMIN===true) {
  $smarty->caching = false;
  if (!empty($_POST["PHPSESSID"])) {
    # Para PHP 5.3
    #if ( SCRIPT!==true && empty($_SESSION) ) {
    #  session_destroy();
    #  error_log( 'entro' );
    #}
    $cur_sid  = session_id();
    if ( $cur_sid != $_POST["PHPSESSID"] )
      session_id($_POST["PHPSESSID"]);
  } 
  if ( SCRIPT!==true && $cur_sid != $_POST["PHPSESSID"] )
    session_start();
  #setcookie(session_name(),$_COOKIE[session_name()],time()+$time);
  include_once ('functions-na.inc.php');
  # Quitar despues
  # include_once ('admin-old.inc.php');
  include_once(ROOTDIR . '/classes/cdn.class.php');
} elseif(MOVIL===true) {
  include_once ('functions.inc.php');
  # Si se pasa la fecha completa
  include_once ('thisedition.php');
  $smarty->caching = 0;
  $smarty->use_sub_dirs = true;
} elseif(SCRIPT!==true) {
  include_once ('functions.inc.php');
  # Esto lo pasa el calendario del archivo, si se ingresan tanto el anho, el mes, el dia...
  if(!(empty($_GET['Year'])||empty($_GET['Month'])||empty($_GET['Day']))) {
    # Escaping
    $_GET['Year'] = (int)$_GET['Year'];
    $_GET['Month'] = (int)$_GET['Month'];
    $_GET['Day'] = (int)$_GET['Day'];
    if(strlen($_GET['Month']) < 2)  $_GET['Month'] = '0' . $_GET['Month'];
    if(strlen($_GET['Day']) < 2)  $_GET['Day'] = '0' . $_GET['Day'];
    header("Location: /" . $_GET['Year'] . "/" . $_GET['Month'] . "/" . $_GET['Day'] . "/");
    die();
  # Si se pasa la edicion por la URL
  } elseif(!(empty($_GET['year'])||empty($_GET['month'])||empty($_GET['day']))) {
    # Escaping
    $_GET['year'] = (int)$_GET['year'];
    $_GET['month'] = ((int)$_GET['month'])>9?(int)$_GET['month']:'0'.((int)$_GET['month']);
    $_GET['day'] = ((int)$_GET['day'])>9?(int)$_GET['day']:'0'.(int)$_GET['day'];
    $idedicion = $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['day'];
    if(!checkdate($_GET['month'],$_GET['day'],$_GET['year'])) {
      #include_once ('thisedition.php');
      #include('../classes/404.inc.php');
      #include('./404.php');
      header('Location: /404.html');
      exit();
    }
    @include 'ediciones.class.php';
  # De lo contrario es hoy
  } else {
    include_once ('thisedition.php');
    # Para el Calendario del Archivo
    #$params = trim($_SERVER['REQUEST_URI'],"\ \t\n\r\0\x0B\/");
    #if(empty($params)) {
    #  list($year,$mon,$day) = split('-',$idedicion);
    #  header("Location: /$year/$mon/$day/");
    #  die();
    #}
  }
  $cache_prefix = strftime("%Y|%m|%d",strtotime($idedicion));
  $smarty->caching = 2;
  $smarty->use_sub_dirs = true;
}
