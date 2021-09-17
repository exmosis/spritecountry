<?php 

namespace Exmosis\SpriteCountry\HTML;

abstract class TrailEntryRenderer {

    // TrailEntry to render
    protected $trail_entry;
    // Info about all possible signs
    protected $sign_lookup;
    
    public function __construct($trail_entry, array $sign_lookup = array()) {

        // Currently child classes need to do their own validation on $trail_entry
        
        $this->trail_entry = $trail_entry;
        $this->sign_lookup = $sign_lookup;
        
    }
    
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
    protected function getNextLinkOpen(String $css_class = "next") {
        if (! is_null($next = $this->trail_entry->getNext())) {
            $html = '<a class="' . $css_class . '" href="/trail/' . $this->trail_entry->getTrailCode() . '/' . $next->getId() . '">';
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
    
    /**
     * 
     * @return string HTML containing link with CSS to turn into full screen link
     */
    public function getNextLinkFullScreen() {
        return $this->getNextLinkOpen('full_screen_link') . '&nbsp;' . $this->getNextLinkClose();
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
        $signs_renderer = new SignsRenderer($this->trail_entry->getSigns(), $this->sign_lookup);
        return $signs_renderer->getHTML($this->trail_entry->getPathRef());
    }
    
    
}