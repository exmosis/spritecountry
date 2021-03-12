<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\Trail;

class TrailEndingRenderer {
    
    protected $trail;
    
    public function __construct(Trail $trail) {
        $this->trail = $trail;
    }
    
    public function getHtml() {
        $html = '<p>' . $this->trail->getGame() . '</p>';
        $html .= '<p><a href="/">Return</a></p>';
        
        return $html;
    }
    
}