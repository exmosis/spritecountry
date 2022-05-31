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
use Exmosis\SpriteCountry\Domain\TrailEntryImage;
use Exmosis\SpriteCountry\HTML\Header;
use Exmosis\SpriteCountry\HTML\TrailInfoBox;

$sctd = new SpriteCountryTrailData('data/trails.csv');
$sctd->load();

$scd = new SpriteCountryData('data/trail_entries.csv');
$scd->load();

?>
<html>
	<head>
		<title><?php echo Header::HEADER_PREFIX; ?></title>
		<link rel="stylesheet" href="/css/spritecountry.css">
	</head>
	<body id="homepage">
		<div id="wrap">
		
			<div id="index_head" class="section_wrap">
				<img src="/media/spritecountry_doticon_logo.png" width="100" height="100" id="site_logo">
				<div id="head_title">
					Sprite<br />Country
				</div>
			</div>
			
			<div id="intro" class="section_wrap">
				<p>A labyrinth gallery of videogame photography</p>
			</div>
			<div id="intro" class="section_wrap">
				<p>
					All images have been post-processed, and are a combination of the 
					original game environment, my own hardware (and its limits), and 
					applied styling and after-effects.
				</p>
			</div>
			
			<?php

			$trail_code = null;
			
			/***** CHECK FOR REQUESTED TRAIL *****/
			if (array_key_exists('trail', $_GET)) {
			    $trails = $sctd->getData($_GET['trail']);
			    if (count($trails) == 1) {
			        // got data back so use it
			        $trail_code = $trails[0][SpriteCountryTrailData::FIELD__TRAIL];
					$trail = new Trail($trail_code, $sctd, $scd);
			    }
			}
			
			/***** USE RANDOM TRAIL IF NOT REQUESTED OR NOT FOUND *****/
			if (is_null($trail_code)) {
				$trails = $sctd->getShuffledTrails();
				$trail_code = $trails[0][SpriteCountryTrailData::FIELD__TRAIL];
				$trail = new Trail($trail_code, $sctd, $scd);
			}
         ?>

			<div class="trail_intro wrap">Entry <?php echo $trail->getId(); ?> of ?</div> 
			<div id="trail_menu" class="section_wrap">

			<?php
			    $trail = new Trail($trail_code, $sctd, $scd);
				$entry = null;
				while (! $entry instanceof TrailEntryImage) {
				    $entry = $trail->getRandomTrailEntry();
				}
				$box = new TrailInfoBox($entry);
				echo $box->getHtml(true, false);
			?>
			</div>	
			

			<div id="newsletter_form">
				<form
				action="https://buttondown.email/api/emails/embed-subscribe/sprite_country"
				method="post"
				target="popupwindow"
				onsubmit="window.open('https://buttondown.email/sprite_country', 'popupwindow')"
				class="embeddable-buttondown-form"
				>
					<div class="section_wrap">
						<p>
							Subscribe to get updates, including new trails and new features being added:
						</p>
					</div>
					<div class="section_wrap">
						<div>
							<input type="email" name="email" id="bd-email" />
							<input type="hidden" value="1" name="embed" />
							<input type="submit" value="Subscribe" />
						</div>
					</div>
					<div class="section_wrap">
						<p>
							<a href="https://buttondown.email" target="_blank">Powered by Buttondown</a>
						</p>
					</div>
				</form>
			</div>
			
			<!-- div id="instructions" class="section_wrap">
				<p>Click to enter.<br />Click/tap anywhere on the screen to advance.<br />Choose a symbol to sidestep.</p>
			</div -->
		
		</div>
	</body>
<html>
