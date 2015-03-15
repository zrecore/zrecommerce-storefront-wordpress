<?php

namespace Rest;

class Decoder  extends \Rest\Encoder
{
	public function pass($data)
	{
		return $data;
	}
}