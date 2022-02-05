<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidUser($username, $password)
    {
        $sql = "SELECT * FROM users 
 				where username='" . $username . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($username, $data)
    {
        $this->db->where('username', $username);
        $this->db->update('users', $data);
        return  "Data " . $username . " Berhasil Diupdate";
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM users order by id_user desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data)
    {
        $this->db->insert('users', $data);
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM users WHERE id_user='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
