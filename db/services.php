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
 * Web service definitions for the catquizcentralhub_client subplugin.
 *
 * @package catquizcentralhub_client
 * @category external
 * @copyright 2024 Wunderbyte GmbH (info@wunderbyte.at)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$services = [
    'CatQuiz Client Service' => [
        'functions' => [
            'catquizcentralhub_client_submit_responses',
            'catquizcentralhub_client_fetch_parameters',
        ],
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => 'catquizcentralhub_client_service',
        'downloadfiles' => 0,
        'uploadfiles' => 0,
    ],
];

$functions = [
    'catquizcentralhub_client_submit_responses' => [
        'classname' => 'catquizcentralhub_client\\external\\submit_responses',
        'methodname' => 'execute',
        'description' => 'Submit responses for a given scale ID to the central hub.',
        'type' => 'write',
        'capabilities' => 'moodle/site:config',
        'ajax' => true,
    ],
    'catquizcentralhub_client_fetch_parameters' => [
        'classname' => 'catquizcentralhub_client\\external\\fetch_parameters',
        'methodname' => 'execute',
        'description' => 'Fetch calculated item parameters from the central hub.',
        'type' => 'write',
        'capabilities' => 'moodle/site:config',
        'ajax' => true,
    ],
];
