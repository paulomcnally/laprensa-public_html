<?php
// Register the autoloader
#require( dirname(__FILE__) . '/../Raven/Autoloader.php');
require(dirname(__FILE__) . '/../raven-php/lib/Raven/Autoloader.php');
Raven_Autoloader::register();

// Instantiate a new client with a compatible DSN
#$client = new Raven_Client('http://d02934acf8dc47b3ad753d9f798656dd:b7795f76946d4df29cc05ac8663d2e5c@sentryguegue.ep.io/9');
#$client = new Raven_Client('http://5c183c4b762343c39f73ce3f8f599aa5:4c01e05a389b458aafb57fcb0d9f9a6f@monit.guegue.com/5');
#$client = new Raven_Client('http://fde8f8d457fc420394ef4beefe28acf7:b551aaf6ab2b4943bc26d4853bc70d99@monit.guegue.com/sentry/5');
$client = new Raven_Client('udp://39cf3eeda1ac487a9e5918e6492bc295:8c51d42270e34f16a232751ce041bda8@sentry.guegue.com:9001/4');

// Capture a message
#$event_id = $client->getIdent($client->captureMessage('my log message'));

// Capture an exception
#$event_id = $client->getIdent($client->captureException($ex));

// Give the user feedback
#echo "Sorry, there was an error!";
#echo "Your reference ID is " . $event_id;

// Install error handlers
$error_handler = new Raven_ErrorHandler($client);
set_error_handler(array($error_handler, 'handleError'), E_ALL ^ E_NOTICE);
set_exception_handler(array($error_handler, 'handleException'));
