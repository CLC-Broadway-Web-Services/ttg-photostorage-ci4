<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ManageShipmentModel extends Model
{
    protected $table            = 'ttg_ship';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        	
        'files',
        'description',		
        'time',	
        'device',	
        'ship_time',	
        'input_time',	
        'logistic_company',	
        'vahicle_type',	
        'vahicle_container',
        'vahicle_number',	
        'box_condition',	
        'supervisor_name',	
        'supervisor_photo',		
        'supervisor_sign',	
        'note',	
        'hash',	
        'date',		
        'no_of_staff',	
        'no_of_box',	
        'no_of_pallets',	
        'no_of_devices',	
        'no_of_vahicle',	
        'supervisor_ph_no',	
        'is_reject',
        'declr_tick',	
        'org_ship_time',	
        'box_seal',	
        'logistic_waybill',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

public function get_shipment_data(){
    return $this->findAll();
}

}
