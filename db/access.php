<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'enrol/mercadopago:config' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => ['manager' => CAP_ALLOW],
    ],
];
