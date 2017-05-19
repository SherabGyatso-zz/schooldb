<?php

/**
 * School Class
 *
 * @author Pema Zomkyi
 */
class school {

    public $db;
    public $table = 'school';

    function __construct($db) {
        $this->db = $db;
    }

     function get_school_id() {
        return $this->db->get_insert_id();
    }


    /*function get_school($id = '') {
        //when editing school
         $cond='';
        if ($id != 0) $cond="SchoolID" . $id;
        if($this->db->select($this->table, $cond))
            return $this->db->get_results();
         else {
            $cond = "SchoolID='" . $id . "'";
        return false;
        }
    }*/


    function get_school($id = '') {
        //when editing school
        if ($id == '') {
            $cond = '';
        } else {
            $cond = "SchoolID='" . $id . "'";
        }
        
        $orderby = "SchoolName ASC";
    
        if ($this->db->select($this->table, $cond, $orderby)) {
            return $this->db->get_results();
        } else {
            return false;
        }
    }
    

    function get_school_list() {
        $schools = $this->get_school();
        if (is_array($schools) && count($schools)) {
            $school_list = array();
            foreach ($schools as $_school) {
                $school_list[$_school['SchoolID']] = $_school['SchoolName'];
            }
            return $school_list;
        }else {
            return false;
        }
    }

    function get_school_names() {
        $schools = $this->get_school();
        if (is_array($schools) && count($schools)) {
            $school_list = array();
            foreach ($schools as $_school) {
                $school_list[] = $_school['SchoolName'];
                
            }
            return $school_list;
        }else {
            return false;
        }
    }

        function get_student_total_by_classdetail($dl_cond_catch) {
        $h_qresult = $this->db->db_get_student_total_by_classdetail($dl_cond_catch);
        return $h_qresult;
   }

    function get_student_total_by_schools($dl_cond_catch) {
        $h_qresult = $this->db->db_get_student_total_by_schools($dl_cond_catch);
        return $h_qresult;
   }
   function get_student_total_by_class($dl_cond_catch) {
        $h_qresult = $this->db->db_get_student_total_by_class($dl_cond_catch);
        return $h_qresult;
   }
   function get_staff_total_by_staff($dl_cond_catch) {
        $h_qresult = $this->db->db_get_staff_total_by_staff($dl_cond_catch);
        return $h_qresult;
   }
    function get_student_result($dl_cond_catch) {
        $h_qresult = $this->db->db_get_student_result($dl_cond_catch);
        return $h_qresult;
   }
    function get_overall_school_category_result($dl_cond_catch) {
        $h_qresult = $this->db->db_get_overall_school_category_result($dl_cond_catch);
        return $h_qresult;
   }
     function get_overall_school_category_staff_result($dl_cond_catch) {
        $h_qresult = $this->db->db_get_overall_school_category_staff_result($dl_cond_catch);
        return $h_qresult;
   }
       function get_school_category_result($dl_cond_catch,$cat1) {
        $h_qresult = $this->db->db_get_school_category_result($dl_cond_catch,$cat1);
        return $h_qresult;
   }





       function get_latest_data_student() {
        $h_qresult = $this->db->db_get_latest_data_student();
        return $h_qresult;
}
        function get_latest_data_staff() {
        $h_qresult = $this->db->db_get_latest_data_staff();
        return $h_qresult;

/*
echo '<pre>';
print_r ($h_qresult);
echo '</pre>';
*/

    }

    function update_school($post=array(),$cond='') {
        return $this->db->update($this->table, $post, $cond);
    }

     function add_school($post=array()) {
        return $this->db->insert($this->table, $post);
    }
}
