<?php
$banner_superior_728_90 = "<!-- LA_PRENSA_Play_728x90_Superior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_728x90_Superior');
</script>";
$banner_inferior_728_90 = "<!-- LA_PRENSA_Play_728x90_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_728x90_Inferior');
</script>";
$banner_nota_336_280 = "<!-- LA_PRENSA_Play_336x280_Nota_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_336x280_Nota_Inferior');
</script>";
$banner_medio_300_250 = "<!-- LA_PRENSA_Play_300x250_Medio -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_300x250_Medio');
</script>";
$banner_derecho_300_250 = "<!-- LA_PRENSA_Play_300x250_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_300x250_Sidebar');
</script>";
$banner_derecho_160_600 = "<!-- LA_PRENSA_Play_160x600_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_160x600_Sidebar');
</script>";
$banner_160x600_lateral_1 = "<!-- LP_Play_160x600_lateral_1 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_Play_160x600_lateral_1');
</script>";
$banner_160x600_lateral_2 = "<!-- LP_Play_160x600_lateral_2 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_Play_160x600_lateral_2');
</script>";
$boton_260x90 = "<!-- LA_PRENSA_Play_260x90_boton -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_260x90_boton');
</script>";
$boton_inferior_260_90 = "<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_260x90_boton_inferior');
</script>";

$banner_300x250_mundial = <<<EOT
<!-- Portada_Mundial_300x250_inferior -->
<div id='div-gpt-ad-1402563808229-0' style='width:300px; height:250px; float:left; margin-left:40px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1402563808229-0'); });
</script>
</div>
<!-- Portada_Mundial_300x250_sidebar -->
<div id='div-gpt-ad-1402564044426-0' style='width:300px; height:250px; float:left; margin-left:60px'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1402564044426-0'); });
</script>
</div>
EOT;

$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_160x600_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_260x90_boton');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_300x250_Medio');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_300x250_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_336x280_Nota_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_728x90_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_728x90_Superior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LP_Play_160x600_lateral_1');
GA_googleAddSlot('ca-pub-1199834677431615', 'LP_Play_160x600_lateral_2');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_260x90_boton_inferior');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>
<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/11648707/Portada_Mundial_300x250_inferior', [300, 250], 'div-gpt-ad-1402563808229-0').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_300x250_sidebar', [300, 250], 'div-gpt-ad-1402564044426-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
");
$smarty->assign('banner_superior_728_90', $banner_superior_728_90);
$smarty->assign('banner_inferior_728_90', $banner_inferior_728_90);
$smarty->assign('banner_medio_300_250', $banner_medio_300_250);
$smarty->assign('banner_nota_336_280', $banner_nota_336_280);
$smarty->assign('banner_derecho_300_250', $banner_derecho_300_250);
$smarty->assign('banner_derecho_160_600', $banner_derecho_160_600);
$smarty->assign('boton_260x90', $boton_260x90);
$smarty->assign('banner_160x600_lateral_1',$banner_160x600_lateral_1);
$smarty->assign('banner_160x600_lateral_2',$banner_160x600_lateral_2);
$smarty->assign('banner_derecho_300_250', $banner_derecho_300_250);
$smarty->assign('boton_inferior_260_90', $boton_inferior_260_90);

$smarty->assign('banner_300x250_mundial', $banner_300x250_mundial);
?>
