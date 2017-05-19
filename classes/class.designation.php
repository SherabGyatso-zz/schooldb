<?php

class designation {
    
    public $db;
    public $table ='designation';
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function get_designation($id=0) {
        $cond='';
        if($id != 0) $cond="ID=" . $id;
        if($this->db->select($this->table, $cond))
            return $this->db->get_results();
        else
            return false;
        
    }
    
    function get_designation_list() {
        $designations = $this->get_designation();
        if(is_array($designations) && count($designations)) {
            $designation_list = array();
            foreach($designations as $designation) {
                $designation_list[$designation['ID']] = $designation['designation'];
            }
  
            return $designation_list;
        }else {
            return false;
        }
    }
    
    function update_designation($post=array(), $cond='') {
        return $this->db->update($this->table, $post, $cond);
    }

    function add_designation($post=array()) {
        return $this->db->insert($this->table, $post);
    }
}
