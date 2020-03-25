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
 * Text input with a maximum length constraint
 *
 * @copyright 2015 onwards Ankit Agarwal, adapted for monoid by David OC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_monoid_admin_setting_widths extends admin_setting_configtext_with_maxlength {

    /** @var int maximum number of chars allowed. */
    protected $maxlength;

    /**
     * Config text constructor
     *
     * @param string $name unique ascii name, either 'mysetting' for settings that in config,
     *                     or 'myplugin/mysetting' for ones in config_plugins.
     * @param string $visiblename localised
     * @param string $description long localised info
     * @param string $defaultsetting
     * @param mixed $paramtype int means PARAM_XXX type, string is a allowed format in regex
     * @param int $size default field size
     * @param mixed $maxlength int maxlength allowed, 0 for infinite.
     */
    public function __construct($name, $visiblename, $description, $defaultsetting, $minvalue, $maxvalue, $paramtype=PARAM_INT, $size=null, $maxlength = 4) {
        parent::__construct($name, $visiblename, $description, $defaultsetting, $paramtype, $size);
        $this->minvalue = $minvalue;
        $this->maxvalue = $maxvalue;
        $this->maxlength = $maxlength;
    }

    /**
     * Validate data before storage
     *
     * @param string $data data
     * @return mixed true if ok string if error found
     */
    public function validate($data) {
        $parentvalidation = parent::validate($data);
        if ($parentvalidation === true && $data != '') {
            if ($this->maxlength > 0) {
                // Max length check.
                $length = core_text::strlen($data);
                if ($length > $this->maxlength) {
                    return get_string('maximumchars', 'moodle',  $this->maxlength);
                } elseif ((int)$data < $this->minvalue || (int) $data > $this->maxvalue) {
                    return get_string('notinrange', 'theme_monoid');
                } else {
                    return true;
                }
            } else {
                return true; // No max length check needed.
            }
        } else {
            return $parentvalidation;
        }
    }
}
