<?php 

namespace Exmosis\SpriteCountry\HTML;

abstract class TrailEntryRenderer {

    protected $trail_entry;
    
    abstract public function getHtml();
    
    protected function wrapInLink(String $html_text) {
        if (! is_null($next = $this->trail_entry->getNext())) {
            return $this->getNextLinkOpen() . $html_text . $this->getNextLinkClose();
        } else {
            return $this->wrapInLinkToInfoPage($html_text);
        }
    }
    
    abstract protected function getNextLinkOpen();
    abstract protected function getNextLinkClose();
    
    protected function wrapInLinkToInfoPage(String $html_text) {
        return $this->getLinkOpenToInfoPage() . $html_text . $this->getLinkCloseToInfoPage();
    }
    
    protected function getLinkOpenToInfoPage() {
        return '<a href="/trail/' . $this->trail_entry->getTrailCode() . '/end">';
    }

    protected function getLinkCloseToInfoPage() {
        return '</a>';
    }
    
    
}