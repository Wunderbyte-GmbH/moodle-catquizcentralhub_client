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

namespace catquizcentralhub_client\repository;

use stdClass;

/**
 * Data access for sync events and context history.
 *
 * @package    catquizcentralhub_client
 * @copyright  2024 Wunderbyte GmbH
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_repository {
    /**
     * Get the context ID of the last sync event for the given scale.
     *
     * @param int $catscaleid
     * @return int|null
     */
    public static function get_last_synced_context_id(int $catscaleid): ?int {
        global $DB;

        $sql = "SELECT contextid
            FROM {local_catquiz_sync_event}
            WHERE catscaleid = :catscaleid
            ORDER BY id DESC
            LIMIT 1";

        $record = $DB->get_record_sql($sql, ['catscaleid' => $catscaleid]);
        return $record ? (int) $record->contextid : null;
    }

    /**
     * Save a sync event record.
     *
     * @param stdClass $data
     * @return void
     */
    public static function save_sync_event(stdClass $data): void {
        global $DB;
        $DB->insert_record('local_catquiz_sync_event', $data);
    }

    /**
     * Return context IDs from sync_event records between old and new context for a scale.
     *
     * @param int $catscaleid
     * @param int $oldcontextid
     * @param int $newcontextid
     * @return array
     */
    public static function get_intermediate_context_ids(int $catscaleid, int $oldcontextid, int $newcontextid): array {
        global $DB;

        $sql = "SELECT contextid
            FROM {local_catquiz_sync_event}
            WHERE catscaleid = :catscaleid
            AND contextid >= :oldcontextid
            AND contextid <= :newcontextid
            ORDER BY contextid";

        return $DB->get_fieldset_sql($sql, [
            'catscaleid' => $catscaleid,
            'oldcontextid' => $oldcontextid,
            'newcontextid' => $newcontextid,
        ]);
    }
}
