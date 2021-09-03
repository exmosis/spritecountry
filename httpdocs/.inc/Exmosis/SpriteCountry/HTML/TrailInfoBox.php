<?php

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntryImage;
use Exmosis\SpriteCountry\Domain\TrailEntry;

class TrailInfoBox {

	protected $entry;
	protected $trail;

	/**
	 * 
	 * @param TrailEntry $entry
	 */
	public function __construct(TrailEntry $entry) {
		$this->entry = $entry;
		$this->trail = $entry->getTrail();
	}

	/**
	 * 
	 * @param bool $link_to_trail_start Set to false to link direct to image instead of start of trail
	 * @param bool $hide_name Set to true to remove div containing name of trail
	 * @return string HTML for element
	 */
	public function getHtml(bool $link_to_trail_start = true, bool $hide_name = false) {
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
		$html .= '  <a class="box_link" href="' . $link . '">&nbsp;</a>' . "\n";
		$html .= '  <div class="trail_summary" style="--trail-img: url(\'' . HtmlConfig::WEBPATH__TRAIL_IMAGES . $img . '\')">' . "\n";
		if (! $hide_name) {
		  $html .= '   <div class="trail_name">' . 
		             '     <a href="' . $link . '">' . $this->trail->getName() . '</a></div>' . "\n";
		}
		$html .= '  </div>' . "\n";
		$html .= ' </div>' . "\n";
		
		return $html;
	}
	
}