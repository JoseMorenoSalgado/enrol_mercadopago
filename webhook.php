<?php
define('AJAX_SCRIPT', true);
require('../../config.php');

$input = json_decode(file_get_contents('php://input'), true);

$paymentid = $input['data']['id'] ?? null;
if (!$paymentid) {
    http_response_code(400);
    exit;
}

$access_token = get_config('enrol_mercadopago', 'access_token');
$curl = new curl();

$response = $curl->get("https://api.mercadopago.com/v1/payments/$paymentid?access_token=$access_token");

$data = json_decode($response);

if ($data->status === 'approved') {
    list($courseid, $userid, $enrolid) = explode('-', $data->external_reference);

    $plugin = enrol_get_plugin('mercadopago');
    $instance = $DB->get_record('enrol', ['id' => $enrolid]);

    if ($instance && !$plugin->is_enrolled($instance->courseid, $userid)) {
        $plugin->enrol_user($instance, $userid, $instance->roleid, time());
    }

    $DB->insert_record('enrol_mercadopago', [
        'userid' => $userid,
        'courseid' => $courseid,
        'transactionid' => $paymentid,
        'status' => $data->status,
        'amount' => $data->transaction_amount,
        'timecreated' => time(),
    ]);
}
