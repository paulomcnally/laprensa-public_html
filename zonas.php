<?php
#define('ADMIN',true);
require('../classes/app.class.php');
  $banner_superior = "<script type='text/javascript'><!--// <![CDATA[
    /* [id5] Banner Superior 728 - 90*/
    OA_show(472);
// ]]> --></script><noscript><a target='_blank' href='http://www.servidordeanuncios.com/www/delivery/ck.php?n=a3f02152'><img border='0' alt='' src='http://www.servidordeanuncios.com/www/delivery/avw.php?zoneid=472&amp;n=a3f02152' /></a></noscript>";
  $banner_derecho_160_600 = "<script type='text/javascript'><!--// <![CDATA[
    /* [id520] Banner Superior 160 - 600*/
    OA_show(520);
// ]]> --></script><noscript><a target='_blank' href='http://www.servidordeanuncios.com/www/delivery/ck.php?n=a96c515e'><img border='0' alt='' src='http://www.servidordeanuncios.com/www/delivery/avw.php?zoneid=520&amp;n=a96c515e' /></a></noscript>";
  $banner_centro_250_208 = "<script type='text/javascript'><!--// <![CDATA[
    /* [id497] Banner Superior 250 - 208*/
    OA_show(497);
// ]]> --></script><noscript><a target='_blank' href='http://www.servidordeanuncios.com/www/delivery/ck.php?n=fg25885e0'><img border='0' alt='' src='http://www.servidordeanuncios.com/www/delivery/avw.php?zoneid=497&amp;n=mg258950' /></a></noscript>";
  $banner_centro_300_250 = "<script type='text/javascript'><!--// <![CDATA[
    /* [id508] Banner Superior 300 - 250*/
    OA_show(497);
// ]]> --></script><noscript><a target='_blank' href='http://www.servidordeanuncios.com/www/delivery/ck.php?n=fg2h885e0'><img border='0' alt='' src='http://www.servidordeanuncios.com/www/delivery/avw.php?zoneid=508&amp;n=fg2h885e0' /></a></noscript>";
  $smarty->assign('adserver_header',"<script type='text/javascript' src='http://www.servidordeanuncios.com/www/delivery/spcjs.php?id=71'></script>");
  $smarty->assign('banner_superior', $banner_superior);
  $smarty->assign('banner_derecho_160_600', $banner_derecho_160_600);
  $smarty->assign('banner_centro_250_208', $banner_centro_250_208);
  $smarty->assign('banner_centro_300_250', $banner_centro_300_250);
  $smarty->display('zonas.tpl');
?>
