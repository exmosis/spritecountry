<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// composer load.
require_once '.inc' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 	

// exmosis load
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'autoload.php';

use Exmosis\SpriteCountry\HTTP\SpriteCountryRequest;
use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Data\Signs;
use Exmosis\SpriteCountry\Data\SignsData;

$sctd = new SpriteCountryTrailData('data/trails.csv');
$sctd->load();

$scd = new SpriteCountryData('data/trail_entries.csv');
$scd->load();

$signdata = new SignsData('data/signs.csv');
$signdata->load();

// oh wait, the Request object handles types of URL, duh.
// But index doesn't need to load sign data, so...
// TODO: Maybe turn index_trail.php into index.php?
if (array_key_exists('path', $_GET)) {
	$req = new SpriteCountryRequest($_GET['path'], $sctd, $scd, $signdata);
	$req->process();
}


echo "\n";