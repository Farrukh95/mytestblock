<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   block_mytestblock
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('simplehtml_form.php');


class block_mytestblock extends block_base
{

    function init()
    {
        $this->title = get_string('pluginname', 'block_mytestblock');
    }

//    function has_config()
//    {
//        return true;
//    }
//
//    public function hide_header()
//    {
//        return true;
//    }

    function get_content()
    {
        global $DB, $OUTPUT, $PAGE, $COURSE;
        if (!empty ($this->config->text)) {
            $this->content->text .= $this->config->text;
        }


        $this->content = new stdClass;

        $this->content->text .= '';
        $this->content->text .= "Уравнение: A*x² + B * x + C = 0";
        $mform = new simplehtml_form();

        $table = 'block_mytestblock';
        $courseurl = new moodle_url('/my/');

        //Form processing and displaying is done here
        if ($mform->is_cancelled()) {
            redirect($courseurl);
        } else if ($fromform = $mform->get_data()) {

            $a = $fromform->a;
            $b = $fromform->b;
            $c = $fromform->c;
            $d = (pow($b, 2)) - (4 * $a * $c);
            if ($d < 0) {
                $this->content->text .= $mform->render();
                $this->content->text .= "<p style='text-align: center; color: red'>Корней нет</p>";

            } elseif ($d > 0) {
                $x1 = round((-$b + sqrt($d)) / (2 * $a), 3);
                $x2 = round((-$b - sqrt($d)) / (2 * $a), 3);
            } elseif ($d == 0) {
                $x1 = (-$b + sqrt($d)) / (2 * $a);
            }

            $rows = array('a' => $a, 'b' => $b, 'c' => $c, 'd' => $d, 'x1' => $x1, 'x2' => $x2);

            $DB->insert_record($table, $rows);
            $courseurl = new moodle_url('/my/');
            redirect($courseurl);

        } else {
            // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
            // or on the first display of the form.
            //Set default data (if any)
            $mform->set_data($mform);
            //displays the form
            $this->content->text .= $mform->render();
        }


// The other code.

        $url = new moodle_url('/blocks/mytestblock/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
        $this->content->footer .= html_writer::link($url, 'Посмотреть историю');


        return $this->content;

    }
//
//    public function specialization()
//    {
//        if (isset($this->config)) {
//            if (empty($this->config->title)) {
//                $this->title = get_string('defaulttitle', 'block_mytestblock');
//            } else {
//                $this->title = $this->config->title;
//            }
//
//            if (empty($this->config->text)) {
//                $this->config->text = get_string('defaulttext', 'block_mytestblock');
//            }
//        }
//    }
//
//    public function html_attributes()
//    {
//        $attributes = parent::html_attributes(); // Get default values
//        $attributes['class'] .= ' block_' . $this->name(); // Append our class to class attribute
//        return $attributes;
//    }


}
