<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CrnModel extends Model
{
    protected $table            = 'ttg_crn';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'crn',
        'userid',
        'time',
        'name',
        'detail1',
        'detail2',
        'created_at'
    ];

    // // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

}
