<?php

namespace Exmosis\SpriteCountry;

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
			$html = '<p>' . $this->getNextLinkOpen() . $html . $this->getNextLinkClose() . '</p>';
		}
		
		return $html;
	}	
	
	public function getImageHtml() {
		$html = '<img id="trail_image" width="500" src="' . TrailRequest::WEB__IMG_BASE_DIR . $this->trail_code . '/' . $this->image . '" />';
		return $html;
	} 


}