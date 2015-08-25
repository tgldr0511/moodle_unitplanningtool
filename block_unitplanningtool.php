<?php 
global $COURSE;
class block_unitplanningtool extends block_list {
	public function init(){
		$this->title = get_string('unitplanningtool', 'block_unitplanningtool');
	}
	public function get_content() {
    if ($this->content !== null) {
      return $this->content;
    }
 
    $this->content         =  new stdClass;
    $this->content->text   = 'The content of our block!';
    $url = new moodle_url('/blocks/unitplanningtool/view.php', array('id' => '3'));
    $url2 = new moodle_url('/blocks/unitplanningtool/viewhistory.php', array('id' => '3'));
    $url3 = new moodle_url('/blocks/unitplanningtool/viewsaved.php');
    $this->content->footer = html_writer::link($url, 'Main tool');
    $this->content->footer .= html_writer::tag('br', '');
    $this->content->footer .= html_writer::link($url2, 'Course History');
    $this->content->footer .= html_writer::tag('br', '');
    $this->content->footer .= html_writer::link($url3, 'Saved Courses');
 //get_string('addpage', 'block_unitplanningtool')
    return $this->content;
  }
}