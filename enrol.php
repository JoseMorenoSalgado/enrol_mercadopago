<?php
defined('MOODLE_INTERNAL') || die();

class enrol_mercadopago_plugin extends enrol_plugin {

    public function get_coursemodule_info($coursemodule) {
        return null;
    }

    public function enrol_page_hook(stdClass $instance) {
        global $OUTPUT, $USER;

        $courseid = $instance->courseid;
        $userid = $USER->id;

        $paymenturl = new moodle_url('/enrol/mercadopago/pay.php', [
            'id' => $instance->id,
            'userid' => $userid,
            'courseid' => $courseid,
        ]);

        $renderable = new \enrol_mercadopago\output\enrol_button(
            $paymenturl->out(),
            get_string('message', 'enrol_mercadopago'),
            get_string('paybutton', 'enrol_mercadopago')
        );
        return $OUTPUT->render($renderable);
    }
}
