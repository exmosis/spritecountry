<?php

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;

class TrailInfoBox {

	protected $entry;

	public function __construct(TrailEntry $entry) {
		$this->entry = $entry;
	}

	public function getHtml($link_to_trail_start = true) {
		$html = '';
		
		$box_id = "trail_entry_box_" . $this->entry->getTrailCode() . "_" . $this->entry->getId();	
		$img = 'data/img/entry_default_img.jpg';
		if ($this->entry instanceof TrailEntryImage) {
			$img = $this->entry->getImageUrl();
		}
		
		$link_id = $this->entry->getId();
		if ($link_to_trail_start) {
			$link_id = $this->entry->getTrail()->getFirstId();
		}
		
		$html .= ' <div class="trail_entry_box" id="' . $box_id . '">' . "\n";
		$html .= '  <div class="trail_summary" style="--trail-img: url(\'' . $img . '\')">' . "\n";
		$html .= '   <div class="trail_name">' . $this->entry->getTrail()->getName() . '</div>' . "\n";
		$html .= '  </div>' . "\n";
		$html .= ' </div>' . "\n";
		
		return $html;
	}

}