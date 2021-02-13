<?php

namespace Exmosis\SpriteCountry;

/**
 * Class to be extended for TrailTextEntry and TrailImageEntry
 */

abstract class TrailEntry {

	const TRAIL_ENTRY_TYPE__TEXT = 1;
	const TRAIL_ENTRY_TYPE__IMAGE = 2;

	const KEY__TRAIL_CODE = 'trail_code';
	const KEY__TRAIL_N = 'trail_n';
	const KEY__TEXT = 'text';
	const KEY__IMG_FILE = 'img_file';
	const KEY__SIGNS = 'signs';	

	protected $trail;
	protected $id;
	protected $trail_code;
	
	protected $type;
	protected $signs;
	
	// Child implementers need to set $this->type using TRAIL_ENTRY_TYPE* const	
	public function __construct(String $trail_code, int $id, array $entry_data, Trail $trail = null) {
		
		$this->trail_code = $trail_code;
		$this->id = $id;			
		
		// Store the trail that this entry belongs to
		$this->trail = $trail;
		
	}

	abstract public function getHtml();
	
	public function getId() {
		return $this->id;
	}	
	
	public function getNext() {
		if (! is_null($this->trail)) {
			$next_id = $this->trail->getNextId($this->id);
			if ($next_id) {
				$next_entry = $this->trail->getTrailEntry($next_id);
				return $next_entry;
			}
		} 
		
		return null;
		
	}

	public function getNextLinkOpen() {
		if (! is_null($next = $this->getnext())) {
			$html = '<a href="/trail/' . $this->trail_code . '/' . $next->getId() . '">';
			return $html;
		}
		return '';
	}

	public function getNextLinkClose() {
		if (! is_null($next = $this->getnext())) {
			$html = '</a>';
			return $html;
		}
		return '';
	}


}
