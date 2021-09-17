<?php

namespace Exmosis\SpriteCountry\Data;

use \League\Csv\Reader;

class SignsData {

	const FIELD__SIGN = 'sign';
	const FIELD__DISPLAY_TEXT = 'display_text';

	private $signs_data_file;
	private $data;
	private $reader;

	public function __construct(String $signs_data_file) {
	    if ($this->dataFileLooksOk($signs_data_file)) {
	        $this->signs_data_file = $signs_data_file;
		} else {
			throw new \Exception('Data file for Signs does not look accessible');
		}
	}

	private function dataFileLooksOk(String $data_file) {
		if (! file_exists($data_file)) {
			return false;
		}
		
		return true;
	}

	public function load() {
	    $this->reader = Reader::createFromPath($this->signs_data_file, 'r');
		$this->reader->setHeaderOffset(0);
	}
	
	/**
	 * Gets signs data as a PHP array
	 **/
	public function getData(String $sign = null) {
		$records = $this->reader->getRecords();

		$sign_data = array();
		foreach ($records as $offset => $record) {
			if (is_null($sign) || 
					(array_key_exists(SignsData::FIELD__SIGN, $record) && $record[SignsData::FIELD__SIGN] == $sign)
					) {
						array_push($sign_data, $record);
			}
		}
		
		return $sign_data;
	}
	
}
