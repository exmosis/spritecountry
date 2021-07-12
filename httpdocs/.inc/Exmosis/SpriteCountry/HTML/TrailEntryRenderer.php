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
    
    /**
     *
     *
     * @return string
     */
    protected function getNextLinkOpen() {
        if (! is_null($next = $this->trail_entry->getNext())) {
            $html = '<a class="next" href="/trail/' . $this->trail_entry->getTrailCode() . '/' . $next->getId() . '">';
            return $html;
        }
        return '';
    }
    
    /**
     *
     *
     * @return string
     */
    protected function getNextLinkClose() {
        if (! is_null($this->trail_entry->getNext())) {
            $html = '</a>';
            return $html;
        }
        return '';
    }
    
    protected function wrapInLinkToInfoPage(String $html_text) {
        return $this->getLinkOpenToInfoPage() . $html_text . $this->getLinkCloseToInfoPage();
    }
    
    protected function getLinkOpenToInfoPage() {
        return '<a href="/trail/' . $this->trail_entry->getTrailCode() . '/end">';
    }

    protected function getLinkCloseToInfoPage() {
        return '</a>';
    }
    
    
    protected function getListOfSignsAsLinks() {
        $ul = '<ul id="trail_signs">';
        foreach ($this->trail_entry->getSigns() as $sign) {
            $ul .= '<li><a href="">' . $sign . '</a></li>';
        }
        $ul .= '</ul>';
        return $ul;
    }
    
    
}