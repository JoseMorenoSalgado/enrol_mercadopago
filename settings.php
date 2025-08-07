<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configselect(
        'enrol_mercadopago/mode',
        get_string('mode', 'enrol_mercadopago'),
        get_string('mode_desc', 'enrol_mercadopago'),
        'sandbox',
        [
            'sandbox' => 'Sandbox',
            'production' => 'Producción'
        ]
    ));

    $settings->add(new admin_setting_configtext(
        'enrol_mercadopago/public_key',
        get_string('public_key', 'enrol_mercadopago'),
        get_string('public_key_desc', 'enrol_mercadopago'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'enrol_mercadopago/access_token',
        get_string('access_token', 'enrol_mercadopago'),
        get_string('access_token_desc', 'enrol_mercadopago'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configselect(
        'enrol_mercadopago/currency',
        get_string('currency', 'enrol_mercadopago'),
        get_string('currency_desc', 'enrol_mercadopago'),
        'USD',
        [
            'USD' => 'Dólares (USD)',
            'MXN' => 'Pesos Mexicanos (MXN)',
            'COP' => 'Pesos Colombianos (COP)',
            'ARS' => 'Pesos Argentinos (ARS)',
            'BRL' => 'Reales Brasileños (BRL)',
        ]
    ));
}
