<?php
global $CFG;
require_once("{$CFG->libdir}/formslib.php");


class simplehtml_form extends moodleform
{

    function definition()
    {

        $mform =& $this->_form;

        $mform->addElement('text', 'a', "Введите А", 'maxlength="5" size="40"');
        $mform->addRule('a', null, 'numeric', 'required', 'client');
        $mform->addHelpButton('a', 'a', 'Введите А');

        $mform->addElement('text', 'b', 'Введите B', 'maxlength="5" size="40"');
        $mform->addRule('b', null, 'numeric', 'required', 'client');
        $mform->addHelpButton('b', 'b', 'Введите B');

        $mform->addElement('text', 'c', 'Введите C', 'maxlength="5" size="40"');
        $mform->addRule('c', null, 'numeric', 'required', 'client');
        $mform->addHelpButton('c', 'c', 'Введите C');

        $buttonarray = array();
        $buttonarray[] =& $mform->createElement('submit', 'submitbutton', 'submit');
        $buttonarray[] =& $mform->createElement('reset', 'resetbutton', 'Reset');
        $mform->addGroup($buttonarray, 'buttonar', ' ', ' ', false);


    }


    function validation($data)
    {
        $errors = array();
        if (!is_numeric($data['a'])) {
            $errors['a'] = 'invalid A';
        } else if (!is_numeric($data['b'])) {
            $errors['b'] = 'invalid B';
        } else if (!is_numeric($data['c'])) {
            $errors['c'] = 'invalid C';
        } else if ($data['a'] == 0) {
            $errors['a'] = 'Уравнение не квадратное! А не может быть = 0';
        }
        return $errors;
    }


}