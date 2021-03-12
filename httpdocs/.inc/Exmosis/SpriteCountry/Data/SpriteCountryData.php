<?php

namespace Exmosis\SpriteCountry\Data;

use \League\Csv\Reader;

class SpriteCountryData {

	const FIELD__TRAIL = 'trail_code';
	const FIELD__SIGNS = 'signs';

	private $trail_data_file;
	private $data;
	private $reader;

	public function __construct(String $trail_data_file) {
		if ($this->dataFileLooksOk($trail_data_file)) {
			$this->trail_data_file = $trail_data_file;
		} else {
			throw new \Exception('Data file does not look accessible');
		}
	}

	private function dataFileLooksOk(String $data_file) {
		if (! file_exists($data_file)) {
			return false;
		}
		
		return true;
	}

	public function load() {
		$this->reader = Reader::createFromPath($this->trail_data_file, 'r');
		$this->reader->setHeaderOffset(0);
	}
	
	/**
	 * Gets trail data as a PHP array
	 **/
	public function getTrailData(String $trail_code = null) {
		$records = $this->reader->getRecords();

		$trail_data = array();
		foreach ($records as $offset => $record) {
			if (is_null($trail_code) || 
					(array_key_exists(SpriteCountryData::FIELD__TRAIL, $record) && $record[SpriteCountryData::FIELD__TRAIL] == $trail_code)
					) {
						array_push($trail_data, $record);
			}
		}
		
		return $trail_data;
	}
	
	public function getSignData(String $sign = null) {
		$records = $this->reader->getRecords();
		
		$sign_data = array();
		foreach ($records as $offset => $record) {
			if (is_null($sign) || 
					(array_key_exists(SpriteCountryData::FIELD__SIGNS, $record) && 
						strpos(',' . $record[SpriteCountryData::FIELD__SIGNS] . ',', ',' . $sign . ',') !== false)
					) {
						array_push($sign_data, $record);
			}
		}
		
		return $sign_data;

	}

}
