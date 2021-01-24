<?php namespace App\Controllers;

class User extends BaseController
{
   public function __construct()
   {
      $this->session = session();
   }

	public function index()
	{
      $currentPage = $this->request->getGet('page_user') ? $this->request->getGet('page_user') : 1;
      $userModel = new \App\Models\UserModel();
		return view('user/index', [
         'title' => 'User',
         'model' => $userModel->paginate(5, 'user'),
         'pager' => $userModel->pager,
         'currentPage' => $currentPage
      ]);
	}

	//--------------------------------------------------------------------

}
