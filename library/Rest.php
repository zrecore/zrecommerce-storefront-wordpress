<?php
/**
 * @author ZRECommerce LLC
 * @license GNU GPL v3 or higher.
 */

require_once('Rest/Exception.php');
require_once('Rest/Encoder.php');
require_once('Rest/Decoder.php');
require_once('Rest/Encoder/Html.php');
require_once('Rest/Encoder/Json.php');
require_once('Rest/Decoder/Html.php');
require_once('Rest/Decoder/Json.php');

class Rest {

	protected $_url;
	protected $_lastHttpResponseCode;
	protected $_lastHttpResponse;
	protected $_lastInfo;
	protected $_headers;
	
	protected $_username;
	protected $_password;
	
	/**
	 *
	 * @var \Rest\Encoder
	 */
	protected $_encoder;
	/**
	 *
	 * @var \Rest\Decoder
	 */
	protected $_decoder;
	
	public function __construct($url, $encoder = null, $decoder = null) {
		$this->setUrl($url);
		
		if (empty($encoder) || !$encoder instanceof \Rest\Encoder) $encoder = new \Rest\Encoder\Json;
		if (empty($decoder) || !$decoder instanceof \Rest\Decoder) $decoder = new \Rest\Decoder\Json;
		
		$this->setEncoder($encoder);
		$this->setDecoder($decoder);
	}
	
	public function getLastHttpResponseCode() {return $this->_lastHttpResponseCode;}
	public function setLastHttpResponseCode($value) {$this->_lastHttpResponseCode = $value; return $this;}
	
	public function getLastHttpResponse() {return $this->_lastHttpResponse;}
	public function setLastHttpResponse($value) {$this->_lastHttpResponse = $value; return $this;}
	
	public function getLastInfo() {return $this->_lastInfo;}
	
	public function getUrl() {return $this->_url;}
	public function setUrl($value) {$this->_url = $value; return $this;}
	public function setHttpAuth($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}
	
	/**
	 * 
	 * @return \Rest\Encoder
	 */
	public function getEncoder() {return $this->_encoder;}
	/**
	 * 
	 * @return \Rest\Decoder
	 */
	public function getDecoder() {return $this->_decoder;}
	/**
	 * Get the list of additional HTTP headers.
	 * @return array
	 */
	public function getHeaders() { return $this->_headers; }
	
	/**
	 * Set the data encoder.
	 * @param \Rest\Encoder $value
	 * @return \Rest
	 */
	public function setEncoder($value) {$this->_encoder = $value; return $this;}
	/**
	 * Set the data decoder.
	 * @param \Rest\Decoder $value
	 * @return \Rest
	 */
	public function setDecoder($value) {$this->_decoder = $value; return $this;}
	/**
	 * Set the list additional HTTP headers.
	 * @param array $value
	 * @return \Rest
	 */
	public function setHeaders($value) {$this->_headers = $value; return $this;}
	
	public function call($options = null) {
		
		$ch = curl_init();

		if (!empty($options)) {
			foreach($options as $k => $o) {
				curl_setopt($ch, $k, $o);
			}
		}
		
		$result = trim(curl_exec($ch));
		$info = curl_getinfo($ch);
		$this->_lastInfo = $info;
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$this->setLastHttpResponseCode($status);
		$this->setLastHttpResponse($result);
		
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			error_log(print_r($error, 1));
			throw new \Rest\Exception($error);
		}
		
		curl_close($ch);
		
