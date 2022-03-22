<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ChangePasswordModel extends Model
{
    protected $table            = 'password_updates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'userid'
    ];

    // public function createUpdate()
    // {
    //     $id = session()->get('user.id');
    //     return $this->save(['userid' => $id]);
    // }
    // public function createUpdateForUser($id)
    // {
    //     return $this->save(['userid' => $id]);
    // }
}
