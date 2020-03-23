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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Custom CSS.
    $name = 'theme_monoid/customcss';
    $title = get_string('customcss', 'theme_monoid');
    $description = get_string('customcssdesc', 'theme_monoid');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Fonts sizes setting
    // default values
    $base = '1';
    $h1 = '3.5';
    $h2 = '3';
    $h3 = '2';
    $h4 = '1.75';
    $h5 = '1.5';
    $h6 = '1';

    $name = 'theme_monoid/fontsizes';
    $visiblename = get_string('fontsizes', 'theme_monoid');
    $description = get_string('fontsizesdesc', 'theme_monoid', array('base' => $base, 'h1' => $h1, 'h2' => $h2, 'h3' => $h3, 'h4' => $h4, 'h5' => $h5, 'h6' => $h6));
    $default = $base.PHP_EOL.$h1.PHP_EOL.$h2.PHP_EOL.$h3.PHP_EOL.$h4.PHP_EOL.$h5.PHP_EOL.$h6;
    $cols = 7;
    $rows = 8;
    $setting = new theme_monoid_admin_setting_configfontsizes($name, $visiblename, $description, $default, $cols, $rows);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);
}
