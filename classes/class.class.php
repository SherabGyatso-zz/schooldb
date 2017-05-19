<?php
class school_class {
    public $db;
    public $table ='class';
    
    function __construct($db) {
       $this->db = $db;   
}
    function get_class($id = 0) {
        $cond='';
        
        if($id != 0) {
            $cond = "classid =". $id;
        }
        if($this->db->select($this->table, $cond)){
            return $this->db->get_results();
        }else{
            return false;
        }
    }
    
    function get_class_list() {
        $classes = $this->get_class();
        if(is_array($classes) && count($classes)) {
            $class_list = array();
            foreach($classes as $_class) {
                $class_list[$_class['classid']] = $_class['class'];
            }
            return $class_list;
        }else {
            return false;
        }
    }
    
    function update_class($post=array(), $cond) {
        return $this->db->update($this->table, $post, $cond);       
    }
}
