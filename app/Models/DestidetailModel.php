<?php

namespace App\Models;

use CodeIgniter\Model;

class DestidetailModel extends Model
{
    protected $table            = 'tbl_desti_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Allowed fields for insert/update
    protected $allowedFields    = ['desti_id', 'title', 'slug', 'image', 'detail', 'status'];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'desti_id'  => 'required|integer',
        'title'     => 'required|string|max_length[255]',
        'slug'      => 'required|string|max_length[255]|is_unique[tbl_desti_detail.slug,id,{id}]',
        'image'     => 'permit_empty|string|max_length[255]',
        'detail'    => 'permit_empty|string',
        'status'    => 'required|integer|in_list[0,1]', // 0 = inactive, 1 = active
    ];

    protected $validationMessages = [
        'slug' => ['is_unique' => 'The slug must be unique.'],
    ];

    protected $skipValidation = false;

    // Enable callbacks for automatic timestamp handling
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setTimestamps'];
    protected $beforeUpdate   = ['setTimestamps'];

    // Automatically set timestamps before insert/update
    protected function setTimestamps(array $data)
    {
        $currentTime = date('Y-m-d H:i:s');
        if (isset($data['data'])) {
            $data['data']['updated_at'] = $currentTime;
            if (isset($data['data']['created_at']) === false) {
                $data['data']['created_at'] = $currentTime;
            }
        }
        return $data;
    }
}
