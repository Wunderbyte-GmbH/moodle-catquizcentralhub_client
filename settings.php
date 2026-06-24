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
 * Settings for the catquizcentralhub_client plugin.
 *
 * @package    catquizcentralhub_client
 * @copyright  2024 Wunderbyte GmbH <info@wunderbyte.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {
        $settings->add(new admin_setting_configcheckbox(
            'catquizcentralhub_client/enable_sync_as_node',
            get_string('enablesyncasnode', 'catquizcentralhub_client'),
            get_string('enablesyncasnodedesc', 'catquizcentralhub_client'),
            false,
            PARAM_BOOL
        ));

        $settings->add(new admin_setting_configtext(
            'catquizcentralhub_client/central_host',
            get_string('centralhost', 'catquizcentralhub_client'),
            get_string('centralhostdesc', 'catquizcentralhub_client'),
            '',
            PARAM_TEXT
        ));
        $settings->hide_if(
            'catquizcentralhub_client/central_host',
            'catquizcentralhub_client/enable_sync_as_node',
            'notchecked',
            '0'
        );

        $settings->add(new admin_setting_configtext(
            'catquizcentralhub_client/central_token',
            get_string('centraltoken', 'catquizcentralhub_client'),
            get_string('centraltokendesc', 'catquizcentralhub_client'),
            '',
            PARAM_ALPHANUM
        ));
        $settings->hide_if(
            'catquizcentralhub_client/central_token',
            'catquizcentralhub_client/enable_sync_as_node',
            'notchecked',
            '0'
        );

        $settings->add(new admin_setting_configtextarea(
            'catquizcentralhub_client/node_scale_labels',
            get_string('nodescalelabels', 'catquizcentralhub_client'),
            get_string('nodescalelabelsdesc', 'catquizcentralhub_client'),
            '',
            PARAM_TEXT
        ));
        $settings->hide_if(
            'catquizcentralhub_client/node_scale_labels',
            'catquizcentralhub_client/enable_sync_as_node',
            'notchecked',
            '0'
        );

        $settings->add(new admin_setting_configcheckbox(
            'catquizcentralhub_client/skip_ssl_verification',
            get_string('skipsslverification', 'catquizcentralhub_client'),
            get_string('skipsslverificationdesc', 'catquizcentralhub_client'),
            false,
            PARAM_BOOL
        ));
        $settings->hide_if(
            'catquizcentralhub_client/skip_ssl_verification',
            'catquizcentralhub_client/enable_sync_as_node',
            'notchecked',
            '0'
        );
    }
}
