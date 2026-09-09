<?php

namespace App\Models;

use CodeIgniter\Model;

class HolidayModel extends Model
{
    protected $table = 'tbl_holiday'; // Change this to your actual table name
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mem_ms_num',
        'night',
        'day',
        'other',
        'v_from',
        'v_to',
        'location',
        'hotel',
        'book_date',
        'status',
        'company',
        'booked_day',
        'booked_night',
        'created_at',
        'updated_at',
        'remaining_night',
        'remaining_day'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    // Get holidays by membership number

}
