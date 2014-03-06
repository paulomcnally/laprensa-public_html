<?php
header('Status: 404 Not Found');
header('HTTP/1.0 404 Not Found');
if ( !empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
  $ip = $_SERVER["HTTP_CLIENT_IP"];
} else if ( isset($_SERVER["REMOTE_ADDR"]) )    {
  $ip = $_SERVER["REMOTE_ADDR"];
}
error_log("[IP: $ip][error] [".date("D M d H:i:s Y")."] File does not exist: ".$_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
