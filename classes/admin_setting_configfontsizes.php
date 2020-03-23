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


/**
* General text area to store 7 different font sizes in one setting.
*
* @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/
class theme_monoid_admin_setting_configfontsizes extends admin_setting_configtext {
    private $rows;
    private $cols;

    /**
    * @param string $name
    * @param string $visiblename
    * @param string $description
    * @param mixed $defaultsetting string or array
    * @param mixed $paramtype
    * @param string $cols The number of columns to make the editor
    * @param string $rows The number of rows to make the editor
    */
    public function __construct($name, $visiblename, $description, $defaultsetting, $cols, $rows) {
        $this->rows = $rows;
        $this->cols = $cols;
        parent::__construct($name, $visiblename, $description, $defaultsetting, PARAM_TEXT);
    }

    /**
    * Returns an XHTML string for the editor
    *
    * @param string $data
    * @param string $query
    * @return string XHTML string for the editor
    */
    public function output_html($data, $query='') {
        global $OUTPUT;

        $formdata = $this->encode_for_form($data);
        $default = $this->get_defaultsetting();
        $defaultinfo = $default;
        if (!is_null($default) and $default !== '') {
            $defaultinfo = "\n".$default;
        }

        $context = (object) [

            'id' => $this->get_id(),
            'name' => $this->get_full_name(),
            'value' => $formdata,
            'cols' => $this->cols,
            'rows' => $this->rows,
            'size' => $this->size,
            'forceltr' => $this->get_force_ltr()
        ];
        $element = $OUTPUT->render_from_template('theme_monoid/admin_setting_fontsizes', $context);
        $warning = '*';
        return format_admin_setting($this, $this->visiblename, $element, $this->description, true,
            $warning, $defaultinfo, $query);
    }

    /**
    * Validate data before storage
    * @param string data
    * @return mixed true if ok string if error found
    */
    public function validate($data) {
        // Validate using parent method, if ok validate that is a setting
        $validated = is_string(parent::validate($data))
            ? parent::validate($data) : $this->validate_format(self::decode_from_db($data));
        return $validated;
    }

    private function validate_format($data) {
        // trim the array if needed
        $settingsarray = array_filter($data);

        // no setting where introduced
        if (count($settingsarray) === 1 && $settingsarray[0] === '') {
            return true;
        }

        // settings introduced, so check enought settings and right order
        $enoughtsettings = count($settingsarray) === 7;
        $onlymultipliers = array_slice($settingsarray, 1);
        $rightorder = $this->inmutable_sort($onlymultipliers) === $onlymultipliers;

        $validated = $enoughtsettings && $rightorder ? true : get_string('fontsizeserror', 'theme_monoid');
        return $validated;
    }

    public function write_setting($data) {
        if ($data == '') {
            // use the default setting
            $data = $this->get_defaultsetting();
        }

        $data = $this->decode_from_form($data);

        return parent::write_setting($data);
    }

    // Helpers, TODO move to lib
    private function inmutable_sort($array) {
        $sorted = call_user_func(function ($data) {
            rsort($data);
            return $data;
        }, $array);
        return $sorted;
    }

    public static function decode_from_db($data) {
        return explode(',', $data);
    }

    public static function encode_for_form($data) {
        return implode(PHP_EOL, self::decode_from_db($data));
    }

    public static function decode_from_form($data) {
        return implode(',', explode(PHP_EOL, $data));
    }
}
