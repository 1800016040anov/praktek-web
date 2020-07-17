<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $usermodel;
    public function __construct()
    {
        $this->usermodel = new UserModel();
    }

    public function index()
    {
        $komik = $this->usermodel->findAll();
        $data = [
            'title' => 'tabel home',
            'user' => $this->usermodel->getUser()
        ];

        return view('user/index', $data);
    }

    public function login()
    {
        return view('user/login');
    }

    public function validasi()
    {
        $user = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $cek = $user->getData($email, $password);
        if (($cek['email'] == $email) && ($cek['password'] == $password)) {
            session()->setFlashdata('pesan', 'login berhasil');
            return redirect()->to('/User');
        } else {
            session()->setFlashdata('pesan', ' ');
            return redirect()->to('/User/login');
        }
    }

    public function create()
    {

        $data = [
            'title' => 'Form tambah data',
            'validation' =>  \config\Services::validation()
        ];
        return view('user/create', $data);
    }
    public function save()
    {
        //validasi input
        if (!$this->validate([
            'user_id' => [
                'rules' => 'required|is_unique[user.user_id]',
                'errors' => [
                    'required' => '{field} komik ga boleh kosong !!',
                    'is_unique' => '{field} user_id ga boleh sama bro!!'
                ]
            ]
        ])) {

            $validation = \config\Services::validation();
            return redirect()->to('/user/create')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->usermodel->save([
            'user_id' => $this->request->getVar('user_id'),
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/user');
    }


    public function delete($id)
    {
        $this->usermodel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapuskan');
        return redirect()->to('/User');
    }

    public function edit($slug)
    {

        $data = [
            'title' => 'Form update data',
            'validation' =>  \config\Services::validation(),
            'user' => $this->usermodel->getUser($slug)

        ];
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('user_id'), '-', true);
        $this->usermodel->save([
            'id' => $id,
            'user_id' => $this->request->getVar('user_id'),
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('/user');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
