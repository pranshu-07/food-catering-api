<?php

class ItemsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /items
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /items/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /items
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Input::has('title')){
			throw new Dingo\Api\Exception\ResourceException("Title feild is required."); 
		}
		if(!Input::has('price')){
			throw new Dingo\Api\Exception\ResourceException("Price feild is required."); 
		}
		if(!is_int(Input::get('price'))){
			throw new Dingo\Api\Exception\ResourceException("Check Price datatype."); 
		}
		$title = Input::get('title');
		$description = Input::get('description');
		$price = Input::get('price');
		$item = Item::create(array('title'=>$title, 'description'=>$description, 'price'=>$price));
		return $item;
	}

	/**
	 * Display the specified resource.
	 * GET /items/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /items/{id}/edit
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
	 * PUT /items/{id}
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
	 * DELETE /items/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}