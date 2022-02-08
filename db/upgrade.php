<?php

function xmldb_block_mytestblock_upgrade($oldversion)
{
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2020061980) {

        // Define table block_mytestblock to be created.
        $table = new xmldb_table('block_mytestblock');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('a', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('b', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('c', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('d', XMLDB_TYPE_FLOAT, '10, 3', null, XMLDB_NOTNULL, null, null);
        $table->add_field('x1', XMLDB_TYPE_FLOAT, '10, 3', null, XMLDB_NOTNULL, null, null);
        $table->add_field('x2', XMLDB_TYPE_FLOAT, '10, 3', null, XMLDB_NOTNULL, null, null);


        // Adding keys to table block_mytestblock.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Mytestblock savepoint reached.
        upgrade_block_savepoint(true, 2020061980, 'mytestblock');
    }

    return true;
}