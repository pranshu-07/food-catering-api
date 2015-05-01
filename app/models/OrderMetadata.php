<?php

class OrderMetadata extends \Eloquent {

	protected $table = 'ordermetadatas';
	protected $fillable = ['order_id', 'item_id', 'quantity'];
}