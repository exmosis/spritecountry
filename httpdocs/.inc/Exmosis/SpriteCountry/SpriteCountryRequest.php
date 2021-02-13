<?php

namespace Exmosis\SpriteCountry;

class SpriteCountryRequest {

	const SIGN_URL_PREFIX = '+';

	private $url;

	public function __construct(String $url) {
		$this->url = $url;
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
	}
	
	private function processSign(String $sign) {
		if ($sign == '') {
			$this->goToIndex();
			exit;
		}
		
		// TODO: new Sign Object		
	}
	
	private function processTrail(String $url) {
		$trail_request = new TrailRequest($url);
		
		$h = new Header('test');
		$f = new Footer();
						
		$html = $h->getHtml(); 		
		$html .= $trail_request->getHtml();
		$html .= $f->getHtml();
		
		echo $html;
	}

}