<?php
class m_users extends CI_Model{
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function table(){
        return "users";
    }

    public function key_id(){
        return "users_id";
    }

    public function get($id = null){
        $table = $this->table();
        $key = $this->key_id();
        if($id === null){
            return $this->db->get($table)->result_array();
        }else {
            return $this->db->get_where($table,[$key => $id])->result_array();
        }
    }

    public function _delete($id){
        $table = $this->table();
        $key = $this->key_id();
        $this->db->delete($table,[$key => $id]);
        return $this->db->affected_rows();
    }

    public function _insert($data){
        $table = $this->table();
        $key = $this->key_id();
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function _update($data,$id){
        $table = $this->table();
        $key = $this->key_id();
        $this->db->update($table, $data, [$key => $id]);
        return $this->db->affected_rows();
    }
    
    

}