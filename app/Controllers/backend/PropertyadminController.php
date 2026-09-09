<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PackagesModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\ResortModel;
use App\Models\DestinationModel;
use App\Models\BranchModel;
use App\Models\DestidetailModel;
use App\Models\BlogModel;
use App\Models\TestimonialModel;
use App\Models\TestimonialImageModel;
use App\Models\GalleryModel;
use App\Models\TravelDeskModel;
use App\Models\PagevoucherModel;
use App\Models\VideoModel;
use App\Models\CarouselModel;

class PropertyadminController extends BaseController
{
protected $departmentModel;
protected $blogModel;
protected $designationModel;
protected $resortModel;
protected $destinationModel;
protected $branchModel;
protected $destidetailModel;
protected $packagesModel;
protected $galleryModel;
protected $travelModel;
protected $pagevoucheModel;
protected $videoModel;
protected $carouselModel;

public function __construct()
{
    $this->departmentModel = new DepartmentModel();
    $this->blogModel = new BlogModel();
    $this->designationModel = new DesignationModel();
    $this->resortModel = new ResortModel();
    $this->destinationModel = new DestinationModel();
    $this->branchModel = new BranchModel();
    $this->destidetailModel = new DestidetailModel();
    $this->packagesModel = new PackagesModel();
    $this->galleryModel = new GalleryModel();
    $this->travelModel = new TravelDeskModel();
    $this->pagevoucherModel = new PagevoucherModel();
    $this->videoModel = new VideoModel();
    $this->carouselModel = new CarouselModel();

}

    
public function adddestinations()
{
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add-destination');
}

public function storeDestination()
{
$validation = \Config\Services::validation();

$rules = [
    'category'  => 'required',
    'directions' => 'required',
    'name'      => 'required|min_length[3]|max_length[100]',
    'featured'  => 'required|in_list[0,1]'
];

$request = service('request');
$name = $request->getPost('name');
$slug = url_title($name, '-', true);

if (!$this->validate($rules)) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$data = [
    'category'   => $this->request->getPost('category'),
    'directions' => $this->request->getPost('directions'),
    'name'       => $name,
    'featured'   => $this->request->getPost('featured'),
    'slug'       => $slug,
    'status'     => '1',
    'created_at' => date('Y-m-d H:i:s')
];

if ($this->destinationModel->save($data)) {
    return redirect()->back()->with('success', 'Destination added successfully!');
} else {
    return redirect()->back()->with('error', 'Failed to add destination. Please try again.');
}
}

public function alldestination()
{         

        $role = session()->get('role');
        if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
        }

    $data['destinations'] = $this->destinationModel->findAll();

    return view('backend/property_admin/all-destination', $data);
}

public function editalldestination($id)
{
    $destination = $this->destinationModel->find($id);

    if (!$destination) {
        return redirect()->to('/official')->with('error', 'Destination not found.');
    }

    return view('backend/property_admin/edit-all-destination', ['destination' => $destination]);
}

    public function updatealldestination()
    {
        $destinationModel = new DestinationModel();
        $id = $this->request->getPost('id');
    
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'category' => $this->request->getPost('category'),
            'featured' => $this->request->getPost('featured'),
            'status' => $this->request->getPost('status')
        ];
    
        if ($destinationModel->update($id, $data)) {
            return redirect()->to('/webmaster/all_destination')->with('success', 'Destination updated successfully.');
        }
        
        return redirect()->to('/destination/edit/' . $id)->with('error', 'Failed to update destination.');
    }

public function toggleStatus()
{
    $input = $this->request->getJSON();

    if (isset($input->mem_id) && isset($input->mem_status)) {
        $id = $input->mem_id;
        $status = $input->mem_status;

        $update = $this->destinationModel->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status. Please check the ID.'
            ]);
        }
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid input data.'
        ]);
    }
}

