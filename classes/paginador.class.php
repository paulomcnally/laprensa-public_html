<?php
class paginador {
var $TAMANO_PAGINA;
var $PAGINA;
var $INICIO;
var $ODATA;
var $TOTAL;

function paginador($odata,$total,$pagina) {
  if(!$pagina){
  	$this->INICIO=0;
  	$pagina=1;
  }
  else
  {
    $this->INICIO = ($pagina - 1) * $total;
  }
  $this->TAMANO_PAGINA=$total;
  $this->PAGINA=$pagina;
  $this->ODATA=$odata;
 }
 
 function setAttribute($variable,$valor){
  $this->$variable=$valor;
 }
 
 function getPageResult($query){
  $rowstot=$this->ODATA->readDataSql($query);
  $rows=$this->ODATA->readDataSql($query." LIMIT ".$this->TAMANO_PAGINA." OFFSET ".$this->INICIO);
  $num_total_registros = count($rowstot);
  $total_paginas = ceil($num_total_registros / $this->TAMANO_PAGINA);
  $this->TOTAL=$total_paginas;
  return $rows;
 }

}
