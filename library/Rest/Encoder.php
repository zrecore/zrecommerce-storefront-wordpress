<?php

namespace Rest;

class Encoder
{
	protected $_contentType;
	
	public function __construct($contentType = null) {
		$this->_contentType = $contentType;
	}
	public function getContentType() {return $this->_contentType;}
	public function setContentType($value) {$this->_contentType = $value; return $this;}
	
	public function pass($data) {
		return (array) $data;
	}
}