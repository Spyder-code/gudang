<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new \App\Models\User();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'pages' => 'User',
            'users' => $this->userModel->findAll()
        ];

        return view('dashboard/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'pages' => 'User',
        ];

        return view('dashboard/user/create', $data);
    }

    public function store()
    {
        $id = $this->request->getVar('id-user');
        $session = session();
        if ($id == '') { //ini berarti tambah data

            // Mengambil data dari form input
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'jabatan' => $this->request->getVar('jabatan'),
                'gaji' => $this->request->getVar('gaji')
            ];

            // Memasukkan data ke dalam database
            $this->userModel->insert($data);

            $session->set('alert', 'success');
        } else { //ini berarti edit data
            $this->update($id);
            $session->set('alert', 'edit');
        }
        // Mengarahkan pengguna kembali ke halaman daftar user
        return redirect()->route('user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User with ID ' . $id . ' not found.');
        }

        $data = [
            'title' => 'Edit User',
            'pages' => 'User',
            'user' => $user
        ];

        return view('dashboard/user/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'jabatan' => $this->request->getVar('jabatan'),
            'gaji' => $this->request->getVar('gaji')
        ];

        if ($password = $this->request->getVar('password')) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->route('user');
    }
}
