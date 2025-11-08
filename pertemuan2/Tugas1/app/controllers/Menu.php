<?php

class Menu extends Controller {
    public function index()
    {
        $data['judul'] = 'Daftar Menu Makanan';
        $data['menu'] = $this->model('Menu_model')->getAllMenu();
        $this->view('templates/header', $data);
        $this->view('menu/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Menu_model')->tambahDataMenu($_POST) > 0) {
            header('Location: ' . BASEURL . '/menu');
            exit;
        } else {
            echo "Gagal menambah data.";
        }
    }

    public function hapus($id)
    {
        if ($this->model('Menu_model')->hapusDataMenu($id) > 0) {
            header('Location: ' . BASEURL . '/menu');
            exit;
        } else {
            echo "Gagal menghapus data.";
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Menu';
        $data['menu'] = $this->model('Menu_model')->getMenuById($id);
        $this->view('templates/header', $data);
        $this->view('menu/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('Menu_model')->ubahDataMenu($_POST) > 0) {
            header('Location: ' . BASEURL . '/menu');
            exit;
        } else {
            echo "Gagal mengubah data.";
        }
    }
}
