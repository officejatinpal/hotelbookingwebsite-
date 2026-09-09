<?php

namespace App\Controllers;
use App\Models\PackagesModel; 

class Packages extends BaseController
{
    protected $packagesModel;

    public function __construct()
    {
        $this->packagesModel = new PackagesModel();
    }

    public function Packages()
    {
        $packages = $this->packagesModel->where('status', 1)->findAll();

            return view('packages', ['packages' => $packages]);
        }

        public function view($slug)
        {
            $packages = $this->packagesModel->where('slug', $slug)->first();
        
            if (!$packages) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog not found');
            }
    
            return view('package-view', ['packages' => $packages]);
        }

        
        

}