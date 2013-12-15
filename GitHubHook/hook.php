<?php
require_once('class.GitHubHook.php');

// Initiate the GitHub Deployment Hook
$hook = new GitHubHook;

// Enable the debug log, kindly make `log/hook.log` writable
$hook->enableDebug();

// Adding `stage` branch to deploy for `staging` to path `/var/www/testhook/stage`
//$hook->addBranch('fleet', 'staging', '/var/www/html/laprensa/public_html');

// Adding `prod` branch to deploy for `production` to path `/var/www/testhook/prod` limiting to only `user@gmail.com`
$hook->addBranch('fleet', 'production', '/var/www/html/laprensa/public_html', array('support@doap.com'));

// Deploy the commits
$hook->deploy();
