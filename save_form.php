<?php
require_once('../../config.php');
require_once('unitplanningtool_form.php');
global $DB;

if(!empty($_GET['course_array'])) {
    foreach($_GET['course_array'] as $course) {
            $sql = "SELECT c.fullname, u.firstname, u.lastname FROM {course} AS c JOIN {context} AS ctx ON c.id = ctx.instanceid JOIN {role_assignments} AS ra ON ra.contextid = ctx.id JOIN {user} AS u ON u.id = ra.userid WHERE c.id=".$course;
            $coursequery = $DB->get_records_sql($sql);
            foreach($coursequery as $key => $val){
            	print_r($val);
            	$record = new stdClass();
            	$record->course_id = $course;
				$record->course_teacher = $val->lastname." " .$val->firstname;	
				$record->course_fullname = $val->fullname;
				$lastinsertid = $DB->insert_record('block_unitplanningtool', $record, false);
        	}

    }
    header("Location: http://localhost/moodle/blocks/unitplanningtool/viewsaved.php");
}