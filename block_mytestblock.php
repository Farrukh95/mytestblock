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
class block_mytestblock extends block_base
{

    function init()
    {
        $this->title = get_string('pluginname', 'block_mytestblock');
    }


    function get_content()
    {

        if ($this->content !== NULL) {
            return $this->content;
        }
        $form = "<h4>a * x<sup>2</sup> + b * x + с = 0</h4>";
        $form .= "<form action='' method='post'>";
        $form .= "  <p>Введите a: <input required type='number' name='a'></p>";
        $form .= "  <p>Введите b: <input required type='number' name='b'></p>";
        $form .= "  <p>Введите c: <input required type='number' name='c' value='0'></p>";
        $form .= "  <input type='submit' name='sub'>";
        $form .= "  <input type='reset'>";
        $form .= "</form>";

        $this->content = new stdClass;
        $this->content->text = $form;

        if (isset($_POST['sub'])) {
            if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c'])) {
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $this->content->footer .= "Уравнение: $a * x² + ($b) * x + $c = 0; \n";

                if (!isset($a) or !isset($b) or !isset($c)) {
                    $this->content->footer .= "Пожалуйста, введите все значения выше!";
                } elseif ($a == 0) {
                    $this->content->footer .= "Ответ: Уравнение не квадратное! \n";
                } else {

                    $d = (pow($b, 2)) - (4 * $a * $c);

                    if ($d < 0) {
                        $this->content->footer .= "Корней нет \n";
                    } elseif ($d > 0) {
                        $x1 = round((($b * -1) + sqrt(pow($b, 2) - 4 * $a * $c)) / (2 * $a), 3);
                        $x2 = round((($b * -1) - sqrt(pow($b, 2) - 4 * $a * $c)) / (2 * $a), 3);
                        $this->content->footer .= "Ответ: x1 = $x1, x2 = $x2 \n";
                    } elseif ($d == 0) {
                        $x = round((($b * -1) + sqrt(pow($b, 2) - 4 * $a * $c)) / (2 * $a), 3);
                        $this->content->footer .= "Ответ: x = $x \n";
                    }
                }

            }
        }
        $file = $_SERVER['DOCUMENT_ROOT'] . '/blocks/mytestblock/hist/history.txt';
        file_put_contents($file, $this->content->footer, FILE_APPEND | LOCK_EX);
        return $this->content;

    }


}
