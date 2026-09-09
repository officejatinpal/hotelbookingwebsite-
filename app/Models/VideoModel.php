<?php

namespace App\Models;
use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'tbl_youtube_video';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'video_title',
        'video_url',
        'status'
    ];
}
