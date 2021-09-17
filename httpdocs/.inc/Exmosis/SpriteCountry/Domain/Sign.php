<?php

namespace Exmosis\SpriteCountry\Domain;

class Sign {
    
    private $sign_code;
    private $display_text;
    
    public function __construct(String $sign_code, String $display_text) {
        $this->sign_code = $sign_code;
        $this->display_text = $display_text;
    }
    
    public function getSignCode() {
        return $this->sign_code;
    }
    
    public function getDisplayText() {
        return $this->display_text;
    }
    
}
