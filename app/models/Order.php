<?php

class Order extends \Eloquent {

	use SoftDeletingTrait;
	
	protected $fillable = ['delivery_time', 'address', 'amount'];
}