<?php 

namespace Exmosis\SpriteCountry\HTML;

use Exmosis\SpriteCountry\Domain\Sign;

/**
 * Renders an array of Sign objects into HTML
 */
class SignsRenderer {
    
    // Signs to render, array of strings
    private $signs;
    // Sign objects to use, array of Signs
    private $signs_lookup;
    
    /** 
     * 
     * @param array $signs Array of strings noting sign classes to output
     * @param array $signs_lookup Array of Sign classes to use as lookup for strings in $signs
     * @throws \Exception
     */
    public function __construct(array $signs, array $signs_lookup) {
        
        $check_i = 0;
        foreach ($signs_lookup as $s) {
            if (! $s instanceof Sign) {
                throw new \Exception('Element ' . $check_i . ' in $signs_lookup construction array is not a Sign object.');
            }
            $check_i++;
        }
        
        $this->signs = $signs;
        $this->signs_lookup = $signs_lookup;
        
    }
    
    public function getHTML() {
        $html = '';
        
        if (count($this->signs) > 0) {
            $html = '<ul id="trail_signs">';
            foreach ($this->signs as $sign) {
                // Quick loop through Sign objects. Not ideal but should be ok at low scale.
                foreach ($this->signs_lookup as $check_sign) {
                    if ($check_sign->getSignCode() == $sign) {
                        // Match found, so use the matched Sign class
                        $html .= '<li><a href="/sign/' . $check_sign->getSignCode() . '">' . $check_sign->getDisplayText() . '</a></li>';
                    }
                }
            }
            $html .= '</ul>';
        }
        
        return $html;
    }
    
}
