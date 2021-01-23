<?php namespace App\Controllers;

class User extends BaseController
{
   public function __construct()
   {
      $this->session = session();
   }

	public function index()
	{
      $userModel = new \App\Models\UserModel();
		return view('user/index', [
         'title' => 'User',
         'model' => $userModel->paginate(5),
         'pager' => $userModel->pager
      ]);
	}

	//--------------------------------------------------------------------

}
