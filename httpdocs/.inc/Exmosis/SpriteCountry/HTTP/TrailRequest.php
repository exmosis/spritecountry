<?php

namespace Exmosis\SpriteCountry\HTTP;

use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Data\SignsData;
use Exmosis\SpriteCountry\Domain\Trail;
use Exmosis\SpriteCountry\Domain\TrailEntry;
use Exmosis\SpriteCountry\Domain\TrailEntryImage;
use Exmosis\SpriteCountry\HTML\TrailEntryImageRenderer;
use Exmosis\SpriteCountry\HTML\TrailEntryTextRenderer;
use Exmosis\SpriteCountry\HTML\TrailEndingRenderer;
use Exmosis\SpriteCountry\Domain\Sign;

use Exception;

class TrailRequest {

	// Requested entry args
	private $trail_code;
	private $trail_n;
	private $trail;
	private $sctd;
	private $scd;
	private $signs_data;

	public function __construct(String $url, 
	                            SpriteCountryTrailData $sctd, 
	                            SpriteCountryData $scd, 
	                            SignsData $signs_data) {
	    
		$this->trail = null;
		$this->sctd = $sctd;
		$this->scd = $scd;
		$this->signs_data = $signs_data;
		
		$parts = $this->convertUrlToParts($url); // may throw exception
		$this->trail_code = $parts[TrailEntry::KEY__TRAIL_CODE];
		$this->trail_n = $parts[TrailEntry::KEY__TRAIL_N];
	}
	
	private function convertUrlToParts($url) {
		if (preg_match('/^\/?([^\/]+)\/?(\d+|end)?/', $url, $matches)) {
			// default to trail_n = 0
			$trail_n = 1;
			if (count($matches) > 2) {
			    // Check for end of trail requested
			    if ($matches[2] == 'end') {
			        $trail_n = 'end'; // TODO: Fix this hacky use of an int field...
			    }
				// Otherwise we have a digit specified
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

		// Handle trail end requests...
		
		if ($this->trail_n == 'end') {
		    // special case :-/
		    $renderer = new TrailEndingRenderer($trail);
		    return $renderer->getHtml();
		}
		
		$trail_entry = $trail->getTrailEntry($this->trail_n);
		
		// ... or render a specific entry ...
		
		if (! is_null($trail_entry)) {
		    
		    if ($trail_entry instanceof TrailEntryImage) {
		        
		        // Currently we only use signs on image pages, so load them here and pass them in
		        $signs = array();
		        // TODO: Move this into a separate object
		        // function loadSignsFromData():
		        foreach ($this->signs_data->getData() as $sd) {
                    array_push($signs, new Sign($sd[SignsData::FIELD__SIGN], $sd[SignsData::FIELD__DISPLAY_TEXT]));
                }
		        
                $renderer = new TrailEntryImageRenderer($trail_entry, $signs); 
                $html = $renderer->getHtml();	
                return $html;
		    } else {
		        $renderer = new TrailEntryTextRenderer($trail_entry);
		        $html = $renderer->getHtml();
		        return $html;
		        
		    }
		    
		}
		
		return '';
			
	}
	
}

