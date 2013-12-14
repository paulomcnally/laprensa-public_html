<?php
$claves = file_get_contents(ROOTDIR . '/cache/misc/tagcloud.dat');
$smarty->assign('claves', unserialize($claves));
