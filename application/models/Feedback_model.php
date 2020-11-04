<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {

	public function __construct() {

		parent::__construct();

		$this->table = 'website_feedback';
		$this->primary_key = 'id';
	
	}

	public function save($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data) {
		return $this->db->update($this->table, $data, $where);
	}

	public function delete($id, $data) {
		return $this->db->delete($this->table, $data);
	}

	public function is_exists($email, $mobile) {
		$this->db->where(['email' => $email]);
		$this->db->or_where(['mobile' => $mobile]);
		return $this->db->get($this->table)->num_rows();

	}

	public function get($data) {
		return $this->db
						->where($data)	
						->get($this->table)
						->row();
	}

	public function get_all($data) {
		return $this->db
						->where($data)	
						->get($this->table)
						->result();
	}

}