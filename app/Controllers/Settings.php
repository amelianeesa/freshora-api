<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SettingModel;

class Settings extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new SettingModel();
        $data = $model->first(); 
        
        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data pengaturan dari Freshora berhasil diambil',
                'data' => $data
            ]);
        }

        return $this->failNotFound('Pengaturan sistem belum dikonfigurasi.');
    }

    public function update($id = null)
    {
        $model = new SettingModel();
        
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data pengaturan tidak ditemukan.');
        }

        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data pengaturan berhasil diperbarui',
                'data' => $data
            ]);
        } 
        
        return $this->fail($model->errors());
    }
}