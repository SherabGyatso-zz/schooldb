<?php
/**
 * Database Class
 *
 * @author Pema Zomkyi
 */

class database {

	private $resource;
	private $link;
	private $num_rows = null;
	private $insert_id = null;
	private $valid_resource = false;

	function __construct() {
	//mysql_connect(HOSTNAME, USERNAME, PASSWORD);
	//mysql_select_db(DATABASE);
		$this->link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		return $this;
	}

	function select_direct($query) {
		return mysqli_query($this->link, $sql);
	}

	function select( $table = '', $conditions = '', $order_by ='', $count = false,  $group_by = '', $agg = '', $agg_col = '',
		$agg_other_cols = '', $distinct = false, $distinct_col = '', $order = '') {

		$return = array();

		if (trim($table) != '') {
			if (trim($conditions) == '') {
				$conditions = ' 1 = 1';
			}
			if ($count) {
				$sql = "SELECT count(*) as count_rows ";
			}elseif($distinct) {
				$sql = "SELECT DISTINCT $distinct_col";
			}else {
				$sql = "SELECT * ";
			}

			if(trim($agg) != '' && trim($agg_col) != '') {
				$sql = "SELECT $agg($agg_col) as $agg_col, $agg_other_cols ";
			}

			$sql .= "FROM $table WHERE $conditions";

			if(trim($order_by) != '') {
				if(trim($order) != '') {
					$sql .= " ORDER BY $order_by $order";
				}else {
					$sql .= " ORDER BY $order_by";
				}                   
			} 

			if(trim($group_by) != '') {
				$sql .= " GROUP BY $group_by;";
			} else {
				$sql .= ";";
			}

	    //echo $sql."<br />";
            //exit;
			$this->query($sql);
			if ($this->valid_resource && ($this->num_rows > 0)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		return $return;
	}


	private function query($sql = '', $type = 'select') {
		if (trim($sql) != '') {

			$this->resource = mysqli_query($this->link, $sql);
			if (!$this->resource) {
				return false;
			}

			switch($type) {
				case 'insert':
				$this->set_insert_id();
				break;
				case 'select':
				$this->set_number_of_results();
				break;
				case 'update':
				break;
				default:
		    //
			}
			$this->valid_resource = true;
	    //return $this->valid_resource;
		} else {
			return false;
		}
	}

	function update($table = '', $data = array(), $conditions = '') {
		if (trim($table) == '' || trim($conditions) == '' || !is_array($data) || count($data) == 0) {
			return false;
		}

		$sql = $this->create_update_sql($table, $data, $conditions);
        //echo $sql;
        //exit;
		$this->query($sql, 'update');

		return $this->valid_resource;
	}

	function delete($table = '', $condition = '') {
		if (
			trim($table) == ''
			|| trim($condition) == '' 
			|| trim($condition) == '1 = 1'
			|| trim($condition) == '1=1'
			|| trim($condition) == '1 =1' 
			|| trim($condition) == '1= 1'
			) {
			return false;
			}
		$sql = "DELETE FROM $table WHERE $condition;";

		$this->query($sql);

		return $this->valid_resource;
	}

	function insert($table = '', $data = array()) {
		if (trim($table) == '' || !is_array($data) || count($data) == 0) {
			return false;
		}

		$sql = $this->create_insert_sql($table, $data);
			//echo $sql; 
		$this->query($sql,'insert');

		return $this->valid_resource;
	}

	function get_results() {
		$result = array();
		while ($row = mysqli_fetch_array($this->resource)) {
			$result[] = $row;
		}
		return $result;
	}

	function get_one_result() {
		return mysqli_fetch_array($this->resource);
	}
	

	function get_number_of_results() {
		return $this->num_rows;
	}

	function get_db_instance() {
		return $this;
	}

	function get_insert_id() {
		return $this->insert_id;
	}

function db_get_student_total_by_classdetail($dl_catch) {
	

		$sql = "SELECT 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	Sum(tboy) AS tibetanboys, 
Sum(tgirl) AS tibetangirls, 
Sum(tboy + tgirl) AS total1, 
Sum(nboy) AS himalayanboys, 
Sum(ngirl) AS himalayangirls, 
Sum(nboy + ngirl) AS total2, 
sum(hboy) as 'Indianboys', 
sum(hgirl) as 'Indiangirls', 
	sum(hboy + hgirl) as 'total3', 
Sum(dboy) AS Dayboys, 
Sum(dgirl) AS Daygirls, 
Sum(dboy + dgirl) AS total4, 
Sum(bboy) AS boardingboys, 
Sum(bgirl) AS boardinggirls, 

Sum(bboy + bgirl) AS total5, 
Sum(dboy + bboy) AS TotalBoy, 
Sum(dgirl + dgirl) AS TotalGirl, 
sum(dboy + bboy + dgirl + bgirl) as 'Grand Total', 
staffhead.deadline, 
class.class, 
school.sortby, 
class.sortby, 
school.status 
FROM 
	class 
	INNER JOIN (
		schoolcategory 
		INNER JOIN (
			(
				school 
				INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid
			) 
			INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid
		) ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
	) ON class.classid = studentstrength.class 
WHERE 
	staffhead.deadline = '$dl_catch' 
GROUP BY 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	staffhead.deadline, 
	class.class, 
	school.sortby, 
	class.sortby, 
	school.status 
ORDER BY 
	school.SchoolName,
	school.sortby, 
	class.sortby";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	#echo "Problem";
	  }

	}  // end function.


	function db_get_student_total_by_schools($dl_catch) {

		$sql = "select school.SchoolName, sum(studentstrength.tboy) as 'tibetanboys', sum(studentstrength.tgirl) as 'tibetangirls', sum(tboy) + sum(tgirl) as 'total1', 
				 sum(studentstrength.nboy) as 'himalayanboys', sum(studentstrength.ngirl) as 'himalayangirls', sum(nboy) + sum(ngirl) as 'total2',
				 sum(studentstrength.hboy) as 'Indianboys', sum(studentstrength.hgirl) as 'Indiangirls', sum(hboy) + sum(hgirl) as 'total3', 
				 sum(studentstrength.dboy) as 'Dayboys', sum(studentstrength.dgirl) as 'Daygirls', sum(dboy) + sum(dgirl) as 'total4',sum(studentstrength.bboy) as 'boardingboys', sum(studentstrength.bgirl) as 'boardinggirls', sum(bboy) + sum(bgirl) as 'total5', 
				 sum(dboy) + sum(bboy) as 'TotalBoy',
				 sum(dgirl) + sum(bgirl) as 'TotalGirl', 
				 sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Grand Total',
				 staffhead.deadline from studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline = '$dl_catch' 
				  GROUP by school.SchoolName order by school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	#echo "Problem";
	  }

	}  // end function.

