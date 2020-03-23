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
 * Not completely required in a child theme of Boost but here so we can add our own
 * SCSS easily.

 * @package    theme_monoid
 * @copyright  &copy; 2019-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot.'/theme/boost/lib.php');
require_once($CFG->dirroot.'/lib/adminlib.php');


/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_monoid_get_pre_scss($theme) {
    global $CFG;
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_pre_scss($boosttheme);
    $scss .= file_get_contents($CFG->dirroot . '/theme/monoid/scss/monoid_pre.scss');

    // Our setting is applied
    $sizes = theme_monoid_admin_setting_configfontsizes::decode_from_db($theme->settings->fontsizes);

    $scss .= '$font-size-base: '.trim($sizes[0]).'rem;';

    $scss .= '$h1-font-size: $font-size-base * '.trim($sizes[1]).';';
    $scss .= '$h2-font-size: $font-size-base * '.trim($sizes[2]).';';
    $scss .= '$h3-font-size: $font-size-base * '.trim($sizes[3]).';';
    $scss .= '$h4-font-size: $font-size-base * '.trim($sizes[4]).';';
    $scss .= '$h5-font-size: $font-size-base * '.trim($sizes[5]).';';
    $scss .= '$h6-font-size: $font-size-base * '.trim($sizes[6]).';';

    error_log($scss);

    return $scss;
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_monoid_get_main_scss_content($theme) {
    global $CFG;
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }

    if ($boosttheme->settings->preset == 'default.scss') {
       /* Use our own default.scss as the Boost default.scss redefines $theme-colors instead of merging with
           map-merge as shown in _variables.css.  The method 'theme_boost_get_main_scss_content()' only looks
           at the 'preset' setting.  If this changes then adapt.*/
            $scss .= file_get_contents($CFG->dirroot . '/theme/monoid/scss/preset-m/default.scss');
        } else {
            $scss = theme_boost_get_main_scss_content($boosttheme);
        }

    $scss .= file_get_contents($CFG->dirroot . '/theme/monoid/scss/monoid.scss');

    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_monoid_get_extra_scss($theme) {
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_extra_scss($boosttheme);

    return $scss;
}

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_monoid_process_css($css, $theme) {

    // Add any CSS processing here.

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_monoid_set_customcss($css, $customcss);

    return $css;
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_monoid_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
