<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;
use Exmosis\SpriteCountry\Domain\TrailEntryText;

use Exception;

class TrailEntryTextRenderer extends TrailEntryRenderer {
    
    public function __construct(TrailEntry $trail_entry) {
        
        if (! $trail_entry instanceof TrailEntryText) {
            throw Exception('TrailEntryTextRenderer needs a TrailEntryText');
        }
        
        $this->trail_entry = $trail_entry;
    }
    
    public function getHtml() {
        return $this->getTextHtml();
    }
    
    public function getTextHtml() {
        $text = $this->trail_entry->getText();
        $text = $this->wrapInLink($text);

        $html = '<div id="text_container">';
        $html .= '<div id="trail_text">' . $text . '</div>';
        $html .= $this->getNextLinkFullScreen();
        $html .= '</div>';
        return $html;
    }   
    
}