<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
      $faker = \Faker\Factory::create();
      for ($i=1; $i < 10; $i++) { 
         $data = [
                  'username' => $faker->userName,
                  'password'    => $faker->password,
                  'salt'    => $faker->password,
                  'avatar'    => null,
                  'role'    => 1,
                  'created_by'    => 0,
                  'created_date'    => date('Y-m-d H:i:s'),
          ];

          // Using Query Builder
          $this->db->table('user')->insert($data);
      }
		
	}
}
