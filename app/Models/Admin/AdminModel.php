<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'ttg_login';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'name',
        'email',
        'pass',
        'type',
        'firstname',
        'lastname',
        'token',
        'time',
        'country',
        'mobile',
        'crn_status',
        'device',
        'profile_pic',
        'status',
        'creator_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'     => 'required|alpha_numeric_space|min_length[3]',
        'email'        => 'required|valid_email|is_unique[ttg_login.email]',
        'mobile'        => 'required|is_unique[ttg_login.mobile]',
        'country'        => 'required',
        'password'     => 'required|min_length[8]'
    ];
    protected $validationMessages   = [
        'email'        => [
            'is_unique' => 'That email has already been taken.',
        ],
        'mobile'        => [
            'is_unique' => 'That mobile has already been taken.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function manage_client()
    {
        return $this->findAll();
    }
}
