<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\TrailEntry;
use Exmosis\SpriteCountry\Domain\TrailEntryImage;

class TrailEntryImageRenderer extends TrailEntryRenderer {

    // temporary til we sort out config
    const WEB__IMG_BASE_DIR = '/data/img/';
    
    private $optimise_image = true;
    
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
                ' . $this->getNextLinkFullScreen() . '
            </div>
        ';
        $html .= $this->getListOfSignsAsLinks();
        return $html;
    }
    
    protected function getImageHtml() {
        $html = '<img id="trail_image" width="500" src="' . $this->getImageUrl() . '" />';
        return $html;
    }
    
    protected function getImageUrl() {
        if ($this->optimise_image) {
            $rel_path = $this->trail_entry->getOptimisedImageUrl();
        } else {
            $rel_path = $this->trail_entry->getImageUrl();
        }
        return self::WEB__IMG_BASE_DIR . $rel_path;
    }
    
    protected function wrapInLink(String $html_text) {
        if (! is_null($next = $this->trail_entry->getNext())) {
            return $this->getNextLinkOpen() . $html_text . $this->getNextLinkClose();
        } else {
            return $this->wrapInLinkToInfoPage($html_text);
        }
    }
    
    
}

