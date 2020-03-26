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
* @copyright  &copy; 2018-onwards G J Barnard.
* @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
*/
namespace theme_monoid\output;

class core_renderer extends \theme_boost\output\core_renderer {

    /**
    * Overriden wrapper for header elements.
    *
    * @return string HTML to display the main header.
    */
    public function full_header() {
        global $PAGE;

        $header = new \stdClass();
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->contextheader = $this->context_header();
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();

        // Here we change the header template to use theme_monoid template
        return $this->render_from_template('theme_monoid/header', $header);
    }
}
