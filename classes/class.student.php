<?php

class student {
    public $db;
    public $table ='studentstrength';
    
    function __construct($db) {
        $this->db = $db;
    }
    
    function get_student($id = '', $action='') {
        $cond = '';
        if($id != 0 && $action == '') {
            $cond = "typeid =".$id;
        }elseif($action != '') {
            $cond = 'detailid='.$id;
        }
       
        if($this->db->select($this->table, $cond)) {
            return $this->db->get_results();
        }       
    }
    
    function add_student($post=array()) {
        //check if duplicate record exit in database
        //print_r($post);
       // $cond='class=$post['class'] and typeid='.$id;
         // if($this->db->select($this->table, $cond)) {
            //return $this->db->get_results();
        //} 
        return $this->db->insert($this->table, $post);
    }
    
    function complex_query_for_reporting($sql) {
        if($sql != '') {
        if($this->db->select_for_reporting($sql))  {
            return $this->db->get_results();
        }
        }
    }
    
    function update_student($post = array(), $condition = '') {
        return $this->db->update($this->table, $post, $condition);
    }
    
    function delete_student($condition) {
        return $this->db->delete($this->table, $condition);
    }

     /*function get_student($id = '') {
        $cond = '';
        if($id != '') {
            $cond='typeid='.$id;
        }
        if($this->db->select($this->table, $cond)) {
            return $this->db->get_results();
        }       
    }*/
    
}
