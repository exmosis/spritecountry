<?php

// composer load.
require_once '.inc' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 	
// exmosis load
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Header.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Footer.php';

require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Trail.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailRequest.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryRequest.php'; 	
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryData.php'; 	

$scd = new Exmosis\SpriteCountry\SpriteCountryData('data/test.csv');
$scd->load();

$req = new Exmosis\SpriteCountry\SpriteCountryRequest('/a/1');
$req->process();


$req = new Exmosis\SpriteCountry\SpriteCountryRequest('/a/2');
$req->process();

echo "\n";