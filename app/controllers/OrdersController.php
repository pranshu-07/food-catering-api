<?php

class OrdersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /orders
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::where('user_id', Auth::user()->id)->get();
		foreach($orders as $key=>$i){
			$i->items = OrderMetadata::where('order_id', $i->id)->get();
		}
		return $orders;
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /orders/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /orders
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Input::has('items')){
			throw new Dingo\Api\Exception\ResourceException("Items feild is required."); 
		}
		if(!Input::get('address')){
			throw new Dingo\Api\Exception\ResourceException("Address feild is required."); 
		}
		$items = json_decode(Input::get('items'));
		foreach($items as $key=>$i){
			if(Item::find($i->item_id) == null){
				throw new Dingo\Api\Exception\ResourceException("Error in items feild");
			}
			if(!is_int($i->quantity) || !is_int($i->quantity)){
				throw new Dingo\Api\Exception\ResourceException("Price and Quantity should be in integer."); 
			}
		}
		$order = Order::create(array('user_id', Auth::user()->id, 'address'=>Input::get('address')));
		$price = 0;
		foreach($items as $key=>$i){
			$item = Item::find($i->item_id);
			$this_price = $item->price * $i->quantity;
			$price = $price + $this_price;
			OrderMetadata::create(array(
					'order_id'=> $order->id,
					'item_id'=>$i->item_id,
					'quantity'=>$i->quantity
				));
		}
		$order->amount = $price;
		$order->save();
		return 'Order Placed. ID is ' . $order->id . '. Total Charge: ' . $price;
	}

	/**
	 * Display the specified resource.
	 * GET /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order = Order::find($id);
		if($order == null){
			throw new Dingo\Api\Exception\DeleteResourceFailedException('Order not found');
		}
		if($order->user_id != Auth::user()->id){
			throw new Dingo\Api\Exception\DeleteResourceFailedException('Unauthorized Order');
		}
		$order->items = OrderMetadata::where('order_id', $i->id)->get();
		return $order;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /orders/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$order = Order::find($id);
		if($order == null){
			throw new Dingo\Api\Exception\DeleteResourceFailedException('Order not found');
		}
		if($order->user_id != Auth::user()->id){
			throw new Dingo\Api\Exception\DeleteResourceFailedException('Unauthorized Order');
		}
		$order->delete();
		return 1;
	}

}