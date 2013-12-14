<?php
if($_REQUEST['Year']&&$_REQUEST['Month']&&$_REQUEST['Day']) {
  $edicion = ((int)$_REQUEST['Year']) . '/' . (strlen($_REQUEST['Month']) < 2?'0'.$_REQUEST['Month']:$_REQUEST['Month']) . '/' . (strlen($_REQUEST['Day']) < 2?'0'.$_REQUEST['Day']:$_REQUEST['Day']) . '/';
  header("Location: " . $edicion);
} elseif($_REQUEST['Year']&&$_REQUEST['Month']) {
}
?>
