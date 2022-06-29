<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $_table_name;
	protected $_order_by;
	protected $_order_by_type = 'ASC';
	protected $_primary_filter = 'intval';
	protected $_primary_key;
	protected $_type;
	public $rules;



	public function __construct()
	{ 
		parent::__construct();
		
	}

	public function insert($data,$batch=FALSE){
		if ($batch == TRUE) {
			$this->db->insert_batch('{PRE}'.$this->_table_name, $data);
			// $this->db->insert_batch('tbl_user', $data);
		} else {
			$this->db->set($data);
			$this->db->insert('{PRE}'.$this->_table_name);
			$id = $this->db->insert_id();
			return $id;
		}
	}
	public function update($data,$where=[]){
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('{PRE}'.$this->_table_name);
	}
	public function get($id=NULL,$single=FALSE){
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key,$id);
			$method = 'row';
			
		}else if ($single == TRUE) {
			$method = 'row';
		}else {
			$method	= 'result';
		}
		if ($this->_order_by_type) {
			$this->db->order_by($this->_order_by,$this->_order_by_type);
			// $this->db->order_by('ID','DESC');
		} else {
			$this->db->order_by($this->_order_by);
		}

		return $this->db->get('{PRE}'.$this->_table_name)->$method();
	}
	public function get_by($where=NULL, $limit=NULL, $offset=NULL, $single=FALSE, $select=NULL){
		if ($select != NULL) {
			$this->db->select($select);
		}
		
		if ($where) {
			$this->db->where($where);			
		}
		if (($limit) && ($offset)) {
			$this->db->limit($limit,$offset);
		}
		else if($limit){
			$this->db->limit($limit);
		}
		return $this->get(NULL,$single);
	}
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key,$id);
		$this->db->limit(1);
		$this->db->delete('{PRE}'.$this->_table_name);
	}
	public function delete_by($where=NULL){
		if ($where) {
			$this->db->where($where);
		}

		$this->db->delete('{PRE}'.$this->_table_name);
	}
	public function count($where=NULL){
		if ($where) {
			$this->db->where($where);
		}
		$this->db->from('{PRE}'.$this->_table_name);
		return $this->db->count_all_results();
	}

}