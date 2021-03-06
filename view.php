<?php
global $DB, $OUTPUT, $PAGE;
require_once('../../config.php');
require_once('unitplanningtool_form.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/blocks/unitplanningtool/view.php');
$PAGE->requires->js('/blocks/unitplanningtool/js/jquery-2.1.4.min.js',true);
$PAGE->requires->js('/blocks/unitplanningtool/js/jquery.tablesorter.min.js',true);
$PAGE->requires->js('/blocks/unitplanningtool/js/final.js',true);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading("Unit Planning Tool");
$settingsnode = $PAGE->settingsnav->add("UnitPlanningTool");
$editurl = new moodle_url('/blocks/unitplanningtool/view.php', array('id' => '3'));
$editurl2 = new moodle_url('/blocks/unitplanningtool/viewhistory.php', array('id' => '3'));
$editnode = $settingsnode->add("Department Summary", $editurl);
$editnode = $settingsnode->add("Course History", $editurl2);
$editnode->make_active();
$unitplanningtool = new unitplanningtool_form();
$display = $OUTPUT->heading("Unit Planning Tool");
// Syntax for count: SELECT COUNT(column_name) FROM table_name;
$dep_id = htmlspecialchars($_GET['id']);
$sql = "SELECT c.id, c.shortname, c.idnumber, c.fullname, u.firstname, u.lastname, u.deleted FROM {course} AS c JOIN {context} AS ctx 
ON c.id = ctx.instanceid JOIN {role_assignments} AS ra ON ra.contextid = ctx.id JOIN {user} AS u ON u.id = ra.userid WHERE ra.roleid =3 AND c.category=";
$sql.= $dep_id;
$sql.=" AND ctx.instanceid = c.id ORDER BY c.shortname ASC";
$customquery = $DB->get_records_sql($sql);
$studentsql = "SELECT course.id, COUNT(course.id) AS Students FROM mdl_role_assignments AS asg JOIN mdl_context AS context 
ON asg.contextid = context.id AND context.contextlevel = 50 JOIN mdl_user AS USER ON USER.id = asg.userid JOIN mdl_course AS course ON context.instanceid = course.id WHERE asg.roleid = 5 AND course.category = ";
$studentsql .= $dep_id;
$studentsql .= " GROUP BY course.id";
$studentquery = $DB->get_records_sql($studentsql);
echo $OUTPUT->header();
$unitplanningtool->display();
// initialize the table
	echo "Department: ";
    echo "<select id='id_department' name='department'>
    	<option> Navigate to </option>
    	<option value='3'>Athletics</option>
    	<option value='4'>Art</option>
    	<option value='6'>Biology</option>
    	<option value='7'>Chemistry</option>
    	<option value='8'>Computer Science</option>
    	<option value='9'>Economics</option>
    	<option value='10'>English</option>
    	<option value='11'>German Lan. & Lit.</option>
    	<option value='12'>Hum Dev. & Social Relations</option>
    	<option value='13'>Japanese Lan. & Lit.</option>
    	<option value='14'> Journalism</option>
    	<option value='15'> International Studies</option>
    	<option value='16'>Business & Nonprofit</option>
    	<option value='17'>Mathematics</option>
    	<option value='18'>Physics</option>
    	<option value='19'>Psychology</option>
    	<option value='20'>Spanish and Hispanic Studies</option>
    	<option value='21'>Music</option>
    	<option value='24'>History</option>
    	<option value='25'>Peace and global Studies</option>
    </select>";
echo "<table border='2' class='table tablesorter' id='myTable'>";
echo "<thead><tr><th>Select</th><th>Short name &#x25B2; &#x25BC;</th><th> Section ID</th><th>CRN</th><th>Course Title</th><th>Year | Semester</th><th>Credits</th><th>Teacher firstname</th><th>Teacher lastname</th><th># students</th></tr></thead>";
echo "<form action='save_form.php' method='get'>";
foreach($customquery as $key => $val){
	$CRN = explode(".", $val->idnumber);
	$short = explode("-", $val->shortname);
	$sectionid = substr($short[1], 0, 1);
	$yearsem = explode("(", $val->fullname);
	$yearc = explode(" ", substr($yearsem[1], 0, -1));
    $student_num = "-";
    if(array_key_exists($key, $studentquery)){
        $student_num = $studentquery[$key]->students;
    } 
	echo "<tr> <td><input type='checkbox' name='course_array[]' value='".$val->id."'></td><td>"	. $short[0]. "</td><td>". $sectionid . "</td><td>". $CRN[0] . "</td><td>". $yearsem[0]. "</td><td>". $yearc[1]." " .$yearc[0]. "</td><td> 3 </td><td>". $val->firstname ."</td><td>". $val->lastname ."</td><td>". 
	$student_num."</td> </tr>";
}
// closing tags
echo "</table>";
echo "<a href='#' id='resetBut' class='btn btn-primary text-center' onclick='refreshPage()'> Reset Sort </a>";
echo "<input type='submit' value='Save Courses' class='btn btn-primary text-center'>";
echo "</form>";
echo $OUTPUT->footer();
?>