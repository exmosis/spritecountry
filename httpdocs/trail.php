<?php

// composer load.
require_once '.inc' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 	
// exmosis load - TODO: Autoload
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Header.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Footer.php';

require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Trail.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntry.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntryText.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntryImage.php';


require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailRequest.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryRequest.php'; 	
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryData.php'; 	

// TODO: Pass this round
$scd = new Exmosis\SpriteCountry\SpriteCountryData('data/trail_entries.csv');
$scd->load();

// oh wait, the Request object handles types of URL, duh.
// TODO: turn trail.php into index.php
if (array_key_exists('path', $_GET)) {
	$req = new Exmosis\SpriteCountry\SpriteCountryRequest($_GET['path']);
	$req->process();
}


echo "\n";