<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Admin_model extends CI_Model
{
    public $table = 'user';
    public $id = 'user.id';
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
   
}