		return $this->getDecoder()->pass($result);
	}
	
	public function get($data = null, $options = null) {
		$ch = curl_init( $this->getUrl() . (!empty($data) && is_array($data) ?  '?' . $this->toNVP($data) : ''));
		$this->_addHeaders($ch);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // @TODO STUB: Enable SSL verification!
		// @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, preg_match('/^(https\:\/\/api\.femtoduino\.com|https\:\/\/apistaging\.femtoduino\.com)/i', $this->getUrl()) ? 0: 1); // @todo fix this to use 2, force verify
		
		if (is_array($options)) {
			foreach($options as $k => $o) {
				curl_setopt($ch, $k, $o);
			}
		}
		
		$result = trim(curl_exec($ch));
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$this->setLastHttpResponseCode($status);
		$this->setLastHttpResponse($result);
		$errno = curl_errno($ch);
		if ($errno) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \Rest\Exception('url(' . $this->getUrl() . '), err no(' . $errno . ') ' . $error);
		}
		
		curl_close($ch);
		return $this->getDecoder()->pass($result);
	}
	
	private function _addHeaders($ch, $headers = array(), $addContentTypeHeaders = true) {
		$headers = array();

		if ($addContentTypeHeaders && $this->getEncoder()->getContentType()) {
			$ct = $this->getEncoder()->getContentType();
			array_merge($headers, array('Accept: ' . $ct, 'Content-Type: ' . $ct ));
		}
		
		$additional_headers = $this->getHeaders();
		$headerCount = count($additional_headers);
		
		if ($headerCount > 0) {
			$headers = array_merge($headers, $additional_headers);
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		if (!empty($this->_username)) {
			curl_setopt($ch, CURLOPT_USERPWD, $this->_username . ':' . $this->_password);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		}
		
		return $headers;
	}
	
	public function post($data, $options = null)
	{
		$ch = curl_init( $this->getUrl() . (!empty($data) && is_array($data) ?  '?' . $this->toNVP($data) : ''));
		
		$this->_addHeaders($ch);
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // @TODO STUB: Enable SSL verification!
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, preg_match('/^(https\:\/\/api\.femtoduino\.com|https\:\/\/apistaging\.femtoduino\.com)/i', $this->getUrl()) ? 0: 1); // @todo fix this to use 2, force verify
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getEncoder()->pass($data));
		
		if (is_array($options)) {
			foreach($options as $k => $o) {
				curl_setopt($ch, $k, $o);
			}
		}
		
		$result = trim(curl_exec($ch));
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$this->setLastHttpResponseCode($status);
		$this->setLastHttpResponse($result);
		
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \Rest\Exception($error);
		}
		
		curl_close($ch);
		return $this->getDecoder()->pass($result);
	}
	/**
	 * @todo See http://stackoverflow.com/questions/3958226/using-put-method-with-php-curl-library
	 * @param array $data
	 * @param array $options
	 * @return mixed
	 * @throws Exception
	 */
	public function put($data, $options = null) {

		$curl_url = $this->getUrl();
		$ch = curl_init( $curl_url );
		
		$this->_addHeaders($ch, array(
			'Content-Type: application/json'
		));
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // @TODO STUB: Enable SSL verification!
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, preg_match('/^(https\:\/\/api\.femtoduino\.com|https\:\/\/apistaging\.femtoduino\.com)/i', $this->getUrl()) ? 0: 1); // @todo fix this to use 2, force verify
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		
		if (is_array($options)) {
			foreach($options as $k => $o) {
				curl_setopt($ch, $k, $o);
			}
		}
		
		$result = trim(curl_exec($ch));
		$allInfo = curl_getinfo($ch);
		
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$this->setLastHttpResponseCode($status);
		$this->setLastHttpResponse($result);
		
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \Rest\Exception($error);
		}
		
		curl_close($ch);
		
		return $this->getDecoder()->pass($result);
	}
	
	public function delete($data, $options = null) {
		$curl_url = $this->getUrl();
		
		 
//			(!empty($data) &&
//			 is_array($data) && 
//			 (isset($data['id']) && !preg_match('/' . $data['id'] . '$/', $this->getUrl())) ?  
//				'?' . $this->toNVP($data) : 
//				'');
		$data = (array) $data;
		if (!empty($data)) {
			if (isset($data['id']) || isset($data['_id'])) {
				$id = isset($data['id']) ? $data['id'] : $data['_id'];
				if (!preg_match('/\/' . $id . '\/?$/', $curl_url)) {
					$curl_url .= '/' . $id;
					echo "\nCURL URL: $curl_url\n";
				}
			}
			
		}
		
		$ch = curl_init( $curl_url );
		
		$this->_addHeaders($ch);
		
//		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // @TODO STUB: Enable SSL verification!
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, preg_match('/^(https\:\/\/api\.femtoduino\.com|https\:\/\/apistaging\.femtoduino\.com)/i', $this->getUrl()) ? 0: 1); // @todo fix this to use 2, force verify
//		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getEncoder()->pass($data));
		
		if (is_array($options)) {
			foreach($options as $k => $o) {
				curl_setopt($ch, $k, $o);
			}
		}
		
		$result = trim(curl_exec($ch));
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		$this->setLastHttpResponseCode($status);
		$this->setLastHttpResponse($result);
		
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new \Rest\Exception($error);
		}
		
		curl_close($ch);
		
		return $this->getDecoder()->pass($result);
	}
	
	/**
	* Parse a Name-Value Pair response into an object.
	* @param string $response
	* @return array Returns an array representation of the response.
	*/
	public static function parseNVP($response) {
		$result = null;
		parse_str($response, $result);

		if (empty($result)) {
			$result = null;
		}

		return $result;
	}
	/**
	 * Convert to a URL-encoded string.
	 * @param type $data
	 * @return type
	 */
	public static function toNVP($data) {
		return http_build_query($data);
	}
}