<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'users';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields = [
        'created_on',
        'updated_on',
        'branch_id',
        'join_date',
        'ms_num',
        'password',
        'en_password', // Add this field
        'name',
        'email',
        'dob',
        'venue',
        'marriage_anniversary',
        'spouse',
        'f_child_name',
        'f_child_age',
        's_child_name',
        's_child_age',
        'last_holiday',
        'ms_category',
        'ms_year', 
        'day_night', 
        'mobile',
        'alt_mobile',
        'address',
        'ms_amount',
        'ms_advance',
        'ms_due',
        'ms_amc',
        'mngr_id', 
        'salep_id',
        'status',
        'exchange_num',
        'subsidiary_id',
        'document',
        'comment',
        'api_token'
    ];
    
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_on';
    protected $updatedField         = 'updated_on';
    protected $deletedField         = 'deleted_at';
 
    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
 
    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
    

    }