<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\OrderModel;

class Orders extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new OrderModel();
        $data = $model->findAll(); 
        
        return $this->respond([
            'status' => 200,
            'message' => 'Semua data order berhasil diambil',
            'data' => $data
        ]);
    }

    public function show($id = null)
    {
        $model = new OrderModel();
        $data = $model->find($id);

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Detail order berhasil diambil',
                'data' => $data
            ]);
        }

        return $this->failNotFound('Data order tidak ditemukan.');
    }

    public function create()
    {
        $rules = [
            'user_id'      => 'required',
            'service_name' => 'required',
            'fullname'     => 'required',
            'whatsapp'     => 'required',
            'address'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new OrderModel();
        $data = [
            'user_id'        => $this->request->getVar('user_id'),
            'service_name'   => $this->request->getVar('service_name'),
            'fullname'       => $this->request->getVar('fullname'),
            'whatsapp'       => $this->request->getVar('whatsapp'),
            'address'        => $this->request->getVar('address'),
            'pickup_time'    => $this->request->getVar('pickup_time'),
            'notes'          => $this->request->getVar('notes'),
            'promo_code'     => $this->request->getVar('promo_code'), 
            'resi_code'      => 'FRESH-' . strtoupper(substr(md5(uniqid()), 0, 5)),
            'status'         => 'Pending',
            'payment_method' => $this->request->getVar('payment_method'),
            'weight'         => $this->request->getVar('weight') ?? 0,
            'total_price'    => $this->request->getVar('total_price') ?? 0,
        ];

        if ($model->insert($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Pesanan laundry baru berhasil disimpan',
                'data' => $data
            ]);
        }
        
        return $this->fail($model->errors());
    }

    public function update($id = null)
    {
        $model = new OrderModel();
        
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data order tidak ditemukan.');
        }

        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data order berhasil diperbarui',
                'data' => $data
            ]);
        }
        
        return $this->fail($model->errors());
    }

    public function delete($id = null)
    {
        $model = new OrderModel();
        
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data order tidak ditemukan untuk dihapus.');
        }

        if ($model->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Data order berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus data order.');
    }
}