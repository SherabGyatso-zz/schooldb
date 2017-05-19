<?php

class result {
    public $db;
    public $table = 'genresult';
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function get_result($id=0, $action='') {
        $cond = '';
        if($id != 0 && $action == '') {
            $cond = "schooltype =".$id;
        }elseif($action != '') {
            $cond = 'resultid='.$id;
        }
        if($this->db->select($this->table, $cond)) {
            return $this->db->get_results();
        }
    }

    function add_result($post=array()) {
        
        return $this->db->insert($this->table, $post);
    }
    
    function delete_result($condition) {
        return $this->db->delete($this->table, $condition);
    }

    function update_result($post = array(), $condition = '') {

        return $this->db->update($this->table, $post, $condition);
    }
}