public function searchDestination()
{
    try {
        $post_data = $this->request->getJSON();
        
        if (!$post_data || !isset($post_data->search_key) || !isset($post_data->search_value)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request. Please provide both search key and value.'
            ]);
        }

        log_message('debug', 'Received search request: ' . json_encode($post_data));

        $search_key = $post_data->search_key;
        $search_value = $post_data->search_value;

        $destinationModel = new \App\Models\DestinationModel();
        $destinations = [];

        if ($search_key == 'name') {
            $destinations = $destinationModel->like('name', $search_value)->findAll();
        } elseif ($search_key == 'category') {
            $destinations = $destinationModel->where('category', $search_value)->findAll();
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid search key.'
            ]);
        }

        if ($destinations) {
            return $this->response->setJSON([
                'success' => true,
                'destinations' => $destinations
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No destinations found.'
            ]);
        }
    } catch (\Exception $e) {
        log_message('error', 'Error in searchDestination: ' . $e->getMessage());
        return $this->response->setJSON([
            'success' => false,
            'message' => 'An error occurred while processing the request.'
        ]);
    }
}


public function addResort()
{
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $data['destinations'] = $this->destinationModel->findAll();

    return view('backend/property_admin/add-resort', $data);
}

public function getCitiesByCategory()
{
    $categoryName = $this->request->getPost('category');
    
    log_message('debug', 'Received Category Name: ' . $categoryName);
    
    $cities = $this->destinationModel->where('category', $categoryName)->find();

    if (!$cities) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Category not found.',
        ]);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'cities' => $cities,
    ]);
}
    
public function resortstore()
{
    $name = $this->request->getPost('name');

    $existingResort = $this->destinationModel->where('name', $name)->get()->getRow();

    if ($existingResort) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Resort name already exists. Please choose a different name.'
        ]);
    }

    $data = [
        'desti_category' => $this->request->getPost('desti_category'),
        'name'           => $name,
        'desti_id'       => $this->request->getPost('desti_id'),
        'slug'           => url_title($name, '-', true),
        'main_image'     => $this->uploadImage(),
        'descr'          => $this->request->getPost('descr'),
        'longi'          => $this->request->getPost('longi'),
        'lati'           => $this->request->getPost('lati'),
        'address'        => $this->request->getPost('address'),
        'external_url'        => $this->request->getPost('external_url'),
        'status'         => '1',  // Active status
        'is_featured'    => $this->request->getPost('is_featured'),
        'rating'         => $this->request->getPost('rating'),
    ];

    if ($this->resortModel->save($data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Resort added successfully!'
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to add resort. Please try again.'
        ]);
    }
}

    private function uploadImage()
{
    $image = $this->request->getFile('main_image');
    if ($image->isValid()) {
        $imageName = $image->getRandomName();
        $image->move(ROOTPATH . 'uploads/resorts', $imageName);
        return $imageName;
    }
    return null;
}

public function editResort($id)
{
 
  $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $resort = $this->resortModel->find($id);
    if (!$resort) {
        return redirect()->to('/backend/resorts')->with('error', 'Resort not found.');
    }

    $data['resort'] = $resort;
    $data['cities'] = $this->destinationModel->findAll();
    
    return view('backend/property_admin/edit-resort', $data);
}

public function updateresort($id)
{
    $resort = $this->resortModel->find($id);
    if (!$resort) {
        return redirect()->to('/backend/resorts')->with('error', 'Invalid Resort ID.');
    }

    $data = [
        'desti_category' => $this->request->getPost('desti_category'),
        'desti_id'       => $this->request->getPost('desti_id'),
        'name'           => $this->request->getPost('name'),
        'slug'           => url_title($this->request->getPost('name'), '-', true),
        'descr'          => $this->request->getPost('descr'),
        'longi'          => $this->request->getPost('longi'),
        'lati'           => $this->request->getPost('lati'),
        'address'        => $this->request->getPost('address'),
        'external_url'   => $this->request->getPost('external_url'),
    ];

    $file = $this->request->getFile('main_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('uploads/resorts', $newName);
        $data['main_image'] = $newName;

        if (!empty($resort['main_image']) && file_exists('uploads/resorts/' . $resort['main_image'])) {
            unlink('uploads/resorts/' . $resort['main_image']);
        }
    }

    $this->resortModel->update($id, $data);

    return redirect()->to(base_url('/webmaster/edit_resort/' . $id))->with('success', 'Resort updated successfully!');
}


public function delete($id)
{
    $this->resortModel->delete($id);
    return redirect()->to('/backend/resorts')->with('success', 'Resort deleted successfully!');
}

public function show($id)
{
                $role = session()->get('role');
                if ($role !== 'property') {
                return redirect()->to('/official')->with('error', 'Unauthorized access');
                }
                
    $category = $this->destinationModel->find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Category not found');
    }

    $destinations = $this->destidetailModel->where('desti_id', $category['id'])->findAll();

    $data = [
        'destinations' => $destinations,
        'selected_desti_id' => $id, 
    ];

    return view('backend/property_admin/destination-detail', $data);
}


