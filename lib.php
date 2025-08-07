<?php
defined('MOODLE_INTERNAL') || die();

function enrol_mercadopago_supports($feature) {
    switch ($feature) {
        case FEATURE_ENROL_HAS_COURSE_LEVEL_SETTINGS: return true;
        default: return null;
    }
}
