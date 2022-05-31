<?php

namespace Exmosis\SpriteCountry\Domain;

use Exmosis\SpriteCountry\Data\SpriteCountryTrailData;
use Exmosis\SpriteCountry\Data\SpriteCountryData;

use Exception;

/**
 * Represents the data for a whole trail, including encapsulating TrailEntry objects within.
 */
class Trail {

	private $id;
	private $trail_code;
	private $name;
	private $game;
	private $developer;
	private $publisher;
	private $url;
	private $entries; // array
	
	// Lesser dependencies
	
	private $utef; // UniversalTrailEntryFactory

	/**
	 * Must be created from a Trail dataset and a TrailEntries dataset
	 * Will populate all properties and TrailEntry items
	 * 
	 * @param String $trail_code
	 * @param SpriteCountryTrailData $sctd
	 * @param SpriteCountryData $scd
	 */
	public function __construct(String $trail_code, SpriteCountryTrailData $sctd, SpriteCountryData $scd) {

	    $this->setUniversalTrailEntryFactory(new UniversalTrailEntryFactory());
	    
		$this->trail_code = $trail_code;
		$this->loadFromTrailData($sctd);
		$this->loadFromTrailEntryData($scd);
						
	}
	
	public function setUniversalTrailEntryFactory(UniversalTrailEntryFactory $utef) {
	    $this->utef = $utef;
	}
	
	public function getId() {
		return $this->id;
	}	
	
	public function getCode() {
		return $this->trail_code;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getGame() {
		return $this->game;
	}
	
	public function getDeveloper() {
	    return $this->developer;
	}
	
	public function getPublisher() {
		return $this->publisher;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	/** 
	 * Load main trail metadata in
	 */
	protected function loadFromTrailData(SpriteCountryTrailData $sctd) {
		$data = $sctd->getData($this->trail_code);
		$this->id = $data[0][SpriteCountryTrailData::FIELD__ID];
		$this->name = $data[0][SpriteCountryTrailData::FIELD__NAME];
		$this->game = $data[0][SpriteCountryTrailData::FIELD__GAME];
		$this->developer = $data[0][SpriteCountryTrailData::FIELD__DEVELOPER];
		$this->publisher = $data[0][SpriteCountryTrailData::FIELD__PUBLISHER];
		$this->url = $data[0][SpriteCountryTrailData::FIELD__URL];
	}

	/**
	 * Turn the passed in data into TrailEntry objects of the right type.
	 * 
	 * @param SpriteCountryData $scd
	 */
	protected function loadFromTrailEntryData(SpriteCountryData $scd) {
		
		$data = $scd->getTrailData($this->trail_code);

		foreach ($data as $d) {
		    // Create a TrailEtry - the Factory will work out what type
			$entry = $this->utef->create($d, $this);
			// Store locally, keyed by entry ID
			$this->entries[$entry->getId()] = $entry;
		}
		
	}

	public function getTrailEntries() {
		return $this->entries;
	}

	public function getLength() {
		return count($this->entries);
	}
	
	public function getNextId(int $current_id) {

		$counter = 0;
		$found = false;
		
		foreach (array_keys($this->entries) as $n) {
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
		return array_keys($this->entries);		
	}
	
	public function getFirstId() {
		$keys = $this->getIds();
		return $keys[0];
	}
	
	// getEntry(int $id)
	public function getTrailEntry(int $id) {
		if (array_key_exists($id, $this->entries)) {
			return $this->entries[$id];		
		}
		
		throw new Exception('ID not found');
	}
	
	public function getRandomTrailEntry() {
		$ids = $this->getIds();
		shuffle($ids);
		$random_id = $ids[0];
		
		return $this->getTrailEntry($random_id); 		
	}
	

}