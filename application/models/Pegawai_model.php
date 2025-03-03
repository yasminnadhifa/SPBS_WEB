<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Pegawai_model extends CI_Model
{
    public $table = 'pegawai';
    public $id = 'pegawai.id';
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($username) {
        $query = $this->db->get_where('pegawai', array('username' => $username));
        return $query->row_array();
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
    public function tpegawai()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
}