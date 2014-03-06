<?php
function checkEmail($email) {
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" , $email)) {
    list($username,$domain)=preg_split('/@/',$email);
    $checked = checkdnsrr($domain,'MX');
    return $checked;
  }
  return false;
}
?>
