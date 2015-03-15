<?php

namespace Rest\Encoder;

class Html extends \Rest\Encoder
{
	public function __construct($contentType = null) {
		if (!isset($contentType)) $contentType = 'text/html';
		$this->setContentType($contentType);
	}
	
	public function pass($data) {
		$result = '';
		throw new \Exception("Not implemented");
		return $result;
	}
}