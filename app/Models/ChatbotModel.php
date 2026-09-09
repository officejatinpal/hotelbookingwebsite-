<?php

namespace App\Models;
use CodeIgniter\Model;

class ChatbotModel extends Model
{
    protected $table = 'chatbot';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keywords', 'answer'];
}