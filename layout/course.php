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
 * A course layout for the monoid theme theme.
 *
 * @package   theme_monoid
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Detect server date time AJAX call.
$sdt = \optional_param('sdt', false, PARAM_BOOL);
if ($sdt) {
    \require_sesskey();

    header('HTTP/1.1 200 OK');
    header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
    header('Content-Type: text/plain; charset=utf-8');
    echo strftime('%d/%m/%Y %H:%M:%S');

    die();
}

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();

// js
$serverdatetime = strftime('%d/%m/%Y %H:%M:%S');
$courseurl = new \moodle_url('/course/view.php');
$courseurl->param('id', $PAGE->course->id);
$courseurl->param('sdt', true);
$courseurl->param('sesskey', sesskey());
$PAGE->requires->js_call_amd('theme_monoid/serverdatetime', 'init', array('data' => array('courseurl' => $courseurl->out(false))));

// search incourse button
$PAGE->requires->js_call_amd('theme_monoid/searchincourse', 'init', array('data' => ['button' => '#searchincoursebtn', 'input' => '#searchincourseinput']));

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'serverdatetime' => $serverdatetime
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_monoid/course', $templatecontext);
