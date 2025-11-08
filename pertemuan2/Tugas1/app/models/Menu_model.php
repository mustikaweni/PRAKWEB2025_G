<?php

class Menu_model {
    private $table = 'menu';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMenu()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMenuById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMenu($data)
    {
        $query = "INSERT INTO menu (nama, harga, kategori)
                  VALUES (:nama, :harga, :kategori)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataMenu($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataMenu($data)
    {
        $query = "UPDATE menu SET nama=:nama, harga=:harga, kategori=:kategori WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
