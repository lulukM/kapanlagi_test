<?php

class Data_model extends CI_Model{

	public function getData(){
		return $this->db->get('data_diri');
	}

	public function get_data_user($id){
		return $this->db->query("select*from data_diri where id='$id'")->row();
	}

	public function add_user($data){
		return $this->db->insert('data_diri', $data);
	}

	public function update_user($id,$data){
		return $this->db->where('id', $id)
						->update('data_diri', $data);
	}	

	public function delete_user($id){
		return $this->db->where('id', $id)
						->delete('data_diri');
	}


}
?>