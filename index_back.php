
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(isset($_GET['msg']) && trim($_GET['msg']) != '' ) {
   $msg = "?msg={$_GET['msg']}"; 
}
if(isset($_GET['id']) && trim($_GET['id']) != '' ) {
   $id = "&id={$_GET['id']}"; 
}
        
switch($_GET['action']) {
	case 'dashboard':
		$msg = '';
		if(isset($_GET['msg']) && trim($_GET['msg']) != '') {
			$msg = "?msg={$_GET['msg']}";
		}
		header("Location:dashboard.php$msg");
		break;
	case 'logout':
		header("Location:logout.php$msg");
		break;
	case 'list_school':
		header("Location:school_list.php$msg");
		break;
	case 'add_school':
		header("Location:add_school.php$msg");
		break;
	case 'list_school_category':
		header("Location:school_category_list.php$msg");
		break;
    case 'list_class':
		header("Location:class_list.php$msg");
		break;
    case 'list_designation':
		header("Location:designation_list.php$msg");
		break;
    case 'main_entry':
		header("Location:main_entry.php$msg");
		break;
    case 'main_list':
		header("Location:main_list.php$msg$id");
		break;
    case 'detail_entry':
                header("Location:main_info.php$msg$id");
		break;
    case 'report_details':
        header("Location:report_details.php$msg$id");
        break;
    case 'school_wise':
        header("Location:schoolwise.php");
	break;
        
	default:
		header("Location:school_list.php$msg");
}


