<?php

class User_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM '. $this->table);
        return $this->db->resultSet();
    }

    public function getUserByld($ld)
    {
        $this->db->query('SELECT * FROM '. $this->table. 'WEHERE id=:id');
        $this->db->bind('id, $id');
        return $this->db->single();
    }

    }


