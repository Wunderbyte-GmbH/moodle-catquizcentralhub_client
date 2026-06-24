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
 * German language strings for catquizcentralhub_client.
 *
 * @package     catquizcentralhub_client
 * @copyright   2024 Wunderbyte GmbH <info@wunderbyte.at>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$string['centralhost'] = 'Recheninstanz';
$string['centralhostdesc'] = 'Der Host, der die Parameterberechnungen durchführt, z. B. https://www.example.com';
$string['centraltoken'] = 'Zugriffstoken für die Recheninstanz';
$string['centraltokendesc'] = 'Das Token, das für Sie auf der Recheninstanz erstellt wurde';
$string['enablesyncasnode'] = 'Synchronisation mit Hub erlauben';
$string['enablesyncasnodedesc'] = 'Wenn aktiviert, kann diese Instanz Antwortdaten an einen zentralen Hub übermitteln und berechnete Item-Parameter importieren.';
$string['fetchempty'] = 'Parameter sind aktuell';
$string['fetchparamheading'] = 'Parameter werden von {$a} abgerufen';
$string['fetchsuccess'] = '{$a->num} Parameter wurden erfolgreich im neuen Kontext "{$a->contextname}" gespeichert';
$string['invalidresponse'] = 'Ungültige Antwort von der zentralen Instanz erhalten.';
$string['missing_scale_label'] = 'Die ausgewählte Skala hat keine zugeordnete Bezeichnung';
$string['nocentralconfig'] = 'Konfiguration der zentralen Instanz fehlt. Bitte konfigurieren Sie Host und Token in den Plugin-Einstellungen.';
$string['nodescalelabels'] = 'Zu synchronisierende Skalenbezeichnungen';
$string['nodescalelabelsdesc'] = 'Geben Sie pro Zeile eine Skalenbezeichnung ein. Nur diese Skalen werden an den zentralen Hub übermittelt.';
$string['nolocalmappingforscale'] = 'Keine Skala mit der Bezeichnung "{$a->remotelabel}" auf der lokalen Instanz gefunden';
$string['nonewresponses'] = 'Es gibt keine neuen Antworten zum Teilen';
$string['noquestionhashmatch'] = 'Keine passende Frage für den Hash gefunden';
$string['pluginname'] = 'CatQuiz Zentraler Hub (Client)';
$string['responses_submitted'] = 'Neue Antworten wurden geteilt';
$string['responses_submitted_desc'] = 'Neue Antworten wurden mit der zentralen Recheninstanz {$a->centralhost} geteilt. {$a->added} neue '
    . 'Antworten wurden hinzugefügt, {$a->skipped} übersprungen und {$a->errors} Fehler sind aufgetreten';
$string['scalehasnolabel'] = 'Die Skala hat keine Bezeichnung';
$string['scalenotfound'] = 'Skala nicht gefunden';
$string['skipsslverification'] = 'SSL-Verifizierung überspringen';
$string['skipsslverificationdesc'] = 'SSL-Zertifikatsprüfung beim Verbinden mit dem zentralen Hub deaktivieren. Nur für Entwicklungs- oder Testumgebungen aktivieren.';
$string['submission_error'] = 'Fehler beim Übermitteln der Antworten: {$a}';
$string['submission_success'] = '{$a->total} Antworten wurden erfolgreich übermittelt. {$a->added} neue Antworten wurden hinzugefügt und {$a->skipped} übersprungen.';
$string['submit_responses'] = 'Antworten an die zentrale Instanz übermitteln';
$string['submitresponsescheduled'] = 'Antworten an zentralen Hub übermitteln (geplant)';
$string['unknownerror'] = 'Ein unbekannter Fehler ist aufgetreten';
