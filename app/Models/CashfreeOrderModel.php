<?php

namespace App\Models;
use CodeIgniter\Model;

class CashfreeOrderModel extends Model
{
    protected $table      = 'tbl_cashfree_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 'customer_name', 'customer_email', 'customer_phone', 'amount', 'status', 'payment_id', 'type'
    ];
    protected $useTimestamps = true;
}
