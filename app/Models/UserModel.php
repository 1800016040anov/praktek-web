<?php

namespace App\Models;

use App\Controllers\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['user_id', 'slug', 'nama', 'email', 'password'];

    public function getUser($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
    public function getData($email, $password)
    {
        return $this->db->table('user')
            ->where(array('email' => $email, 'password' => $password))
            ->get()->getRowArray();
    }
}
