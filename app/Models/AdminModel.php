<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'official';
    protected $allowedFields = ['username', 'password', 'role'];

    public function authenticate($username, $password)
    {
        return $this->where('username', $username)
                    ->where('password', $password)
                    ->first();
    }
}
