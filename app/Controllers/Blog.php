<?php

namespace App\Controllers;
use App\Models\BlogModel;

class Blog extends BaseController
{

    protected $blogModel;


 public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

public function index()
{
    // Fetch all active blogs, latest first
    $blogs = $this->blogModel
        ->where('status', 1)
        ->orderBy('id', 'DESC') // or use 'created_at' if you have a date field
        ->findAll();

    return view('blog', ['blogs' => $blogs]);
}

    
    public function view($slug)
{
    $blog = $this->blogModel->where('slug', $slug)->first();

    if (!$blog) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog not found');
    }

    return view('blog-view', ['blog' => $blog]);
}

    
}