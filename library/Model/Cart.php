<?php
namespace Model;

class CartException extends \Exception {};
class Cart extends \Model\Rest {
	
	private static $_cart = array();
	private static $_validProperties = array(
		'item_id',
		'quantity',
		'properties',
		
		'_id',
		'name',
		'slug',
		'sku',
		'price',
		'currency_id',
	);
	
	private static $_unmutableProperties = array(
		'item_id',
		'_id',
		'sku',
		'price'
	);
	
	public function __construct($data = null, $options = null) {
		parent::__construct($data, $options);
		
		$cart = \Session::getNs('cart', array());
		
		if (!empty($cart)) {
			
			self::$_cart = $cart;
		}
		//$this->restURL( APP_URL . '/api/cart' );
	}
	
	public function findByQuery($query) {
		$key = array_shift(array_keys($query));
		$value = $query[$key];
		$results = array();
		
		if (!empty(self::$_cart)) {
			foreach(self::$_cart as $row) {
				if ($row[$key] == $value) {
					$results[] = $row;
				}
			}
		}
		
		return $results;
	}
	
	public function findOneByQuery($query) {
		$key = array_shift(array_keys($query));
		$value = $query[$key];
		
		if (!empty(self::$_cart)) {
			foreach(self::$_cart as $row) {
				if ($row[$key] == $value) {
					return $row;
				}
			}
		}
	}
	
	public function Get() {
		$result = null;
		
		try {
			
			// List the cart items
			$d = $this->data();
			

			$document = array();

			if (!empty($d['id'])) { // id, as in the cart item pseudo ID, not the _id attribute.
				$id = $d['id'];
				
				foreach(self::$_cart as $i => $item) {
					if ($item['item_id'] == $id) {
						$document = $item;
						break;
					}
				}
				
			} else {
				$document = self::$_cart;
			}
			$this->data($document);
			$result = array(
				'result' => 'ok',
				'data' => $document
			);
		} catch (\Exception $e) {
			
			error_log((string) $e);
			
			$result = array(
				'result' => 'error',
				'message' => $e->getMessage()
			);
		}
		
		return $result;
	}
	
	public function Put() {
		$itm = null;
		$result = null;
		
		try {
			// Save only
//			$r = $this->getRequest();
			$d = $this->data();
			$id = isset($d['id']) ? $d['id'] : null;
			
			$totalTransactions = 0;
			
			if (isset($id)) { // Can be zero...so use isset() instead of !empty()

				// Save
				if (count(self::$_cart) > 0) {
					foreach(self::$_cart as $i => $item) {
						if ($item['item_id'] == $id) {
							
//							$params = $r->getParams();
							$params = $d;
							
							$input = array();
							foreach($params as $k => $p) {
								if (in_array($k, self::$_validProperties) && 
									!in_array($k, self::$_unmutableProperties)) {
									
									$input[$k] = $p;
								}
							}

							$newItem = array_merge($item, $input);
							
							// Load the model, do some validation.
							$rest = new \Model\Rest(
								null, 
								array(
									'restURL' => API_URL . '/item',
									'query' => array(
										'_id' => $params['_id']
									)
								)
							);

							$itemData = $rest->Get();
							$itm = $itemData->data[0];
							
							if ($itm->is_finite && (int)$itm->finite_amount_available < $input['quantity']) {
								$itm->quantity = $itm->finite_amount_available;
								throw new \Model\CartException('The quantity requested (' . ((int) $input['quantity']) . ') exceeds the quantity available (' . $itm->finite_amount_available . ')');
							} else {
							
								self::$_cart[$i] = $newItem;
								++$totalTransactions;
							}
						}
					}
				}
			}
			
			\Session::setNs('cart', self::$_cart);
			
			$result = array(
				'result' => 'ok',
				'message' => 'saved',
				'data' => $totalTransactions,

			);
		} catch (\Model\CartException $ce) {
			$result = array(
				'result' => 'error',
				'type' => 'validation',
				'message' => $ce->getMessage(),
				'data' => $itm
			);
		} catch (\Exception $e) {
			error_log((string)$e);
			$result = array(
				'result' => 'error',
				'message' => $e->getMessage()
			);
		}
		
		return $result;
	}
	
