<?php

namespace Exmosis\SpriteCountry\Domain;

/**
 * Represents the data for a whole trail.
 */
class Trail {

	private $trail_code;
	private $parent_trail;
	private $name;
	private $data;
		// trail_code
		// trail_n
		// text
		// img_file
		// signs

	public function __construct(String $trail_code, SpriteCountryData $scd) {
		$this->trail_code = $trail_code;
		$data = $scd->getTrailData($this->trail_code);
		// Key trail data by trail_n
		foreach ($data as $d) {
			$this->data[$d['trail_n']] = $d;
		}
	}

	public function getName() {
		// TODO
		return 'test trail';
	}

	public function getData() {
		return $this->data;
	}

	public function getLength() {
		return count($this->data);
	}
	
	public function getNextId(int $current_id) {

		$counter = 0;
		$found = false;
		
		foreach ($this->data as $n => $data) {
			$counter++;
			if ($found) {
				// Found it last time, report this key
				return $n;
			}
			if ($n == $current_id) {
				// eg if at pos 1, and only 1 item, then no next item
				if ($counter == $this->getLength()) {
					return null;
				}
				$found = true;
			}	
		}
		
		// didn't find it, return null
		return null; 		
		
	}
	
	// getIDs
	public function getIds() {		
		return array_keys($this->data);		
	}
	
	public function getFirstId() {
		$keys = $this->getIds();
		return $keys[0];
	}
	
	// getEntry(int $id)
	public function getEntryData(int $id) {
		if (array_key_exists($id, $this->data)) {
			return $this->data[$id];		
		}
		
		throw new Exception('ID not found');
	}
	
	public function getTrailEntry(int $id) {
		$data = $this->getEntryData($id);
		
		// TODO: ERROR CHECK
		
		$entry = null; 		
		
		if ($data[TrailEntry::KEY__TEXT]) {
			$entry = new TrailEntryText($this->trail_code, $id, $data, $this);
		} else {
			$entry = new TrailEntryImage($this->trail_code, $id, $data, $this);
		}
		
		return $entry;
	}
	
	public function getRandomTrailEntry() {
		$ids = $this->getIds();
		shuffle($ids);
		$random_id = $ids[0];
		
		return $this->getTrailEntry($random_id); 		
	}
	
	

}