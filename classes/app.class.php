<?php
#require('raven.php');
if ( SCRIPT!==true ) {
  ini_set("session.cookie_domain","www.laprensa.com.ni");
  $var = session_get_cookie_params();
  session_set_cookie_params($var['lifetime'],$var['path'],"www.laprensa.com.ni");
  session_name('LPPHPSESSID');
  session_start();
}
require_once('config.php');
if(DB3N===true)  require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'db3.class.new.php');
elseif(DB3===true)  require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'db3.class.php');
else  require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'db2.class.php');
require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'Smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->template_dir = ROOTDIR . '/templates/';
$smarty->compile_dir = ROOTDIR . '/templates_c/';
$smarty->config_dir = ROOTDIR . '/configs/';
#$smarty->cache_dir = '/var/www/cache/smarty/';
$smarty->cache_dir = ROOTDIR . '/cache/smarty/';
$smarty->caching = 2;

# carga array de secciones validas
$secciones_validas = unserialize(file_get_contents(ROOTDIR . '/cache/misc/secciones.dat'));

# holidays
# 0 => from
# 1 => to
# 2 => edition to show
if(ADMIN===true) {
  $smarty->template_dir .= 'admon/';
  $smarty->compile_dir .= 'admon/';
} elseif(MOVIL===true) {
  $smarty->template_dir .= 'movil/';
  $smarty->compile_dir .= 'movil/';
  $smarty->cache_dir .= '../movil/';
  #$holidays['12-25'] = array(date("Y") . '-12-24',date("Y") . '-12-25',date("Y") . '-12-24');
  #$holidays['01-01'] = array((date("Y")-1) . '-12-31',date("Y") . '-01-01',(date("Y")-1) . '-12-31');
} else {
  $smarty->template_dir .= 'public/';
  $smarty->compile_dir .= 'public/';
  #$holidays['12-25'] = array(date("Y") . '-12-24',date("Y") . '-12-25',date("Y") . '-12-24');
 # $holidays['01-01'] = array((date("Y")-1) . '-12-31',date("Y") . '-01-01',(date("Y")-1) . '-12-31');
  #$holidays['04-07'] = array((date("Y")) . '-04-06',date("Y") . '-04-07',(date("Y")) . '-04-06');
}

require('tables.class.php');
require('extra.class.php');
require('whereAreWe.inc.php');

/* condicionando la aparicion del contenido segun litado de dias*/
$electionsdays= array('2011-11-05','2011-11-06','2011-11-07','2011-11-08','2011-11-09','2011-11-10','2011-11-11','2011-11-12','2011-11-13');

if(in_array($idedicion,$electionsdays)){
        $smarty->assign('showelecciones',true);
}
else{
        $smarty->assign('showelecciones',false);
}
