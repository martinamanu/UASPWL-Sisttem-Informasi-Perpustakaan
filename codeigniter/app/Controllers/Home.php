<?php

namespace App\Controllers;

use App\Models\Auth;

class Home extends BaseController
{
	public function index()
	{
		$data["title"] = "Home";
		$data["home_active"] = true;
		$session = \Config\Services::session();
		$data["session"] = $session;
		if ($session->has("token")) {
			$user = new Auth();
			$token = $session->get("token");
			// dd($user->getUserFromToken($token));
			$data["user"] = array(
				"email" => $user->getUserFromToken($token)->email,
				"nama" => $user->getUserFromToken($token)->name,
				"token" => $user->getUserFromToken($token)->api_token,
			);
			echo view("layout/head", $data);
			echo view('awal', $data);
			echo view("layout/footer");
		} else {
			// $data["token"] = "";
			echo view("layout/head", $data);
			echo view('awal', $data);
			echo view("layout/footer");
		};
	}

	//--------------------------------------------------------------------

}
