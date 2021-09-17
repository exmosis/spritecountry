<?php 

namespace Exmosis\SpriteCountry\HTTP;

use Exmosis\SpriteCountry\Data\SpriteCountryData;
use Exmosis\SpriteCountry\Domain\TrailEntry;

/**
 * Sign requests work like this:
 * Given a starting location (trail entry) and a sign to follow, we work out the next entry for 
 * that sign.
 * Then we send a redirect to send the browser to the next entry.
 */
class SignRequest {
    
    // We need to know what sign we're processing...
    private $sign_code;
    // We need to look up where we've come from, and what the next entry for this sign is
    private $original_entry_data;
    // We'll convert that to only trail entry references of interest
    // we store this as basic strings though - trail_code/n
    private $sign_trail_entries;
    // We also need to know where we've come from, in the form of trail_code/n as well
    private $from_trail_entry_ref;

    // We don't worry about loading SignData or Signs here, as we only need to match the sign code up
    
    public function __construct(String $sign_code, 
                                SpriteCountryData $trail_data, 
                                String $from_trail_entry_ref) {
        
        $this->sign_code = $sign_code;
        $this->original_entry_data = $trail_data;
        $this->from_trail_entry_ref = $from_trail_entry_ref;
                                    
        // We're only interested in entries with our requested sign, so...
        $this->filterTrailEntryData($this->sign_code);
    }
    
    protected function filterTrailEntryData(String $sign_code) {
        $this->sign_trail_entries = array();
        foreach ($this->original_entry_data->getTrailData() as $d) {
            if (strpos(',' . $d[SpriteCountryData::FIELD__SIGNS] . ',', $sign_code) !== false) {
                // Found it
                array_push($this->sign_trail_entries, 
                           $d[SpriteCountryData::FIELD__TRAIL] . '/' . $d[SpriteCountryData::FIELD__N]
                );
            }
        }
        
        // $sign_trail_entries now contains something like:
        // array( 'trail_a/2', 'trail_b/1', 'trail_b/4', 'trail_e/50' ... )
    }
    
    /**
     * 
     * @return NULL|string Null if no next found. String URL reference if found in form trail/n
     */
    protected function getNextEntryWithSign() {
        
        // Go through trail data, check each row against $from_trail_entry, and go from there
        // 1. Find our current position
        $current_ref = $this->from_trail_entry_ref;
        
        $pos = 0;
        while ($pos < count($this->sign_trail_entries) && $this->sign_trail_entries[$pos] != $current_ref) {
            $pos++;
        }
        
        // check we actually found anything
        if ($pos >= count($this->sign_trail_entries)) {
            // oops, not found. Perfectly feasible if making up URLS
            return null;
        }
        
        // Get the next one, or the first one if we're at the end.
        // This can return the same entry we requested, if we only have one trail entry with that sign.
        $pos++;
        if ($pos == count($this->sign_trail_entries)) {
            $pos = 0;
        }
        
        return $this->sign_trail_entries[$pos];
        
    }
    
    public function sendRedirect() {
        $next_url = $this->getNextEntryWithSign();
        if (is_null($next_url)) {
            // Don't do anything
        } else {
            header('Location: /trail/' . $next_url);
            exit;
        }
    }
    
}