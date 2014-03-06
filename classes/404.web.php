<?php
header('Status: 404 Not Found');
header('HTTP/1.0 404 Not Found');
error_log("[error] [".date("D M d H:i:s Y")."] File does not exist: ".$_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
$smarty->display('404.tpl');
die();
