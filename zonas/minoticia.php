<?php
$banner_160x600_lateral_1 = "<!-- LP_MiNoticia_160x600_lateral_1 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_MiNoticia_160x600_lateral_1');
</script>";

$banner_160x600_lateral_2 = "<!-- LP_MiNoticia_160x600_lateral_2 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_MiNoticia_160x600_lateral_2');
</script>";

$boton_260x90 = "<!-- LP_MiNoticia_Boton_260x90 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_MiNoticia_Boton_260x90');
</script>";

$banner_superior_minoticia_728_90 = "<!-- MI_NOTICIA_PORTADA_Portada_728x90_Superior -->
                           <script type='text/javascript'>
                             GA_googleFillSlot('LA_PRENSA_Mi_Noticia_728x90_Superior');
                           </script>";

$banner_inferior_728_90 = "<!-- LA_PRENSA_Mi_Noticia_728x90_Inferior -->
                          <script type='text/javascript'>
                            GA_googleFillSlot('LA_PRENSA_Mi_Noticia_728x90_Inferior');
                          </script>";

$Mi_Noticia_160_600 = "<!-- LA_PRENSA_Mi_Noticia_160x600 -->
                         <script type='text/javascript'>
                         GA_googleFillSlot('LA_PRENSA_Mi_Noticia_160x600');
                         </script>";

$sidebar_300_250 = "<!-- LA_PRENSA_Mi_Noticia_300x250_Sidebar -->
                    <script type='text/javascript'>
                      GA_googleFillSlot('LA_PRENSA_Mi_Noticia_300x250_Sidebar');
                    </script>";

$nota_inferior_336_280 = "<!-- LA_PRENSA_Mi_Noticia_336x280_Nota_Inferior -->
                         <script type='text/javascript'>
                           GA_googleFillSlot('LA_PRENSA_Mi_Noticia_336x280_Nota_Inferior');
                         </script>";

$smarty->assign('adserver_header_minoticia',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
                    <script type='text/javascript'>
                      GS_googleAddAdSenseService('ca-pub-1199834677431615');
                      GS_googleEnableAllServices();
                    </script>
                    <script type='text/javascript'>
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LP_MiNoticia_Boton_260x90');
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LP_MiNoticia_160x600_lateral_1'); 
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LP_MiNoticia_160x600_lateral_2'); 
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Mi_Noticia_160x600');
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Mi_Noticia_300x250_Sidebar');
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Mi_Noticia_336x280_Nota_Inferior');
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Mi_Noticia_728x90_Inferior');
                      GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Mi_Noticia_728x90_Superior');
                    </script>
                    <script type='text/javascript'>
                      GA_googleFetchAds();
                    </script>");
$smarty->assign("boton_260x90", $boton_260x90);

$smarty->assign("banner_superior_minoticia_728_90", $banner_superior_minoticia_728_90);
$smarty->assign("banner_inferior_728_90", $banner_inferior_728_90);
$smarty->assign('banner_160x600_lateral_1',$banner_160x600_lateral_1);
$smarty->assign('banner_160x600_lateral_2',$banner_160x600_lateral_2);
$smarty->assign("Mi_Noticia_160_600", $Mi_Noticia_160_600);
$smarty->assign("sidebar_300_250", $sidebar_300_250);
$smarty->assign("nota_inferior_336_280", $nota_inferior_336_280);
?>
