<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Login extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	use ResponseTrait;
	public function index()
	{
		//
		helper(['form']);
		$rules = [
			'email' => 'required|valid_email',
			'password' => 'required|min_length[6]',
		];
		if(!$this->validate($rules)){
			$this->fail($this->validator->getErrors());
		}
		$model = new UserModel();

		$user = $model -> where("email", $this->request->getVar('email'))->first();
		if(!$user){
			return $this->failNotFound('email tidak terdaftar');
		}

		$verification = password_verify($this->request->getVar('password'), $user['password']);
		if(!$verification){
			return $this->fail('password tidak cocok');
		}

		$key = getenv('TOKEN_SECRET');
		$payload = array(
			"iat" => 1356999524,
			"nbf" => 1357000000,
			"uid" => $user['id'],
			"email" => $user['email']
		);

		$jwttoken = JWT::encode($payload, $key);
		// $decoded = JWT::decode($jwttoken, $key, array('HS256'));


		return $this->respond($jwttoken);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{
		//
	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		//
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		//
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		//
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		//
	}
}
