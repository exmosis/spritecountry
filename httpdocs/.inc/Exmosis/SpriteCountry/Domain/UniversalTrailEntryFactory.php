<?php 

namespace Exmosis\SpriteCountry\Domain;

use Exception;

class UniversalTrailEntryFactory {
    
    /**
     * TrailEntry keys, for reference:
     * 
     * 	const KEY__TRAIL_CODE = 'trail_code';
	 *  const KEY__TRAIL_N = 'trail_n';
	 *  const KEY__TEXT = 'text';
	 *  const KEY__IMG_FILE = 'img_file';
	 *  const KEY__SIGNS = 'signs';	
     */
    
    // Creation will error if these aren't found
    const REQUIRED_KEYS = array(TrailEntry::KEY__TRAIL_CODE, TrailEntry::KEY__TRAIL_N);
    
    // Creation will create a text key if this field is populated
    const TEXT_KEY = TrailEntry::KEY__TEXT;
    
    
    public function __construct() {}
    
    /** 
     * Converts an entry of trail entry data from TrailEntry Dataset into the relevant
     * TrailEntry object, based on if text exists.
     * 
     * @throws Exception if any required keys are missing or blank
     */
    public function create(Array $trail_entry_data, Trail $parent_trail = null) {
        
        $missing_required_keys = array();
        foreach (self::REQUIRED_KEYS as $key) {
            if (! array_key_exists($key, $trail_entry_data) || // missing
                  is_null(trim($trail_entry_data[$key])) ||    // null
                  trim($trail_entry_data[$key]) == '') {       // blank text
                array_push($missing_required_keys, $key);
            }
        }
        if ($missing_required_keys) {
            throw new Exception('Missing key(s): ' . implode(', ', $missing_required_keys));
        }
        
        $trail_code = $trail_entry_data[TrailEntry::KEY__TRAIL_CODE];
        $trail_entry_id = $trail_entry_data[TrailEntry::KEY__TRAIL_N];
        
        if (array_key_exists(self::TEXT_KEY, $trail_entry_data) &&
            ! is_null($trail_entry_data[self::TEXT_KEY]) &&
            trim($trail_entry_data[self::TEXT_KEY])) {
                // Text TrailEntry
                return new TrailEntryText($trail_code, $trail_entry_id, $trail_entry_data, $parent_trail);
        } else {
                // Image Trail Entry
                return new TrailEntryImage($trail_code, $trail_entry_id, $trail_entry_data, $parent_trail);
        }

        
        var_dump($trail_entry_data);
        throw new Exception('Did not manage to create a Text _or_ an Image Trail Entry for some reason.');
        
    }
    
    
    
}