public function edit_destination($id)
{
                $role = session()->get('role');
                if ($role !== 'property') {
                return redirect()->to('/official')->with('error', 'Unauthorized access');
                }
                
    $category = $this->destinationModel->find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Destination not found.');
    }

    $destinations = $this->destidetailModel->where('desti_id', $category['id'])->findAll();

    $data = [
        'category' => $category,
        'destinations' => $destinations,
    ];

    return view('backend/property_admin/edit_destination_details', $data);
}

public function update_destinationdetail($id)
{
    $title = $this->request->getPost('title');
    $detail = $this->request->getPost('detail');
    $image = $this->request->getFile('image');

    $destination = $this->destidetailModel->where('desti_id', $id)->first();
    
    if (!$destination) {
        return redirect()->back()->with('error', 'Destination details not found.');
    }

    $updateData = [
        'title' => $title,
        'detail' => $detail,
    ];

    if ($image && $image->isValid() && !$image->hasMoved()) {
        $newImageName = $image->getRandomName();

        $image->move('uploads/destinations', $newImageName);

        $updateData['image'] = $newImageName;

        if (!empty($destination['image']) && file_exists('uploads/destinations/' . $destination['image'])) {
            unlink('uploads/destinations/' . $destination['image']);
        }
    }

    $this->destidetailModel->update($destination['id'], $updateData);

    return redirect()->to('webmaster/destination/edit/' . $id)->with('success', 'Destination updated successfully.');
}

public function insert_destinationdetails()
{
$title = $this->request->getPost('title');
$detail = $this->request->getPost('detail');
$image = $this->request->getFile('image');
$desti_id = $this->request->getPost('desti_id'); 

if (!$desti_id) {
    return redirect()->back()->with('error', 'No destination ID provided.');
}

$destination = $this->destinationModel->find($desti_id);

if (!$destination) {
    return redirect()->back()->with('error', 'Destination category not found.');
}

$insertData = [
    'desti_id' => $desti_id,
    'title' => $title,
    'detail' => $detail,
    'status' => '1',
    'slug' => url_title($title, '-', true), 
];

if ($image && $image->isValid() && !$image->hasMoved()) {
    $newImageName = $image->getRandomName();
    $image->move('backend/assets/admin/images/destination', $newImageName);

    $insertData['image'] = $newImageName;
    $this->destinationModel->update($desti_id, ['featured' => '1']);
}

$insertedId = $this->destidetailModel->insert($insertData);

if ($insertedId) {
    return redirect()->back()->with('success', 'Destination added successfully.');
}

return redirect()->back()->with('error', 'Failed to add destination.');
}

public function view_resort_pagination($category) {
$page_no = $this->request->getPost('page_no');
$limitPP = $this->request->getPost('limitPP') ?? 25;

$offset = ($page_no - 1) * $limitPP;

$builder = $this->db->table('tbl_resort');
$builder->where('desti_category', 'domestic');
$builder->limit($limitPP, $offset);
$query = $builder->get();

$data['resorts'] = $query->getResult();

return view('backend/property_admin/domestic-all-resort', $data);
}


public function AllResorts()
{
$role = session()->get('role');
if ($role !== 'property') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
}

$search = $this->request->getVar('search') ?? '';
$category = $this->request->getVar('category') ?? ''; 
$limit = (int)($this->request->getVar('limit') ?? 25);
$page = (int)($this->request->getVar('page') ?? 1);
$offset = ($page - 1) * $limit;

$builder = $this->resortModel
    ->select('tbl_resort.*, tbl_destination.name as destination_name')
    ->join('tbl_destination', 'tbl_resort.desti_id = tbl_destination.id');

if (!empty($search)) {
    $builder->groupStart()
        ->like('tbl_resort.name', $search)
        ->groupEnd();
}

if (!empty($category)) {
    $builder->where('tbl_resort.desti_category', $category);
}

$totalRecords = $builder->countAllResults(false);
$resorts = $builder->limit($limit, $offset)->findAll();

$categories = [
    ['desti_category' => 'Domestic'],
    ['desti_category' => 'International']
];

