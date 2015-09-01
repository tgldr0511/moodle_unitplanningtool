<?php
require_once('../../config.php');
require_once('unitplanningtool_form.php');
global $DB, $OUTPUT, $PAGE, $COURSE;
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/blocks/unitplanningtool/viewsaved.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading("Unit Planning Tool");
$settingsnode = $PAGE->settingsnav->add("UnitPlanningTool");
$editurl = new moodle_url('/blocks/unitplanningtool/view.php', array('id' => '3'));
$editurl2 = new moodle_url('/blocks/unitplanningtool/viewhistory.php', array('id' => '3'));
$editurl3 = new moodle_url('/blocks/unitplanningtool/viewsaved.php');
$editnode = $settingsnode->add("Department Summary", $editurl);
$editnode = $settingsnode->add("Course History", $editurl2);
$editnode = $settingsnode->add("Saved Courses", $editurl3);
$editnode->make_active();
$unitplanningtool = new unitplanningtool_form();
$display = $OUTPUT->heading("Unit Planning Tool");

echo $OUTPUT->header();
$unitplanningtool->display();
echo "<h2> Saved Courses </h2>";
if ($savedcourses = $DB->get_records_sql('SELECT * FROM {block_unitplanningtool}')) {
	echo "<table class='table'><tr><th>Course ID </th><th> Course Name </th> <th> Instructor</th></tr>";
    foreach ($savedcourses as $savedcourse) {
        echo "<tr><td>". $savedcourse->course_id. "</td><td>".$savedcourse->course_fullname."</td><td>". $savedcourse->course_teacher;
        echo "</tr>";
    }
    echo "</table>";
}
echo $OUTPUT->footer();

?>