<?php
# Obtiene resultados por departamento
#$mapavotos = $noticia->readDataSql("SELECT iddepto,string_agg(candidato||' '||votos,'<br/>') AS votos FROM candidato GROUP BY iddepto");
$mapavotos = $noticia->readDataSql("SELECT iddepto,string_agg(votos,'<br/>') AS votos FROM (SELECT iddepto,('<img width=\"25\" src=\"/files/ppolitico/'|| ppolitico.imagen ||'\"/>'||' '||candidato.votos::int) AS votos FROM candidato LEFT OUTER JOIN ppolitico USING(idppolitico) ORDER BY candidato.iddepto, ppolitico.orden) votosdepto group by iddepto");
//$mapavotos = $noticia->readDataSql("SELECT iddepto,string_agg('<img width=\"25\" src=\"/files/ppolitico/'|| ppolitico.imagen ||'\"/>'||' '||candidato.votos,'<br/>') AS votos FROM candidato JOIN ppolitico USING(idppolitico) GROUP BY iddepto ORDER BY candidato.iddepto, ppolitico.casilla ASC;");
foreach($mapavotos as $mapavoto) {
  $mapavoto['votos'] = preg_replace('/"/','&quot;',$mapavoto['votos']);
  $mapavotos_array[$mapavoto['iddepto']] = $mapavoto['votos'];
}
$smarty->assign('mapavotos', $mapavotos_array);
