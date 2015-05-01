<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		return Auth::user();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$validation = Validator::make(
							array('email' => $email, 'password' => $password),
							array('email' => 'required|unique:users|email', 'password' => 'required|alpha_num|between:4,20')
						);
		if($validation->fails()){
			throw new Dingo\Api\Exception\ResourceException($validation->messages()->first());
		}
		if(User::where('email', $email)->exists()){
			throw new Dingo\Api\Exception\ResourceException("Email already exists");
		}
		$user = User::create(array(
				'email'=>$email,
				'password'=>Hash::make($password), 
				'lname'=> Input::get('lname'),
				'fname'=>Input::get('fname')
				));
		return $user->api_key;
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
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
	 * GET /users/{id}/edit
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
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::where('email', Input::get('email'))->first();
		$user->fname = Input::get('fname');
		$user->lname = Input::get('lname');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('new_password'));
		$user->save();
		return 1;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($id != Auth::user()->id){
			throw new Dingo\Api\Exception\DeleteResourceFailedException('Not Authorized');
		}
		User::destroy(Auth::user()->id);
		return 1;
	}

	public function getApiKey(){
		$user = array('email'=>Input::get('email'),'password'=>Input::get('password'));
		if (Auth::attempt($user)) {
			return Auth::user()->api_key;
		} else {
			throw new Dingo\Api\Exception\ResourceException("Email or Password Does not match");
		}
	}

}