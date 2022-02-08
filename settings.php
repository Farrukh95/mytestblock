<?php
$settings->add(new admin_setting_heading(
    'headerconfig',
    get_string('headerconfig', 'block_mytestblock'),
    get_string('descconfig', 'block_mytestblock')
));

$settings->add(new admin_setting_configcheckbox(
    'mytestblock/Allow_HTML',
    get_string('labelallowhtml', 'block_mytestblock'),
    get_string('descallowhtml', 'block_mytestblock'),
    '0'
));