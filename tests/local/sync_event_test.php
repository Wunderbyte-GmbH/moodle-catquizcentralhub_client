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
 * Tests for the sync_event class.
 *
 * @package    catquizcentralhub_client
 * @copyright  2024 Wunderbyte GmbH <info@wunderbyte.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace catquizcentralhub_client\local;

use advanced_testcase;

/**
 * Tests for sync_event.
 *
 * @package    catquizcentralhub_client
 * @covers     \catquizcentralhub_client\local\sync_event
 */
final class sync_event_test extends advanced_testcase {
    /** @var int admin user ID */
    private int $adminid;

    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
        $this->setAdminUser();
        global $USER;
        $this->adminid = $USER->id;
    }

    public function test_save_inserts_record_into_sync_event_table(): void {
        global $DB;
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 5);
        $event->save();
        $this->assertSame(1, $DB->count_records('local_catquiz_sync_event'));
    }

    public function test_save_stores_correct_contextid(): void {
        global $DB;
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 5);
        $event->save();
        $record = $DB->get_record('local_catquiz_sync_event', ['contextid' => $contextid]);
        $this->assertNotFalse($record);
        $this->assertEquals($contextid, $record->contextid);
    }

    public function test_save_stores_correct_catscaleid(): void {
        global $DB;
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 5);
        $event->save();
        $record = $DB->get_record('local_catquiz_sync_event', ['contextid' => $contextid]);
        $this->assertEquals($scaleid, $record->catscaleid);
    }

    public function test_save_stores_num_fetched_params(): void {
        global $DB;
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 42);
        $event->save();
        $record = $DB->get_record('local_catquiz_sync_event', ['contextid' => $contextid]);
        $this->assertSame(42, (int) $record->num_fetched_params);
    }

    public function test_save_stores_current_user(): void {
        global $DB;
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 5);
        $event->save();
        $record = $DB->get_record('local_catquiz_sync_event', ['contextid' => $contextid]);
        $this->assertEquals($this->adminid, $record->userid);
    }

    public function test_saved_event_is_retrievable_by_catquiz(): void {
        ['contextid' => $contextid, 'scaleid' => $scaleid] = $this->create_context_and_scale();
        $event = new sync_event($contextid, $scaleid, 3);
        $event->save();
        $repo = new \local_catquiz\catquiz();
        $result = $repo->get_last_synced_context_id($scaleid);
        $this->assertEquals($contextid, $result);
    }

    /**
     * Creates a catcontext and catscale record and returns both IDs.
     *
     * @return array{contextid: int, scaleid: int}
     */
    private function create_context_and_scale(): array {
        global $DB;
        $contextid = $DB->insert_record('local_catquiz_catcontext', (object) [
            'name' => 'Test Context',
            'usermodified' => $this->adminid,
            'timecreated' => time(),
            'timemodified' => time(),
            'timecalculated' => 0,
        ]);
        $scaleid = $DB->insert_record('local_catquiz_catscales', (object) [
            'name' => 'Test Scale',
            'label' => 'testscale',
            'parentid' => 0,
            'contextid' => $contextid,
            'timecreated' => time(),
            'timemodified' => time(),
        ]);
        return ['contextid' => $contextid, 'scaleid' => $scaleid];
    }
}
