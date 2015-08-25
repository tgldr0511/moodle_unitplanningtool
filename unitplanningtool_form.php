<?php

require_once("{$CFG->libdir}/formslib.php");
class unitplanningtool_form extends moodleform {
 
    function definition() {
 
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', "Department Summary of courses");
    }
}