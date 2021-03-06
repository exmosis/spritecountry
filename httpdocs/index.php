<!DOCTYPE HTML>
<?php

error_reporting(E_ALL);

// composer load.
require_once '.inc' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 	
// exmosis load
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'autoload.php';
/*
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Header.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Footer.php';

require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'Trail.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntry.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntryText.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailEntryImage.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'TrailRequest.php';
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryRequest.php'; 	
require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'SpriteCountryData.php'; 	

require_once '.inc' . DIRECTORY_SEPARATOR . 'Exmosis' . DIRECTORY_SEPARATOR . 'SpriteCountry' . DIRECTORY_SEPARATOR . 'HTML' . DIRECTORY_SEPARATOR . 'TrailInfoBox.php';
*/
use Exmosis\SpriteCountry\SpriteCountryData;
use Exmosis\SpriteCountry\Trail;
use Exmosis\SpriteCountry\HTML\TrailInfoBox;


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
				// No overall trail data yet...
				$trails = [ 'fugue_in_void', 'abzu' ];
				shuffle($trails);
				$trail = new Trail($trails[0], $scd);
				$entry = $trail->getRandomTrailEntry();
				$box = new TrailInfoBox($entry);
				echo $box->getHtml();
			?>
			</div>		
		
		</div>
	</body>
<html>
