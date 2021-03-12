<!DOCTYPE HTML>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// composer load.
require_once '.inc' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 	
// exmosis load
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'autoload.php';

use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Domain\Trail;
use Exmosis\SpriteCountry\HTML\TrailInfoBox;

$sctd = new SpriteCountryTrailData('data/trails.csv');
$sctd->load();

$scd = new SpriteCountryData('data/trail_entries.csv');
$scd->load();
 	
?>
<html>
	<head>
		<title>' . Header::HEADER_PREFIX . $this->title . '</title>
		<link rel="stylesheet" href="/css/spritecountry.css">
	</head>
	<body>
		<div id="wrap">
		
			<div id="index_head">
				Sprite Country...
			</div>
			
			<div id="trail_menu">
			<?php
				/***** RANDOM TRAIL *****/
				$trails = $sctd->getShuffledTrails();
				$trail = new Trail($trails[0][SpriteCountryTrailData::FIELD__TRAIL], $sctd, $scd);
				$entry = $trail->getRandomTrailEntry();
				$box = new TrailInfoBox($entry);
				echo $box->getHtml();
			?>
			</div>		
		
		</div>
	</body>
<html>
