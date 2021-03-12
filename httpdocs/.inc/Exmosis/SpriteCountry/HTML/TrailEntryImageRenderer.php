<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;
use Exmosis\SpriteCountry\Domain\TrailEntryImage;

use Exception;

class TrailEntryImageRenderer extends TrailEntryRenderer {

    // temporary til we sort out config
    const WEB__IMG_BASE_DIR = '/data/img/';
    
    public function __construct(TrailEntry $trail_entry) {
        
        if (! $trail_entry instanceof TrailEntryImage) {
            throw Exception('TrailEntryImageRenderer needs a TrailEntryImage');
        }
        
        $this->trail_entry = $trail_entry;
    }
    
    public function getHtml() {
        $img = $this->getImageHtml();
        $html = $this->wrapInLink($img);
        $html = '
            <div id="image_container">
                ' . $html . '
            </div>
        ';
        return $html;
    }
    
    protected function getImageHtml() {
        $html = '<img id="trail_image" width="500" src="' . $this->getImageUrl() . '" />';
        return $html;
    }
    
    protected function getImageUrl() {
        $rel_path = $this->trail_entry->getImageUrl();
        return self::WEB__IMG_BASE_DIR . $rel_path;
    }
    
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
    
    
    
}

