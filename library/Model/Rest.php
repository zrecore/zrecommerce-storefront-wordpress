<?php

namespace Model;

defined('API_URL')  || define('API_URL', get_option('zrecore_api_url'));
defined('API_USER') || define('API_USER', get_option('zrecore_api_user'));
defined('API_KEY')  || define('API_KEY', get_option('zrecore_api_key'));

class Rest extends \Model
{
	/**
	 *
	 * @var \Rest
	 */
	private $_rest;
	
	public function __construct($data = null, $options = null) {
		parent::__construct($data, $options);
	}
	
	public function restURL($restURL) {
		
		if (isset($restURL)) {
			parent::option('restURL', $restURL);
			return $this;
		} else {
			return parent::option('restURL');
		}
	}
	
	public function findByQuery($query, $populate = null) {
		$class = get_class($this);
		
		$options = array(
			'query' => $query
		);
		
		if (!empty($populate)) $options['populate'] = $populate;
			
		$m = new $class(null, $options);
		$docs = $m->Get();
		
		return $docs->data;
	}
	
	public function findOneByQuery($query, $populate = null) {
		$docs = $this->findByQuery($query, $populate);
		
		return !empty($docs) ? $docs[0]: null;
	}
	
	public function rest() {
		return $this->_rest;
	}
	
	/**
	 * Get the REST client.
	 * @return \Rest
	 */
	private function _RestClient() {
		
//		if (empty($this->_rest)) {
			$rest = new \Rest(parent::option('restURL'));
			
			$headers = array(
				'API-USER: ' . API_USER,
				'API-KEY: ' . API_KEY,
				'API-VERSION: ' . API_VERSION
			);
			
			if ($this->option('query')) {
				
				$headers[] = 'API-QUERY: ' . (
					is_array($this->option('query')) ?
						json_encode($this->option('query')):
					$this->option('query')
				);
			}
			
			if ($this->option('limit')) {
				$headers[] = 'API-LIMIT: ' . (int) $this->option('limit');
			}
			
			if ($this->option('skip')) {
				$headers[] = 'API-SKIP: ' . (int) $this->option('skip');
			}
			
			if ($this->option('sort') && is_string($this->option('sort'))) {
				$headers[] = 'API-SORT: ' . $this->option('sort');
			}
			
			if ($this->option('populate')) {
				$headers[] = 'API-POPULATE: ' . (
					is_array($this->option('populate')) ? 
						json_encode($this->option('populate')): 
						$this->option('populate') 
				);
			}
			
			$rest->setHeaders($headers);
			
			$this->_rest = $rest;
//		}
		
		return $this->_rest;
	}
	
	public function Get() {
		return $this->_RestClient()->get($this->data());
	}
	
	public function Put() {
		return $this->_RestClient()->put($this->data());
	}
	
	public function Post() {
		return $this->_RestClient()->post($this->data());
	}
	
	public function Delete() {
		return $this->_RestClient()->delete($this->data());
	}
}