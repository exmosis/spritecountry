<?php

namespace Exmosis\SpriteCountry\HTML;

class Header {

	const HEADER_PREFIX = 'Sprite Country: ';

	private $title;

	public function __construct(String $title) {
		$this->title = $title;
	}

	public function getHtml() {
		
		$header_text = '
<!DOCTYPE HTML>
<html>
	<head>
		<title>' . Header::HEADER_PREFIX . $this->title . '</title>
		<link rel="stylesheet" href="/css/spritecountry.css">
	</head>
	<body>
		' . $this->getHeaderMenu() . '
		';		
		
		return $header_text;		
		
	}
	
	private function getHeaderMenu() {
		return '
		<div></div>
		';	
	}

}

