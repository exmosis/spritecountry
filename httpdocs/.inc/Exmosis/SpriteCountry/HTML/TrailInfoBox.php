<?php

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;

class TrailInfoBox {

	protected $entry;
	protected $trail;

	public function __construct(TrailEntry $entry) {
		$this->entry = $entry;
		$this->trail = $entry->getTrail();
	}

	public function getHtml($link_to_trail_start = true) {
		$html = '';
		
		$box_id = "trail_entry_box_" . $this->trail->getCode() . "_" . $this->entry->getId();	
		$img = 'data/img/entry_default_img.jpg';
		if ($this->entry instanceof TrailEntryImage) {
			$img = $this->entry->getImageUrl();
		}
		
		$link_id = $this->entry->getId();
		if ($link_to_trail_start) {
			$link_id = $this->entry->getTrail()->getFirstId();
		}
		
		// TODO: Move this elsewhere to be generic
		$link = '/trail/' . $this->trail->getCode() . '/' . $link_id;
		
		$html .= ' <div class="trail_entry_box" id="' . $box_id . '">' . "\n";
		$html .= '  <div class="trail_summary" style="--trail-img: url(\'' . $img . '\')">' . "\n";
		$html .= '   <div class="trail_name">' . 
		         '     <a href="' . $link . '">' . $this->trail->getName() . '</a></div>' . "\n";
		$html .= '  </div>' . "\n";
		$html .= ' </div>' . "\n";
		
		return $html;
	}
	
}