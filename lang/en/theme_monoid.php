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
 * Monoid theme.
 *
 * @package    theme_monoid
 * @copyright  &copy; 2019-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

$string['choosereadme'] = '
<div class="clearfix">
<h2>Monoid</h2>
<h3>About</h3>
<p>Monoid is a basic child theme of the Boost theme.</p>
<h3>Theme Credits</h3>
<p>Author: G J Barnard<br>
Contact: <a href="http://moodle.org/user/profile.php?id=442195">Moodle profile</a><br>
Website: <a href="http://about.me/gjbarnard">about.me/gjbarnard</a>
</p>
<h3>More information</h3>
<p><a href="monoid/Readme.md">How to use this theme.</a></p>
</div></div>';

$string['configtitle'] = 'Monoid';
$string['pluginname'] = 'Monoid';

$string['region-side-pre'] = 'Left';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = 'Add custom CSS to the theme.';

$string['fontsizes'] = 'Headings and body font sizes';
$string['fontsizesdesc'] = 'Set the base font size and heading multiplers.  Defaults of base: {$a->base}, h1: {$a->h1}, h2: {$a->h2}, h3: {$a->h3}, h4: {$a->h4}, h5: {$a->h5} and h6: {$a->h6}.';

$string['fontsizeslabel'] = 'body<br>h1<br>h2<br>h3<br>h4<br>h5<br>h6';
$string['fontsizeserror'] = 'Each line must have a value. The line value must be lower than the previous line';

// min value
$string['minwidthvalue'] = 'Min range value';
$string['minwidthvaluedesc'] = 'Minimun allowed value to especify widths';

// max value
$string['maxwidthvalue'] = 'Max range value';
$string['maxwidthvaluedesc'] = 'Maximun allowed value to especify widths';

// Range to validate min and max values for widths
$string['notinrange'] = 'The size you introduced is not between [number and number]';

// Blocks column width
$string['blockswidth'] = 'Blocks column width';
$string['blockswidthdesc'] = 'Width in pixels of the blocks column in the right';

// Drawer width
$string['drawerwidth'] = 'Drawer width';
$string['drawerwidthdesc'] = 'Width in pixels of the drawer in the left';

// For javascript modules
$string['serverdatetimebutton'] = 'My date and time is: ';

$string['searchincoursebtnt'] = 'Search!';
$string['searchincourseinputplaceholder'] = 'Type your search';

// Privacy.
$string['privacy:nop'] = 'The Monoid theme stores has settings that pertain to its configuration.  It also may inherit settings and user preferences from the parent Boost theme, please examine the \'Plugin privacy compliance registry\' for \'Boost\' for details.  For the settings, it is your responsibility to ensure that no user data is entered in any of the free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the themes control, please see the core logging system for privacy compliance for this.  When uploading images, you should avoid uploading images with embedded location data (EXIF GPS) included or other such personal data.  It would be possible to extract any location / personal data from the images.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the theme forthwith.';
