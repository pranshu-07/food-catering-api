<?php

class Order extends \Eloquent {
	protected $fillable = ['delivery_time', 'address', 'amount'];

	public function price(){
		dd($this);
	}
}