	function db_get_student_total_by_class($dl_catch) {
		$sql = "SELECT SchoolName,
IFNULL(MAX(CASE WHEN class = 1 THEN (dboy+dgirl+bboy+bgirl) END),0) PrePrimary,
IFNULL(MAX(CASE WHEN class = 2 THEN (dboy+dgirl+bboy+bgirl) END),0)  I,
IFNULL(MAX(CASE WHEN class = 3 THEN (dboy+dgirl+bboy+bgirl) END),0)  II,
IFNULL(MAX(CASE WHEN class = 4 THEN (dboy+dgirl+bboy+bgirl) END),0)  III,
IFNULL(MAX(CASE WHEN class = 5 THEN (dboy+dgirl+bboy+bgirl) END),0)  IV,
IFNULL(MAX(CASE WHEN class = 6 THEN (dboy+dgirl+bboy+bgirl) END),0)  V,
IFNULL(MAX(CASE WHEN class = 7 THEN (dboy+dgirl+bboy+bgirl) END),0)  VI,
IFNULL(MAX(CASE WHEN class = 8 THEN (dboy+dgirl+bboy+bgirl) END),0)  VII,
IFNULL(MAX(CASE WHEN class = 9 THEN (dboy+dgirl+bboy+bgirl) END),0)  VIII,
IFNULL(MAX(CASE WHEN class = 10 THEN (dboy+dgirl+bboy+bgirl) END),0) IX,
IFNULL(MAX(CASE WHEN class = 11 THEN (dboy+dgirl+bboy+bgirl) END),0) X,
IFNULL(MAX(CASE WHEN class = 12 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Sc,
IFNULL(MAX(CASE WHEN class = 13 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Com,
IFNULL(MAX(CASE WHEN class = 14 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Hum,
IFNULL(MAX(CASE WHEN class = 15 THEN (dboy+dgirl+bboy+bgirl) END),0) XI_Voc,
IFNULL(MAX(CASE WHEN class = 16 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Com,
IFNULL(MAX(CASE WHEN class = 17 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Hum,
IFNULL(MAX(CASE WHEN class = 18 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Sc,
IFNULL(MAX(CASE WHEN class = 19 THEN (dboy+dgirl+bboy+bgirl) END),0) XII_Voc,
IFNULL(MAX(CASE WHEN class = 20 THEN (dboy+dgirl+bboy+bgirl) END),0) Special_Class,
IFNULL(MAX(CASE WHEN class = 21 THEN (dboy+dgirl+bboy+bgirl) END),0) OC,

sum(dboy) + sum(dgirl) + sum(bboy) + sum(bgirl) as 'Grand Total'

FROM studentstrength ss 
inner join staffhead on ss.typeid = staffhead.schooltype 
inner join school on staffhead.schoolid = school.SchoolID

where staffhead.deadline='$dl_catch'
GROUP By school.SchoolName
ORDER BY school.sortby ASC"; 

	$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}
/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	#echo "Problem";
	  }

	}  // end function.


	function db_get_staff_total_by_staff($dl_catch) {
		$sql = "SELECT SchoolName,
IFNULL(MAX(CASE WHEN designationid = 1 THEN (Female+Male) END),0) Princ,
IFNULL(MAX(CASE WHEN designationid = 2 THEN (Female+Male) END),0) Rect,
IFNULL(MAX(CASE WHEN designationid = 3 THEN (Female+Male) END),0) Dir,
IFNULL(MAX(CASE WHEN designationid = 4 THEN (Female+Male) END),0) Headm,
IFNULL(MAX(CASE WHEN designationid = 5 THEN (Female+Male)END),0) PGTNTibLang,
IFNULL(MAX(CASE WHEN designationid = 6 THEN (Female+Male) END),0) TGTNTibLang,
IFNULL(MAX(CASE WHEN designationid = 7 THEN (Female+Male) END),0) PGTTibLang,
IFNULL(MAX(CASE WHEN designationid = 8 THEN (Female+Male) END),0) TGTTibLang,
IFNULL(MAX(CASE WHEN designationid = 9 THEN (Female+Male) END),0) PRT,
IFNULL(MAX(CASE WHEN designationid = 10 THEN (Female+Male) END),0) PrePriTeacher,
IFNULL(MAX(CASE WHEN designationid = 11 THEN (Female+Male) END),0) Cultural,
IFNULL(MAX(CASE WHEN designationid = 12 THEN (Female+Male) END),0) Computer,
IFNULL(MAX(CASE WHEN designationid = 13 THEN (Female+Male) END),0) WoodCraft,
IFNULL(MAX(CASE WHEN designationid = 14 THEN (Female+Male) END),0) Tailoring,
IFNULL(MAX(CASE WHEN designationid = 15 THEN (Female+Male) END),0) PhysicalEducation,
IFNULL(MAX(CASE WHEN designationid = 16 THEN (Female+Male) END),0) Drawing,
IFNULL(MAX(CASE WHEN designationid = 17 THEN (Female+Male) END),0) DanceMusic,
IFNULL(MAX(CASE WHEN designationid = 18 THEN (Female+Male) END),0) NonTeachingStaff,
IFNULL(MAX(CASE WHEN designationid = 19 THEN (Female+Male) END),0) Tibetstaff,
IFNULL(MAX(CASE WHEN designationid = 20 THEN (Female+Male) END),0) NonTibetanStaff,
IFNULL(MAX(CASE WHEN designationid = 21 THEN (Female+Male) END),0) Librarian,
IFNULL(MAX(CASE WHEN designationid = 22 THEN (Female+Male) END),0) CareerCounselor,
IFNULL(MAX(CASE WHEN designationid = 23 THEN (Female+Male) END),0) Supervisor,
IFNULL(MAX(CASE WHEN designationid = 24 THEN (Female+Male) END),0) ChineseLang,
IFNULL(MAX(CASE WHEN designationid = 25 THEN (Female+Male) END),0) Religion,
TRUNCATE((sum(Female) + sum(Male)) / 2,0) as 'Grand Total'

FROM staffstrength staffstr
inner join staffhead on staffstr.schoolinfo = staffhead.schooltype 
inner join school on staffhead.schoolid = school.SchoolID

where staffhead.deadline='$dl_catch'
GROUP By school.SchoolName
ORDER BY school.sortby ASC"; 

	$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}
/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	#echo "Problem";
	  }

	}  // end function.
function db_get_student_result($dl_catch) {

		$sql = "SELECT 
	SchoolCategoryName, 
	SchoolName, 
	IFNULL(totstu,0) Total, 
	IFNULL(stuappear,0) Appeared, 
	IFNULL(stupromoted,0) Pass, 
	IFNULL(sturetain,0) Fail,
    TRUNCATE((stupromoted/stuappear) * 100,1) AS PassPercentage,
    IFNULL(TRUNCATE((sturetain/stuappear) * 100,1),0) AS FailPercentage,
	school.sortby, 
	staffhead.deadline 

FROM 
	(
		schoolcategory 
		INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
	) 
	INNER JOIN (
		genresult 
		INNER JOIN staffhead ON genresult.schooltype = staffhead.schooltype
	) ON school.SchoolID = staffhead.schoolid 
WHERE 
	(
		(
			(staffhead.deadline)= '$dl_catch'
		)
	) 
GROUP By school.SchoolName
ORDER By school.sortby";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.

function db_get_overall_school_category_result($dl_catch) {

		$sql = "select 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName,
	sum(studentstrength.tboy) as 'tibetanboys', 
	sum(studentstrength.tgirl) as 'tibetangirls', 
	sum(tboy) + sum(tgirl) as 'total1', 
	sum(studentstrength.hboy) as 'himalayanboys', 
	sum(studentstrength.hgirl) as 'himalayangirls', 
	sum(hboy) + sum(hgirl) as 'total2', 
	sum(studentstrength.nboy) as 'Indianboys', 
	sum(studentstrength.ngirl) as 'Indiangirls', 
	sum(nboy) + sum(ngirl) as 'total3', 
	sum(studentstrength.dboy) as 'Dayboys', 
	sum(studentstrength.dgirl) as 'Daygirls', 
	sum(dboy) + sum(dgirl) as 'total4', 
	sum(studentstrength.bboy) as 'boardingboys', 
	sum(studentstrength.bgirl) as 'boardinggirls', 
	sum(bboy) + sum(bgirl) as 'total5', 
	sum(tboy) + sum(hboy) + sum(nboy) as 'TotalBoy', 
	sum(tgirl) + sum(hgirl) + sum(ngirl) as 'TotalGirl', 
	sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Grand Total', 
	staffhead.deadline 
from 
	studentstrength 
	inner join (
		staffhead 
		INNER JOIN(
			schoolcategory 
			INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
		) ON staffhead.schoolid = school.SchoolID
	) ON studentstrength.typeid = staffhead.schooltype 
where 
	staffhead.deadline = '$dl_catch'
GROUP by 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName
order by 
	school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.




		


	function db_get_school_category_result($dl_catch,$cat_1) {
		//print_r($cat_1,$cat_2);

		$sql = "select 
	schoolcategory.schoolCategoryId,
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	sum(studentstrength.tboy) as 'tibetanboys', 
	sum(studentstrength.tgirl) as 'tibetangirls', 
	sum(tboy) + sum(tgirl) as 'total1', 
	sum(studentstrength.hboy) as 'himalayanboys', 
	sum(studentstrength.hgirl) as 'himalayangirls', 
	sum(hboy) + sum(hgirl) as 'total2', 
	sum(studentstrength.nboy) as 'Indianboys', 
	sum(studentstrength.ngirl) as 'Indiangirls', 
	sum(nboy) + sum(ngirl) as 'total3', 
	sum(studentstrength.dboy) as 'Dayboys', 
	sum(studentstrength.dgirl) as 'Daygirls', 
	sum(dboy) + sum(dgirl) as 'total4', 
	sum(studentstrength.bboy) as 'boardingboys', 
	sum(studentstrength.bgirl) as 'boardinggirls', 
	sum(bboy) + sum(bgirl) as 'total5', 
	sum(dboy) + sum(bboy) as 'TotalBoy', 
	sum(dgirl) + sum(bgirl) as 'TotalGirl', 
	sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Grand Total', 
	staffhead.deadline 
from 
	studentstrength 
	inner join (
		staffhead 
		INNER JOIN(
			schoolcategory 
			INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
		) ON staffhead.schoolid = school.SchoolID
	) ON studentstrength.typeid = staffhead.schooltype 
where 
	staffhead.deadline = '$dl_catch' AND school.SchoolCategoryId in ('$cat_1')
GROUP by 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName, 
	school.SchoolName, 
	school.sortby, 
	school.status 
order by 
	school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.




	function db_get_overall_school_category_staff_result($dl_catch) {

		$sql = "select 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName,   
    school.SchoolName,
IFNULL(SUM(CASE WHEN designationid = 1 THEN (Female+Male) END),0) as Princ,
IFNULL(SUM(CASE WHEN designationid = 2 THEN (Female+Male) END),0) as Rect,
IFNULL(SUM(CASE WHEN designationid = 3 THEN (Female+Male) END),0) as Dir,
IFNULL(SUM(CASE WHEN designationid = 4 THEN (Female+Male) END),0) as Headm,
IFNULL(SUM(CASE WHEN designationid = 5 THEN (Female+Male)END),0)  as PGTNTibLang,
IFNULL(SUM(CASE WHEN designationid = 6 THEN (Female+Male) END),0) as TGTNTibLang,
IFNULL(SUM(CASE WHEN designationid = 7 THEN (Female+Male) END),0) as PGTTibLang,
IFNULL(SUM(CASE WHEN designationid = 8 THEN (Female+Male) END),0) as TGTTibLang,
IFNULL(SUM(CASE WHEN designationid = 9 THEN (Female+Male) END),0) as PRT,
IFNULL(SUM(CASE WHEN designationid = 10 THEN (Female+Male) END),0) as PrePriTeacher,
IFNULL(SUM(CASE WHEN designationid = 11 THEN (Female+Male) END),0) as Cultural,
IFNULL(SUM(CASE WHEN designationid = 12 THEN (Female+Male) END),0) as Computer,
IFNULL(SUM(CASE WHEN designationid = 13 THEN (Female+Male) END),0) as WoodCraft,
IFNULL(SUM(CASE WHEN designationid = 14 THEN (Female+Male) END),0) as Tailoring,
IFNULL(SUM(CASE WHEN designationid = 15 THEN (Female+Male) END),0) as PhysicalEducation,
IFNULL(SUM(CASE WHEN designationid = 16 THEN (Female+Male) END),0) as Drawing,
IFNULL(SUM(CASE WHEN designationid = 17 THEN (Female+Male) END),0) as DanceMusic,
IFNULL(SUM(CASE WHEN designationid = 18 THEN (Female+Male) END),0) as NonTeachingStaff,
IFNULL(SUM(CASE WHEN designationid = 19 THEN (Female+Male) END),0) as Tibetstaff,
IFNULL(SUM(CASE WHEN designationid = 20 THEN (Female+Male) END),0) as NonTibetanStaff,
IFNULL(SUM(CASE WHEN designationid = 21 THEN (Female+Male) END),0) as Librarian,
IFNULL(SUM(CASE WHEN designationid = 22 THEN (Female+Male) END),0) as CareerCounselor,
IFNULL(SUM(CASE WHEN designationid = 23 THEN (Female+Male) END),0) as Supervisor,
IFNULL(SUM(CASE WHEN designationid = 24 THEN (Female+Male) END),0) as ChineseLang,
IFNULL(SUM(CASE WHEN designationid = 25 THEN (Female+Male) END),0) as Religion,
TRUNCATE((sum(Female) + sum(Male)) / 2,0) as 'Grand Total', 
	staffhead.deadline 
from 
	staffstrength
	inner join (
		staffhead 
		INNER JOIN(
			schoolcategory 
			INNER JOIN school ON schoolcategory.SchoolCategoryId = school.SchoolCategoryId
		) ON staffhead.schoolid = school.SchoolID
	) ON staffstrength.schoolinfo = staffhead.schooltype 
where 
	staffhead.deadline = '$dl_catch'
GROUP by 
	schoolcategory.schoolcatname, 
	schoolcategory.SchoolCategoryName
order by 
	school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.



	

		function db_get_latest_data_student() {

		$sql = "select school.sortby, school.SchoolName, sum(dboy) + sum(bboy) + sum(dgirl) + sum(bgirl) as 'Student',  staffhead.deadline as 'reporting' from  studentstrength inner join staffhead ON studentstrength.typeid = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline = (select MAX(deadline) from staffhead) GROUP by school.SchoolName order by school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.


		function db_get_latest_data_staff() {

		$sql = "select school.sortby,school.SchoolName,truncate((sum(Female) + sum(Male)) / 2, 0) as 'Staff', 
staffhead.deadline from staffstrength inner join staffhead ON staffstrength.schoolinfo = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline= (select MAX(deadline) from staffhead) GROUP by school.SchoolName order by school.sortby ASC";
	
		#$this->resource = mysqli_query($this->link, $sql);
    #mysql_real_escape_string($_POST['dl'])
		$this->query($sql);
		if ($this->valid_resource && ($this->num_rows > 0)) {
		   	 $h_result = array();
				 while ($row = mysqli_fetch_array($this->resource)) {
					   $h_result[] = $row;
				}

/*
echo '<pre>';
print_r ($h_result);
echo '</pre>';
*/
				return ($h_result);

		} else {
		  	//echo "Problem";
	  }

	}  // end function.



	function set_insert_id() {
		$this->insert_id = mysqli_insert_id($this->link);
		#$this->insert_id = mysqli($this->link);     
	}

	function set_number_of_results() {
		$this->num_rows = mysqli_num_rows($this->resource);
	}

	private function create_insert_sql($table = '', $data = array()) {
		$sql = "INSERT INTO $table ";
		$columns = array();
		$values = array();
		$_columns = '';
		$_values = '';
		$i = 0;

		foreach ($data as $k => $v) {
			$columns[$i] = $k;
			$values[$i] = $v;
			$i++;
		}

		$first = true;
		foreach ($columns as $k => $column) {
			if ($first) {
				$_columns .= "`{$column}`";
				$_values .= "'{$values[$k]}'";
				$first = false;
			} else {
				$_columns .= ", `{$column}`";
				$_values .= ", '{$values[$k]}'";
			}
		}
		$sql .= " ($_columns) VALUES ($_values) ;";
		return $sql;
	}

	private function create_update_sql($table = '', $data = array(), $conditions = '') {
		$sql = "UPDATE `$table` SET ";
		$columns = array();
		$values = array();
		$_columns = '';
		$_values = '';
		$i = 0;
		foreach ($data as $k => $v) {
			$columns[$i] = $k;
			$values[$i] = $v;
			$i++;
		}

		$first = true;
		foreach ($columns as $k => $column) {
			if ($first) {
				$first = false;
			} else {
				$sql .= ', ';
			}
			if(is_numeric($values[$k])) {
				$sql .= "`{$column}` = {$values[$k]}";
			} else {
				$value = mysqli_real_escape_string($this->link,$values[$k]);
				$sql .= "`{$column}` = '{$value}'";
			}
		}
		$sql .= " WHERE $conditions";
		return $sql;
	}

	function select_for_reporting($sql) {

		$records = array();
		if($sql != ''){
			$this ->query($sql);
			if($this->valid_resource && ($this->num_rows > 0)){
				return true;
			}else{
				return false;
			}
		}
		return $records;
	}

}
