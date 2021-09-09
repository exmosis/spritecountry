<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\Trail;

class TrailEndingRenderer {
    
    protected $trail;
    
    public function __construct(Trail $trail) {
        $this->trail = $trail;
    }
    
    public function getHtml() {
        
        $trail_info_meta = array(
            array(
                'key' => 'Game',
                'value' => $this->trail->getName(),
                'is_link' => false
            ),
            array(
                'key' => 'Developer',
                'value' => $this->trail->getDeveloper(),
                'is_link' => false
            ),
            array(
                'key' => 'Publisher',
                'value' => $this->trail->getPublisher(),
                'is_link' => false
            ),
            array(
                'key' => 'Link',
                'value' => $this->trail->getUrl(),
                'is_link' => true
            ),
        );
        
        $html = '';
        foreach ($trail_info_meta as $meta) {
            $meta_key = $meta['key'];
            $meta_value = $meta['value'];
            $is_link = $meta['is_link'];
            
            if ($is_link) {
                $meta_value = '<a href="' . $meta_value . '" target="_blank">' . $meta_value . '</a>';
            }
            
            $html .= '<p><span class="trail_info_key">' . $meta_key . ': </span>' .
                     '<span class="trail_info_value">' . $meta_value . '</span></p>' . "\n";
            
        }
        // $html = '<p><span class="trail_info_key">Game:</span><span class="trail_info_value">' . $this->trail->getGame() . '</span></p>';
        $html .= '<p><a href="/" class="return_link">&lt; Return</a></p>';
        
        $html = '<div id="text_container">' .
                '<div id="trail_text">' . $html . '</div></div>';
        
        return $html;
    }
    
}