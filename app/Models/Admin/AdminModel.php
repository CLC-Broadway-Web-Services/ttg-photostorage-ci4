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
    // protected $validationRules      = [
    //     'name'     => 'alpha_numeric_space|min_length[3]',
    //     'email'        => 'valid_email|is_unique[ttg_login.email]',
    //     'mobile'        => 'is_unique[ttg_login.mobile]',
    //     'password'     => 'min_length[8]'
    // ];
    // protected $validationMessages   = [
    //     'email'        => [
    //         'is_unique' => 'That email has already been taken.',
    //     ],
    //     'mobile'        => [
    //         'is_unique' => 'That mobile has already been taken.',
    //     ],
    // ];
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

    // public function manage_client()
    // {
    //     return $this->findAll();
    // }

    public function getCurrentUser()
    {
        return $this->find(session()->get('user.id'));
    }

    public function createPasswordUpdate($id = 0)
    {
        $passwordMd = new ChangePasswordModel();
        $userId = $id != 0 ? $id : session()->get('user.id');
        return $passwordMd->save(['userid' => $userId]);
    }

    public function getLastPasswordUpdate($id = 0)
    {
        $passwordMd = new ChangePasswordModel();
        $userId = $id != 0 ? $id : session()->get('user.id');
        return $passwordMd->where('userid', $userId)->orderBy('id', 'desc')->first();
    }
    // public function createPasswordUpdateForUser($id)
    // {
    //     $passwordMd = new ChangePasswordModel();
    //     return $passwordMd->save(['userid' => $id]);
    // }

    public function createDeveloperAccount()
    {
        $devData = [
            'name' => DEV_NAME,
            'pass' => passwordHash(DEV_PASS),
            'email' => DEV_EMAIL,
            'type' => DEV_TYPE,
            'time' => DEV_TIME,
            'country' => DEV_COUNTRY,
            'mobile' => DEV_MOBILE,
            'crn_status' => DEV_CRN,
            'status' => DEV_STATUS,
        ];
        return $this->save($devData);
    }
}
