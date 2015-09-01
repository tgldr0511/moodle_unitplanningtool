<?php
function xmldb_block_unitplanningtool_upgrade($oldversion = 0) {
    global $CFG;
    global $DB;
    $dbman = $DB->get_manager();
    $result = TRUE;     
    if ($oldversion < 2015080700) {
        // Define table block_unitplanningtool to be created.
        $table = new xmldb_table('block_unitplanningtool');

        // Adding fields to table block_unitplanningtool.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('course_fullname', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('course_teacher', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('course_credit', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);
$field = new xmldb_field('course_credit', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'course_teacher');
        // Adding keys to table block_unitplanningtool.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for block_unitplanningtool.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Unitplanningtool savepoint reached.
        upgrade_block_savepoint(true, 2015080700, 'unitplanningtool');
    }
    return $result;
}