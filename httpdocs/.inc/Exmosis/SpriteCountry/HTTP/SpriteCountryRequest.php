<?php

namespace Exmosis\SpriteCountry\HTTP;

use Exmosis\SpriteCountry\HTML\Header;
use Exmosis\SpriteCountry\HTML\Footer;
use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Data\SignsData;

class SpriteCountryRequest {

	const SIGN_URL_PREFIX = 'sign/';

	private $url;
	private $sctd;
	private $scd;
	private $signs_data;

	public function __construct(String $url, SpriteCountryTrailData $sctd, SpriteCountryData $scd, SignsData $signs_data) {
		$this->url = $url;
		$this->sctd = $sctd;
		$this->scd = $scd;
		$this->signs_data = $signs_data;
	}
	
	public function process() {
		if ($this->url == '') {
			$this->goToIndex();
			exit;
		}

		$is_sign = $this->urlLooksLikeSign($this->url);
		if ($is_sign) {
			$sign = ltrim($this->url, SpriteCountryRequest::SIGN_URL_PREFIX);
			$this->processSign($sign);
		} else {
			$this->processTrail($this->url);		
		}
	}
	
	private function urlLooksLikeSign(String $url) {
		if (strpos($url, SpriteCountryRequest::SIGN_URL_PREFIX) === 0) {
			return true;
		}	
		return false;
	}
	
	private function goToIndex() {
	    header('Location: /');
	    exit;
	}
	
	/**
	 * Incoming $sign_url will look like <sign>/<trail_code>/<n>
	 * 
	 * This will redirect one way or another.
	 * 
	 * @param String $sign_url
	 */
	private function processSign(String $sign_url) {
		if ($sign_url == '') {
			$this->goToIndex();
			// exits
		}

		$sign_url_parts = explode('/', $sign_url);
		if (count($sign_url_parts) != 3) {
		    $this->goToIndex();
		    // exits
		}
		
		$sign = $sign_url_parts[0];
		$entry_trail_code = $sign_url_parts[1];
		$entry_trail_n = (int) $sign_url_parts[2];

		$sr = new SignRequest($sign, $this->scd, $entry_trail_code . '/' . $entry_trail_n);
		$sr->sendRedirect(); // exits if redirect happens
		
		// If that failed for any reason, redirect to index too
		$this->goToIndex();
		// exits;
		
	}
	
	private function processTrail(String $url) {
		$trail_request = new TrailRequest($url, $this->sctd, $this->scd, $this->signs_data);
		
		$h = new Header('test');
		$f = new Footer();
						
		$html = $h->getHtml(); 		
		$html .= $trail_request->getHtml();
		$html .= $f->getHtml();
		
		echo $html;
	}

}