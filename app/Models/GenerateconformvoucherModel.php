<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateconformvoucherModel extends Model
{
    protected $table            = 'tbl_confirm_offer_voucher';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'created_at',
        'updated_at',
        'book_id',
        'id',
        'confirm_by',
        'ms_num',
        'name',
        'email',
        'mobile',
        'destination',
        'property_name',
        'location',
        'contact_num',
        'no_of_room',
        'room_type',
        'includes',
        'adults',
        'kids',
        'check_in',
        'check_out',
        'check_in_time',
        'check_out_time',
        'cv_num',
        'book_amount',
        'book_through',
        'book_from',
        'company',
        'received_amount',
        'deduction_amount',
        'tbl_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
}
