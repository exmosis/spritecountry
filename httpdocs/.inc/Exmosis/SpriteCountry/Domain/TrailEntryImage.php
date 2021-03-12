<?php

namespace Exmosis\SpriteCountry\Domain;

// TODO: Decouple.
use Exmosis\SpriteCountry\HTTP\TrailRequest;

class TrailEntryImage extends TrailEntry {

	protected $image;

	public function __construct(String $trail_code, int $id, array $entry_data, Trail $trail = null) {
		parent::__construct($trail_code, $id, $entry_data, $trail);
		$this->type = TrailEntry::TRAIL_ENTRY_TYPE__IMAGE;
		// store text from incoming data
		$this->image = $entry_data[TrailEntry::KEY__IMG_FILE];
	}
	
	public function getHtml() {
		$html = $this->getImageHtml();
		
		if (! is_null($this->getNext())) {
			$html = '<div id="image_container">' . $this->getNextLinkOpen() . $html . $this->getNextLinkClose() . '</div>';
		}
		
		return $html;
	}	
	
	public function getImageHtml() {
		$html = '<img id="trail_image" width="500" src="' . $this->getImageUrl() . '" />';
		return $html;
	}
	
	public function getImageUrl() {
	    // TODO: Decouple this from WEB__IMG_BASE_DIR
		return TrailRequest::WEB__IMG_BASE_DIR . $this->trail_code . '/' . $this->image;
	}

}