	public function Post() {
		$itm = null;
		$result = null;
		
		try {
			// Create or Save
//			$r = $this->getRequest();
			$d = $this->data();
			$id = isset($d['id']) ? $d['id'] : null;

			if (!empty($id)) {
				$totalTransactions = 0;
				// Save
				if (count(self::$_cart) > 0) {
					foreach(self::$_cart as $i => $item) {
						if ($item['item_id'] == $id) {

							$params = $d;
							$input = array();
							foreach($params as $k => $p) {
								if (in_array($k, self::$_validProperties) && 
									!in_array($k, self::$_unmutableProperties)) {
									$input[$k] = $p;
								}
							}

							$newItem = array_merge($item, $input);

							self::$_cart[$i] = $newItem;
							++$totalTransactions;
						}
					}
				}

				$result = array(
					'result' => 'ok',
					'message' => 'saved',
					'data' => $totalTransactions,

				);
			} else {
				// Create
				$params = $d;//$r->getParams();
				
				$input = array();
				
				foreach($params as $k => $p) {
					
					if (in_array($k, self::$_validProperties) && !in_array($k, self::$_unmutableProperties)) {
						$input[$k] = $p;
					}
				}
				// Load the model, merge whatever we can.
				$rest = new \Model\Rest(
					null, 
					array(
						'restURL' => API_URL . '/item',
						'query' => array(
							'_id' => $params['_id']
						)
					)
				);
				
				$itemData = $rest->Get();
				$itm = $itemData->data[0];
				
				$newItem = array_merge((array)$itm, $input);
				
				$newId = $this->getNewId();
				$newItem['item_id'] = $newId;
				
				// If its finite, check the amount available first!
				if ($itm->is_finite && (int)$itm->finite_amount_available < (int)$input['quantity']) {
					$itm->quantity = $itm->finite_amount_available;
					throw new \Model\CartException('The quantity requested (' . ((int) $input['quantity']) . ') exceeds the quantity available (' . $itm->finite_amount_available . ')');
				} else {
					self::$_cart[] = $newItem;

					$result = array(
						'result' => 'ok',
						'message' => 'created',
						'data' => $newItem,

					);
				}
			}
			
			\Session::setNs('cart', self::$_cart);
		} catch (\Model\CartException $ce) {
			$result = array(
				'result' => 'error',
				'type' => 'validation',
				'message' => $ce->getMessage(),
				'data' => $itm
			);
		} catch (\Exception $e) {
			error_log((string)$e);
			$result = array(
				'result' => 'error',
				'message' => $e->getMessage()
			);
		}
		
		return $result;
	}
	
	public function Delete() {
		$result = null;
		try {
			// Remove
//			$r = $this->getRequest();
			$d = $this->data();
			$id = isset($d['id']) ? $d['id'] : null;//$r->getParam('id');
			$totalDeleted = 0;
			
			if (isset($id)) { // Could be a zero, so we use isset() instead.


				if (count(self::$_cart) > 0) {
					foreach(self::$_cart as $i => $item) {
						
						if ($item['item_id'] == $id) {
							array_splice(self::$_cart, $i, 1);
//							unset(self::$_cart[$i]);
							++$totalDeleted;
						}
					}
				}

				if ($totalDeleted > 0) {
					// Save the changes.
					
					\Session::setNs('cart', self::$_cart);
				}
			}
			
			$result = array(
				'result' => 'ok',
				'data' => (int)$totalDeleted
			);
		} catch (\Exception $e) {
			error_log((string)$e);
			$result = array(
				'result' => 'error',
				'message' => $e->getMessage()
			);
		}
		
		return $result;
	}
	
	private function getNewId() {
		return count(self::$_cart);
	}
}