<?php

abstract class Model
{
	private $_options;
	private $_data;
	
	public function __construct($data = null, $options = null) {
		
		$this->_data = $data;
		$this->_options = $options;
		
	}
	public function options($options = null) {
		if (isset($options)) {
			$this->_options = $options;
			return $this;
		} else {
			return $this->_options;
		}
	}
	
	public function option($key, $value = null) {
		if (isset($value)) {
			// Set
			$this->_options[$key] = $value;
			return $this;
		} else {
			// Get
			return isset($this->_options[$key]) ? $this->_options[$key] : null;
 		}
	}
	
	public function data($data = null) {
		if (isset($data)) {
			$this->_data = $data;
			return $this;
		} else {
			return $this->_data;
		}
	}
	
	abstract function Get();
	
	abstract function Put();
	
	abstract function Post();
	
	abstract function Delete();
}