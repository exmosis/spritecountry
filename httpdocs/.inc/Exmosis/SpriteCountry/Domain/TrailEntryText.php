<?php

namespace Exmosis\SpriteCountry\Domain;

class TrailEntryText extends TrailEntry {

	protected $text;

	public function __construct(String $trail_code, int $id, array $entry_data, Trail $trail = null) {
		parent::__construct($trail_code, $id, $entry_data, $trail);
		$this->type = TrailEntry::TRAIL_ENTRY_TYPE__TEXT;
		// store text from incoming data
		$this->text = $entry_data[TrailEntry::KEY__TEXT];
	}
	
	public function getText() {
	    return $this->text;
	}

}