<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateinvoiceModel extends Model
{
    protected $table            = 'tbl_invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'created_on',
        'updated_on',
        'created_by',
        'receipt_num',
        'gen_date',
        'subsidiary_id',
        'branch_id',
        'mem_ms_num',
        'mem_name',
        'mem_email',
        'mem_address',
        'mode',
        'bank',
        'card_num',
        'payment_type',
        'amount',
        'tid',
        'mngr_id',
        'salep_id',
        'detail',
        'status',
        'company'
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
