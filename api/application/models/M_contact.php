<?php
class m_contact extends CI_Model{
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function table(){
        $table = "phone";
        return $table;
    }

    public function get($id = null){
        $table = $this->table();
        if($id === null){
            return $this->db->get($table)->result_array();
        }else {
            return $this->db->get_where($table,['id'=>$id])->result_array();
        }
    }

    public function _delete($id){
        $table = $this->table();
        $this->db->delete($table,['id' => $id]);
        return $this->db->affected_rows();
    }

    public function _insert($data){
        $table = $this->table();
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function _update($data,$id){
        $table = $this->table();
        $this->db->update($table, $data, ['id'=>$id]);
        return $this->db->affected_rows();
    }
    
}