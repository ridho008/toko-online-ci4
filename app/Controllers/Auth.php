<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
   public function __construct()
   {
      helper('form');
      $this->validation = \Config\Services::validation();
      $this->session = session();
      $this->userModel = new UserModel();
   }

	public function index()
	{
      if($this->request->getPost())
      {
         $field = $this->request->getPost();
         $validate = $this->validation->run($field, 'login');
         $errors = $this->validation->getErrors();

         // Jika ada input error
         if($errors) {
            $this->session->setFlashdata('errors', $errors);
            return redirect()->to('/auth');
         }

         $username = $this->request->getPost('username');
         $password = $this->request->getPost('password');

         $user = $this->userModel->where('username', $username)->first();
         // Jika usernya ada
         if($user != null) {
            $salt = $user->salt;
            // jika password yang di ketik tidak sama di masukan user
            if($user->password != md5($salt.$password)) {
               $this->session->setFlashdata('errors', ['Password Salah!']);
            } else {
               // jika password benar
               $sessData = [
                  'username' => $user->username,
                  'id' => $user->id,
                  'role' => $user->role,
                  'isLoggedIn' => TRUE,
               ];

               $this->session->set($sessData);
               return redirect()->to('/');
            }
         } else {
            $this->session->setFlashdata('errors', ['Username/Password Salah!']);
            return redirect()->to('/auth');
         }
      }

      $data = [
         'title' => 'Halaman Login'
      ];
		return view('auth/login', $data);
	}

   public function register()
   {
      if($this->request->getPost()) {
         $field = $this->request->getPost();
         $validate = $this->validation->run($field, 'register');
         $errors = $this->validation->getErrors();

         // jika semua form terisi
         if(!$errors) {
            $userModel = $this->userModel = new UserModel();
            $user = new \App\Entities\User();
            $user->username = $this->request->getPost('username');
            $user->password = $this->request->getPost('password');

            $user->created_by = 0;
            $user->created_date = date('Y-m-d H:i:s');

            $userModel->save($user);
            return redirect()->to('/auth');
         }

         $this->session->setFlashdata('errors', $errors);

      }
      $data = [
         'title' => 'Halaman Register'
      ];
      return view('auth/register', $data);
   }

   public function logout()
   {
      $this->session->destroy();
      return redirect()->to('/auth');
   }

	//--------------------------------------------------------------------

}
