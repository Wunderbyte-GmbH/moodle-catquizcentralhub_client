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

namespace catquizcentralhub_client\task;

use catquizcentralhub_client\client\response_submitter;
use core\task\scheduled_task;
use moodle_exception;

/**
 * Scheduled task to submit CAT quiz responses to the central hub.
 *
 * @package    catquizcentralhub_client
 * @copyright  2024 Wunderbyte GmbH <info@wunderbyte.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scheduled_submit_responses extends scheduled_task {
    /**
     * Returns the name of the scheduled task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('submitresponsescheduled', 'catquizcentralhub_client');
    }

    /**
     * Submits all pending local responses to the central hub.
     *
     * @return void
     */
    public function execute() {
        $config = get_config('catquizcentralhub_client');
        if (empty($config->central_host) || empty($config->central_token)) {
            throw new moodle_exception('nocentralconfig', 'catquizcentralhub_client');
        }

        if (!$labels = array_filter(explode("\n", $config->node_scale_labels ?? ''))) {
            mtrace('No active scales found - nothing to do.');
            return;
        }

        foreach ($labels as $label) {
            $submission = new response_submitter(
                $config->central_host,
                $config->central_token,
                trim($label)
            );
            $result = $submission->submit_responses();

            if ($result->success) {
                mtrace(get_string(
                    'submission_success',
                    'catquizcentralhub_client',
                    (object)[
                        'total' => $result->processed,
                        'added' => $result->added,
                        'skipped' => $result->skipped,
                    ]
                ));
            } else {
                mtrace(get_string('submission_error', 'catquizcentralhub_client', $result->error));
            }
        }

        mtrace('All responses submitted successfully.');
    }
}
