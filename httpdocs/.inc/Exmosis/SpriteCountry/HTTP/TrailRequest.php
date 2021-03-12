<?php

namespace Exmosis\SpriteCountry\HTTP;

use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Domain\Trail;
use Exmosis\SpriteCountry\Domain\TrailEntry;

use Exception;

class TrailRequest {

	const WEB__IMG_BASE_DIR = '/data/img/';

	// Requested entry args
	private $trail_code;
	private $trail_n;
	private $trail;
	private $sctd;
	private $scd;

	public function __construct(String $url, SpriteCountryTrailData $sctd, SpriteCountryData $scd) {
	    
		$this->trail = null;
		$this->sctd = $sctd;
		$this->scd = $scd;
		
		$parts = $this->convertUrlToParts($url); // may throw exception
		$this->trail_code = $parts[TrailEntry::KEY__TRAIL_CODE];
		$this->trail_n = $parts[TrailEntry::KEY__TRAIL_N];
	}
	
	private function convertUrlToParts($url) {
		if (preg_match('/^\/?([^\/]+)\/?(\d+)?/', $url, $matches)) {
			// default to trail_n = 0
			$trail_n = 1;
			if (count($matches) > 2) {
				// we have a digit specified
				$trail_n = (int) $matches[2];
			}
			$trail_code = $matches[1];
			// safety time, strip out a-z, 0-9, - _ and .
			$trail_code = preg_replace('/[^a-zA-Z0-9\-_\.]/', '', $trail_code);
			
			return array(
				TrailEntry::KEY__TRAIL_CODE => $trail_code,
				TrailEntry::KEY__TRAIL_N => $trail_n
			);
		}
	}	
	
	protected function getTrail() {
		
		if (! is_null($this->trail)) {
			return $this->trail;		
		} 		
		
		if (! $this->trail_code) {
			throw new Exception('Trail code missing, cannot load data.');		
		}

		$trail = new Trail($this->trail_code, $this->sctd, $this->scd);
		// store in case called again
		$this->trail = $trail;
		return $this->trail;

	}	
	
	public function getHtml() {

		$trail = $this->getTrail();
		$trail_entry = $trail->getTrailEntry($this->trail_n);
				
		if (! is_null($trail_entry)) {
			$html = $trail_entry->getHtml();			
			return $html;			
		}
		
		return '';
			
	}
	
}

