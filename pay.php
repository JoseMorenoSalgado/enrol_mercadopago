<?php
require('../../config.php');

$id = required_param('id', PARAM_INT); // ID de enrol instance
$userid = required_param('userid', PARAM_INT);
$courseid = required_param('courseid', PARAM_INT);

require_login();

$mode = get_config('enrol_mercadopago', 'mode');
$access_token = get_config('enrol_mercadopago', 'access_token');
$currency = get_config('enrol_mercadopago', 'currency');

if ($mode === 'sandbox') {
    $api_url = 'https://api.mercadopago.com/checkout/preferences?access_token=' . $access_token;
} else {
    $api_url = 'https://api.mercadopago.com/checkout/preferences?access_token=' . $access_token;
}

$curl = new curl();

$preference = [
    'items' => [[
        'title' => 'Inscripción al curso',
        'quantity' => 1,
        'unit_price' => 10.00,
        'currency_id' => $currency,
    ]],
    'payer' => [
        'email' => $USER->email
    ],
    'notification_url' => $CFG->wwwroot . '/enrol/mercadopago/webhook.php',
    'external_reference' => "$courseid-$userid-$id"
];

$headers = ['Content-Type: application/json'];

$response = $curl->post($api_url, json_encode($preference), $headers);

$data = json_decode($response);

if (!empty($data->init_point)) {
    redirect($data->init_point);
} else {
    print_error('No se pudo generar la preferencia de pago.');
}
