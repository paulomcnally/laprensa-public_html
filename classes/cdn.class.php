<?php
class cdnTable extends Table {
  function cdnTable() {
    $this->Table('cdn');
    $this->title = 'Archivos CDN';
    $this->key = 'idcdn';
    $this->maxrows = 30;
    $this->addColumn('idcdn','serial',0,1,0,'Id');
    $this->addColumn('cdn','varchar',300,0,0,'Archivo');
  }
}
