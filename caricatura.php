<html>
                                <div id="derbloque4">
                                  <div class="ancho370 columnabloque4 slider" id="slider2">
                                    <div class="ancho370 titularb">
                                     <span class="titulo">Caricatura del día</span>
                                     <div class="mas"><a href="/widget/caricatura.php?id={$caricaturas[0].idcaricatura}" id="catfullscreen" class="cartelera"><img src="http://du89eogdt5czf.cloudfront.net/imgs/resize_blanco.png" alt="resize" align="left" class="imagencartelera" /> Ampliar</a></div>
                                     <div class="separacion5right">{*<a href="/widget/caricatura.php?id={$caricaturas[0].idcaricatura}" class="caricatura" id="catfullscreen"><img src="http://du89eogdt5czf.cloudfront.net/imgs/resize_blanco.png" alt="" class="cartoon"></a>*}
                                     <script type="text/javascript">
                                     // <![CDATA[
                                     {literal}
                                     function onMouseOutFunction() {
                                        cats=$('a.differ');for(c=0;c<cats.length;c++)if($(cats[c]).parent().attr('style')=='' || $(cats[c]).parent().css('display')!='none')$('#catfullscreen').attr('href',$(cats[c]).attr('href'));
                                     }
                                     {/literal}
                                     // ]]>
                                     </script>
                                     <span class="separacion5left"><a onmouseout="onMouseOutFunction();" class="prev" name="slider2"><img src="http://du89eogdt5czf.cloudfront.net/imgs/flechitaizq2.png" width="11" height="12" alt="" /></a><span class="num_slides2"><span class="cur_slide2">1</span>/{$caricaturas|@count}</span><a onmouseout="onMouseOutFunction();" class="next" name="slider2"><img src="http://du89eogdt5czf.cloudfront.net/imgs/flechitader2.png" width="11" height="12" alt="" /></a></span>
                                     {*<span class="separacion5left"><a onmouseout="{literal}cats=$('a.differ');for(c=0;c<cats.length;c++)if($(cats[c]).parent().attr('style')=='' || $(cats[c]).parent().css('display')!='none')$('#catfullscreen').attr('href',$(cats[c]).attr('href'));{/literal}" class="prev" name="slider2"><img src="http://du89eogdt5czf.cloudfront.net/imgs/flechitaizq2.png" width="11" height="12" alt="" /></a><span class="num_slides2"><span class="cur_slide2">1</span>/{$caricaturas|@count}</span><a onmouseout="{literal}cats=$('a.differ');for(c=0;c<cats.length;c++)if($(cats[c]).parent().attr('style')=='' || $(cats[c]).parent().css('display')!='none')$('#catfullscreen').attr('href',$(cats[c]).attr('href'));{/literal}" class="next" name="slider2"><img src="http://du89eogdt5czf.cloudfront.net/imgs/flechitader2.png" width="11" height="12" alt="" /></a></span>*}
                                      </div>

                                    </div><!--titular-->
                                    <div class="limpiar"></div>
                                    <div class="cartoon">
                                      {*<div class="flechanaranja"><a href="/widget/caricatura.php?id={$caricaturas[cp].idcaricatura}" class="enlacemas"><img src="http://du89eogdt5czf.cloudfront.net/imgs/resize_blanco.png" alt="resize" align="left" /></a><span class="espacio"><a href="/widget/caricatura.php?id={$caricaturas[cp].idcaricatura}" class="enlacemas">Ver caricatura del dia</a></span>*}
                                      <div class="imagen">
                                        {section name=cp loop=1}
                                          <div id="caricatura_{$caricaturas[cp].idcaricatura}"{if !$smarty.section.cp.first} style="display:none"{/if} class="slide">
                                            <a href="/widget/caricatura.php?id={$caricaturas[cp].idcaricatura}" class="caricatura differ">
                                        <img src="{$smarty.const.PIXURL}/{$caricaturas[cp].caricatura|time_pic:"%Y/%m"}/404_{$caricaturas[cp].caricatura}" alt="{$caricaturas[cp].caricatura}" width="404" />
                                            </a>
                                            {*<div class="comments">Comentarios: {$caricaturas[cp].comentarios}</div>*}
                                          </div>
                                        {/section}
                                      </div>
                                    <div class="limpiar"></div>
                                    </div>
                                  </div><!--columnabloque4-->
                                </div><!--derbloque4-->

</html>
