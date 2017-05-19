<?php

/**
 * School Class
 *
 * @author Pema Zomkyi
 */
class schoolcat {

    public $db;
    public $table = 'schoolcategory';

    function __construct($db) {
        $this->db = $db;
    }


    //fetch whole result of mysql_query
    function get_school($id = 0) {

        if ($id != 0) {
            $cond = 'SchoolCategoryId =' . $id;
        } else {
            $cond = '';
        }

        if ($this->db->select($this->table, $cond))
            return $this->db->get_results();
        else
            return false;
    }


      function get_schoolcat($id = 0) {

        if ($id != 0) {
            $cond = 'SchoolCategoryId =' . $id;
        } else {
            $cond = '';
        }

        if ($this->db->select($this->table, $cond))
            return $this->db->get_results();
        else
            return false;
    }

    //fetching array of school category name
    function get_school_cat_list() {
        $school_categories = $this->get_school();
        if (is_array($school_categories) && count($school_categories)) {
            $school_cats = array();
            foreach ($school_categories as $school_category) {
                $school_cats[$school_category['SchoolCategoryId']] = $school_category['SchoolCategoryName'];
            }
            return $school_cats;
        } else {
            return false;
        }
    }

    function update_school_category($post = array(),$condition) {
        return $this->db->update($this->table,$post, $condition);
    }

    function add_school_category($post = array()) {
        return $this->db->insert($this->table, $post);
        
    }
    function get_school_category_id() {
        return $this->db->get_insert_id();
    }

}
