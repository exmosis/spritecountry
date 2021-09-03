<?php

namespace Exmosis\SpriteCountry\Data;

use \League\Csv\Reader;

class SpriteCountryTrailData {

	// This class defines the headers to be used in the CSV, as single source of truth.
	const FIELD__TRAIL = 'trail_code';
	const FIELD__NAME = 'name';
	const FIELD__GAME = 'game';
	const FIELD__DEVELOPER = 'developer';
	const FIELD__PUBLISHER = 'publisher';	
	const FIELD__URL = 'url';

	private $data_file;
	private $data;
	private $reader;

	public function __construct(String $data_file) {
		if ($this->dataFileLooksOk($data_file)) {
			$this->data_file = $data_file;
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
		$this->reader = Reader::createFromPath($this->data_file, 'r');
		$this->reader->setHeaderOffset(0);
	}
	
	public function getData(String $trail_code = null) {
		$records = $this->reader->getRecords();

		$trail_data = array();
		foreach ($records as $offset => $record) {
			if (is_null($trail_code) || 
					(array_key_exists(SpriteCountryTrailData::FIELD__TRAIL, $record) && $record[SpriteCountryTrailData::FIELD__TRAIL] == $trail_code)
					) {
						array_push($trail_data, $record);
			}
		}
		
		return $trail_data;
	}
	
	public function getShuffledTrails() {
		$data_copy = $this->getData();
		shuffle($data_copy);
		return $data_copy;
	}
	

}
