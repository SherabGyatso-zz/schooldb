<?php

class staff {
    public $db;
    public $table='staffstrength';
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function get_staff($id=0, $action='') {
        $cond = '';
        if($id != 0 && $action == '') {
            $cond = "schoolinfo =".$id;
        }elseif($action != '') {
            $cond = 'ID='.$id;
        }        
        if($this->db->select($this->table, $cond)) {
            return $this->db->get_results();
        }
    }
    
    function get_new_staff_id() {
        return $this->db->get_insert_id();
    }

    function add_staff($post=array()) {
        return $this->db->insert($this->table, $post);
    }

    function update_staff($post = array(), $condition = '') {
        return $this->db->update($this->table, $post, $condition);
    }
    
      function delete_staff($condition) {
        return $this->db->delete($this->table, $condition);
    }
}

