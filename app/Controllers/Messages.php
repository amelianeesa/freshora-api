<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MessageModel;

class Messages extends ResourceController
{
    use ResponseTrait;

    // GET: /api/messages 
    // (Fitur Admin: Melihat semua pesan dari pelanggan)
    public function index()
    {
        $model = new MessageModel();
        
        // Mengurutkan dari pesan terbaru ke paling lama (opsional tapi disarankan)
        $data = $model->orderBy('id', 'DESC')->findAll(); 
        
        return $this->respond([
            'status' => 200,
            'message' => 'Daftar pesan berhasil diambil',
            'data' => $data
        ]);
    }

    // POST: /api/messages 
    // (Fitur Pelanggan: Mengirim pesan)
    public function create()
    {
        $rules = [
            'name'     => 'required',
            'whatsapp' => 'required',
            'message'  => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new MessageModel();
        $data = [
            'name'     => $this->request->getVar('name'),
            'whatsapp' => $this->request->getVar('whatsapp'),
            'message'  => $this->request->getVar('message')
        ];

        if ($model->insert($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Pesan berhasil dikirim ke Admin Freshora',
                'data' => $data
            ]);
        }

        return $this->fail('Gagal mengirim pesan.');
    }
    
    // DELETE: /api/messages/1
    // (Fitur Admin: Menghapus pesan tertentu)
    public function delete($id = null)
    {
        $model = new MessageModel();
        
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Pesan tidak ditemukan.');
        }

        if ($model->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Pesan berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus pesan.');
    }
}