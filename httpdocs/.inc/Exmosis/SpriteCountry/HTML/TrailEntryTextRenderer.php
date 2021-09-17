<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;
use Exmosis\SpriteCountry\Domain\TrailEntryText;

use Exception;

class TrailEntryTextRenderer extends TrailEntryRenderer {
    
    public function __construct(TrailEntry $trail_entry, array $sign_lookup = array()) {
        
        if (! $trail_entry instanceof TrailEntryText) {
            throw Exception('TrailEntryImageRenderer needs a TrailEntryText');
        }
        
        parent::__construct($trail_entry, $sign_lookup);
        
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