$data = [
    'resorts' => $resorts,
    'categories' => $categories,
    'limit' => $limit,
    'totalRecords' => $totalRecords,
    'currentPage' => $page,
    'totalPages' => ceil($totalRecords / $limit),
    'search' => $search,
    'selectedCategory' => $category,
];

if ($this->request->isAJAX()) {
    return view('backend/property_admin/all_resorts_table', $data);
}

return view('backend/property_admin/all-resort', $data);
}


public function AllResortsStatus($empID)
{
$resort = $this->resortModel->find($empID);
$newStatus = ($resort['status'] == 1) ? 0 : 1;

if ($this->resortModel->toggleStatus($empID, $newStatus)) {
return $this->response->setJSON([
    'success' => true,
    'status' => $newStatus,
    'message' => 'Status updated successfully'
]);
} else {
return $this->response->setJSON([
    'success' => false,
    'message' => 'Failed to update status'
]);
}
}

public function addblog()
{

    $role = session()->get('role');
    if ($role !== 'property') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add-blog');
}

public function blogstore()
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
    'title'             => 'required|max_length[255]',
    'slug'              => 'required|alpha_dash|is_unique[tbl_blogs.slug]',
    'meta_description'  => 'required|max_length[255]',
    'image'             => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
    'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$file = $this->request->getFile('image');
$title = $this->request->getPost('title'); 

$newFileName = url_title($title, '-', true) . '.' . $file->getExtension(); // e.g., my-title.jpg

if ($file->isValid() && !$file->hasMoved()) {
$file->move(FCPATH . 'uploads/blogs', $newFileName);
} else {
return redirect()->back()->withInput()->with('error', 'Image upload failed.');
}

// Prepare data for insertion
$data = [
    'title'            => $this->request->getPost('title'),
    'slug'             => $this->request->getPost('slug'),
    'meta_description' => $this->request->getPost('meta_description'),
    'image'            => $newFileName,
    'content'          => $this->request->getPost('content'),
    'status'           => '1',
];

if ($this->blogModel->insert($data)) {
    return redirect()->to(base_url('webmaster/add-blog'))->with('success', 'Resort added successfully.');
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to add resort.');
}
}

public function viewblog()
{

$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

$data['viewblogs'] = $this->blogModel->findAll();

return view('backend/property_admin/all-blogs', $data);
}

public function blogEdit($id)
{
$blog = $this->blogModel->find($id);
if (!$blog) {
    return redirect()->to(base_url('webmaster/view-blog'))->with('error', 'Blog not found');
}

return view('backend/property_admin/edit-all-blogs', ['blog' => $blog]);
}

public function blogUpdate($id)
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
    'title'             => 'required|max_length[255]',
    'slug'              => 'required|alpha_dash|is_unique[tbl_blogs.slug,id,' . $id . ']',
    'meta_description'  => 'required|max_length[255]',
    'image'             => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]', 
    'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$title = $this->request->getPost('title');
$slug = $this->request->getPost('slug');
$meta_description = $this->request->getPost('meta_description');
$content = $this->request->getPost('content');

$file = $this->request->getFile('image');
$newFileName = $this->request->getPost('existing_image');  

if ($file->isValid() && !$file->hasMoved()) {
$newFileName = url_title($title, '-', true) . '_' . time() . '.' . $file->getExtension();

    if ($file->move(FCPATH . 'uploads/blogs', $newFileName)) {
    // Delete the old image if it exists
    $oldImage = $this->request->getPost('existing_image');
    if ($oldImage && file_exists(FCPATH . 'uploads/blogs/' . $oldImage)) {
        unlink(FCPATH . 'uploads/blogs/' . $oldImage);
    }
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to upload new image.');
}
}

$data = [
    'title'            => $title,
    'slug'             => $slug,
    'meta_description' => $meta_description,
    'image'            => $newFileName, 
    'content'          => $content,
    'status'           => '1',
];

if ($this->blogModel->update($id, $data)) {
    return redirect()->back()->withInput()->with('success', 'Blog updated successfully.');
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to update blog.');
}
}


public function blogStatus()
{
$input = $this->request->getJSON();

if (isset($input->mem_id) && isset($input->mem_status)) {
    $id = $input->mem_id;
    $status = $input->mem_status;

    $update = $this->blogModel->update($id, ['status' => $status]);

    if ($update) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status updated successfully.'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status. Please check the ID.'
        ]);
    }
} else {
    return $this->response->setJSON([
        'success' => false,
        'message' => 'Invalid input data.'
    ]);
}
}


