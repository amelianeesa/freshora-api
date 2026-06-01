<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Users extends ResourceController
{
    use ResponseTrait;

    // GET: /api/users
    // (Fitur Khusus Admin: Melihat daftar semua pengguna)
    public function index()
    {
        $model = new UserModel();
        $users = $model->select('id, username, fullname, role, phone, address, profile_image, created_at')
                       ->findAll();

        return $this->respond([
            'status' => 200,
            'message' => 'Daftar pengguna berhasil diambil',
            'data' => $users
        ]);
    }

    // POST: /api/users/register
    // (Fitur Pendaftaran Akun Baru)
    public function register()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'fullname' => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new UserModel();
        
        $data = [
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role'     => 'user',
            'phone'    => $this->request->getVar('phone'),
            'address'  => $this->request->getVar('address')
        ];

        if ($model->insert($data)) {
            unset($data['password']);
            
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Registrasi akun berhasil',
                'data' => $data
            ]);
        }

        return $this->fail('Gagal melakukan registrasi.');
    }

    // POST: /api/users/login
    // (Fitur Masuk Aplikasi)
    public function login()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // 1. Cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        // 2. Jika username tidak ditemukan
        if (!$user) {
            return $this->failNotFound('Username tidak terdaftar.');
        }

        // 3. Jika username ada, cek kecocokan passwordnya
        if (password_verify($password, $user['password'])) {
            
            // Hapus field password agar tidak bocor ke aplikasi Flutter
            unset($user['password']); 
            
            return $this->respond([
                'status' => 200,
                'message' => 'Login berhasil',
                'data' => $user
            ]);
        } 
        
        // 4. Jika password salah
        return $this->failUnauthorized('Password yang Anda masukkan salah.');
    }
}