<?php
namespace enrol_mercadopago\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;

class enrol_button implements renderable, templatable {
    public $paymenturl;
    public $message;
    public $buttontext;

    public function __construct($paymenturl, $message, $buttontext) {
        $this->paymenturl = $paymenturl;
        $this->message = $message;
        $this->buttontext = $buttontext;
    }

    public function export_for_template(renderer_base $output) {
        return [
            'paymenturl' => $this->paymenturl,
            'message' => $this->message,
            'buttontext' => $this->buttontext,
        ];
    }
}