public function addpackage()
{

$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

return view('backend/property_admin/add-package');
}

public function packagestore()
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
    'title'             => 'required|max_length[255]',
    'slug'              => 'required|alpha_dash|is_unique[tbl_packages.slug]',
    'meta_description'  => 'required|max_length[255]',
    'image'             => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
    'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$file = $this->request->getFile('image');
$title = $this->request->getPost('title'); 

$newFileName = url_title($title, '-', true) . '.' . $file->getExtension();

if ($file->isValid() && !$file->hasMoved()) {
    $file->move(FCPATH . 'uploads/packages', $newFileName);
} else {
    return redirect()->back()->withInput()->with('error', 'Image upload failed.');
}

$data = [
    'title'             => $this->request->getPost('title'),
    'slug'              => $this->request->getPost('slug'),
    'meta_description'  => $this->request->getPost('meta_description'),
    'image'             => $newFileName,
    'content'           => $this->request->getPost('content'),
    'status'            => $this->request->getPost('status'),
    'category'          => $this->request->getPost('category'),
    'location'          => $this->request->getPost('location'),
    'price'             => $this->request->getPost('price'),
    'duration'          => $this->request->getPost('duration'),
    'rating'          => $this->request->getPost('rating'),
    'persons'          => $this->request->getPost('persons'),

];

if ($this->packagesModel->insert($data)) {
    return redirect()->to(base_url('webmaster/add-package'))->with('success', 'Package added successfully.');
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to add resort.');
}
}


public function viewpackage()
{

$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

$packages['packages'] = $this->packagesModel->getAllPackages();

return view('backend/property_admin/allpackage', $packages);
}

public function packageEdit($id)
{

$package = $this->packagesModel->find($id);
if (!$package) {
return redirect()->to(base_url('webmaster/view-package'))->with('error', 'package not found');
}

return view('backend/property_admin/edit-all-blogs', ['package' => $package]);
}

public function packageUpdate($id)
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
'title'             => 'required|max_length[255]',
'slug'              => 'required|alpha_dash|is_unique[tbl_blogs.slug,id,' . $id . ']',
'meta_description'  => 'required|max_length[255]',
'image'             => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]', 
'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$title = $this->request->getPost('title');
$slug = $this->request->getPost('slug');
$meta_description = $this->request->getPost('meta_description');
$content = $this->request->getPost('content');

$file = $this->request->getFile('image');
$newFileName = $this->request->getPost('existing_image');  

if ($file->isValid() && !$file->hasMoved()) {

$newFileName = url_title($title, '-', true) . '_' . time() . '.' . $file->getExtension();

if ($file->move(FCPATH . 'uploads/blogs', $newFileName)) {

$oldImage = $this->request->getPost('existing_image');
if ($oldImage && file_exists(FCPATH . 'uploads/blogs/' . $oldImage)) {
    unlink(FCPATH . 'uploads/blogs/' . $oldImage);
}
} else {
return redirect()->back()->withInput()->with('error', 'Failed to upload new image.');
}
}

$data = [
'title'            => $title,
'slug'             => $slug,
'meta_description' => $meta_description,
'image'            => $newFileName, 
'content'          => $content,
'status'           => '1',
];


if ($this->packagesModel->update($id, $data)) {
return redirect()->back()->withInput()->with('success', 'Packages updated successfully.');
} else {
return redirect()->back()->withInput()->with('error', 'Failed to update blog.');
}
}


public function packageStatus()
{

$input = $this->request->getJSON();

if (isset($input->mem_id) && isset($input->mem_status)) {
$id = $input->mem_id;
$status = $input->mem_status;

$update = $this->packagesModel->update($id, ['status' => $status]);

if ($update) {
    return $this->response->setJSON([
        'success' => true,
        'message' => 'Status updated successfully.'
    ]);
} else {
    return $this->response->setJSON([
        'success' => false,
        'message' => 'Failed to update status. Please check the ID.'
    ]);
}
} else {
return $this->response->setJSON([
    'success' => false,
    'message' => 'Invalid input data.'
]);
}
}
 public function testadd()
{
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add_testimonial');
}


