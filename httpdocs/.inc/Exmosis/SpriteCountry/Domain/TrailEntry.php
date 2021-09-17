<?php

namespace Exmosis\SpriteCountry\Domain;

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

	    // Convert incoming signs into an array
		$this->signs = explode(',', $entry_data[self::KEY__SIGNS]);
		if (count($this->signs) == 1 && trim($this->signs[0]) == '') {
		    $this->signs = array();
		}
		
		// Store the trail that this entry belongs to
		$this->trail = $trail;
		
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTrailCode() {
		return $this->trail_code;
	}
	
	/**
	 * Gets URL-style reference ot this trail entry in the form of "<trail_code>/<id>"
	 * 
	 * @return string
	 */
	public function getPathRef() {
	    return $this->getTrailCode() . '/' . $this->getId();
	}
	
	/**
	 * @return array Array of strings, one for each sign attached
	 */
	public function getSigns() {
	    return $this->signs;
	}
	
	public function getTrail() {
		return $this->trail;	
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


}
