<?php
namespace Model;

class OrderCoupon extends \Model\Rest {
	public function __construct($data = null, $options = null) {
		parent::__construct($data, $options);
		
		$this->restURL( API_URL . '/order-coupon' );
	}
}