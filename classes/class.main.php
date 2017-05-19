<?php

Class main_class {
    public $db;
    public $table ='staffhead';
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function get_staff_head_id() {
        return $this->db->get_insert_id();
    }
    
    function get_main_detail($id='', $dl='') {
        
        $cond = '';
        if($id != '') {
            $cond = "schooltype=".$id;
        }
        if($dl != '') {
            $cond .="deadline='".$dl."'";
        }
        if($this->db->select($this->table, $cond)) {
            return $this->db->get_results();
        }else {
            return false;
        }
        
    }
    
    function add_staff_head($post=array()) {
        return $this->db->insert($this->table, $post);          
    }
    
    function update_staff_head($post = array(), $condition = '') {

        return $this->db->update($this->table, $post, $condition);
    }

    
    function get_deadline() {
        $d_col = " deadline ";
        
        if($this->db->select($this->table,'',$d_col,false,'','','','',true,$d_col,'DESC')) {
            return $this->db->get_results();
        }else {
            return false;
        }
    }
}
