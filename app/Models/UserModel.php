<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   protected $table = 'user';
   protected $primaryKey = 'id';
   protected $allowedFields = ['username', 'password', 'avatar', 'salt', 'created_by', 'created_date', 'updated_by', 'updated_date'];
   protected $returnType = 'App\Entities\User';
   protected $useTimestamps = false;
}