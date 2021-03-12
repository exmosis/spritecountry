<?php

namespace Exmosis\SpriteCountry\Domain;

class TrailEntryImage extends TrailEntry {

	protected $image;

	public function __construct(String $trail_code, int $id, array $entry_data, Trail $trail = null) {
		parent::__construct($trail_code, $id, $entry_data, $trail);
		$this->type = TrailEntry::TRAIL_ENTRY_TYPE__IMAGE;
		// store text from incoming data
		$this->image = $entry_data[TrailEntry::KEY__IMG_FILE];
	}
	
	public function getImageUrl() {
		return $this->trail_code . '/' . $this->image;
	}

}