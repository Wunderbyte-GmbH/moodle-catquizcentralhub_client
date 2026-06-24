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
 * Class representing a sync event (syncing a local CAT scale with a central hub).
 *
 * @package catquizcentralhub_client
 * @copyright 2024 Wunderbyte GmbH <info@wunderbyte.at>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace catquizcentralhub_client\local;

use catquizcentralhub_client\repository\sync_repository;
use stdClass;

/**
 * Holds a single sync event (parameter import from the central hub).
 */
class sync_event {
    /** @var int The context ID where this sync event occurs */
    private int $contextid;

    /** @var int The ID of the CAT scale being synced */
    private int $catscaleid;

    /** @var int Number of parameters fetched during sync */
    private int $numfetchedparams;

    /** @var int The ID of the user performing the sync */
    private int $userid;

    /**
     * Creates a new sync event.
     *
     * @param int $contextid The context ID where this sync event occurs
     * @param int $catscaleid The ID of the CAT scale being synced
     * @param int $numfetchedparams Number of parameters fetched during sync
     */
    public function __construct(
        int $contextid,
        int $catscaleid,
        int $numfetchedparams
    ) {
        global $USER;
        $this->userid = $USER->id;
        $this->contextid = $contextid;
        $this->catscaleid = $catscaleid;
        $this->numfetchedparams = $numfetchedparams;
    }

    /**
     * Saves this sync event to the database.
     */
    public function save() {
        sync_repository::save_sync_event($this->as_record());
    }

    /**
     * Converts this sync event to a database record.
     *
     * @return stdClass
     */
    private function as_record(): stdClass {
        return (object) [
            'contextid' => $this->contextid,
            'catscaleid' => $this->catscaleid,
            'num_fetched_params' => $this->numfetchedparams,
            'userid' => $this->userid,
        ];
    }
}
