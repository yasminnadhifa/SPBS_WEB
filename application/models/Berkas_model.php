<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Berkas_model extends CI_Model
{
    public $table = 'file';
    public $id = 'file.id_file';
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($username) {
        $query = $this->db->get_where('user', array('username' => $username));
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
    public function insertFile($user, $filename, $encryptedFilename, $fileUrl, $fileSize, $key, $deskripsi) {
        $data = array(
            'username' => $user,
            'file_name_source' => $filename,
            'file_name_finish' => $encryptedFilename,
            'file_url' => $fileUrl,
            'file_size' => $fileSize,
            'password' => $key,
            'tgl_upload' => date('Y-m-d H:i:s'),
            'status' => '1',
            'keterangan' => $deskripsi
        );

        $this->db->insert('file', $data);
    }
    public function tberkas_enkripsi()
    {
        $this->db->from($this->table);
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function tberkas_dekripsi()
    {
        $this->db->from($this->table);
        $this->db->where('status', '2');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_file', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getFileById($idFile)
    {
        $query = $this->db->get_where($this->table, array('id_file' => $idFile));
        return $query->row_array();
    }
    public function checkPassword($idfile, $pwdfile) {
        $this->db->select('id_file');
        $this->db->from('file');
        $this->db->where('id_file', $idfile);
        $this->db->where('password', $pwdfile);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? true : false;
    }

    public function getFileData($idfile) {
        $this->db->select('*');
        $this->db->from('file');
        $this->db->where('id_file', $idfile);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->row_array() : false;
    }

    public function updateFileStatus($idfile) {
        $data = array('status' => '2');
        $this->db->where('id_file', $idfile);
        $this->db->update('file', $data);
    }
}