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
	
	/**
	 * TODO: Move this into a separate renderer.
	 * 
	 * {@inheritDoc}
	 * @see \Exmosis\SpriteCountry\Domain\TrailEntry::getHtml()
	 */
	public function getHtml() {
		$html = '<div id="text_container">';
		$html .= '<div id="trail_text">' . $this->text . '</div>';
		if (! is_null($this->getNext())) {
			$html .= '<div>' . $this->getNextLinkOpen() . '&gt;' . $this->getNextLinkClose() . '</div>';
		}
		$html .= '</div>';
		return $html;
	} 
	


}