public function teststore()
{
helper(['form', 'url']);

$testimonialModel = new TestimonialModel();
$imageModel       = new TestimonialImageModel();

$validation = $this->validate([
'name'        => 'required|min_length[3]',
'location'    => 'required',
'testimonial' => 'required',
'image'       => 'uploaded[image]|max_size[image,2048]|is_image[image]',
'rating'      => 'required|integer|greater_than[0]|less_than[6]',
'images.*'    => 'permit_empty|max_size[images,2048]|is_image[images]'
]);


if (!$validation) {
    return redirect()->back()
        ->withInput()
        ->with('errors', $this->validator->getErrors());
}

$image = $this->request->getFile('image');

$imageName = 'default.png';
if ($image && $image->isValid() && !$image->hasMoved()) {
    $imageName = $image->getRandomName();
    $image->move('uploads/review_img/', $imageName);
}

$testimonialId = $testimonialModel->insert([
    'name'        => $this->request->getPost('name'),
    'location'    => $this->request->getPost('location'),
    'testimonial' => $this->request->getPost('testimonial'),
    'image'       => $imageName,
    'rating'      => $this->request->getPost('rating')
]);

$files = $this->request->getFiles();

if (isset($files['images'])) {

    foreach ($files['images'] as $img) {

        if (!$img->isValid() || $img->hasMoved()) {
            continue;
        }

        $allowedMime = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($img->getMimeType(), $allowedMime)) {
            continue;
        }

        if ($img->getSize() > (2 * 1024 * 1024)) {
            continue;
        }

        $imgName = $img->getRandomName();
        $img->move('uploads/review_img/', $imgName);

        $imageModel->insert([
            'testimonial_id' => $testimonialId,
            'image'          => $imgName
        ]);
    }
}

return redirect()->back()->with('success', 'Testimonial added successfully!');
}

public function viewReview()
{
$model = new TestimonialModel();

return view('backend/property_admin/view-reviews', [
    'testimonials' => $model->orderBy('id','DESC')->findAll()
]);
}

public function editReview($id)
{
$testimonialModel = new TestimonialModel();
$imageModel = new TestimonialImageModel();

return view('backend/property_admin/edit-testimonial', [
    'testimonial' => $testimonialModel->find($id),
    'images'      => $imageModel->where('testimonial_id', $id)->findAll()
]);
}
public function updatereview($id)
{
helper(['form', 'url']);

$testimonialModel = new TestimonialModel();
$imageModel       = new TestimonialImageModel();


if (!$this->validate([
    'name'        => 'required|min_length[3]',
    'location'    => 'required',
    'testimonial' => 'required',
    'rating'      => 'required|integer|greater_than[0]|less_than[6]',
    'image'       => 'permit_empty|max_size[image,2048]|is_image[image]',
    'images.*'    => 'permit_empty|max_size[images,2048]|is_image[images]'
])) {
    return redirect()->back()
        ->withInput()
        ->with('errors', $this->validator->getErrors());
}

$oldData = $testimonialModel->find($id);
$imageName = $oldData['image'];

$image = $this->request->getFile('image');
if ($image && $image->isValid() && !$image->hasMoved()) {
    $imageName = $image->getRandomName();
    $image->move('uploads/review_img/', $imageName);
}

$testimonialModel->update($id, [
    'name'        => $this->request->getPost('name'),
    'location'    => $this->request->getPost('location'),
    'testimonial' => $this->request->getPost('testimonial'),
    'image'       => $imageName,
    'rating'      => $this->request->getPost('rating')
]);

$files = $this->request->getFiles();

if (!empty($files['images'])) {
    foreach ($files['images'] as $img) {

        if (!$img->isValid() || $img->hasMoved()) {
            continue;
        }

        $imgName = $img->getRandomName();
        $img->move('uploads/review_img/', $imgName);

        $imageModel->insert([
            'testimonial_id' => $id,
            'image'          => $imgName
        ]);
    }
}

return redirect()->back()->with('success', 'Testimonial updated successfully!');
}

public function deletereview($id)
{
$testimonialModel = new TestimonialModel();
$imageModel       = new TestimonialImageModel();


$testimonial = $testimonialModel->find($id);
if (!$testimonial) {
    return redirect()->back()->with('errors', ['Testimonial not found']);
}


if (!empty($testimonial['image']) && file_exists('uploads/review_img/'.$testimonial['image'])) {
    unlink('uploads/review_img/'.$testimonial['image']);
}

$images = $imageModel->where('testimonial_id', $id)->findAll();
foreach ($images as $img) {
    if (file_exists('uploads/review_img/'.$img['image'])) {
        unlink('uploads/review_img/'.$img['image']);
    }
}

$imageModel->where('testimonial_id', $id)->delete();
$testimonialModel->delete($id);

return redirect()->back()->with('success', 'Testimonial deleted successfully!');
}

