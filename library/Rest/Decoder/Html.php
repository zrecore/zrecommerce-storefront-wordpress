<?php

namespace Rest\Decoder;

class Html extends \Rest\Decoder
{
	public function __construct($contentType = null) {
		if (!isset($contentType)) $contentType = 'text/html';
		$this->setContentType($contentType);
	}
	public function pass($data) {
		$result = ($data);
		return $result;
	}
}