<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Pengaduan_model extends CI_Model
{
    public $table = 'pengaduan';
    public $id = 'pengaduan.id';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RSA', 'rsa');
    }

    public function getBy()
    {
        $this->db->from($this->table);
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->Select('p.*');
        $this->db->from('pegawai p');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    public function tpengaduan()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function test()
    {
        $this->db->Select('nama');
        $this->db->from($this->table);
        $this->db->where('id',10);
        $query = $this->db->get();
        return $query->row();
    }
    public function getIdFromEncryptedData($encryptedData) {
        return isset($encryptedData['id']) ? $encryptedData['id'] : null;
    }
}