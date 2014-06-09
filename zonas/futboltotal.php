<?php 
$futboltotal_slots_definition= <<<EOT
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
googletag.defineSlot('/11648707/Portada_Mundial_160x600_left', [160, 600], 'div-gpt-ad-1401745156322-0').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_160x600_right', [160, 600], 'div-gpt-ad-1401745156322-1').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_260x90', [260, 90], 'div-gpt-ad-1401745156322-2').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_300x250_inferior', [300, 250], 'div-gpt-ad-1401745156322-3').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_300x250_sidebar', [300, 250], 'div-gpt-ad-1401745156322-4').addService(googletag.pubads());
googletag.defineSlot('/11648707/Portada_Mundial_728x90', [728, 90], 'div-gpt-ad-1401745156322-5').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
EOT;

$smarty->assign('adserver_header',$futboltotal_slots_definition);

$futboltotal_ad_160x600_left= <<<EOT
<!-- Portada_Mundial_160x600_left -->
<div id='div-gpt-ad-1401745156322-0' style='width:160px; height:600px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-0'); });
</script>
</div>
EOT;

$futboltotal_ad_160x600_right= <<<EOT
<!-- Portada_Mundial_160x600_right -->
<div id='div-gpt-ad-1401745156322-1' style='width:160px; height:600px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-1'); });
</script>
</div>
EOT;
 
$futboltotal_ad_260x90= <<<EOT
<!-- Portada_Mundial_260x90 -->
<div id='div-gpt-ad-1401745156322-2' style='width:260px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-2'); });
</script>
</div>
EOT;
 
$futboltotal_ad_300x250= <<<EOT
<!-- Portada_Mundial_300x250_inferior -->
<div id='div-gpt-ad-1401745156322-3' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-3'); });
</script>
</div>
EOT;
 
$futboltotal_ad_300x250= <<<EOT
<!-- Portada_Mundial_300x250_sidebar -->
<div id='div-gpt-ad-1401745156322-4' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-4'); });
</script>
</div>
EOT;
 
$futboltotal_ad_728x90= <<<EOT
<!-- Portada_Mundial_728x90 -->
<div id='div-gpt-ad-1401745156322-5' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1401745156322-5'); });
</script>
</div>
EOT;

$smarty->assign('banner_superior_728_90', $futboltotal_ad_728x90);
$smarty->assign('banner_inferior_728_90', $futboltotal_ad_728x90);
$smarty->assign('banner_medio_300_250', $futboltotal_ad_300x250);
$smarty->assign('banner_nota_336_280', $futboltotal_ad_300x250);
$smarty->assign('banner_derecho_300_250', $futboltotal_ad_300x250);
$smarty->assign('banner_derecho_160_600', $futboltotal_ad_160x600_right);
$smarty->assign('boton_260x90', $futboltotal_ad_260x90);
$smarty->assign('banner_160x600_lateral_1',$futboltotal_ad_160x600_left);
$smarty->assign('banner_160x600_lateral_2',$futboltotal_ad_160x600_left);
$smarty->assign('banner_derecho_300_250', $futboltotal_ad_300x250);
$smarty->assign('boton_inferior_260_90', $futboltotal_ad_260x90);
?>
