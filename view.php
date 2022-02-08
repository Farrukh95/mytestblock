<?php
require_once(__DIR__ . '/../../config.php');
global $DB, $CFG, $OUTPUT, $PAGE;

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title('');
$PAGE->set_heading('История');
$PAGE->set_url($CFG->wwwroot . '/blocks/mytestblock/view.php');

echo $OUTPUT->header();
$records = $DB->get_records("block_mytestblock", array());
echo '<table style="text-align: center;" align="center" width="50%"  cellspacing="1" border="1">' . "\n";
echo '<tr style="text-align: center">
            <td colspan="2"><strong>А</strong></td>
            <td colspan="2"><strong>B</strong></td>
            <td colspan="2"><strong>C</strong></td>
            <td colspan="2"><strong>D</strong></td>
            <td colspan="2"><strong>X1</strong></td>
            <td colspan="2"><strong>X2</strong></td>
        </tr>' . "\n";

foreach ($records as $item) {
    echo '<tr>
               <td colspan="2" >' . $item->a . '</td>
               <td colspan="2" >' . $item->b . '</td>
               <td colspan="2" >' . $item->c . '</td>
               <td colspan="2" >' . $item->d . '</td>
               <td colspan="2" >' . $item->x1 . '</td>
               <td colspan="2" >' . $item->x2 . '</td>        
        </tr>' . "\n";
}

echo '</table>';
echo $OUTPUT->footer();

?>