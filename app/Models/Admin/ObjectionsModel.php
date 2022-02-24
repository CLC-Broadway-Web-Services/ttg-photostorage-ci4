<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ObjectionsModel extends Model
{
    protected $table            = 'ttg_objections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'userid',
        'crn',
        'files',
        'description',
        'c_description',
        'filen',
        'descn',
        'time',
        'uid',
        'sid',
        'verifyStatus',
        'readunread',
        'userverify',
        'userType',
        'senderImg',
        'UserObID',
        'rcid',
        'objectionContent',
        'objectionRecords',
        'datetimes',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function performance_report(){
        return $this->findAll();
    }
}