public function gallery(): string
{
     $data['galleryImages'] = $this->galleryModel->findAll();
    return view('gallery', $data);
}

public function galleryadd()

{
$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

    return view('backend/property_admin/add-gallery'); 
}

public function galleryStore()
{
$validation = \Config\Services::validation();

$validation->setRules([
    'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]', 
]);

if (!$validation->withRequest($this->request)->run()) {
    return redirect()->back()->with('errors', $validation->getErrors());
}

// Upload image
$file = $this->request->getFile('image');
if ($file->isValid() && !$file->hasMoved()) {
    $originalName = $file->getClientName(); 
    $newName = $file->getRandomName(); 
    $file->move(ROOTPATH . 'uploads/gallery', $newName);

    $altText = pathinfo($originalName, PATHINFO_FILENAME);

    $this->galleryModel->save([
        'filename' => $newName,
        'alt' => $altText, 
    ]);

return redirect()->back()->with('success', 'Image added successfully!');

}

return redirect()->back()->with('error', 'Failed to upload image.');
}

public function addslideimg()
{
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
    return view('backend/property_admin/slideadd');
}

public function storeslideimg()
{
$file = $this->request->getFile('file_name');

if ($file->isValid() && !$file->hasMoved()) {
    $newName = $file->getClientName(); 
    $file->move('asset/img/slide', $newName);

    $data = [
        'type' => $this->request->getPost('type'),
        'file_name' => $newName,
        'caption' => $this->request->getPost('caption'),
        'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        'sort_order' => $this->request->getPost('sort_order'),
    ];

    if ($this->carouselModel->save($data) === false) {
        return redirect()->back()->with('error', implode(', ', $this->carouselModel->errors()));
    }

    return redirect()->back()->with('success', 'Slide added successfully.');
}

return redirect()->back()->with('error', 'File upload failed.');
}


public function slideview()
{

$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

$data['slides'] = $this->carouselModel->findAll();

return view('backend/property_admin/slideview', $data);
}

public function deleteslideimg($id)
{
    $slide = $this->carouselModel->find($id);
    if ($slide) {
        unlink('asset/img/slide/' . $slide['file_name']);
        $this->carouselModel->delete($id);
    }

    return redirect()->back()->with('success', 'Slide deleted.');
}


   public function adddesk()
{

    $role = session()->get('role');
    if ($role !== 'property') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add_travel_desk');
}

public function deskstore()
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
    'title'             => 'required|max_length[255]',
    'slug'              => 'required|alpha_dash|is_unique[tbl_blogs.slug]',
    'meta_description'  => 'required|max_length[255]',
    'image'             => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
    'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$file = $this->request->getFile('image');
$title = $this->request->getPost('title'); 

$newFileName = url_title($title, '-', true) . '.' . $file->getExtension(); // e.g., my-title.jpg

if ($file->isValid() && !$file->hasMoved()) {
$file->move(FCPATH . 'uploads/traveldesk', $newFileName);
} else {
return redirect()->back()->withInput()->with('error', 'Image upload failed.');
}

$data = [
    'title'            => $this->request->getPost('title'),
    'slug'             => $this->request->getPost('slug'),
    'meta_description' => $this->request->getPost('meta_description'),
    'image'            => $newFileName,
    'content'          => $this->request->getPost('content'),
    'status'           => '1',
];

if ($this->travelModel->insert($data)) {
    return redirect()->back()->with('success', 'Resort added successfully.');
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to add resort.');
}
}

public function viewdesk()
{

$role = session()->get('role');
if ($role !== 'property') {
return redirect()->to('/official')->with('error', 'Unauthorized access');
}

$data['viewdesks'] = $this->travelModel->findAll();

return view('backend/property_admin/all-travel-desk', $data);
}

public function deskEdit($id)
{
$desk = $this->travelModel->find($id);
if (!$desk) {
    return redirect()->to(base_url('webmaster/view-desk'))->with('error', 'Desk not found');
}

// Pass data to view
return view('backend/property_admin/edit-all-desks', ['desk' => $desk]);
}

public function deskUpdate($id)
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

