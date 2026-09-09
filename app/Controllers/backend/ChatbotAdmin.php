<?php

namespace App\Controllers\backend;
use App\Controllers\BaseController;
use App\Models\ChatbotModel;

class ChatbotAdmin extends BaseController
{
    public function index()
    {
        
        $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

        $model = new ChatbotModel();
        $data['chatbots'] = $model->findAll();
        return view('backend/chatboat/chatbot_list', $data);
    }

    public function create()
    {
        
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
        
        return view('backend/chatboat/chatbot_add');
    }

    public function store()
    {
        $model = new ChatbotModel();

        $model->save([
            'keywords' => $this->request->getPost('keywords'),
            'answer'   => $this->request->getPost('answer')
        ]);

        return redirect()->back()->with('msg', 'Added Successfully');
    }

    public function edit($id)
    {
        
    $role = session()->get('role');
    if ($role !== 'property') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

        $model = new ChatbotModel();
        $data['chatbot'] = $model->find($id);
        return view('backend/chatboat/chatbot_edit', $data);
    }

    public function update($id)
    {
        $model = new ChatbotModel();

        $model->update($id, [
            'keywords' => $this->request->getPost('keywords'),
            'answer'   => $this->request->getPost('answer')
        ]);

        return redirect()->back()->with('msg', 'Updated Successfully');
    }

    public function delete($id)
    {
        $model = new ChatbotModel();
        $model->delete($id);

        return redirect()->back()->with('msg', 'Deleted Successfully');
    }
}