// Validation rules
$validation->setRules([
    'title'             => 'required|max_length[255]',
    'slug'              => 'required|alpha_dash|is_unique[tbl_blogs.slug,id,' . $id . ']',
    'meta_description'  => 'required|max_length[255]',
    'image'             => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]', 
    'content'           => 'required',
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$title = $this->request->getPost('title');
$slug = $this->request->getPost('slug');
$meta_description = $this->request->getPost('meta_description');
$content = $this->request->getPost('content');

$file = $this->request->getFile('image');
$newFileName = $this->request->getPost('existing_image');  

if ($file->isValid() && !$file->hasMoved()) {
$newFileName = url_title($title, '-', true) . '_' . time() . '.' . $file->getExtension();

if ($file->move(FCPATH . 'uploads/traveldesk', $newFileName)) {
    $oldImage = $this->request->getPost('existing_image');
    if ($oldImage && file_exists(FCPATH . 'uploads/traveldesk/' . $oldImage)) {
        unlink(FCPATH . 'uploads/traveldesk/' . $oldImage);
    }
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to upload new image.');
}
}

$data = [
    'title'            => $title,
    'slug'             => $slug,
    'meta_description' => $meta_description,
    'image'            => $newFileName, 
    'content'          => $content,
    'status'           => '1',
];

if ($this->travelModel->update($id, $data)) {
    return redirect()->back()->withInput()->with('success', 'Desk updated successfully.');
} else {
    return redirect()->back()->withInput()->with('error', 'Failed to update Desk.');
}
}

public function diskStatus()
{
$input = $this->request->getJSON();

if (isset($input->mem_id) && isset($input->mem_status)) {
    $id = $input->mem_id;
    $status = $input->mem_status;

    $update = $this->travelModel->update($id, ['status' => $status]);

    if ($update) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status updated successfully.'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status. Please check the ID.'
        ]);
    }
} else {
    return $this->response->setJSON([
        'success' => false,
        'message' => 'Invalid input data.'
    ]);
}
}

   public function addpagevoucher()
{

    $role = session()->get('role');
    if ($role !== 'property') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add_page_voucher');
}

public function pagevouchertore()
{
helper(['form', 'url']);
$validation = \Config\Services::validation();

$validation->setRules([
    'title' => 'required|max_length[255]',
    'image' => [
        'label' => 'File',
        'rules' => 'uploaded[image]|max_size[image,5120]|ext_in[image,jpg,jpeg,png,pdf]'
    ],
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()
        ->withInput()
        ->with('errors', $validation->getErrors());
}

$file  = $this->request->getFile('image');
$title = $this->request->getPost('title');

$extension  = $file->getClientExtension(); 
$newFileName = url_title($title, '-', true) . '.' . $extension;

if ($file->isValid() && !$file->hasMoved()) {
    $file->move(FCPATH . 'uploads/pagevouchers', $newFileName);
} else {
    return redirect()->back()
        ->withInput()
        ->with('error', 'File upload failed.');
}

// Save data
$data = [
    'title'  => $title,
    'image'  => $newFileName,
    'status' => '1',
];

if ($this->pagevoucherModel->insert($data)) {
    return redirect()->back()
        ->with('success', 'Resort added successfully.');
}

return redirect()->back()
    ->withInput()
    ->with('error', 'Failed to add resort.');
}

   public function addvideo()
{

    $role = session()->get('role');
    if ($role !== 'property') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    return view('backend/property_admin/add_video');
}

public function saveVideo() 
{
$validation = \Config\Services::validation();

$validation->setRules([
    'video_title' => 'required|max_length[255]',
    'video_url'   => 'required|valid_url'
]);

if (!$this->validate($validation->getRules())) {
    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
}

$ytUrl = $this->request->getPost('video_url');

preg_match('/(?:v=|\/|embed\/|shorts\/)([0-9A-Za-z_-]{11})/', $ytUrl, $match);

$videoID = $match[1] ?? null;

if (!$videoID) {
    return redirect()->back()->withInput()->with('error', 'Invalid YouTube URL.');
}

$data = [
    'video_title' => $this->request->getPost('video_title'),
    'video_url'   => $videoID,
    'status'      => 1
];

if ($this->videoModel->insert($data)) {
    return redirect()->back()->with('success', 'Video added successfully.');
}

return redirect()->back()->with('error', 'Failed to add video.');
}


}
